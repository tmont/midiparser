<?php

	/**
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.1
	 */

	namespace Midi\Event;
	
	use Midi\MidiException;

	/**
	 * Factory for creating channel events
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.1
	 */
	class ChannelEventFactory {
		
		/**
		 * Creates a channel event
		 *
		 * @since 1.1
		 * 
		 * @param  int      $eventType See {@link EventType}
		 * @param  int      $channel   4-bit unsigned integer
		 * @param  int      $param1
		 * @param  int|null $param2
		 * @throws {@link MidiException}
		 * @return ChannelEvent
		 */
		public function create($eventType, $channel, $param1, $param2 = null) {
			switch ($eventType) {
				case EventType::NOTE_OFF:
					return new NoteOffEvent($channel, $param1, $param2);
				case EventType::NOTE_ON:
					return new NoteOnEvent($channel, $param1, $param2);
				case EventType::NOTE_AFTERTOUCH:
					return new NoteAftertouchEvent($channel, $param1, $param2);
				case EventType::CONTROLLER:
					return new ControllerEvent($channel, $param1, $param2);
				case EventType::PROGRAM_CHANGE:
					return new ProgramChangeEvent($channel, $param1, $param2);
				case EventType::CHANNEL_AFTERTOUCH:
					return new ChannelAftertouchEvent($channel, $param1, $param2);
				case EventType::PITCH_BEND:
					return new PitchBendEvent($channel, $param1, $param2);
				default:
					throw new MidiException('Invalid channel event');
			}
		}
		
	}

?>