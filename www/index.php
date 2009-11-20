<?php

	function connect() {
		global $config;
		$conn = mysql_connect($config['host'], $config['username'], $config['password']);
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
			return false;
		}
		
		require_once $includeDir . '/lib/RecordIterator.php';
		
		return new RecordIterator($result);
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
	
	session_start();

	$uri = trim($_SERVER['REQUEST_URI'], '/');
	
	$uriSegments = explode('/', $uri);
	@list($section, $page) = $uriSegments;
	
	if (empty($section)) {
		$section = 'news';
	}
	
	global $includeDir, $conn, $downloadDir, $config;
	$downloadDir = 'http://static.tommymontgomery.com/sites/phpmidiparser.com';
	$includeDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'include';
	$config = parse_ini_file($includeDir . '/meta/www.config');
	
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