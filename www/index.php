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
	
	$section = 'news';
	$page = null;
	switch (count($uriSegments)) {
		case 2: $page = $uriSegments[1];
		case 1: $section = $uriSegments[0];
	}
	
	if (empty($section)) {
		$section = 'news';
	}
	
	global $includeDir, $conn, $downloadDir;
	$downloadDir = 'http://static.tommymontgomery.com/projects/php-midi-parser';
	$includeDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'include';
	
	if ($section !== 'docs') {
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
				if ($page !== null) {
					$title = $delimiter . 'Not Found';
					$file = $includeDir . '/404.html';
				} else {
					$file = $includeDir . '/' . $section . '.php';
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
					
					$download = $downloadDir . $page;
					
					$headers = get_headers($download, true);
					if (strpos($headers[0], '200 OK') === false) {
						$title = $delimiter . 'Not Found';
						$file = $includeDir . '/404.html';
					} else {
						$size = $headers['Content-Length'];
						header('Content-Length', $size);
						header('Content-Type', 'application/gz');
						readfile($download);
						exit;
					}
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
	} else {
		
	}
	
	
	

?>