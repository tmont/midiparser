<?php
	
	namespace Tmont\Midi\Tests\Emit;
	
	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Emit\Track;

	class TrackTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var Track
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new Track();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetData() {
			$delta = $this->getMock('Tmont\Midi\Delta', array('getLength', 'toBinary'), array(), '', false);
			$delta->expects($this->once())
			      ->method('getLength')
			      ->will($this->returnValue(1));
			$delta->expects($this->once())
			      ->method('toBinary')
			      ->will($this->returnValue('delta|'));
			
			$event = $this->getMock('Tmont\Midi\Event', array('getLength', 'toBinary', '__toString', 'getData', 'getType'), array(), '', false);
			$event->expects($this->once())
			      ->method('getLength')
			      ->will($this->returnValue(4));
			$event->expects($this->once())
			      ->method('toBinary')
			      ->will($this->returnValue('event'));
			
			$trackHeader = $this->getMock('Tmont\Midi\TrackHeader', array('toBinary'), array(), '', false);
			$trackHeader->expects($this->once())
			            ->method('toBinary')
			            ->will($this->returnValue('track header|'));
			
			
			$this->obj = $this->getMock('Tmont\Midi\Emit\Track', array('createTrackHeader'));
			$this->obj->expects($this->once())
			          ->method('createTrackHeader')
			          ->with(5)
			          ->will($this->returnValue($trackHeader));
			
			$this->obj->appendEvent($event, $delta);
			
			$this->assertEquals('track header|delta|event', $this->obj->getData());
		}
		
		public function testAppendEventWithoutDelta() {
			$event = $this->getMock('Tmont\Midi\Event', array('getLength', 'toBinary', '__toString', 'getData', 'getType'), array(), '', false);
			$this->assertInstanceOf('Tmont\Midi\Emit\Track', $this->obj->appendEvent($event));
		}
		
		public function testCreateTrackHeader() {
			$header = $this->obj->createTrackHeader(2);
			$this->assertInstanceOf('Tmont\Midi\TrackHeader', $header);
			$this->assertEquals(2, $header->getSize());
		}
		
	}

?>