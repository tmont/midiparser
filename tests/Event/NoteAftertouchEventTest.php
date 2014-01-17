<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\EventType;
	use Tmont\Midi\Event\NoteAftertouchEvent;
	use Tmont\Midi\Util\Note;

	class NoteAftertouchEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var NoteAftertouchEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new NoteAftertouchEvent(1, Note::A4, 0x64);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('A4 with amount 100', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(EventType::NOTE_AFTERTOUCH, $this->obj->getType());
		}
	
	}

?>