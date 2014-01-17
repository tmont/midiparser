<?php
	
	namespace Tmont\Midi\Tests;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\TrackHeader;

	class TrackHeaderTest extends PHPUnit_Framework_TestCase {

		/**
		 * @var TrackHeader
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new TrackHeader(0x974A8);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testToString() {
			$this->assertEquals('Track (619688 bytes)', $this->obj->__toString());
		}
		
		public function testToBinary() {
			$binary  = pack('C4', 0x4D, 0x54, 0x72, 0x6B);
			$binary .= pack('C4', 0x00, 0x09, 0x74, 0xA8);
			$this->assertEquals($binary, $this->obj->toBinary());
		}
		
		public function testGetData() {
			$this->assertEquals(array(0x974A8), $this->obj->getData());
		}
		
		public function testGetLength() {
			$this->assertEquals(8, $this->obj->getLength());
		}
		
	}

?>