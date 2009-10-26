<?php

	function connect() {
		$conn = mysql_connect('localhost', 'midiparser', 'midiparser');
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
	
	session_start();

	$uri = trim($_SERVER['REQUEST_URI'], '/');
	
	$uriSegments = explode('/', $uri);
	@list($section, $page) = $uriSegments;
	
	if (empty($section)) {
		$section = 'news';
	}
	
	global $includeDir, $conn, $downloadDir;
	$downloadDir = 'http://static.tommymontgomery.com/sites/phpmidiparser.com';
	$includeDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'include';
	
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
				$title = $delimiter . 'Not Found';
				$file = $includeDir . '/404.html';
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
					$title = $delimiter . 'Not Found';
					$file = $includeDir . '/404.html';
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
				$title = $delimiter . 'Not Found';
				$file = $includeDir . '/404.html';
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
					$page = 'php-midi-library-1.0.tar.gz';
				}
				
				$download = $downloadDir . '/' . $page;
				
				$headers = get_headers($download, true);
				if (strpos($headers[0], '200 OK') === false) {
					$title = $delimiter . 'Not Found';
					$file = $includeDir . '/404.html';
				} else {
					$size = $headers['Content-Length'];
					header('Content-Length', $size);
					
					switch(pathinfo($download, PATHINFO_EXTENSION)) {
						case 'gz':
							header('Content-Type: application/gz');
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
						$title = $delimiter . 'Not Found';
						$file = $includeDir . '/404.html';
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
						$title = $delimiter . 'Not Found';
						$file = $includeDir . '/404.html';
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
			$title = $delimiter . 'Not Found';
			$file = $includeDir . '/404.html';
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