<?php
	
	namespace Midi\Tests\Event;

	class NoteAftertouchEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\NoteAftertouchEvent(1, \Midi\Util\Note::A4, 0x64);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('A4 with amount 100', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(\Midi\Event\EventType::NOTE_AFTERTOUCH, $this->obj->getType());
		}
	
	}

?>