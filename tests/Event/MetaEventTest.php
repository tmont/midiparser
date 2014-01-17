<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\EventType;
	use Tmont\Midi\Event\MetaEvent;
	use Tmont\Midi\Event\MetaEventType;

	class MetaEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var MetaEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = $this->getMock(
				'\Tmont\Midi\Event\MetaEvent',
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
			          ->will($this->returnValue(MetaEventType::SEQUENCE_NUMBER));
			
			$this->assertEquals(
				MetaEventType::getEventTypeName(MetaEventType::SEQUENCE_NUMBER) . ': foo',
				$this->obj->__toString()
			);
		}
		
		public function testToBinary() {
			$this->obj = $this->getMock(
				'\Tmont\Midi\Event\MetaEvent',
				array('getParamDescription', 'getSubtype'),
				array(array(0x43, 0x12, 0xA9))
			);
			
			$this->obj->expects($this->once())
			          ->method('getSubtype')
			          ->will($this->returnValue(MetaEventType::SEQUENCE_NUMBER));
			
			$this->assertEquals(
				pack(
					'C*',
					EventType::META,
					MetaEventType::SEQUENCE_NUMBER,
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
			          ->will($this->returnValue(MetaEventType::SEQUENCE_NUMBER));
			
			$this->assertEquals(
				pack(
					'C*',
					EventType::META,
					MetaEventType::SEQUENCE_NUMBER,
					0x81, 
					0x7F
				) . str_repeat('x', 255),
				$this->obj->toBinary()
			);
		}
		
		public function testGetData() {
			$this->obj->expects($this->once())
			          ->method('getSubtype')
			          ->will($this->returnValue(MetaEventType::SEQUENCE_NUMBER));
			
			$this->assertEquals(
				array(
					MetaEventType::SEQUENCE_NUMBER,
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
			$this->assertSame(EventType::META, $this->obj->getType());
		}
		
	}

?>