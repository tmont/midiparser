<?php
	
	namespace Midi\Tests;

	class DeltaTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Delta(255);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testToString() {
			$this->assertEquals('Delta value: 255', $this->obj->__toString());
		}
		
		public function testToBinary() {
			$this->assertEquals(pack('C2', 0x81, 0x7F), $this->obj->toBinary());
		}
		
		public function testGetData() {
			$this->assertEquals(array(255), $this->obj->getData());
		}
		
		public function testGetLength() {
			$this->assertSame(2, $this->obj->getLength());
		}
		
	}

?>