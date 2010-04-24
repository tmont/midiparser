<?php
	
	namespace Midi\Tests\Event;

	class ProgramChangeEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\ProgramChangeEvent(1, \Midi\Util\Instrument::HonkyTonk);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals(\Midi\Util\Instrument::getInstrumentName(\Midi\Util\Instrument::HonkyTonk), $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(\Midi\Event\EventType::PROGRAM_CHANGE, $this->obj->getType());
		}
		
		public function testGetLength() {
			$this->assertEquals(2, $this->obj->getLength());
		}
		
		public function testToBinary() {
			$this->assertEquals(pack('C2', 0xC1, \Midi\Util\Instrument::HonkyTonk), $this->obj->toBinary());
		}
		
	}

?>