<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\KeySignatureEvent;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Util\Key;

	class KeySignatureEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var KeySignatureEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new KeySignatureEvent(0xFD, 0x01);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals(Key::getKeySignature(0xFD, 0x01), $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::KEY_SIGNATURE, $this->obj->getSubtype());
		}
		
	}

?>