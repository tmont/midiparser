<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Event\SmpteOffsetEvent;

	class SmpteOffsetEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var SmpteOffsetEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new SmpteOffsetEvent(3, 21, 16, 36, 7, 58);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('21h 16m 36s 7.58f @ 30fps', $this->obj->getParamDescription());
		}
		
		public function testGetFrameRateDescription() {
			$this->assertEquals('24fps', SmpteOffsetEvent::getFrameRateDescription(0));
			$this->assertEquals('25fps', SmpteOffsetEvent::getFrameRateDescription(1));
			$this->assertEquals('30fps (drop frame)', SmpteOffsetEvent::getFrameRateDescription(2));
			$this->assertEquals('30fps', SmpteOffsetEvent::getFrameRateDescription(3));
		}
		
		public function testGetFrameRateDescriptionThrowsInvalidArgumentException() {
			$this->setExpectedException('InvalidArgumentException');
			SmpteOffsetEvent::getFrameRateDescription(7);
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::SMPTE_OFFSET, $this->obj->getSubtype());
		}
		
	}

?>