<?php
	
	namespace Midi\Tests\Emit;
	
	use \Midi\Emit\Track;

	class TrackTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new Track();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetData() {
			$delta = $this->getMock('Midi\Delta', array('getLength', 'toBinary'), array(), '', false);
			$delta->expects($this->once())
			      ->method('getLength')
			      ->will($this->returnValue(1));
			$delta->expects($this->once())
			      ->method('toBinary')
			      ->will($this->returnValue('delta|'));
			
			$event = $this->getMock('Midi\Event', array('getLength', 'toBinary', '__toString', 'getData', 'getType'), array(), '', false);
			$event->expects($this->once())
			      ->method('getLength')
			      ->will($this->returnValue(4));
			$event->expects($this->once())
			      ->method('toBinary')
			      ->will($this->returnValue('event'));
			
			$trackHeader = $this->getMock('Midi\TrackHeader', array('toBinary'), array(), '', false);
			$trackHeader->expects($this->once())
			            ->method('toBinary')
			            ->will($this->returnValue('track header|'));
			
			
			$this->obj = $this->getMock('Midi\Emit\Track', array('createTrackHeader'));
			$this->obj->expects($this->once())
			          ->method('createTrackHeader')
			          ->with(5)
			          ->will($this->returnValue($trackHeader));
			
			$this->obj->appendEvent($event, $delta);
			
			$this->assertEquals('track header|delta|event', $this->obj->getData());
		}
		
		public function testAppendEventWithoutDelta() {
			$event = $this->getMock('Midi\Event', array('getLength', 'toBinary', '__toString', 'getData', 'getType'), array(), '', false);
			$this->assertType('Midi\Emit\Track', $this->obj->appendEvent($event));
		}
		
		public function testCreateTrackHeader() {
			$header = $this->obj->createTrackHeader(2);
			$this->assertType('Midi\TrackHeader', $header);
			$this->assertEquals(2, $header->getSize());
		}
		
	}

?>