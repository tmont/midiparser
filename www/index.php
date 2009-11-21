<?php

	function connect() {
		global $config;
		$conn = mysql_connect($config['database']['host'], $config['database']['username'], $config['database']['password']);
		if (!$conn) {
			return false;
		}
		
		mysql_select_db('midiparser', $conn);
		return $conn;
	}
	
	function query($query) {
		global $conn, $includeDir;
		if (!$conn) {
			return false;
		}
		
		$result = mysql_query($query, $conn);
		if (!$result) {
			throw new Exception('Query failed: ' . $query .' (' . mysql_error($conn) . ')');
		}
		
		if (is_resource($result)) {
			require_once $includeDir . '/lib/RecordIterator.php';
			return new RecordIterator($result);
		}
		
		return $result;
	}
	
	function queryResult($query) {
		global $conn, $includeDir;
		if (!$conn) {
			return false;
		}
		
		$result = mysql_query($query, $conn);
		if (!$result) {
			throw new Exception('Query failed: ' . $query .' (' . mysql_error($conn) . ')');
		}
		
		if (mysql_num_rows($result) > 0) {
			return mysql_result($result, 0);
		}
		
		return false;
	}
	
	function escape($string) {
		return htmlentities($string, ENT_QUOTES, 'utf-8');
	}
	
	function prepare404(&$file, &$title, $delimiter) {
		header('HTTP/1.1 404 Not Found');
		
		global $includeDir;
		$file = $includeDir . '/404.html';
		$title = $delimiter . 'Not Found';
	}
	
	function createReport($midiFile, $fileName, $type) {
		global $config, $conn, $includeDir;
		
		if (!is_file($midiFile)) {
			throw new Exception('Invalid filename');
		}
		
		$type = ($type === 'html') ? 'html' : 'text';
		$hash = md5_file($midiFile);
		$query = '
			SELECT report_id FROM reports
			WHERE midi_file_hash=\'' . $hash . '\'
			AND report_type=\'' . mysql_real_escape_string($type, $conn) . '\'';
		
		$id = queryResult($query);
		if ($id) {
			//already been created, so use that one
			return $id;
		}
		
		//create the report
		$location = str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)) . '/' . $config['report']['dir'];
		$tempLocation =  $location . '/' . $hash .'_'. $type;
		if (!is_dir($tempLocation) && !mkdir($tempLocation)) {
			throw new Exception('Could not create directory');
		}
		
		require_once $includeDir . '/lib/Midi/bootstrap.php';
		
		$parser = new \Midi\Parsing\FileParser();
		$parser->load($midiFile);

		if ($type === 'html') {
			//limit is 50KB
			if (filesize($midiFile) > 50 * 1024) {
				throw new Exception('File too large, cannot exceed 50KB');
			}
			$formatter = new \Midi\Reporting\HtmlFormatter();
			$formatter->setMultiFile(true);
			$printer = new \Midi\Reporting\MultiFilePrinter($formatter, $parser, $tempLocation);
		} else {
			//limit is 100KB
			if (filesize($midiFile) > 100 * 1024) {
				throw new Exception('File too large, cannot exceed 100KB');
			}
			$formatter = new \Midi\Reporting\TextFormatter();
			$printer = new \Midi\Reporting\FilePrinter($formatter, $parser);
			$printer->setFile($tempLocation . '/index.html');
		}
		
		$printer->printAll();
		$printer = null;
		
		$ip = (string)@$_SERVER['REMOTE_ADDR'];
		$size = filesize($midiFile);
		$query = "
			INSERT INTO reports (
				ip,
				midi_filename,
				midi_file_hash,
				midi_file_size,
				report_type
			) VALUES (
				'$ip',
				'" . mysql_real_escape_string($fileName, $conn) . "',
				'$hash',
				$size,
				'$type'
			)";
			
		query($query);
		
		$id = queryResult('SELECT LAST_INSERT_ID()');
		if (is_dir($tempLocation)) {
			rename(realpath($tempLocation), realpath($location) . DIRECTORY_SEPARATOR . $id);
		}
		return $id;
	}
	
	session_start();

	$uri = trim($_SERVER['REQUEST_URI'], '/');
	$requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
	
	$uriSegments = explode('/', $uri, 2);
	@list($section, $page) = $uriSegments;
	
	if (empty($section)) {
		$section = 'news';
	}
	
	global $includeDir, $conn, $downloadDir, $config;
	$downloadDir = 'http://static.tommymontgomery.com/sites/phpmidiparser.com';
	$includeDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'include';
	$config = parse_ini_file($includeDir . '/meta/www.config', true);
	
	$title = '';
	$file = null;
	$delimiter = ' | ';
	$conn = connect();
	if (!$conn) {
		$section = 'error';
	}

	switch ($section) {
		case 'news':
		case 'quickstart':
		case 'contact':
		case 'resources':
		case 'statistics':
			if ($page !== null) {
				prepare404($file, $title, $delimiter);
			} else {
				$file = $includeDir . '/' . $section . '.php';
			}
			break;
		case 'demo':
			if ($page === null) {
				$file = $includeDir . '/demo.php';
			} else if ($page === 'and_we_die_young') {
				//demo
				$basename = ltrim(str_replace('demo/' . $page, '', $uri), '/');
				if (empty($basename)) {
					$basename = 'index.html';
				}
				
				$file = $includeDir . '/demo/' . $basename;
				
				if (!is_file($file)) {
					prepare404($file, $title, $delimiter);
				} else {
					switch (pathinfo($file, PATHINFO_EXTENSION)) {
						case 'css':
							header('Content-Type: text/css');
							break;
						case 'js':
							header('Content-Type: application/js');
							break;
					}
					require $file;
					exit;
				}
			} else if (preg_match('@^report(?:/(?<report_id>\d+))?$@', $page, $matches)) {
				//var_dump($matches); exit;
				if ($requestMethod === 'POST') {
					if (isset($matches['report_id'])) {
						//redirect to same page with GET request
						header('Location: /demo/' . $page);
						exit;
					} else {
						//create a new report
						if (!isset($_FILES['midi_file'], $_POST['report_type'])) {
							//form error, redirect back to demo page
							header('Location: /demo');
							exit;
						} else {
							try {
								$reportId = createReport($_FILES['midi_file']['tmp_name'], basename($_FILES['midi_file']['name']), $_POST['report_type']);
								header('Location: /demo/report/' . $reportId);
								exit;
							} catch (Exception $e) {
								//set errors in session for redirect
								$_SESSION['report-error'] = serialize($e);
								header('Location: /demo');
								exit;
							}
						}
					}
				} else if (isset($matches['report_id'])) {
					//show a previously created report
					$reportId = $matches['report_id'];
					
					$query = '
						SELECT * FROM reports
						WHERE report_id=' . $reportId;
					
					$row = query($query)->current();
					if (!is_array($row)) {
						prepare404($file, $title, $delimiter);
					} else {
						$title = $delimiter . 'Parse Report: ' . $row['midi_filename'];
						$file = $includeDir . '/report.php';
					}
				} else {
					prepare404($file, $title, $delimiter);
				}
			} else {
				prepare404($file, $title, $delimiter);
			}
			break;
		case 'error':
			$title = $delimiter . 'OH NOES!!';
			$file = $includeDir . '/error.html';
			break;
		case 'downloads':
			if ($page === null) {
				$file = $includeDir . '/downloads.php';
			} else {
				//trying to download something
				if ($page === 'latest') {
					$page = 'php-midi-library-1.0.163.tar.gz';
				}
				
				$download = $downloadDir . '/' . $page;
				
				$headers = get_headers($download, true);
				if (strpos($headers[0], '200 OK') === false) {
					prepare404($file, $title, $delimiter);
				} else {
					//store download data
					$ip = isset($_SERVER['REMOTE_ADDR']) ? substr($_SERVER['REMOTE_ADDR'], 0, 15) : 'unknown';
					if ($ip !== '127.0.0.1') {
						$query = '
							INSERT INTO downloads (
								ip,
								path
							)
							VALUES(
								\'' . mysql_real_escape_string($ip, $conn) . '\',
								\'' . mysql_real_escape_string($page, $conn) . '\'
							)';
						
						mysql_query($query, $conn);
					}
					
					$size = $headers['Content-Length'];
					header('Content-Length', $size);
					header('Content-Disposition: attachment; filename=' . basename($page));
					
					switch(pathinfo($download, PATHINFO_EXTENSION)) {
						case 'gz':
							header('Content-Type: application/x-tar-gz');
							break;
						case 'mid':
							header('Content-Type: audio/midi');
							break;
					}
					
					readfile($download);
					exit;
				}
			}
			break;
		case 'docs':
			switch ($page) {
				case null:
					$title = $delimiter . 'Documentation';
					$file = $includeDir . '/docs.php';
					break;
				case 'api':
				case 'coverage':
					$basename = ltrim(str_replace('docs/' . $page, '', $uri), '/');
					if (empty($basename)) {
						$basename = 'index.html';
					}
					
					$file = $includeDir . '/docs/' . $page . '/' . $basename;
					
					if (!is_file($file)) {
						prepare404($file, $title, $delimiter);
					} else if (substr($file, -4) === '.css') {
						header('Content-Type: text/css');
						require $file;
						exit;
					} else {
						require $file;
						exit;
					}
					break;
				case 'pdepend':
					if (count($uriSegments) > 2) {
						prepare404($file, $title, $delimiter);
					} else {
						$title = $delimiter . 'Dependencies';
						$file = $includeDir . '/docs/pdepend.php';
					}
					break;
				default:
					$title = $delimiter . 'Not Found';
					$file = $includeDir . '/404.html';
					break;
			}
			break;
		default:
			prepare404($file, $title, $delimiter);
			break;
	}
	
	if (empty($title)) {
		$title = $delimiter . ucfirst($section);
	}
	
	if (!is_file($file)) {
		$title = $delimiter . 'OH NOES!!';
		$file = $includeDir . '/error.html';
	}
	
	ob_start();
	require $file;
	$content = ob_get_clean();
	
	echo preg_replace(
		array('/@title@/', '/@content@/'),
		array($title, $content),
		file_get_contents($includeDir . '/template.php')
	);
	
	unset($content);

?>