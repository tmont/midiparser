<?php

	/**
	 * \Tmont\Midi\TrackHeader
	 *
	 * @package   Midi
	 * @copyright � 2009 Tommy Montgomery <http://phpmidiparser.com>
	 * @since     1.0
	 */

	namespace Tmont\Midi;
	
	use Tmont\Midi\Util\Util;

	/**
	 * Represents a MIDI track header
	 *
	 * @package Midi
	 * @since   1.0
	 */
	class TrackHeader implements Chunk {
		
		/**
		 * @var int
		 */
		protected $size;
		
		/**
		 * The length of a MIDI track header in bytes
		 *
		 * @var int
		 */
		const LENGTH = 8;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  int $size The size of the track in bytes
		 */
		public function __construct($size) {
			$this->size = $size;
		}
		
		/**
		 * Gets the size of the track in bytes
		 *
		 * @since 1.0
		 * @todo  Get rid of this and use getData() instead
		 * 
		 * @return int
		 */
		public function getSize() {
			return $this->size;
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
		 * @return array
		 */
		public function getData() {
			return array($this->size);
		}
		
		/**
		 * @since 1.0
		 * @uses  Util::pack()
		 * 
		 * @return binary
		 */
		public function toBinary() {
			return 
				Util::pack(0x4D, 0x54, 0x72, 0x6B) . 
				Util::pack($this->size >> 24) .
				Util::pack(($this->size >> 16) & 0xFF) .
				Util::pack(($this->size >> 8) & 0xFF) .
				Util::pack($this->size & 0xFF);
		}
		
		/**
		 * @since 1.0
		 * 
		 * @return string
		 */
		public function __toString() {
			return 'Track (' . $this->size . ' bytes)';
		}
		
	}

?>