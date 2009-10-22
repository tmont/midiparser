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

	$uri = trim($_SERVER['REQUEST_URI'], '/');
	
	$uriSegments = explode('/', $uri);
	
	$section = 'default';
	$page = null;
	switch (count($uriSegments)) {
		case 2: $page = $uriSegments[1];
		case 1: $section = $uriSegments[0];
	}
	
	if (empty($section)) {
		$section = 'default';
	}
	
	global $includeDir, $conn;
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
			case 'default':
				$file = $includeDir . '/default.php';
				break;
			case 'error':
				$title = $delimiter . 'OH NOES!!';
				$file = $includeDir . '/error.html';
				break;
			default:
				$title = $delimiter . 'Not Found';
				$file = $includeDir . '/404.html';
				break;
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