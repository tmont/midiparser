<?php
	
	namespace Midi\Tests\Event;

	class ChannelAftertouchEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\ChannelAftertouchEvent(1, 0x64, 0x00);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('aftertouch pressure [100]', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(\Midi\Event\EventType::CHANNEL_AFTERTOUCH, $this->obj->getType());
		}
		
		public function testGetLength() {
			$this->assertEquals(2, $this->obj->getLength());
		}
		
	}

?>