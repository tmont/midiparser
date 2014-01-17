<?php

	/**
	 * Tmont\Midi\Event\EndOfTrackEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  � 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Tmont\Midi\Event;
	
	/**
	 * Represents an end of track meta event
	 *
	 * This event should only ever appear as the last event of
	 * a track. Every track should end with one of these events.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class EndOfTrackEvent extends MetaEvent {
		
		/**
		 * @since 1.0
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return '';
		}
		
		/**
		 * @since 1.0
		 * @uses  MetaEventType::END_OF_TRACK
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::END_OF_TRACK;
		}
		
	}

?>