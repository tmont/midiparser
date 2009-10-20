<?php

	/**
	 * Dynamically runs a bunch of tests under a directory, or a single
	 * test
	 *
	 * This script determines which tests to run based on the MIDI_LIBRARY_COMPONENT
	 * environment variable. Normally, this script is run from the shell,
	 * and the environment variable is only around as long as the shell
	 * is open.
	 *
	 * @package Midi
	 * @since   1.0
	 */
	
	namespace Midi\Tests;

	$path = getenv('MIDI_LIBRARY_COMPONENT');
	if (empty($path)) {
		fwrite(STDERR, 'Environment variable "MIDI_LIBRARY_COMPONENT" is not set');
		exit(1);
	}
	
	$baseDir         = dirname(dirname(__FILE__));
	$testsDir        = $baseDir . DIRECTORY_SEPARATOR . 'tests';
	$GLOBALS['path'] = $testsDir . DIRECTORY_SEPARATOR . 'Midi' . DIRECTORY_SEPARATOR . $path;
	
	if (!is_dir($GLOBALS['path'])) {
		$tempPath = $GLOBALS['path'] . 'Test.php';
		if (is_file($tempPath)) {
			$GLOBALS['path'] = $tempPath;
			unset($tempPath);
		} else {
			fwrite(STDERR, $GLOBALS['path'] . ' is neither a directory nor a file');
			exit(1);
		}
	}
	
	\PHPUnit_Util_Filter::addFileToFilter(__FILE__, 'PHPUNIT');

	//iterates over all the files in the directory, and require_onces's them
	//or, if it's just a single file, it require_once's that single file
	$GLOBALS['test_classes'] = array();
	if (is_dir($GLOBALS['path'])) {
		foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($GLOBALS['path'])) as $file) {
			if (
				$file->isFile() &&
				strpos($file->getPathName(), DIRECTORY_SEPARATOR . '.') === false &&
				preg_match('/Test\.php$/', $file->getFileName())
			) {
				$testClass = ltrim(str_replace($testsDir, '', $file->getPathName()), DIRECTORY_SEPARATOR . '/');
				$testClass = str_replace('Midi\\', 'Midi\\Tests\\', $testClass);
				$testClass = substr($testClass, 0, -4);
				$GLOBALS['test_classes'][] = $testClass;
				require_once $file->getPathname();
			}
		}
		
		unset($file);
	} else {
		require_once $GLOBALS['path'];
		$testClass = ltrim(str_replace($testsDir, '', $GLOBALS['path']), DIRECTORY_SEPARATOR . '/');
		$testClass = str_replace('Midi\\', 'Midi\\Tests\\', $testClass);
		$testClass = substr($testClass, 0, -4);
		$GLOBALS['test_classes'][] = $testClass;
	}
	
	unset($baseDir, $testsDir, $path);
	
	if (empty($GLOBALS['test_classes'])) {
		fwrite(STDERR, 'No test classes found');
		exit(1);
	}

	/**
	 * Dynamically runs a bunch of tests under a directory, or a single
	 * test
	 *
	 * @package Testing
	 * @since   1.0
	 * @version 1.0
	 */
	class DynamicTestSuite {
		
		/**
		 * Creates a test suite
		 *
		 * @since   1.0
		 *
		 * @return PHPUnit_Framework_TestSuite
		 */
		public static function suite() {
			$suite = new \PHPUnit_Framework_TestSuite('Tests From ' . $GLOBALS['path']);
			
			foreach ($GLOBALS['test_classes'] as $class) {
				$suite->addTestSuite($class);
			}
			
			return $suite;
		}
		
	}

?>