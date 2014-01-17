<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\LyricsEvent;
	use Tmont\Midi\Event\MetaEventType;

	class LyricsEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var LyricsEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new LyricsEvent('yay!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('yay!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::LYRICS, $this->obj->getSubtype());
		}
		
	}

?>