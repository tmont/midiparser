<?php

	namespace Tmont\Midi\Tests\Util;
	
	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Util\Util;

	class UtilTest extends PHPUnit_Framework_TestCase {
		
		public function testGetDeltaByteSequence() {
			$this->assertEquals(pack('C2', 0x81, 0x7F), Util::getDeltaByteSequence(0xFF));
			$this->assertEquals(pack('C', 0x69), Util::getDeltaByteSequence(0x69));
		}
		
		public function testGetTicksFromDeltaByteSequence() {
			$this->assertEquals(0xFF, Util::getTicksFromDeltaByteSequence(pack('C2', 0x81, 0x7F)));
			$this->assertEquals(0x69, Util::getTicksFromDeltaByteSequence(pack('C', 0x69)));
		}
		
		public function testBinaryToHex() {	
			$binary = pack('C3', 0x00, 0x80, 0x9A);
			$this->assertSame(array('00', '80', '9A'), Util::binaryToHex($binary));
		}
		
		public function testPackWithNullValues() {	
			$this->assertSame(pack('C2', 0x30, 0x20),Util::pack(0x30, 0x20, null));
		}
		
	}

?>