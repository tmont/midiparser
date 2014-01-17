<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\CuePointEvent;
	use Tmont\Midi\Event\MetaEventType;

	class CuePointEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var CuePointEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new CuePointEvent('yay!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('yay!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::CUE_POINT, $this->obj->getSubtype());
		}
		
	}

?>