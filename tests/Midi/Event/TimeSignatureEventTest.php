<?php
	
	namespace Midi\Tests\Event;

	class TimeSignatureEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\TimeSignatureEvent(4, 4);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals(
				'4/4, metronome pulses every 24 clock ticks, 8 32nd notes per quarter note',
				$this->obj->getParamDescription()
			);
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::TIME_SIGNATURE, $this->obj->getSubtype());
		}
		
	}

?>