<?php

	/**
	 * \Midi\Event\LyricsEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a lyrics meta event
	 *
	 * Lyrics events should be in the first track, and can
	 * be spread out (using delta) to line up with the music.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class LyricsEvent extends MetaEvent {
		
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
		 * @uses  MetaEventType::LYRICS
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::LYRICS;
		}
		
	}

?>