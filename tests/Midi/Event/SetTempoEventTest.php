<?php
	
	namespace Midi\Tests\Event;

	class SetTempoEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\SetTempoEvent(666666);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('90 BPM', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::SET_TEMPO, $this->obj->getSubtype());
		}
		
	}

?>