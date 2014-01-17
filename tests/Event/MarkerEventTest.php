<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MarkerEvent;
	use Tmont\Midi\Event\MetaEventType;

	class MarkerEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var MarkerEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new MarkerEvent('yay!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('yay!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::MARKER, $this->obj->getSubtype());
		}
		
	}

?>