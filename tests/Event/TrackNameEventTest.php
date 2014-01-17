<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Event\TrackNameEvent;

	class TrackNameEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var TrackNameEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new TrackNameEvent('yay!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('yay!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::TRACK_NAME, $this->obj->getSubtype());
		}
		
	}

?>