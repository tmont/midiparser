<?php
	
	namespace Midi\Tests\Event;

	class SequenceNumberEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\SequenceNumberEvent(13, 216);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('most significant bits: 13, least significant bits: 216', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::SEQUENCE_NUMBER, $this->obj->getSubtype());
		}
		
	}

?>