<?php
	
	namespace Midi\Tests\Event;
	
	use Midi\Event\EventFactory;
	use Midi\Event\EventType;
	use Midi\Event\MetaEventType;
	
	class EventFactoryTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new EventFactory();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testCreateChannelEvent() {
			$this->assertInstanceOf('\Midi\Event\NoteOffEvent', $this->obj->createChannelEvent(EventType::NOTE_OFF, 1, 1, 1));
			$this->assertInstanceOf('\Midi\Event\NoteOnEvent', $this->obj->createChannelEvent(EventType::NOTE_ON, 1, 1, 1));
			$this->assertInstanceOf('\Midi\Event\NoteAftertouchEvent', $this->obj->createChannelEvent(EventType::NOTE_AFTERTOUCH, 1, 1, 1));
			$this->assertInstanceOf('\Midi\Event\ControllerEvent', $this->obj->createChannelEvent(EventType::CONTROLLER, 1, 1, 1));
			$this->assertInstanceOf('\Midi\Event\ProgramChangeEvent', $this->obj->createChannelEvent(EventType::PROGRAM_CHANGE, 1, 1, 1));
			$this->assertInstanceOf('\Midi\Event\ChannelAftertouchEvent', $this->obj->createChannelEvent(EventType::CHANNEL_AFTERTOUCH, 1, 1, 1));
			$this->assertInstanceOf('\Midi\Event\PitchBendEvent', $this->obj->createChannelEvent(EventType::PITCH_BEND, 1, 1, 1));
		}
		
		public function testCreateChannelEventWithInvalidEventType() {
			$this->setExpectedException('Midi\MidiException', 'Invalid channel event');
			$this->obj->createChannelEvent(-1, 1, 1, 1);
		}
		
		public function testCreateMetaEvent() {
			$this->assertInstanceOf('\Midi\Event\SequenceNumberEvent', $this->obj->createMetaEvent(MetaEventType::SEQUENCE_NUMBER, pack('C2', 0, 1)));
			$this->assertInstanceOf('\Midi\Event\TextEvent', $this->obj->createMetaEvent(MetaEventType::TEXT_EVENT, 'foo'));
			$this->assertInstanceOf('\Midi\Event\CopyrightNoticeEvent', $this->obj->createMetaEvent(MetaEventType::COPYRIGHT_NOTICE, 'foo'));
			$this->assertInstanceOf('\Midi\Event\TrackNameEvent', $this->obj->createMetaEvent(MetaEventType::TRACK_NAME, 'foo'));
			$this->assertInstanceOf('\Midi\Event\InstrumentNameEvent', $this->obj->createMetaEvent(MetaEventType::INSTRUMENT_NAME, 'foo'));
			$this->assertInstanceOf('\Midi\Event\LyricsEvent', $this->obj->createMetaEvent(MetaEventType::LYRICS, 'foo'));
			$this->assertInstanceOf('\Midi\Event\MarkerEvent', $this->obj->createMetaEvent(MetaEventType::MARKER, 'foo'));
			$this->assertInstanceOf('\Midi\Event\CuePointEvent', $this->obj->createMetaEvent(MetaEventType::CUE_POINT, 'foo'));
			$this->assertInstanceOf('\Midi\Event\EndOfTrackEvent', $this->obj->createMetaEvent(MetaEventType::END_OF_TRACK, null));
			$this->assertInstanceOf('\Midi\Event\ChannelPrefixEvent', $this->obj->createMetaEvent(MetaEventType::CHANNEL_PREFIX, pack('C', 0)));
			$this->assertInstanceOf('\Midi\Event\SetTempoEvent', $this->obj->createMetaEvent(MetaEventType::SET_TEMPO, pack('C3', 0, 0, 1)));
			$this->assertInstanceOf('\Midi\Event\SmpteOffsetEvent', $this->obj->createMetaEvent(MetaEventType::SMPTE_OFFSET, pack('C5', 1, 2, 3, 4, 5)));
			$this->assertInstanceOf('\Midi\Event\TimeSignatureEvent', $this->obj->createMetaEvent(MetaEventType::TIME_SIGNATURE, pack('C4', 1, 2, 3, 4)));
			$this->assertInstanceOf('\Midi\Event\KeySignatureEvent', $this->obj->createMetaEvent(MetaEventType::KEY_SIGNATURE, pack('C2', 1, 2)));
			$this->assertInstanceOf('\Midi\Event\SequencerSpecificEvent', $this->obj->createMetaEvent(MetaEventType::SEQUENCER_SPECIFIC, 'foo'));
		}
		
		public function testCreateSystemExclusiveEvent() {
			$this->assertInstanceOf('\Midi\Event\SystemExclusiveEvent', $this->obj->createSystemExclusiveEvent(array('f')));
		}
		
		public function testCreateMetaEventWithInvalidEventType() {
			$this->assertInstanceOf('\Midi\Event\UnknownMetaEvent', $this->obj->createMetaEvent(MetaEventType::DEVICE_NAME, 1));
		}
	
	}

?>