<?php

	/**
	 * Bootstrapper for the MIDI parsing library
	 *
	 * @package   Midi
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