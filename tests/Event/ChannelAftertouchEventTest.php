<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\ChannelAftertouchEvent;
	use Tmont\Midi\Event\EventType;

	class ChannelAftertouchEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var ChannelAftertouchEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new ChannelAftertouchEvent(1, 0x64, 0x00);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('aftertouch pressure [100]', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(EventType::CHANNEL_AFTERTOUCH, $this->obj->getType());
		}
		
		public function testGetLength() {
			$this->assertEquals(2, $this->obj->getLength());
		}
		
	}

?>