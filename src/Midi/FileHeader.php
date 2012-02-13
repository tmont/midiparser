<?php

	/**
	 * \Midi\FileHeader
	 *
	 * @package   Midi
	 * @since     1.0
	 */

	namespace Midi;
	
	use Midi\Util\Util;

	/**
	 * Represents a MIDI file header
	 *
	 * @package Midi
	 * @since   1.0
	 */
	class FileHeader implements Chunk {
		
		/**
		 * @var int
		 */
		protected $midiFormat;
		
		/**
		 * @var int
		 */
		protected $numTracks;
		
		/**
		 * @var int
		 */
		protected $timeDivision;
		
		/**
		 * The length of a MIDI file header
		 *
		 * @var int
		 */
		const LENGTH = 14;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  int $midiFormat   The MIDI file format; valid values are 0, 1 or 2
		 * @param  int $numTracks    The number of tracks in the MIDI file
		 * @param  int $timeDivision The number of clock ticks per quarter note (240 is the standard)
		 */
		public function __construct($midiFormat, $numTracks, $timeDivision) {
			$this->midiFormat   = $midiFormat;
			$this->numTracks    = $numTracks;
			$this->timeDivision = $timeDivision;
		}
		
		/**
		 * @since 1.0
		 * 
		 * @return int
		 */
		public function getLength() {
			return self::LENGTH;
		}
		
		/**
		 * @since 1.0
		 * 
		 * @return array [0] => midi format, [1] => # of tracks, [2] => time division
		 */
		public function getData() {
			return array(
				$this->midiFormat,
				$this->numTracks,
				$this->timeDivision
			);
		}
		
		/**
		 * @since 1.0
		 * @uses  Util::pack()
		 * 
		 * @return binary
		 */
		public function toBinary() {
			return
				Util::pack(0x4D, 0x54, 0x68, 0x64) . 
				Util::pack(0x00, 0x00, 0x00, 0x06) .
				Util::pack(0x00, $this->midiFormat) .
				Util::pack($this->numTracks >> 8, $this->numTracks & 0xFF) .
				Util::pack($this->timeDivision >> 8, $this->timeDivision & 0xFF);
		}
		
		/**
		 * @since 1.0
		 * 
		 * @return string
		 */
		public function __toString() {
			return
				'MIDI file header: MIDI format ' .
				$this->midiFormat . ', ' .
				$this->numTracks . ' tracks, time division: ' .
				$this->timeDivision;
		}
		
	}

?>