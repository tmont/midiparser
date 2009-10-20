<?php
	
	namespace Midi\Tests\Event;

	class KeySignatureEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\KeySignatureEvent(0xFD, 0x01);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals(\Midi\Util\Key::getKeySignature(0xFD, 0x01), $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::KEY_SIGNATURE, $this->obj->getSubtype());
		}
		
	}

?>