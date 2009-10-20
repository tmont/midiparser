<?php
	
	namespace Midi\Tests\Event;

	class NoteOnEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\NoteOnEvent(1, \Midi\Util\Note::A4, 0x64);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('A4 with velocity 100', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(\Midi\Event\EventType::NOTE_ON, $this->obj->getType());
		}
		
	}

?>