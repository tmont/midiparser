<?php
	
	namespace Tmont\Midi\Tests\Event;

	use Tmont\Midi\Event\EventType;
	use Tmont\Midi\Event\NoteOffEvent;
	use Tmont\Midi\Util\Note;

	class NoteOffEventTest extends \PHPUnit_Framework_TestCase {
		/**
		 * @var NoteOffEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new NoteOffEvent(1, Note::A4, 0x64);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('A4 with velocity 100', $this->obj->getParamDescription());
		}
		
		public function testGetType() {
			$this->assertSame(EventType::NOTE_OFF, $this->obj->getType());
		}
		
	}

?>