<?php

	/**
	 * \Midi\Parsing\FileParser
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */

	namespace Midi\Parsing;
	
	use Midi\FileHeader;
	use Midi\Util\Util;
	
	/**
	 * Class for parsing MIDI files
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */
	class FileParser extends Parser {
		
		/**
		 * @var TrackParser
		 */
		private $trackParser;
		
		/**
		 * The number of tracks parsed thus far
		 *
		 * @var int
		 */
		private $tracksParsed;
		
		/**
		 * The number of tracks expected to be parsed
		 *
		 * @var int
		 */
		private $tracksExpected;
		
		/**
		 * Constructor
		 *
		 * The parse state is initialized to {@link ParseState::FILE_HEADER}.
		 *
		 * @since 1.0
		 * @uses  setState()
		 * 
		 * @param  TrackParser $trackParser
		 */
		public function __construct(TrackParser $trackParser = null) {
			parent::__construct();
			$this->trackParser    = ($trackParser === null) ? new TrackParser() : $trackParser;
			$this->tracksParsed   = 0;
			$this->tracksExpected = 0;
			
			$this->setState(ParseState::FILE_HEADER);
		}
		
		/**
		 * Gets the number of tracks that have been parsed so far
		 *
		 * @since 1.0
		 *
		 * @return int
		 */
		public function getTracksParsed() {
			return $this->tracksParsed;
		}
		
		/**
		 * Gets the number of tracks that should be in the MIDI file
		 *
		 * @since 1.0
		 *
		 * @return int
		 */
		public function getTracksExpected() {
			return $this->tracksExpected;
		}
		
		/**
		 * @since 1.0
		 * @uses  TrackParser::setFile()
		 */
		protected function afterLoad() {
			$this->trackParser->setFile($this->file);
		}
		
		/**
		 * Gets the raw binary file header
		 *
		 * @since 1.0
		 * @uses  read()
		 * @uses  FileHeader::LENGTH
		 * 
		 * @return binary
		 */
		protected function getRawFileHeader() {
			return $this->read(FileHeader::LENGTH, true);
		}
		
		/**
		 * Parses the given file header
		 *
		 * @since 1.0
		 * @uses  FileHeader::LENGTH
		 * @uses  Util::unpack()
		 * 
		 * @param  binary $header
		 * @throws InvalidArgumentException
		 * @throws {@link ParseException} if the file header is not a valid MIDI file header
		 * @return FileHeader
		 */
		public function parseFileHeader($header) {
			if (strlen($header) !== FileHeader::LENGTH) {
				throw new \InvalidArgumentException('MIDI file header must be ' . FileHeader::LENGTH . ' bytes');
			}
			
			$id           = Util::unpack(substr($header, 0, 4));
			$chunkSize    = Util::unpack(substr($header, 4, 4));
			$format       = Util::unpack(substr($header, 8, 2));
			$tracks       = Util::unpack(substr($header, 10, 2));
			$timeDivision = Util::unpack(substr($header, 12, 2));
			
			if ($id !== array(0x4D, 0x54, 0x68, 0x64)) {
				throw new ParseException('Invalid file header, expected byte sequence [4D 54 68 64]');
			}
			if ($chunkSize !== array(0x00, 0x00, 0x00, 0x06)) {
				throw new ParseException('File header chunk size must be [00 00 00 06]');
			}
			
			$format       = ($format[0]       << 8) | $format[1];
			$timeDivision = ($timeDivision[0] << 8) | $timeDivision[1];
			$tracks       = ($tracks[0]       << 8) | $tracks[1];
			
			if ($format !== 0 && $format !== 1 && $format !== 2) {
				throw new ParseException('MIDI file format must be 0, 1 or 2 (got ' . $format . ')');
			}
			
			return new FileHeader($format, $tracks, $timeDivision);
		}
		
		/**
		 * @since 1.0
		 * @uses  getState()
		 * @uses  parseFileHeader()
		 * @uses  getRawFileHeader()
		 * @uses  Chunk::getData()
		 * @uses  TrackParser::parse()
		 * @uses  TrackParser::getState()
		 * 
		 * @throws {@link ParseException}
		 * @return Chunk
		 */
		public function parse() {
			$chunk = null;
			$state = $this->getState();
			switch ($state) {
				case ParseState::FILE_HEADER:
					$chunk                = $this->parseFileHeader($this->getRawFileHeader());
					list(, $numTracks, )  = $chunk->getData();
					$this->tracksExpected = $numTracks;
					$this->setState(ParseState::TRACK_HEADER);
					break;
				case ParseState::TRACK_HEADER:
				case ParseState::EVENT:
				case ParseState::DELTA:
					$chunk    = $this->trackParser->parse();
					$newState = $this->trackParser->getState();
					
					if ($newState === ParseState::TRACK_HEADER) {
						$this->tracksParsed++;
						if ($this->getTracksParsed() >= $this->getTracksExpected()) {
							$newState = ParseState::EOF;
						}
					}
					
					$this->setState($newState);
					break;
				case ParseState::EOF:
					//the pointer is not beyond the buffer length at this point
					//one more should push it over the edge
					$this->file->fgetc();
					if (!$this->file->eof()) {
						throw new ParseException('Expected EOF');
					}
					break;
				default:
					throw new StateException('Unknown parse state: ' . $state);
			}
			
			return $chunk;
		}
		
	}

?>