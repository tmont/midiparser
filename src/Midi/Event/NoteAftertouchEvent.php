<?php

	/**
	 * \Midi\Event\NoteAfterTouchEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	use Midi\Util\Note;
	
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
			return Note::getNoteName($this->param1) . ' with amount ' . $this->param2;
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