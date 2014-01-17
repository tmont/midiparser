<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\EndOfTrackEvent;
	use Tmont\Midi\Event\MetaEventType;

	class EndOfTrackEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var EndOfTrackEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new EndOfTrackEvent();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::END_OF_TRACK, $this->obj->getSubtype());
		}
		
	}

?>