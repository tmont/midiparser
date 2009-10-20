<?php
	
	namespace Midi\Tests\Event;

	class ControllerEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\ControllerEvent(1, \Midi\Util\Controller::PAN, 0x64);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals(\Midi\Util\Controller::getControllerName(\Midi\Util\Controller::PAN) . ' value [100]', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(\Midi\Event\EventType::CONTROLLER, $this->obj->getType());
		}
		
	}

?>