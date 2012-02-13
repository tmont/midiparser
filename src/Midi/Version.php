<?php

	/**
	 * \Midi\Version
	 *
	 * @package   Midi
	 * @since     1.0
	 */
	
	namespace Midi;
	
	/**
	 * Provides static properties such as version and author
	 *
	 * @package Midi
	 * @since   1.0
	 */
	final class Version {
		
		//@codeCoverageIgnoreStart
		/**
		 * @ignore
		 */
		private function __construct() {}
		//@codeCoverageIgnoreEnd
		
		/**
		 * The PHP MIDI Parser library version
		 *
		 * @var string
		 */
		const VERSION    = '1.0.1';
		
		/**
		 * The PHP MIDI Parser library author
		 *
		 * @var string
		 */
		const AUTHOR     = 'Tommy Montgomery';
		
		/**
		 * The PHP MIDI Parser library full product name
		 *
		 * @var string
		 */
		const NAME       = 'PHP MIDI Library';
		
		/**
		 * The build date (Y-m-d H:i:s P)
		 *
		 * @var string
		 */
		const BUILD_DATE = '2012-02-12 21:38:48 -08:00';
		
	}

?>