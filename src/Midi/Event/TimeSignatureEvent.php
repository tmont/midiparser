<?php

	/**
	 * \Midi\Event\TimeSignatureEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	use \Midi\Util\Util;

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
				Util::getTimeSignature($this->data[0], $this->data[1]) .
				', metronome pulses every ' . $this->data[2] . ' clock ticks, ' .
				$this->data[3] . ' 32nd notes per quarter note';
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