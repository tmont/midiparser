<?php

	/**
	 * \Midi\Emit\Track
	 *
	 * @package    Midi
	 * @subpackage Emit
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Emit;
	
	use \Midi\Util\Util;
	use \Midi\Delta;
	use \Midi\TrackHeader;
	use \Midi\Event;
	
	/**
	 * Represents a MIDI track
	 *
	 * @package    Midi
	 * @subpackage Emit
	 * @since      1.0
	 */
	class Track {
		
		/**
		 * @var array
		 */
		private $chunks;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->chunks = array();
		}
		
		/**
		 * Appends an event to the track data
		 *
		 * @since 1.0
		 * 
		 * @param  Event $event
		 * @param  Delta $delta The delta to wait before firing the event; if not given
		 *                      a delta of zero is assumed
		 * @return Track A reference to $this
		 */
		public function appendEvent(Event $event, Delta $delta = null) {
			if ($delta === null) {
				$delta = new Delta(0);
			}
			
			array_push($this->chunks, $delta, $event);
			return $this;
		}
		
		/**
		 * Gets the track data
		 *
		 * @since 1.0
		 * @uses  Chunk::getLength()
		 * @uses  Chunk::toBinary()
		 * @uses  createTrackHeader()
		 * @uses  TrackHeader::toBinary()
		 * 
		 * @return binary
		 */
		public function getData() {
			$data = '';
			$size = 0;
			foreach ($this->chunks as $chunk) {
				$size += $chunk->getLength();
				$data .= $chunk->toBinary();
			}
			
			return $this->createTrackHeader($size)->toBinary() . $data;
		}
		
		/**
		 * Creates a track header chunk
		 *
		 * @since 1.0
		 *
		 * @param  int $size The length of the track in bytes
		 * @return TrackHeader
		 */
		public function createTrackHeader($size) {
			return new TrackHeader($size);
		}
		
	}

?>