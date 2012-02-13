<?php

	/**
	 * \Midi\Event\EventType
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	use InvalidArgumentException;
	
	/**
	 * Represents the different MIDI events that can be fired in a track
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 * @todo       Finish documentation
	 */
	final class EventType {
		/**
		 * Turns a note off for a particular channel
		 *
		 * @var int
		 */
		const NOTE_OFF              = 0x80;
		/**
		 * Turns a note on for a particular channel
		 *
		 * @var int
		 */
		const NOTE_ON               = 0x90;
		/**
		 *
		 *
		 * @var int
		 */
		const NOTE_AFTERTOUCH       = 0xA0;
		/**
		 * Change to a controller for a particular channel
		 *
		 * @var int
		 */
		const CONTROLLER            = 0xB0;
		/**
		 * Changes a program (e.g. instrument for a channel)
		 *
		 * @var int
		 */
		const PROGRAM_CHANGE        = 0xC0;
		/**
		 *
		 *
		 * @var int
		 */
		const CHANNEL_AFTERTOUCH    = 0xD0;
		/**
		 * Bends the pitch for a particular channel
		 *
		 * @var int
		 */
		const PITCH_BEND            = 0xE0;
		/**
		 * System exclusive event
		 *
		 * @var int
		 */
		const SYSTEM_EXCLUSIVE      = 0xF0;
		/**
		 * Reserved event
		 *
		 * @var int
		 */
		const UNDEFINED1            = 0xF1;
		/**
		 *
		 *
		 * @var int
		 */
		const SONG_POSITION_POINTER = 0xF2;
		/**
		 * Selects a song
		 *
		 * @var int
		 */
		const SONG_SELECT           = 0xF3;
		/**
		 * Reserved event
		 *
		 * @var int
		 */
		const UNDEFINED2            = 0xF4;
		/**
		 * Reserved event
		 *
		 * @var int
		 */
		const UNDEFINED3            = 0xF5;
		/**
		 *
		 *
		 * @var int
		 */
		const TUNE_REQUEST          = 0xF6;
		/**
		 *
		 *
		 * @var int
		 */
		const AUTHORIZATION         = 0xF7;
		/**
		 *
		 *
		 * @var int
		 */
		const TIMING_CLOCK          = 0xF8;
		/**
		 * Reserved event
		 *
		 * @var int
		 */
		const UNDEFINED4            = 0xF9;
		/**
		 * Starts a sequence
		 *
		 * @var int
		 */
		const SEQUENCE_START        = 0xFA;
		/**
		 * Continues a previously stopped sequence
		 *
		 * @var int
		 */
		const SEQUENCE_CONTINUE     = 0xFB;
		/**
		 * Stops a sequence
		 *
		 * @var int
		 */
		const SEQUENCE_STOP         = 0xFC;
		/**
		 * Reserved event
		 *
		 * @var int
		 */
		const UNDEFINED5            = 0xFD;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ACTIVE_SENSING        = 0xFE;
		/**
		 * Represents a meta event
		 *
		 * @var int
		 */
		const META                  = 0xFF;
		
		private static $eventNameMap = array(
			0x80 => 'Note Off',
			0x90 => 'Note On',
			0xA0 => 'Note Aftertouch',
			0xB0 => 'Controller',
			0xC0 => 'Program Change',
			0xD0 => 'Channel Aftertouch',
			0xE0 => 'Pitch Bend',
			0xF0 => 'System Exclusive',
			0xF1 => 'Undefined',
			0xF2 => 'Song Position Pointer',
			0xF3 => 'Song Select',
			0xF4 => 'Undefined',
			0xF5 => 'Undefined',
			0xF6 => 'Tune Request',
			0xF7 => 'Authorization',
			0xF8 => 'Timing Clock',
			0xF9 => 'Undefined',
			0xFA => 'Sequence Start',
			0xFB => 'Sequence Continue',
			0xFC => 'Sequence Stop',
			0xFD => 'Undefined',
			0xFE => 'Active Sensing',
			0xFF => 'Meta'
		);
		
		/**
		 * Gets the name of an event
		 *
		 * @since 1.0
		 *
		 * @param  int $event One of the \Midi\EventType constants
		 * @throws InvalidArgumentException
		 * @return string The friendly name of the event
		 */
		public static function getEventName($event) {
			if (!isset(self::$eventNameMap[$event])) {
				throw new InvalidArgumentException('1st argument must be one of the EventType constants');
			}
			
			return self::$eventNameMap[$event];
		}
	}
	

?>