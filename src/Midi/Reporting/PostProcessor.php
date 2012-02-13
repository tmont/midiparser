<?php

	/**
	 * \Midi\Reporting\PostProcessor
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	
	namespace Midi\Reporting;

	/**
	 * Handles post processing for printers after parsing, formatting
	 * and printing is complete
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	interface PostProcessor {
		
		/**
		 * Sets a custom parameter for the post processor
		 *
		 * @since 1.0
		 *
		 * @param  string $key
		 * @param  string $value
		 */
		public function setParameter($key, $value);
		
		/**
		 * Performs the post processing instructions
		 *
		 * @since 1.0
		 */
		public function execute();
		
	}

?>