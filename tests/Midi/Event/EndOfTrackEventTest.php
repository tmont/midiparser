<?php
	
	namespace Midi\Tests\Event;

	class EndOfTrackEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\EndOfTrackEvent();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::END_OF_TRACK, $this->obj->getSubtype());
		}
		
	}

?>