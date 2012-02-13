<?php

	/**
	 * \Midi\Event\UnknownMetaEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a meta event that is unsupported by the MIDI
	 * specification
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class UnknownMetaEvent extends MetaEvent {
		
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
		 * @uses  MetaEventType::UNKNOWN
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::UNKNOWN;
		}
		
	}

?>