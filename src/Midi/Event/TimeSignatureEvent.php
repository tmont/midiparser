<?php

	/**
	 * \Midi\Event\TimeSignatureEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents the set time signature meta event
	 *
	 * This event should be in the first track. There may be
	 * multiple time signature events (if the time signature
	 * changes in the middle of the song, for example).
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class TimeSignatureEvent extends MetaEvent {
		
		/**
		 * @since 1.0
		 * 
		 * @param  int $numerator
		 * @param  int $denominator
		 * @param  int $metronomePulse                  The number of clock ticks per metronome pulse
		 * @param  int $thirtySecondNotesPerQuarterNote
		 */
		public function __construct($numerator, $denominator, $metronomePulse = 24, $thirtySecondNotesPerQuarterNote = 8) {
			parent::__construct(array($numerator, log($denominator, 2), $metronomePulse, $thirtySecondNotesPerQuarterNote));
		}
		
		/**
		 * @since 1.0
		 * @uses  getTimeSignature()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return 
				self::getTimeSignature($this->data[0], $this->data[1]) .
				', metronome pulses every ' . $this->data[2] . ' clock ticks, ' .
				$this->data[3] . ' 32nd notes per quarter note';
		}
		
		/**
		 * Gets a user-friendly time signature
		 *
		 * @since 1.0
		 * @todo  Move to Util
		 * 
		 * @param  int $numerator
		 * @param  int $logarithmicDenominator The base 2 logarithm of the actual denominator
		 *                                     (e.g. 1 instead of 2, 2 instead of 4, 4 instead of 16, etc.)
		 * @return string
		 */
		public static function getTimeSignature($numerator, $logarithmicDenominator) {
			return $numerator . '/' . pow($logarithmicDenominator, 2);
		}
		
		/**
		 * @since 1.0
		 * @uses  MetaEventType::TIME_SIGNATURE
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::TIME_SIGNATURE;
		}
		
	}

?>