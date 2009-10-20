<?php
	
	namespace Midi\Tests\Event;

	class CuePointEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\CuePointEvent('yay!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('yay!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::CUE_POINT, $this->obj->getSubtype());
		}
		
	}

?>