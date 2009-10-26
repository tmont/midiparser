<?php
	
	namespace Midi\Tests\Event;

	class MetaEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = $this->getMock(
				'\Midi\Event\MetaEvent',
				array('getParamDescription', 'getSubtype'),
				array(str_repeat('x', 255))
			);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testToString() {
			$this->obj->expects($this->once())
			          ->method('getParamDescription')
			          ->will($this->returnValue('foo'));
			
			$this->obj->expects($this->once())
			          ->method('getSubtype')
			          ->will($this->returnValue(\Midi\Event\MetaEventType::SEQUENCE_NUMBER));
			
			$this->assertEquals(
				\Midi\Event\MetaEventType::getEventTypeName(\Midi\Event\MetaEventType::SEQUENCE_NUMBER) . ': foo',
				$this->obj->__toString()
			);
		}
		
		public function testToBinary() {
			$this->obj = $this->getMock(
				'\Midi\Event\MetaEvent',
				array('getParamDescription', 'getSubtype'),
				array(array(0x43, 0x12, 0xA9))
			);
			
			$this->obj->expects($this->once())
			          ->method('getSubtype')
			          ->will($this->returnValue(\Midi\Event\MetaEventType::SEQUENCE_NUMBER));
			
			$this->assertEquals(
				pack(
					'C*',
					\Midi\Event\EventType::META,
					\Midi\Event\MetaEventType::SEQUENCE_NUMBER, 
					0x03,
					0x43,
					0x12,
					0xA9
				),
				$this->obj->toBinary()
			);
		}
		
		public function testToBinaryWithAsciiText() {
			$this->obj->expects($this->once())
			          ->method('getSubtype')
			          ->will($this->returnValue(\Midi\Event\MetaEventType::SEQUENCE_NUMBER));
			
			$this->assertEquals(
				pack(
					'C*',
					\Midi\Event\EventType::META,
					\Midi\Event\MetaEventType::SEQUENCE_NUMBER, 
					0x81, 
					0x7F
				) . str_repeat('x', 255),
				$this->obj->toBinary()
			);
		}
		
		public function testGetData() {
			$this->obj->expects($this->once())
			          ->method('getSubtype')
			          ->will($this->returnValue(\Midi\Event\MetaEventType::SEQUENCE_NUMBER));
			
			$this->assertEquals(
				array(
					\Midi\Event\MetaEventType::SEQUENCE_NUMBER,
					255,
					str_repeat('x', 255)
				), 
				$this->obj->getData()
			);
		}
		
		public function testGetLength() {
			$this->assertEquals(259, $this->obj->getLength());
		}
		
		public function testGetType() {
			$this->assertSame(\Midi\Event\EventType::META, $this->obj->getType());
		}
		
	}

?>