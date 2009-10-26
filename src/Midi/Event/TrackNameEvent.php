<?php

	/**
	 * \Midi\Event\TrackNameEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a track name meta event
	 *
	 * This event just names the track. There should only be
	 * one per track.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class TrackNameEvent extends MetaEvent {
		
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
		 * @uses  MetaEventType::TRACK_NAME
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::TRACK_NAME;
		}
		
	}

?>