<?php

	/**
	 * \Midi\Parsing\Parser
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Parsing;
	
	use \Midi\Util\Util;

	/**
	 * Base parsing class
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */
	abstract class Parser {
		
		/**
		 * The current state of the parser
		 *
		 * @var int
		 * @see ParseState
		 */
		private $state;
		
		/**
		 * The file to parse
		 *
		 * @var SplFileObject
		 */
		protected $file;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->file  = null;
			$this->state = ParseState::EOF;
		}
		
		/**
		 * Creates a file object suitable for {@link load()}
		 *
		 * @since 1.0
		 * 
		 * @param  string $file
		 * @return SplFileObject
		 */
		public function createFileObject($file) {
			return new \SplFileObject($file, 'rb');
		}
		
		/**
		 * Loads a file to be parsed
		 *
		 * @since 1.0
		 * @uses  createFileObject()
		 * @uses  afterLoad()
		 * 
		 * @param  string|SplFileObject $file A file path, or an SplFileObject opened in "rb" mode
		 */
		public function load($file) {
			if (!($file instanceof \SplFileObject)) {
				$file = $this->createFileObject($file);
			}
			
			$this->file = $file;
			$this->afterLoad();
		}
		
		/**
		 * Sets the buffer stream to read from
		 *
		 * @since 1.0
		 * @uses  afterSetFile()
		 * 
		 * @param  SplFileObject $file
		 */
		public function setFile(\SplFileObject $file) {
			$this->file = $file;
			$this->afterSetFile();
		}
		
		/**
		 * Gets the current parse state
		 *
		 * The default is {@link ParseState::EOF}.
		 *
		 * @since 1.0
		 * 
		 * @return int One of the {@link ParseState} constants
		 */
		public function getState() {
			return $this->state;
		}
		
		/**
		 * Sets the current parse state
		 *
		 * @since 1.0
		 *
		 * @param  int $state See {@link ParseState}
		 */
		protected function setState($state) {
			$this->state = $state;
		}
		
		/**
		 * Reads $count bytes from the buffer stream
		 *
		 * @since 1.0
		 * 
		 * @param  int  $count
		 * @param  bool $throwOnEof Whether to throw a {@link ParseException} if EOF is encountered
		 * @throws {@link ParseException}
		 * @return binary
		 */
		protected function read($count, $throwOnEof = false) {
			$data = null;
			while ($this->file->valid() && $count--) {
				$data .= $this->file->fgetc();
			}
			
			if ($count > 0 && $throwOnEof) {
				throw new ParseException('Unexpected EOF');
			}
			
			return $data;
		}
		
		/**
		 * Reads a delta time from the buffer stream
		 *
		 * @since 1.0
		 * @uses  read()
		 * @uses  Util::unpack()
		 * @uses  Util::getTicksFromDeltaByteSequence()
		 * 
		 * @return int The number of clock ticks in the delta time
		 */
		protected function getDelta() {
			$byte = $this->read(1, true);
			$value = Util::unpack($byte);
			$delta = '';
			while ($this->file->valid() && $value[0] > 0x7F) {
				$delta .= $byte;
				$byte   = $this->read(1);
				$value  = Util::unpack($byte);
			}
			
			if ($byte !== null) {
				$delta .= $byte;
			}
			
			return Util::getTicksFromDeltaByteSequence($delta);
		}
		
		/**
		 * Called after {@link load()}
		 *
		 * @since 1.0
		 */
		protected function afterLoad() {
		
		}
		
		/**
		 * Called after {@link setFile()}
		 *
		 * @since 1.0
		 */
		protected function afterSetFile() {
		
		}
		
		/**
		 * Parses the buffer stream and returns the next chunk
		 *
		 * @since 1.0
		 *
		 * @return Chunk
		 */
		public abstract function parse();
		
	}

?>