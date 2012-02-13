<?php

	/**
	 * \Midi\Parsing\TrackParser
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */

	namespace Midi\Parsing;
	
	use Midi\Event;
	use Midi\TrackHeader;
	use Midi\Util\Util;
	use InvalidArgumentException;

	/**
	 * Class for parsing MIDI tracks
	 *
	 * The parse state is initialized to {@link ParseState::TRACK_HEADER}.
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */
	class TrackParser extends Parser {
		
		/**
		 * @var EventParser
		 */
		private $eventParser;
		
		/**
		 * @var DeltaParser
		 */
		private $deltaParser;
		
		/**
		 * The expected length of the track in bytes
		 *
		 * @var int
		 */
		private $expectedTrackLength;
		
		/**
		 * The number of bytes that have been parsed so far
		 *
		 * @var int
		 */
		private $parsedTrackLength;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * @uses  setState()
		 * 
		 * @param  EventParser $eventParser
		 * @param  DeltaParser $deltaParser
		 */
		public function __construct(EventParser $eventParser = null, DeltaParser $deltaParser = null) {
			$this->eventParser         = $eventParser ?: new EventParser();
			$this->deltaParser         = $deltaParser ?: new DeltaParser();
			$this->expectedTrackLength = 0;
			$this->parsedTrackLength   = 0;
			
			$this->setState(ParseState::TRACK_HEADER);
		}
		
		/**
		 * Gets the expected length of the track in bytes
		 *
		 * @since 1.0
		 *
		 * @return int
		 */
		public function getExpectedTrackLength() {
			return $this->expectedTrackLength;
		}
		
		/**
		 * Gets the total number of bytes that have already been
		 * parsed in the track
		 *
		 * @since 1.0
		 *
		 * @return int
		 */
		public function getParsedTrackLength() {
			return $this->parsedTrackLength;
		}
		
		/**
		 * Gets the raw binary track header
		 *
		 * @since 1.0
		 * @uses  read()
		 * @uses  TrackHeader::LENGTH
		 * 
		 * @return binary
		 */
		protected function getRawTrackHeader() {
			return $this->read(TrackHeader::LENGTH, true);
		}
		
		/**
		 * Parses the given track header
		 *
		 * @since 1.0
		 * @uses  TrackHeader::LENGTH
		 * @uses  Util::unpack()
		 * 
		 * @param  binary $header
		 * @throws InvalidArgumentException
		 * @throws {@link ParseException} if the header is invalid
		 * @return TrackHeader
		 */
		public function parseTrackHeader($header) {
			if (strlen($header) !== TrackHeader::LENGTH) {
				throw new InvalidArgumentException('Track header must be ' . TrackHeader::LENGTH . ' bytes');
			}
			
			$id   = Util::unpack(substr($header, 0, 4));
			$size = array_reverse(Util::unpack(substr($header, 4)));
			
			if ($id !== array(0x4D, 0x54, 0x72, 0x6B)) {
				throw new ParseException('Invalid track header, expected [4D 54 72 6B]');
			}
			
			$shift = 0;
			$trackSize = 0;
			foreach ($size as $byte) {
				$trackSize |= ($byte << $shift);
				$shift += 8;
			}
			
			return new TrackHeader($trackSize);
		}
		
		/**
		 * @since 1.0
		 * @uses  EventParser::setFile()
		 * @uses  DeltaParser::setFile()
		 */
		protected function afterSetFile() {
			$this->eventParser->setFile($this->file);
			$this->deltaParser->setFile($this->file);
		}
		
		/**
		 * @since 1.0
		 * @uses  parseTrackHeader()
		 * @uses  getRawTrackHeader()
		 * @uses  TrackHeader::getSize()
		 * @uses  DeltaParser::parse()
		 * @uses  Chunk::getLength()
		 * @uses  EventParser::parse()
		 * @uses  checkTrackLength()
		 * 
		 * @throws {@link ParseException}
		 * @throws {@link StateException}
		 * @return Chunk
		 */
		public function parse() {
			$state = $this->getState();
			$chunk = null;
			switch ($state) {
				case ParseState::TRACK_HEADER:
					$chunk                     = $this->parseTrackHeader($this->getRawTrackHeader());
					$this->parsedTrackLength   = 0;
					$this->expectedTrackLength = $chunk->getSize();
					$this->setState(ParseState::DELTA);
					break;
				case ParseState::DELTA:
					$chunk = $this->deltaParser->parse();
					$this->setState(ParseState::EVENT);
					$this->checkTrackLength($chunk->getLength());
					break;
				case ParseState::EVENT:
					$chunk = $this->eventParser->parse();
					$this->checkTrackLength($chunk->getLength());
					if ($this->getParsedTrackLength() === $this->getExpectedTrackLength()) {
						if (!($chunk instanceof Event\EndOfTrackEvent)) {
							throw new ParseException('Expected end of track');
						} else {
							$this->setState(ParseState::TRACK_HEADER);
						}
					} else {
						$this->setState(ParseState::DELTA);
					}
					break;
				default:
					throw new StateException('Invalid state: ' . $state);
			}
			
			return $chunk;
		}
		
		/**
		 * Verifies that the track length does not exceed its
		 * expected length
		 *
		 * @since 1.0
		 * @todo  The parsed track length increment shouldn't happen here
		 * 
		 * @param  int $length The number of bytes to add to the parsed track bytes
		 * @throws {@link ParseException} if the track length exceeds its expected length
		 */
		protected function checkTrackLength($length) {
			$this->parsedTrackLength += $length;
			$expectedLength = $this->getExpectedTrackLength();
			$parsedLength = $this->getParsedTrackLength();
			if ($parsedLength > $expectedLength) {
				throw new ParseException('Track data exceeds expected length (' . $parsedLength . '/' . $expectedLength . ')');
			}
		}
		
	}

?>