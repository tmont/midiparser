<?php
	
	namespace Tmont\Midi\Tests\Event;

	use Tmont\Midi\Event\ChannelPrefixEvent;
	use Tmont\Midi\Event\MetaEventType;

	class ChannelPrefixEventTest extends \PHPUnit_Framework_TestCase {
		/**
		 * @var ChannelPrefixEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new ChannelPrefixEvent(7);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('channel: 7', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::CHANNEL_PREFIX, $this->obj->getSubtype());
		}
		
	}

?>