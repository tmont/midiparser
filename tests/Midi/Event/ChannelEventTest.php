<?php
	
	namespace Midi\Tests\Event;

	class ChannelEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = $this->getMock(
				'\Midi\Event\ChannelEvent',
				array('getParamDescription', 'getType'),
				array(1, 0x50, 0x64)
			);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testToString() {
			$this->obj->expects($this->once())
			          ->method('getType')
			          ->will($this->returnValue(\Midi\Event\EventType::NOTE_OFF));
			$this->obj->expects($this->once())
			          ->method('getParamDescription')
			          ->will($this->returnValue('bar'));
			
			$this->assertEquals(\Midi\Event\EventType::getEventName(\Midi\Event\EventType::NOTE_OFF) . ' (channel 1): bar', $this->obj->__toString());
		}
		
		public function testToBinary() {
			$this->obj->expects($this->once())
			          ->method('getType')
			          ->will($this->returnValue(\Midi\Event\EventType::NOTE_OFF));
			$this->assertEquals(pack('C3', \Midi\Event\EventType::NOTE_OFF | 1, 0x50, 0x64), $this->obj->toBinary());
		}
		
		public function testGetData() {
			$this->assertEquals(array(1, 0x50, 0x64), $this->obj->getData());
		}
		
		public function testGetLength() {
			$this->assertSame(3, $this->obj->getLength());
		}
		
		public function testSetContinuation() {
			$this->obj->setContinuation(true);
			$this->assertTrue($this->obj->isContinuation());
			$this->obj->setContinuation(false);
			$this->assertFalse($this->obj->isContinuation());
		}
		
	}

?>