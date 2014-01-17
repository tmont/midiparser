<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Event\TimeSignatureEvent;

	class TimeSignatureEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var TimeSignatureEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new TimeSignatureEvent(4, 4);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals(
				'4/4, metronome pulses every 24 clock ticks, 8 32nd notes per quarter note',
				$this->obj->getParamDescription()
			);
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::TIME_SIGNATURE, $this->obj->getSubtype());
		}
		
	}

?>