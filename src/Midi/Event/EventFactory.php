<?php

	/**
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.1
	 */

	namespace Midi\Event;
	
	use Midi\MidiException;
	use Midi\Util\Util;

	/**
	 * Factory for creating events
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.1
	 */
	class EventFactory {
		
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
		public function createChannelEvent($eventType, $channel, $param1, $param2 = null) {
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
		
		/**
		 * Creates a meta event, or returns an {@link UnknownMetaEvent} if the specified
		 * event type is not supported
		 *
		 * @since 1.1
		 * @uses  Util::unpack()
		 * 
		 * @param  int    $eventType See {@link MetaEventType}
		 * @param  binary $data      Binary data associated with the event
		 * @return MetaEvent
		 */
		public function createMetaEvent($eventType, $data) {
			switch ($eventType) {
				case MetaEventType::SEQUENCE_NUMBER:
					$data = Util::unpack($data);
					return new SequenceNumberEvent($data[0], $data[1]);
				case MetaEventType::TEXT_EVENT:
					return new TextEvent($data);
				case MetaEventType::COPYRIGHT_NOTICE:
					return new CopyrightNoticeEvent($data);
				case MetaEventType::TRACK_NAME:
					return new TrackNameEvent($data);
				case MetaEventType::INSTRUMENT_NAME:
					return new InstrumentNameEvent($data);
				case MetaEventType::LYRICS:
					return new LyricsEvent($data);
				case MetaEventType::MARKER:
					return new MarkerEvent($data);
				case MetaEventType::CUE_POINT:
					return new CuePointEvent($data);
				case MetaEventType::END_OF_TRACK:
					return new EndOfTrackEvent();
				case MetaEventType::CHANNEL_PREFIX:
					$data = Util::unpack($data);
					return new ChannelPrefixEvent($data[0]);
				case MetaEventType::SET_TEMPO:
					$data = Util::unpack($data);
					$mpqn = ($data[0] << 16) | ($data[1] << 8) | $data[2];
					return new SetTempoEvent($mpqn);
				case MetaEventType::SMPTE_OFFSET:
					$data      = Util::unpack($data);
					$frameRate = ($data[0] >> 5) & 0xFF;
					$hour      = $data[0] & 0x1F;
					list(, $minute, $second, $frame, $subFrame) = $data;
					return new SmpteOffsetEvent($frameRate, $hour, $minute, $second, $frame, $subFrame);
				case MetaEventType::TIME_SIGNATURE:
					$data = Util::unpack($data);
					return new TimeSignatureEvent($data[0], pow(2, $data[1]), $data[2], $data[3]);
				case MetaEventType::KEY_SIGNATURE:
					$data = Util::unpack($data);
					return new KeySignatureEvent($data[0], $data[1]);
				case MetaEventType::SEQUENCER_SPECIFIC:
					return new SequencerSpecificEvent($data);
				default:
					return new UnknownMetaEvent($data);
			}
		}
		
		/**
		 * System exclusive event factory
		 *
		 * @since 1.1
		 * 
		 * @param  array $data
		 * @return SystemExclusiveEvent
		 */
		public function createSystemExclusiveEvent(array $data) {
			return new SystemExclusiveEvent($data);
		}
		
	}

?>