<?php

	/**
	 * \Tmont\Midi\Event\NoteOnEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  � 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Tmont\Midi\Event;
	
	use Tmont\Midi\Util\Note;
	
	/**
	 * Represents a note on channel event
	 *
	 * Turns a note for a channel on. To achieve polyphony, use
	 * a delta time of zero with consecutive note on events.
	 *
	 * This event can be used in lieu of a note off event by repeating
	 * the same note on the same channel with a velocity of zero.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class NoteOnEvent extends ChannelEvent {
		
		/**
		 * @since 1.0
		 * @uses  Note::getNoteName()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return Note::getNoteName($this->param1) . ' with velocity ' . $this->param2;
		}
		
		/**
		 * @since 1.0
		 * @uses  EventType::NOTE_ON
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::NOTE_ON;
		}
		
	}

?>