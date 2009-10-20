<?php

	/**
	 * \Midi\Reporting\MultiFilePrinter
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Reporting;
	
	use \Midi\Delta;
	use \Midi\TrackHeader;
	use \Midi\FileHeader;
	use \Midi\Event;
	use \Midi\Parsing\Parser;
	
	/**
	 * Printer that outputs to multiple files
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	class MultiFilePrinter extends FilePrinter {
		
		/**
		 * @since 1.0
		 *
		 * @param  Formatter $formatter
		 * @param  Parser    $parser
		 * @param  string    $directory   The directory to write the report to
		 */
		public function __construct(Formatter $formatter, Parser $parser, $directory = null) {
			parent::__construct($formatter, $parser);
			$this->params['target'] = $directory;
			$this->params['items'] = 1;
			$this->params['multi_file'] = true;
			$this->params['max_file_size'] = 1024 * 50;
		}
		
		/**
		 * @since 1.0
		 * @uses  createIndex()
		 * @uses  createFileObject()
		 * @uses  Printer::printNext()
		 * 
		 * @return bool true if there is more to parse, false if EOF has been reached
		 */
		public function printNext() {
			if ($this->file === null) {
				$this->createIndex();
				$this->file = $this->createFileObject($this->params['target'] . DIRECTORY_SEPARATOR . 'data' . $this->params['items'] . '.html');
			} else if ($this->bytesWritten >= $this->params['max_file_size']) {
				$this->parseTime    = 0;
				$this->totalTime    = 0;
				$this->bytesWritten = 0;
				
				$this->params['items']++;
				$this->file = $this->createFileObject($this->params['target'] . DIRECTORY_SEPARATOR . 'data' . $this->params['items'] . '.html');
			}
			
			return parent::printNext();
		}
		
		/**
		 * Creates the index page
		 *
		 * @since 1.0
		 * @uses  createFileObject()
		 * @uses  printData()
		 * @uses  Formatter::beforeFile()
		 * @uses  Formatter::afterFile()
		 */
		protected function createIndex() {
			$this->file = $this->createFileObject($this->params['target'] . DIRECTORY_SEPARATOR . 'index.html');
			$this->printData($this->formatter->beforeFile());
			$this->printData($this->formatter->afterFile(0, 0));
		}
		
		/**
		 * @since 1.0
		 * @uses  Formatter::beforeFile()
		 * @uses  Formatter::beforeFileHeader()
		 * @uses  Formatter::beforeChunk()
		 * @uses  Formatter::formatFileHeader()
		 * @uses  Formatter::afterChunk()
		 * @uses  Formatter::afterFileHeader()
		 * @uses  printData()
		 * 
		 * @param  FileHeader $fileHeader
		 */
		protected function printFileHeader(FileHeader $fileHeader) {
			$this->printData($this->formatter->beforeFileHeader($fileHeader));
			$this->printData($this->formatter->beforeChunk($fileHeader));
			$this->printData($this->formatter->formatFileHeader($fileHeader));
			$this->printData($this->formatter->afterChunk($fileHeader));
			$this->printData($this->formatter->afterFileHeader($fileHeader));
		}
		
		/**
		 * @since 1.0
		 */
		protected function printEof() {
			$this->isParsingTrack = false;
		}
		
	}
	
?>