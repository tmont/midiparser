<?php

	/**
	 * \Midi\Reporting\DefaultPostProcessor
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Reporting;

	/**
	 * Empty post processor
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	class DefaultPostProcessor implements PostProcessor {
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {}
		
		/**
		 * @since 1.0
		 *
		 * @param  string $key
		 * @param  string $value
		 */
		public function setParameter($key, $value) {}
		
		/**
		 * @since 1.0
		 */
		public function execute() {}
		
	}

?>