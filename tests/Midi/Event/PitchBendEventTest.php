<?php
	
	namespace Midi\Tests\Event;

	class PitchBendEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\PitchBendEvent(1, 0xFFFF, 0xFFFF);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('+100 cents', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(\Midi\Event\EventType::PITCH_BEND, $this->obj->getType());
		}
		
	}

?>