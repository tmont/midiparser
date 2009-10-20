<?php
	
	namespace Midi\Tests\Event;

	class InstrumentNameEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\InstrumentNameEvent('yay!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('yay!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::INSTRUMENT_NAME, $this->obj->getSubtype());
		}
		
	}

?>