<?php

	/**
	 * \Midi\Event\InstrumentNameEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents an instrument name meta event
	 *
	 * Allows you to name an instrument beyond its default MIDI name.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class InstrumentNameEvent extends MetaEvent {
		
		/**
		 * @since 1.0
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return $this->data;
		}
		
		/**
		 * @since 1.0
		 * @uses  MetaEventType::INSTRUMENT_NAME
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::INSTRUMENT_NAME;
		}
		
	}

?>