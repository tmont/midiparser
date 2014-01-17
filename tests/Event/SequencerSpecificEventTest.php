<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Event\SequencerSpecificEvent;

	class SequencerSpecificEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var SequencerSpecificEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new SequencerSpecificEvent(array(0x00));
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('read the manufacturer\'s manual', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::SEQUENCER_SPECIFIC, $this->obj->getSubtype());
		}
		
	}

?>