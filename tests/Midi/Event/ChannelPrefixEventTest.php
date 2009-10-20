<?php
	
	namespace Midi\Tests\Event;

	class ChannelPrefixEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\ChannelPrefixEvent(7);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('channel: 7', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::CHANNEL_PREFIX, $this->obj->getSubtype());
		}
		
	}

?>