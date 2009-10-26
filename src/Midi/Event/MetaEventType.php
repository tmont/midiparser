<?php
	
	/**
	 * \Midi\Event
	 *
	 * @package   Midi
	 * @copyright © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since     1.0
	 */

	namespace Midi\Event;

	/**
	 * Collection of constants representing the different
	 * meta event types
	 *
	 * @package Midi
	 * @since   1.0
	 */
	final class MetaEventType {
		/**
		 *
		 *
		 * @var int
		 */
		const SEQUENCE_NUMBER       = 0x00;
		/**
		 * Adds generic text content to a track
		 *
		 * @var int
		 */
		const TEXT_EVENT            = 0x01;
		/**
		 * Adds a copyright notice to a track; should be in the
		 * first track chunk
		 *
		 * @var int
		 */
		const COPYRIGHT_NOTICE      = 0x02;
		/**
		 * Name of the track
		 *
		 * @var int
		 */
		const TRACK_NAME            = 0x03;
		/**
		 *
		 *
		 * @var int
		 */
		const INSTRUMENT_NAME       = 0x04;
		/**
		 *
		 *
		 * @var int
		 */
		const LYRICS                = 0x05;
		/**
		 *
		 *
		 * @var int
		 */
		const MARKER                = 0x06;
		/**
		 *
		 *
		 * @var int
		 */
		const CUE_POINT             = 0x07;
		/**
		 *
		 *
		 * @var int
		 */
		const DEVICE_NAME           = 0x09;
		/**
		 * Signifies the end of the track; should always be the 
		 * last event of each track
		 *
		 * @var int
		 */
		const END_OF_TRACK          = 0x2F;
		/**
		 *
		 *
		 * @var int
		 */
		const CHANNEL_PREFIX        = 0x20;
		/**
		 * Sets the tempo
		 *
		 * @var int
		 */
		const SET_TEMPO             = 0x51;
		/**
		 *
		 *
		 * @var int
		 */
		const SMPTE_OFFSET          = 0x54;
		/**
		 * Sets the time signature
		 *
		 * @var int
		 */
		const TIME_SIGNATURE        = 0x58;
		/**
		 * Sets the key signature
		 *
		 * @var int
		 */
		const KEY_SIGNATURE         = 0x59;
		/**
		 * Sequencer specific events
		 *
		 * @var int
		 */
		const SEQUENCER_SPECIFIC    = 0x7F;
		
		const UNKNOWN = -1;
		
		private static $eventNameMap = array(
			0x00 => 'Sequence Number',
			0x01 => 'Text Event',
			0x02 => 'Copyright Notice',
			0x03 => 'Track Name',
			0x04 => 'Instrument Name',
			0x05 => 'Lyrics',
			0x06 => 'Marker',
			0x07 => 'Cue Point',
			0x20 => 'Channel Prefix',
			0x2F => 'End of Track',
			0x51 => 'Set Tempo',
			0x54 => 'SMTPE Offset',
			0x58 => 'Time Signature',
			0x59 => 'Key Signature',
			0x7F => 'Sequencer Specific'
		);
		
		/**
		 * Gets the name of the event type
		 *
		 * @since 1.0
		 * @todo  The name of this function is inconsistent with {@link EventType::getEventName()}
		 *
		 * @param  int $eventType
		 * @throws InvalidArgumentException
		 * @return string The friendly name of the event
		 */
		public static function getEventTypeName($eventType) {
			if (!isset(self::$eventNameMap[$eventType])) {
				return 'Unknown';
			}
			
			return self::$eventNameMap[$eventType];
		}
	}

?>