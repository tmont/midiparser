<?php

	/**
	 * \Tmont\Midi\Version
	 *
	 * @package   Midi
	 * @since     1.0
	 * @copyright © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 */
	
	namespace Tmont\Midi;
	
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
		const VERSION    = '1.0';
		
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
		const BUILD_DATE = '2009-10-25 22:43:31 -07:00';
		
	}

?>