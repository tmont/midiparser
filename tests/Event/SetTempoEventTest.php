<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Event\SetTempoEvent;

	class SetTempoEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var SetTempoEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new SetTempoEvent(666666);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('90 BPM', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::SET_TEMPO, $this->obj->getSubtype());
		}
		
	}

?>