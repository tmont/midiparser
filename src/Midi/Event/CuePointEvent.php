<?php

	/**
	 * \Midi\Event\CuePointEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a cue point meta event
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 * @todo       Document what this event actually does
	 */
	class CuePointEvent extends MetaEvent {
		
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
		 * @uses  MetaEventType::CUE_POINT
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::CUE_POINT;
		}
		
	}

?>