<?php

	/**
	 * \Midi\Event\PitchBendEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents the pitch bend channel event
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class PitchBendEvent extends ChannelEvent {
		
		/**
		 * @since 1.0
		 * @uses  pitchBendToCents()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			$cents = self::pitchBendToCents($this->param1, $this->param2);
			if ($cents > 0) {
				$cents = '+' . $cents;
			}
			
			return $cents . ' cents';
		}
		
		/**
		 * Converts the internal MIDI pitch bend value to
		 * cents (100ths of a whole tone)
		 *
		 * @since 1.0
		 * 
		 * @param  int $param1 16-bit integer
		 * @param  int $param2 16-bit integer
		 * @return int Return value is between -100 (one whole tone down) and 100 (one whole tone up)
		 */
		public static function pitchBendToCents($param1, $param2) {
			$param1 &= 0x0FFF;
			$param2 = ($param2 & 0x0FFF) << 2;
			$total = $param2 | $param1;
			
			$total -= 8192;
			$cents = round($total / 81.92);
			return $cents;
		}
		
		/**
		 * @since 1.0
		 * @uses  EventType::PITCH_BEND
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::PITCH_BEND;
		}
		
	}

?>