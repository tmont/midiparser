<?php
	
	namespace Midi\Tests\Event;
	
	use Midi\Event\ChannelEventFactory;
	use Midi\Event\EventType;
	
	class ChannelEventFactoryTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new ChannelEventFactory();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testCreate() {
			$this->assertType('\Midi\Event\NoteOffEvent', $this->obj->create(EventType::NOTE_OFF, 1, 1, 1));
			$this->assertType('\Midi\Event\NoteOnEvent', $this->obj->create(EventType::NOTE_ON, 1, 1, 1));
			$this->assertType('\Midi\Event\NoteAftertouchEvent', $this->obj->create(EventType::NOTE_AFTERTOUCH, 1, 1, 1));
			$this->assertType('\Midi\Event\ControllerEvent', $this->obj->create(EventType::CONTROLLER, 1, 1, 1));
			$this->assertType('\Midi\Event\ProgramChangeEvent', $this->obj->create(EventType::PROGRAM_CHANGE, 1, 1, 1));
			$this->assertType('\Midi\Event\ChannelAftertouchEvent', $this->obj->create(EventType::CHANNEL_AFTERTOUCH, 1, 1, 1));
			$this->assertType('\Midi\Event\PitchBendEvent', $this->obj->create(EventType::PITCH_BEND, 1, 1, 1));
		}
		
		public function testCreateWithInvalidEventType() {
			$this->setExpectedException('Midi\MidiException', 'Invalid channel event');
			$this->obj->create(-1, 1, 1, 1);
		}
	
	}

?>