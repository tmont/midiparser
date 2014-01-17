<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\InstrumentNameEvent;
	use Tmont\Midi\Event\MetaEventType;

	class InstrumentNameEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var InstrumentNameEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new InstrumentNameEvent('yay!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('yay!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::INSTRUMENT_NAME, $this->obj->getSubtype());
		}
		
	}

?>