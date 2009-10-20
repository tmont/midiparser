<?php
	
	namespace Midi\Tests\Event;

	class EventTypeTest extends \PHPUnit_Framework_TestCase {
		
		public function testGetEventNameThrowsInvalidArgumentException() {
			$this->setExpectedException('InvalidArgumentException');
			\Midi\Event\EventType::getEventName(-1);
		}
		
		public function testGetEventName() {
			$eventNameMap = array(
				0x80 => 'Note Off',
				0x90 => 'Note On',
				0xA0 => 'Note Aftertouch',
				0xB0 => 'Controller',
				0xC0 => 'Program Change',
				0xD0 => 'Channel Aftertouch',
				0xE0 => 'Pitch Bend',
				0xF0 => 'System Exclusive',
				0xF1 => 'Undefined',
				0xF2 => 'Song Position Pointer',
				0xF3 => 'Song Select',
				0xF4 => 'Undefined',
				0xF5 => 'Undefined',
				0xF6 => 'Tune Request',
				0xF7 => 'Authorization',
				0xF8 => 'Timing Clock',
				0xF9 => 'Undefined',
				0xFA => 'Sequence Start',
				0xFB => 'Sequence Continue',
				0xFC => 'Sequence Stop',
				0xFD => 'Undefined',
				0xFE => 'Active Sensing',
				0xFF => 'Meta'
			);
			
			foreach ($eventNameMap as $event => $name) {
				$this->assertEquals(\Midi\Event\EventType::getEventName($event), $name);
			}
		}
	
	}

?>