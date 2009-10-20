<?php

	/**
	 * \Midi\Event\ProgramChangeEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a program change event
	 *
	 * A program change is essentially an instrument change.
	 * These events change the instrument of a channel.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class ProgramChangeEvent extends ChannelEvent {
		
		/**
		 * @since 1.0
		 * @uses  Instrument::getInstrumentName()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return \Midi\Util\Instrument::getInstrumentName($this->param1);
		}
		
		/**
		 * @since 1.0
		 * @uses  EventType::PROGRAM_CHANGE
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::PROGRAM_CHANGE;
		}
		
		/**
		 * @since 1.0
		 * 
		 * @return int
		 */
		public function getLength() {
			return 2;
		}
		
	}

?>