<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Event\SequenceNumberEvent;

	class SequenceNumberEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var SequenceNumberEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new SequenceNumberEvent(13, 216);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('most significant bits: 13, least significant bits: 216', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::SEQUENCE_NUMBER, $this->obj->getSubtype());
		}
		
	}

?>