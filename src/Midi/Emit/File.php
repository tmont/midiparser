<?php

	/**
	 * \Midi\Emit\File
	 *
	 * @package    Midi
	 * @subpackage Emit
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Emit;

	use Midi\Util\Timer;
	use Midi\FileHeader;
	use Midi\MidiException;
	use SplFileObject;
	
	/**
	 * Represents a MIDI file
	 *
	 * @package    Midi
	 * @subpackage Emit
	 * @since      1.0
	 */
	class File {
		
		/**
		 * Collection of tracks
		 *
		 * @var array
		 */
		private $tracks;
		
		/**
		 * @var int
		 */
		private $timeDivision;
		
		/**
		 * @var int
		 */
		private $format;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct($timeDivision, $format = null) {
			$this->tracks       = array();
			$this->timeDivision = $timeDivision;
			$this->format       = $format;
		}
		
		/**
		 * Gets the binary data for the MIDI file
		 *
		 * @since 1.0
		 * @uses  createFileHeader()
		 * @uses  FileHeader::toBinary()
		 * @uses  Track::getData()
		 *
		 * @throws {@link MidiException}
		 * @return string A binary string
		 */
		public function getData() {
			$numTracks = count($this->tracks);
			if ($numTracks === 0) {
				throw new MidiException('No tracks have been added');
			}
			
			if ($this->format === null) {
				if ($numTracks > 1) {
					$this->format = 1;
				} else {
					$this->format = 0;
				}
			}
			
			if ($this->format === 0 && $numTracks > 1) {
				throw new MidiException('Cannot have multiple tracks in MIDI format 0');
			}
			
			$data = $this->createFileHeader($this->format, $numTracks, $this->timeDivision)->toBinary();
			foreach ($this->tracks as $track) {
				$data .= $track->getData();
			}
			
			return $data;
		}
		
		/**
		 * Saves the MIDI file to the specified file
		 *
		 * @since 1.0
		 * @uses  createFileObject()
		 * @uses  getData()
		 *
		 * @param  SplFileObject|string $file A file path, or a file object opened in "wb" mode
		 * @return int The amount of data that was written
		 */
		public function save($file) {
			if (!($file instanceof SplFileObject)) {
				$file = $this->createFileObject($file);
			}
			
			$data = $this->getData();
			$file->fwrite($data, strlen($data));
			return strlen($data);
		}
		
		/**
		 * Creates a file object in "wb" mode suitable for {@link save()}
		 *
		 * @since 1.0
		 *
		 * @param  string $file A file path
		 * @return SplFileObject
		 */
		public function createFileObject($file) {
			return new SplFileObject($file, 'wb');
		}
		
		/**
		 * Creates a file header chunk
		 *
		 * @since 1.0
		 *
		 * @param  int $format       The MIDI file format
		 * @param  int $numTracks    The number of tracks in the file
		 * @param  int $timeDivision The number of MIDI clock ticks per quarter note
		 * @return FileHeader
		 */
		public function createFileHeader($format, $numTracks, $timeDivision) {
			return new FileHeader($format, $numTracks, $timeDivision);
		}
		
		/**
		 * Gets a timer for the file's time division
		 *
		 * @since 1.0
		 * 
		 * @return Timer
		 */
		public function getTimer() {
			return new Timer($this->timeDivision);
		}
		
		/**
		 * Adds a track to the file
		 *
		 * @since 1.0
		 * 
		 * @param  Track $track
		 * @return File A reference to $this
		 */
		public function addTrack(Track $track) {
			$this->tracks[] = $track;
			return $this;
		}
		
	}

?>