<?php

	/**
	 * \Midi\Event\CopyrightNoticeEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents the copyright notice meta event
	 *
	 * This event should always have a delta time of zero
	 * and be in the first track.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class CopyrightNoticeEvent extends MetaEvent {
		
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
		 * @uses  MetaEventType::COPYRIGHT_NOTICE
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::COPYRIGHT_NOTICE;
		}
		
	}

?>