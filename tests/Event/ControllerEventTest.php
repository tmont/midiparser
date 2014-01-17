<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\ControllerEvent;
	use Tmont\Midi\Event\EventType;
	use Tmont\Midi\Util\Controller;

	class ControllerEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var ControllerEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new ControllerEvent(1, Controller::PAN, 0x64);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals(Controller::getControllerName(Controller::PAN) . ' value [100]', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(EventType::CONTROLLER, $this->obj->getType());
		}
		
	}

?>