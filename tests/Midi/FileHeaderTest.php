<?php
	
	namespace Midi\Tests;

	class FileHeaderTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\FileHeader(1, 12, 0x2460);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testToString() {
			$this->assertEquals('MIDI file header: MIDI format 1, 12 tracks, time division: 9312', $this->obj->__toString());
		}
		
		public function testToBinary() {
			$binary  = pack('C4', 0x4D, 0x54, 0x68, 0x64);
			$binary .= pack('C4', 0x00, 0x00, 0x00, 0x06);
			$binary .= pack('C2', 0x00, 1);
			$binary .= pack('C2', 0, 12);
			$binary .= pack('C2', 0x24, 0x60);
			$this->assertEquals($binary, $this->obj->toBinary());
		}
		
		public function testGetData() {
			$this->assertEquals(array(1, 12, 0x2460), $this->obj->getData());
		}
		
		public function testGetLength() {
			$this->assertEquals(14, $this->obj->getLength());
		}
		
	}

?>