<?php
	
	namespace Midi\Tests\Event;

	class SequencerSpecificEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\SequencerSpecificEvent(array(0x00));
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('read the manufacturer\'s manual', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::SEQUENCER_SPECIFIC, $this->obj->getSubtype());
		}
		
	}

?>