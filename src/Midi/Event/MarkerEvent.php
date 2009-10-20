<?php

	/**
	 * \Midi\Event\MarkerEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a marker meta event
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 * @todo       Document what this event actually does
	 */
	class MarkerEvent extends MetaEvent {
		
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
		 * @uses  MetaEventType::MARKER
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::MARKER;
		}
		
	}

?>