<?php

	/**
	 * Bootstrapper for the MIDI parsing library
	 *
	 * @package   Midi
	 * @copyright © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since     1.0
	 */

	namespace Midi;

	spl_autoload_register(function($class) {
		$file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\')) . '.php';
		
		if (is_file($file)) {
			require_once $file;
		}
	});

?>