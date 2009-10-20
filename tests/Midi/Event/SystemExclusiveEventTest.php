<?php
	
	namespace Midi\Tests\Event;

	class SystemExclusiveEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\SystemExclusiveEvent(array_fill(0, 255, 'x'));
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testToString() {
			$this->assertEquals(\Midi\Event\EventType::getEventName(\Midi\Event\EventType::SYSTEM_EXCLUSIVE) . ': manufacturer dependent', $this->obj->__toString());
		}
		
		public function testToBinary() {
			$binary = 
				\Midi\Util\Util::pack(\Midi\Event\EventType::SYSTEM_EXCLUSIVE) .
				\Midi\Util\Util::getDeltaByteSequence(255) .
				str_repeat('x', 255);
			
			$this->assertEquals($binary, $this->obj->toBinary());
		}
		
		public function testIsNormalOrIsDivided() {
			$this->obj = new \Midi\Event\SystemExclusiveEvent(array(pack('C', 0x00)));
			$this->assertFalse($this->obj->isDivided());
			$this->assertTrue($this->obj->isNormal());
			
			$this->obj = new \Midi\Event\SystemExclusiveEvent(array(pack('C', 0xF7)));
			$this->assertTrue($this->obj->isDivided());
			$this->assertFalse($this->obj->isNormal());
		}
		
		public function testGetData() {
			$this->assertEquals(array_fill(0, 255, 'x'), $this->obj->getData());
		}
		
		public function testGetLength() {
			$this->assertSame(258, $this->obj->getLength());
		}
		
	}

?>