<?php

	/**
	 * \Midi\Event\KeySignatureEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	use Midi\Util\Key;
	
	/**
	 * Represents a set key signature event
	 *
	 * This event sets the key signature for the song. It should
	 * always be in the first track. There can be multiple key
	 * signature events per song.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class KeySignatureEvent extends MetaEvent {
		
		/**
		 * @since 1.0
		 * 
		 * @param  int $accidentals 256 - # of flats, 0 + # of sharps
		 * @param  int $mode        0 for major, 1 for minor
		 */
		public function __construct($accidentals, $mode) {
			parent::__construct(array($accidentals, $mode));
		}
		
		/**
		 * @since 1.0
		 * @uses  Key::getKeySignature()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			$key = Key::getKeySignature($this->data[0], $this->data[1]);
			return $key;
		}
		
		/**
		 * @since 1.0
		 * @uses  MetaEventType::KEY_SIGNATURE
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::KEY_SIGNATURE;
		}
		
	}

?>