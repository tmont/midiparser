<?php
	
	namespace Midi\Tests\Event;

	class MetaEventTypeTest extends \PHPUnit_Framework_TestCase {
		
		public function testGetEventTypeNameWithUnknownEvent() {
			$this->assertEquals('Unknown', \Midi\Event\MetaEventType::getEventTypeName(-1));
		}
		
		public function testGetEventTypeName() {
			$eventNameMap = array(
				0x00 => 'Sequence Number',
				0x01 => 'Text Event',
				0x02 => 'Copyright Notice',
				0x03 => 'Track Name',
				0x04 => 'Instrument Name',
				0x05 => 'Lyrics',
				0x06 => 'Marker',
				0x07 => 'Cue Point',
				0x20 => 'Channel Prefix',
				0x2F => 'End of Track',
				0x51 => 'Set Tempo',
				0x54 => 'SMTPE Offset',
				0x58 => 'Time Signature',
				0x59 => 'Key Signature',
				0x7F => 'Sequencer Specific'
			);
			
			foreach ($eventNameMap as $event => $name) {
				$this->assertEquals(\Midi\Event\MetaEventType::getEventTypeName($event), $name);
			}
		}
	
	}

?>