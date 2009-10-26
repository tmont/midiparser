<?php

	/**
	 * \Midi\Reporting\HtmlPostProcessor
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Reporting;

	/**
	 * Handles post processing for HTML formatters
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	class HtmlPostProcessor implements PostProcessor {
		
		/**
		 * @var array
		 */
		private $params;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->params = array(
				'target' => null,
				'items' => 0,
				'multi_file' => false
			);
		}
		
		/**
		 * @since 1.0
		 *
		 * @param  string $key
		 * @param  string $value
		 */
		public function setParameter($key, $value) {
			if (array_key_exists($key, $this->params)) {
				$this->params[$key] = $value;
			}
		}
		
		/**
		 * Opens and returns a file object suitable for writing
		 *
		 * @since 1.0
		 *
		 * @param  string $file Path to the file to open
		 * @return SplFileObject
		 */
		public function createFileObject($file) {
			return new \SplFileObject($file, 'w');
		}
		
		/**
		 * @since 1.0
		 * @uses  createFileObject()
		 * @uses  copyFile()
		 */
		public function execute() {
			$target = $this->params['target'];
			$numItems = $this->params['items'];
			$isMultiFile = (bool)$this->params['multi_file'];
			
			$dir = dirname(__FILE__) . '/_html';
			
			$javascript = $dir . ($isMultiFile ? '/midiparser-multi.js' : '/midiparser.js');
			$data = preg_replace('/\{numItems\}/', $numItems, file_get_contents($javascript));
			
			$this->createFileObject($target . '/midiparser.js')->fwrite($data, strlen($data));
			unset($data);
			
			$files = array(
				'/midiparser.css',
				'/row.png',
				'/arrow_left.png',
				'/arrow_right.png',
				'/loading.gif'
			);
			
			foreach ($files as $file) {
				$this->copyFile($dir . $file, $target . $file);
			}
		}
		
		//@codeCoverageIgnoreStart
		/**
		 * Copies a file
		 *
		 * @since 1.0
		 *
		 * @param  string $source
		 * @param  string $target
		 * @ignore
		 */
		protected function copyFile($source, $target) {
			copy($source, $target);
		}
		//@codeCoverageIgnoreEnd
		
	}

?>