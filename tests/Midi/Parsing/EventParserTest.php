<?php
	
	namespace Midi\Tests\Parsing;
	
	use \Midi\Parsing;
	use \Midi\Parsing\ParseState;

	class EventParserTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new Parsing\EventParser();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testDefaultState() {
			$this->assertEquals(ParseState::EOF, $this->obj->getState());
		}
		
		public function testGetChannelEvent() {
			$this->assertType('\Midi\Event\NoteOffEvent', $this->obj->getChannelEvent(\Midi\Event\EventType::NOTE_OFF, 1, 1, 1));
			$this->assertType('\Midi\Event\NoteOnEvent', $this->obj->getChannelEvent(\Midi\Event\EventType::NOTE_ON, 1, 1, 1));
			$this->assertType('\Midi\Event\NoteAftertouchEvent', $this->obj->getChannelEvent(\Midi\Event\EventType::NOTE_AFTERTOUCH, 1, 1, 1));
			$this->assertType('\Midi\Event\ControllerEvent', $this->obj->getChannelEvent(\Midi\Event\EventType::CONTROLLER, 1, 1, 1));
			$this->assertType('\Midi\Event\ProgramChangeEvent', $this->obj->getChannelEvent(\Midi\Event\EventType::PROGRAM_CHANGE, 1, 1, 1));
			$this->assertType('\Midi\Event\ChannelAftertouchEvent', $this->obj->getChannelEvent(\Midi\Event\EventType::CHANNEL_AFTERTOUCH, 1, 1, 1));
			$this->assertType('\Midi\Event\PitchBendEvent', $this->obj->getChannelEvent(\Midi\Event\EventType::PITCH_BEND, 1, 1, 1));
		}
		
		public function testGetMetaEvent() {
			$this->assertType('\Midi\Event\SequenceNumberEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::SEQUENCE_NUMBER, pack('C2', 0, 1)));
			$this->assertType('\Midi\Event\TextEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::TEXT_EVENT, 'foo'));
			$this->assertType('\Midi\Event\CopyrightNoticeEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::COPYRIGHT_NOTICE, 'foo'));
			$this->assertType('\Midi\Event\TrackNameEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::TRACK_NAME, 'foo'));
			$this->assertType('\Midi\Event\InstrumentNameEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::INSTRUMENT_NAME, 'foo'));
			$this->assertType('\Midi\Event\LyricsEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::LYRICS, 'foo'));
			$this->assertType('\Midi\Event\MarkerEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::MARKER, 'foo'));
			$this->assertType('\Midi\Event\CuePointEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::CUE_POINT, 'foo'));
			$this->assertType('\Midi\Event\EndOfTrackEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::END_OF_TRACK, null));
			$this->assertType('\Midi\Event\ChannelPrefixEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::CHANNEL_PREFIX, pack('C', 0)));
			$this->assertType('\Midi\Event\SetTempoEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::SET_TEMPO, pack('C3', 0, 0, 1)));
			$this->assertType('\Midi\Event\SmpteOffsetEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::SMPTE_OFFSET, pack('C5', 1, 2, 3, 4, 5)));
			$this->assertType('\Midi\Event\TimeSignatureEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::TIME_SIGNATURE, pack('C4', 1, 2, 3, 4)));
			$this->assertType('\Midi\Event\KeySignatureEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::KEY_SIGNATURE, pack('C2', 1, 2)));
			$this->assertType('\Midi\Event\SequencerSpecificEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::SEQUENCER_SPECIFIC, 'foo'));
		}
		
		public function testGetSystemExclusiveEvent() {
			$this->assertType('\Midi\Event\SystemExclusiveEvent', $this->obj->getSystemExclusiveEvent(array('f')));
		}
		
		public function testGetMetaEventWithInvalidEventType() {
			$this->assertType('\Midi\Event\UnknownMetaEvent', $this->obj->getMetaEvent(\Midi\Event\MetaEventType::DEVICE_NAME, 1));
		}
		
		public function testGetChannelEventWithInvalidEventType() {
			$this->setExpectedException('Midi\MidiException');
			$this->obj->getChannelEvent(0xF0, 2, 1, 1);
		}
		
		public function testParseNormalChannelEvent() {
			$file = $this->getMock('SplFileObject', array('fseek'), array(), '', false);
			
			$bytes = $this->onConsecutiveCalls(
				pack('C', 0x80),
				pack('C2', 0x64, 0x65),
				pack('C', 0x64),
				pack('C2', 0x64, 0x00)
			);
			
			$event1 = $this->getMock('Midi\Event\ChannelEvent', array('getType', 'getParamDescription'), array(), '', false);
			$event2 = $this->getMock('Midi\Event\ChannelEvent', array('setContinuation', 'getType', 'getParamDescription'), array(), '', false);
			$event2->expects($this->once())
			       ->method('setContinuation');
			
			//normal channel event
			$this->obj = $this->getMock('Midi\Parsing\EventParser', array('getChannelEvent', 'read'));
			$this->obj->expects($this->exactly(4))
			          ->method('read')
			          ->will($bytes);
			
			$this->obj->expects($this->exactly(2))
			          ->method('getChannelEvent')
			          ->will($this->onConsecutiveCalls($event1, $event2));
			
			//continuation event
			$file->expects($this->once())
			     ->method('fseek')
			     ->with(-1, SEEK_CUR);
			
			$this->obj->setFile($file);
			$this->assertEquals($event1, $this->obj->parse());
			$this->assertEquals($event2, $this->obj->parse());
		}
		
		public function testParseSpecialChannelEvent() {
			$file = $this->getMock('SplFileObject', array('fseek'), array(), '', false);
			
			$bytes = $this->onConsecutiveCalls(
				pack('C', 0xC0),
				pack('C', 0x64),
				pack('C', 0x64),
				pack('C', 0x64)
			);
			
			$event1 = $this->getMock('Midi\Event\ChannelEvent', array('getType', 'getParamDescription'), array(), '', false);
			$event2 = $this->getMock('Midi\Event\ChannelEvent', array('setContinuation', 'getType', 'getParamDescription'), array(), '', false);
			$event2->expects($this->once())
			       ->method('setContinuation');
			
			//normal channel event
			$this->obj = $this->getMock('Midi\Parsing\EventParser', array('getChannelEvent', 'read'));
			$this->obj->expects($this->exactly(4))
			          ->method('read')
			          ->will($bytes);
			
			$this->obj->expects($this->exactly(2))
			          ->method('getChannelEvent')
			          ->with(0xC0, 0x00, 0x64, null)
			          ->will($this->onConsecutiveCalls($event1, $event2));
			
			//continuation event
			$file->expects($this->once())
			     ->method('fseek')
			     ->with(-1, SEEK_CUR);
			
			$this->obj->setFile($file);
			$this->assertEquals($event1, $this->obj->parse());
			$this->assertEquals($event2, $this->obj->parse());
		}
		
		public function testParseChannelEventWithoutContinuation() {
			//normal channel event
			$this->obj = $this->getMock('Midi\Parsing\EventParser', array('read'));
			$this->obj->expects($this->once())
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(0x7F));
			
			$this->setExpectedException('Midi\Parsing\ParseException');
			$this->obj->parse();
		}
		
		public function testParseMetaEvent() {
			//normal channel event
			$this->obj = $this->getMock('Midi\Parsing\EventParser', array('getMetaEvent', 'read', 'getDelta'));
			$this->obj->expects($this->at(0))
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(pack('C', 0xFF)));
			$this->obj->expects($this->at(1))
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(pack('C', 0x20)));
			$this->obj->expects($this->at(2))
			          ->method('read')
			          //->with(3, true) wtf?
			          ->will($this->returnValue(pack('C3', 0x21, 0x22, 0x23)));
			
			$this->obj->expects($this->once())
			          ->method('getDelta')
			          ->will($this->returnValue(3));
			
			$this->obj->expects($this->once())
			          ->method('getMetaEvent')
			          //->with(0x20, pack('C3', 0x21, 0x22, 0x23))
			          ->will($this->returnValue('yay for meta!'));
			
			$this->assertEquals('yay for meta!', $this->obj->parse());
		}
		
		public function testParseSystemExclusiveEvent() {
			//normal channel event
			$this->obj = $this->getMock('Midi\Parsing\EventParser', array('getSystemExclusiveEvent', 'read', 'getDelta'));
			$this->obj->expects($this->at(0))
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(pack('C', 0xF0)));
			$this->obj->expects($this->at(1))
			          ->method('read')
			          //->with(3, true) wtf?
			          ->will($this->returnValue('foo'));
			
			$this->obj->expects($this->once())
			          ->method('getDelta')
			          ->will($this->returnValue(3));
			
			$this->obj->expects($this->once())
			          ->method('getSystemExclusiveEvent')
			          //->with(array('f', 'o', 'o')) //wtf? phpunit bug?
			          ->will($this->returnValue('yay for sysex!'));
			
			$this->assertEquals('yay for sysex!', $this->obj->parse());
		}
		
		public function testParseUnknownEvent() {
			//normal channel event
			$this->obj = $this->getMock('Midi\Parsing\EventParser', array('read'));
			$this->obj->expects($this->once())
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(pack('C', 0xF3)));
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'Unsupported event type: 0xF3');
			$this->obj->parse();
		}
		
	}

?>