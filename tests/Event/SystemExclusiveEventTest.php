<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\EventType;
	use Tmont\Midi\Event\SystemExclusiveEvent;
	use Tmont\Midi\Util\Util;

	class SystemExclusiveEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var SystemExclusiveEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new SystemExclusiveEvent(array_fill(0, 255, 'x'));
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testToString() {
			$this->assertEquals(EventType::getEventName(EventType::SYSTEM_EXCLUSIVE) . ': manufacturer dependent', $this->obj->__toString());
		}
		
		public function testToBinary() {
			$binary = 
				Util::pack(EventType::SYSTEM_EXCLUSIVE) .
				Util::getDeltaByteSequence(255) .
				str_repeat('x', 255);
			
			$this->assertEquals($binary, $this->obj->toBinary());
		}
		
		public function testIsNormalOrIsDivided() {
			$this->obj = new SystemExclusiveEvent(array(pack('C', 0x00)));
			$this->assertTrue($this->obj->isDivided());
			$this->assertFalse($this->obj->isNormal());
			
			$this->obj = new SystemExclusiveEvent(array(pack('C', 0xF7)));
			$this->assertFalse($this->obj->isDivided());
			$this->assertTrue($this->obj->isNormal());
		}
		
		public function testGetData() {
			$this->assertEquals(array_fill(0, 255, 'x'), $this->obj->getData());
		}
		
		public function testGetLength() {
			$this->assertSame(258, $this->obj->getLength());
		}
		
	}

?>