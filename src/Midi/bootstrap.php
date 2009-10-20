<?php

	/**
	 * Bootstrapper for the MIDI parsing library
	 *
	 * @package   Midi
	 * @copyright © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since     1.0
	 */

	namespace Midi;

	/**
	 * Autoload mechanism for the MIDI parsing library
	 *
	 * @since 1.0
	 * 
	 * @param  string $class The fully qualified name of the class
	 */
	function autoload($class) {
		$file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\')) . '.php';
		
		if (is_file($file)) {
			require_once $file;
		}
	}
	
	spl_autoload_register('\Midi\autoload');

?>