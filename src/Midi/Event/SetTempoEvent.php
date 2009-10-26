<?php

	/**
	 * \Midi\Event\SetTempoEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents the set tempo meta event
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class SetTempoEvent extends MetaEvent {
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  int $mpqn Microseconds per quarter note
		 */
		public function __construct($mpqn) {
			parent::__construct(array(($mpqn >> 16) & 0xFF, ($mpqn >> 8) & 0xFF, $mpqn & 0xFF));
		}
		
		/**
		 * @since 1.0
		 * @uses  getBpmFromMpqn()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			$mpqn = ($this->data[0] << 16) | ($this->data[1] << 8) | $this->data[2];
			return self::getBpmFromMpqn($mpqn) . ' BPM';
		}
		
		/**
		 * Calculates the beats per minute give the number
		 * of microseconds per quarter note
		 *
		 * @since 1.0
		 * 
		 * @param  int $mpqn The number of microseconds per quarter note
		 * @return int
		 */
		public static function getBpmFromMpqn($mpqn) {
			return (int)floor(60000000 / $mpqn);
		}
		
		/**
		 * @since 1.0
		 * @uses  MetaEventType::SET_TEMPO
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::SET_TEMPO;
		}
		
	}

?>