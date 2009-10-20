<?php

	/**
	 * \Midi\Reporting\Printer
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
	 * Default printer for parse results
	 *
	 * This class handles the output created by a
	 * {@link Formatter}.
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	class Printer {
		
		/**
		 * @var Formatter
		 */
		protected $formatter;
		
		/**
		 * @var Parser
		 */
		protected $parser;
		
		/**
		 * @var bool
		 */
		protected $isParsingTrack;
		
		/**
		 * @var float
		 */
		protected $parseTime;
		
		/**
		 * @var float
		 */
		protected $totalTime;
		
		/**
		 * @var array
		 */
		protected $params;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  Formatter $formatter
		 * @param  Parser    $parser
		 */
		public function __construct(Formatter $formatter, Parser $parser) {
			$this->formatter      = $formatter;
			$this->parser         = $parser;
			$this->isParsingTrack = false;
			$this->parseTime      = 0;
			$this->totalTime      = 0;
			$this->params         = array();
		}
		
		/**
		 * Gets whether a track is currently being a parsed
		 *
		 * @since 1.0
		 * 
		 * @return bool
		 */
		public function isParsingTrack() {
			return $this->isParsingTrack;
		}
		
		/**
		 * Prints the formatted results of a complete parse
		 *
		 * @since 1.0
		 * @uses  printNext()
		 * @uses  doPostProcessing()
		 */
		public function printAll() {
			while ($this->printNext()) {}
			
			$this->doPostProcessing($this->params);
		}
		
		/**
		 * Sets a custom parameter
		 *
		 * @since 1.0
		 *
		 *
		 * @param  string $key
		 * @param  string $value
		 */
		public function setParameter($key, $value) {
			$this->params[$key] = $value;
		}
		
		/**
		 * Handles any post processing that the formatter requires
		 *
		 * @since 1.0
		 * @uses  Formatter::getPostProcessor()
		 * @uses  PostProcesor::setParamter()
		 * @uses  PostProcesor::execute()
		 *
		 * @param  array $params Parameters to set on the post processor
		 */
		public function doPostProcessing(array $params = array()) {
			$processor = $this->formatter->getPostProcessor();
			
			foreach ($params as $key => $value) {
				$processor->setParameter($key, $value);
			}
			
			$processor->execute();
		}
		
		/**
		 * Parses, formats and prints the next chunk
		 *
		 * @since 1.0
		 * @uses  Parser::parse()
		 * @uses  printEvent()
		 * @uses  printDelta()
		 * @uses  printTrackHeader()
		 * @uses  printFileHeader()
		 * @uses  printEof()
		 * @uses  printData()
		 * 
		 * @return bool true if there is more to parse, false if EOF has been reached
		 */
		public function printNext() {
			$totalTime        = microtime(true);
			$parseTime        = $totalTime;
			$chunk            = $this->parser->parse();
			$this->parseTime += microtime(true) - $parseTime;
			$notEof           = true;
			
			if ($chunk !== null) {
				if ($chunk instanceof Delta) {
					$this->printDelta($chunk);
				} else if ($chunk instanceof Event) {
					$this->printEvent($chunk);
				} else if ($chunk instanceof TrackHeader) {
					$this->printTrackHeader($chunk);
				} else if ($chunk instanceof FileHeader) {
					$this->printFileHeader($chunk);
				}
			} else {
				$this->printEof();
				$notEof = false;
			}
			
			$this->totalTime += microtime(true) - $totalTime;
			
			return $notEof;
		}
		
		/**
		 * Prints the data
		 *
		 * @since 1.0
		 * 
		 * @param  string $data
		 */
		protected function printData($data) {
			echo $data;
		}
		
		/**
		 * Prints an event
		 *
		 * @since 1.0
		 * @uses  Formatter::beforeEvent()
		 * @uses  Formatter::formatEvent()
		 * @uses  Formatter::afterEvent()
		 * @uses  printData()
		 * 
		 * @param  Event $event
		 */
		protected function printEvent(Event $event) {
			$this->printData($this->formatter->beforeEvent($event));
			$this->printData($this->formatter->beforeChunk($event));
			$this->printData($this->formatter->formatEvent($event));
			$this->printData($this->formatter->afterChunk($event));
			$this->printData($this->formatter->afterEvent($event));
		}
		
		/**
		 * Prints a delta time
		 *
		 * @since 1.0
		 * @uses  Formatter::beforeDelta()
		 * @uses  Formatter::formatDelta()
		 * @uses  Formatter::afterDelta()
		 * @uses  printData()
		 * 
		 * @param  Delta $delta
		 */
		protected function printDelta(Delta $delta) {
			$this->printData($this->formatter->beforeDelta($delta));
			$this->printData($this->formatter->beforeChunk($delta));
			$this->printData($this->formatter->formatDelta($delta));
			$this->printData($this->formatter->afterChunk($delta));
			$this->printData($this->formatter->afterDelta($delta));
		}
		
		/**
		 * Prints a track header
		 *
		 * @since 1.0
		 * @uses  isParsingTrack()
		 * @uses  Formatter::afterTrack()
		 * @uses  Formatter::beforeTrack()
		 * @uses  Formatter::beforeTrackHeader()
		 * @uses  Formatter::afterTrackHeader()
		 * @uses  TrackHeader::getSize()
		 * @uses  printData()
		 * 
		 * @param  TrackHeader $trackHeader
		 */
		protected function printTrackHeader(TrackHeader $trackHeader) {
			if ($this->isParsingTrack()) {
				$this->printData($this->formatter->afterTrack());
			}
			
			$this->isParsingTrack = false;
			
			$this->printData($this->formatter->beforeTrack());
			$this->printData($this->formatter->beforeTrackHeader($trackHeader));
			$this->printData($this->formatter->beforeChunk($trackHeader));
			$this->printData($this->formatter->formatTrackHeader($trackHeader));
			$this->printData($this->formatter->afterChunk($trackHeader));
			$this->printData($this->formatter->afterTrackHeader($trackHeader));
			
			if ($trackHeader->getSize() > 0) {
				$this->isParsingTrack = true;
			}
		}
		
		/**
		 * Prints a file header
		 *
		 * @since 1.0
		 * @uses  Formatter::beforeFile()
		 * @uses  Formatter::beforeFileHeader()
		 * @uses  Formatter::formatFileHeader()
		 * @uses  Formatter::afterFileHeader()
		 * @uses  printData()
		 * 
		 * @param  FileHeader $fileHeader
		 */
		protected function printFileHeader(FileHeader $fileHeader) {
			$this->printData($this->formatter->beforeFile());
			$this->printData($this->formatter->beforeFileHeader($fileHeader));
			$this->printData($this->formatter->beforeChunk($fileHeader));
			$this->printData($this->formatter->formatFileHeader($fileHeader));
			$this->printData($this->formatter->afterChunk($fileHeader));
			$this->printData($this->formatter->afterFileHeader($fileHeader));
		}
		
		/**
		 * Prints EOF
		 *
		 * @since 1.0
		 * @uses  isParsingTrack()
		 * @uses  Formatter::afterTrack()
		 * @uses  Formatter::afterFile()
		 * @uses  printData()
		 */
		protected function printEof() {
			if ($this->isParsingTrack()) {
				$this->printData($this->formatter->afterTrack());
			}
			
			$this->printData($this->formatter->afterFile($this->parseTime, $this->totalTime));
			$this->isParsingTrack = false;
		}
		
	}
	
?>