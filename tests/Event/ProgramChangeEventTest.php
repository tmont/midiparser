<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\EventType;
	use Tmont\Midi\Event\ProgramChangeEvent;
	use Tmont\Midi\Util\Instrument;

	class ProgramChangeEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var ProgramChangeEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new ProgramChangeEvent(1, Instrument::HonkyTonk);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals(Instrument::getInstrumentName(Instrument::HonkyTonk), $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(EventType::PROGRAM_CHANGE, $this->obj->getType());
		}
		
		public function testGetLength() {
			$this->assertEquals(2, $this->obj->getLength());
		}
		
		public function testToBinary() {
			$this->assertEquals(pack('C2', 0xC1, Instrument::HonkyTonk), $this->obj->toBinary());
		}
		
	}

?>