<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\EventType;
	use Tmont\Midi\Event\PitchBendEvent;

	class PitchBendEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var PitchBendEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new PitchBendEvent(1, 0xFFFF, 0xFFFF);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('+100 cents', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(EventType::PITCH_BEND, $this->obj->getType());
		}
		
	}

?>