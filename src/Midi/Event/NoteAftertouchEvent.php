<?php

	/**
	 * \Midi\Event\NoteAfterTouchEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents the note aftertouch channel event
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 * @todo       Describe what this event actually does
	 */
	class NoteAftertouchEvent extends ChannelEvent {
		
		/**
		 * @since 1.0
		 * @uses  Note::getNoteName()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return \Midi\Util\Note::getNoteName($this->param1) . ' with amount ' . $this->param2;
		}
		
		/**
		 * @since 1.0
		 * @uses  EventType::NOTE_AFTERTOUCH
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::NOTE_AFTERTOUCH;
		}
		
	}

?>