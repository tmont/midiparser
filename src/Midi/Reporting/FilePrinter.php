<?php

	/**
	 * \Midi\Reporting\FilePrinter
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Reporting;
	
	use \Midi\Parsing\Parser;
	use \Midi\MidiException;
	use \SplFileObject;
	
	/**
	 * Printer that redirects its output to a file
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	class FilePrinter extends Printer {
		
		/**
		 * @var SplFileObject
		 */
		protected $file;
		
		/**
		 * @var int
		 */
		protected $bytesWritten;
		
		/**
		 * @since 1.0
		 *
		 * @param  Formatter $formatter
		 * @param  Parser    $parser
		 * @param  string    $file
		 */
		public function __construct(Formatter $formatter, Parser $parser, $file = null) {
			parent::__construct($formatter, $parser);
			$this->file         = ($file !== null) ? $this->createFileObject($file, true) : null;
			$this->bytesWritten = 0;
		}
		
		/**
		 * Opens and returns a file object suitable for writing
		 *
		 * @since 1.0
		 *
		 * @param  string $file   Path to the file to open
		 * @param  bool   $binary Whether to open the file in binary mode
		 * @return SplFileObject
		 */
		public function createFileObject($file, $binary = false) {
			$mode = 'w' . ($binary ? 'b' : '');
			return new SplFileObject($file, $mode);
		}
		
		/**
		 * Sets the output file
		 *
		 * @since 1.1
		 * @uses  createFileObject()
		 *
		 * @param  string|SplFileObject $file
		 */
		public function setFile($file) {
			if (!($file instanceof SplFileObject)) {
				$file = $this->createFileObject($file, true);
			}
			
			$this->file = $file;
		}
		
		/**
		 * @since 1.0
		 * 
		 * @param  string $data
		 */
		protected function printData($data) {
			if ($this->file === null) {
				throw new MidiException('Target not set');
			}
			
			$this->file->fwrite($data, strlen($data));
			$this->bytesWritten += strlen($data);
		}
		
	}
	
?>