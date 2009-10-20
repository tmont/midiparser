<?php
	
	namespace Midi\Tests\Event;

	class SmpteOffsetEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\SmpteOffsetEvent(3, 21, 16, 36, 7, 58);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('21h 16m 36s 7.58f @ 30fps', $this->obj->getParamDescription());
		}
		
		public function testGetFrameRateDescription() {
			$this->assertEquals('24fps', \Midi\Event\SmpteOffsetEvent::getFrameRateDescription(0));
			$this->assertEquals('25fps', \Midi\Event\SmpteOffsetEvent::getFrameRateDescription(1));
			$this->assertEquals('30fps (drop frame)', \Midi\Event\SmpteOffsetEvent::getFrameRateDescription(2));
			$this->assertEquals('30fps', \Midi\Event\SmpteOffsetEvent::getFrameRateDescription(3));
		}
		
		public function testGetFrameRateDescriptionThrowsInvalidArgumentException() {
			$this->setExpectedException('InvalidArgumentException');
			\Midi\Event\SmpteOffsetEvent::getFrameRateDescription(7);
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::SMPTE_OFFSET, $this->obj->getSubtype());
		}
		
	}

?>