<?php

	namespace Tmont\Midi\Tests\Reporting;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Reporting\TextFormatter;

	class TextFormatterTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var TextFormatter
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new TextFormatter();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testBeforeFile() {
			$this->assertEquals("---- FILE START ----\n", $this->obj->beforeFile());
		}
		
		public function testBeforeFileHeader() {
			$fileHeader = $this->getMock('Tmont\Midi\FileHeader', array('getData'), array(), '', false);
			$this->assertEquals("---- FILE HEADER ----\n", $this->obj->beforeFileHeader($fileHeader));
		}
		
		public function testFormatFileHeader() {
			$expected =  "format:        1\n";
			$expected .= "tracks:        7\n";
			$expected .= "time division: 240\n";
			
			$fileHeader = $this->getMock('Tmont\Midi\FileHeader', array('getData'), array(), '', false);
			$fileHeader->expects($this->once())
			           ->method('getData')
			           ->will($this->returnValue(array(1, 7, 240)));
			
			$this->assertEquals($expected, $this->obj->formatFileHeader($fileHeader));
		}
		
		public function testAfterFileHeader() {
			$this->obj = $this->getMock('Tmont\Midi\Reporting\TextFormatter', array('decreaseIndent'));
			$this->obj->expects($this->once())
			          ->method('decreaseIndent');
			
			$fileHeader = $this->getMock('Tmont\Midi\FileHeader', array('getData'), array(), '', false);
			$this->assertNull($this->obj->afterFileHeader($fileHeader));
		}
		
		public function testFormatTrackHeaderAndAfterTrack() {
			$trackHeader = $this->getMock('Tmont\Midi\TrackHeader', array('getData'), array(), '', false);
			$trackHeader->expects($this->exactly(2))
			            ->method('getData')
			            ->will($this->onConsecutiveCalls(array(3), array(5)));
			
			$this->assertEquals("---- TRACK 1 (3 bytes) ----\n", $this->obj->formatTrackHeader($trackHeader));
			$this->obj->afterTrack();
			$this->assertEquals("---- TRACK 2 (5 bytes) ----\n", $this->obj->formatTrackHeader($trackHeader));
		}
		
		public function testFormatDelta() {
			$delta = $this->getMock('Tmont\Midi\Delta', array('getData'), array(), '', false);
			$delta->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue(array(100)));
			
			$this->assertEquals("delta: 100\n", $this->obj->formatDelta($delta));
		}
		
		public function testFormatEvent() {
			$event = $this->getMock('Tmont\Midi\Event', array('getData', '__toString', 'toBinary', 'getLength', 'getType'), array(), '', false);
			$event->expects($this->once())
			      ->method('__toString')
			      ->will($this->returnValue('yay!'));
			
			$this->assertEquals("yay!\n", $this->obj->formatEvent($event));
		}
		
	}

?>