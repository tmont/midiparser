<?php

	/**
	 * \Midi\Event\TextEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a text meta event
	 *
	 * This event just provides a means of inserting whatever text
	 * one wants into a track.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class TextEvent extends MetaEvent {
		
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
		 * @uses  MetaEventType::TEXT_EVENT
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::TEXT_EVENT;
		}
		
	}

?>