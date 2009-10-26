<?php

	/**
	 * \Midi\Event\NoteOffEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a note off channel event
	 *
	 * This event turns a previously turned on note off. It is
	 * the equivalent of a note on event with a velociy of zero.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class NoteOffEvent extends ChannelEvent {
		
		/**
		 * @since 1.0
		 * @uses  Note::getNoteName()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return \Midi\Util\Note::getNoteName($this->param1) . ' with velocity ' . $this->param2;
		}
		
		/**
		 * @since 1.0
		 * @uses  EventType::NOTE_OFF
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::NOTE_OFF;
		}
		
	}

?>