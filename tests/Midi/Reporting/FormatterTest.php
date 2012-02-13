<?php
	
	namespace Midi\Tests\Reporting;
	
	use \Midi\Reporting\Formatter;

	class FormatterTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new Formatter();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testBeforeFile() {
			$this->assertNull($this->obj->beforeFile());
		}
		
		public function testBeforeFileHeader() {
			$fileHeader = $this->getMock('Midi\FileHeader', array(), array(), '', false);
			$this->assertNull($this->obj->beforeFileHeader($fileHeader));
		}
		
		public function testFormatFileHeader() {
			$fileHeader = $this->getMock('Midi\FileHeader', array(), array(), '', false);
			$this->assertNull($this->obj->formatFileHeader($fileHeader));
		}
		
		public function testAfterFileHeader() {
			$fileHeader = $this->getMock('Midi\FileHeader', array(), array(), '', false);
			$this->assertNull($this->obj->afterFileHeader($fileHeader));
		}
		
		public function testBeforeTrack() {
			$this->assertNull($this->obj->beforeTrack());
		}
		
		public function testBeforeTrackHeader() {
			$trackHeader = $this->getMock('Midi\TrackHeader', array(), array(), '', false);
			$this->assertNull($this->obj->beforeTrackHeader($trackHeader));
		}
		
		public function testFormatTrackHeader() {
			$trackHeader = $this->getMock('Midi\TrackHeader', array(), array(), '', false);
			$this->assertNull($this->obj->formatTrackHeader($trackHeader));
		}
		
		public function testAfterTrackHeader() {
			$trackHeader = $this->getMock('Midi\TrackHeader', array(), array(), '', false);
			$this->assertNull($this->obj->afterTrackHeader($trackHeader));
		}
		
		public function testBeforeDelta() {
			$delta = $this->getMock('Midi\Delta', array(), array(), '', false);
			$this->assertNull($this->obj->beforeDelta($delta));
		}
		
		public function testFormatDelta() {
			$delta = $this->getMock('Midi\Delta', array(), array(), '', false);
			$this->assertNull($this->obj->formatDelta($delta));
		}
		
		public function testAfterDelta() {
			$delta = $this->getMock('Midi\Delta', array(), array(), '', false);
			$this->assertNull($this->obj->afterDelta($delta));
		}
		
		public function testBeforeEvent() {
			$event = $this->getMock('Midi\Event', array('getType', 'getData', '__toString', 'toBinary', 'getLength'));
			$this->assertNull($this->obj->beforeEvent($event));
		}
		
		public function testFormatEvent() {
			$event = $this->getMock('Midi\Event', array('getType', 'getData', '__toString', 'toBinary', 'getLength'));
			$this->assertNull($this->obj->formatEvent($event));
		}
		
		public function testAfterEvent() {
			$event = $this->getMock('Midi\Event', array('getType', 'getData', '__toString', 'toBinary', 'getLength'));
			$this->assertNull($this->obj->afterEvent($event));
		}
		
		public function testAfterTrack() {
			$this->assertNull($this->obj->afterTrack());
		}
		
		public function testAfterFile() {
			$this->assertNull($this->obj->afterFile(1, 1));
		}
		
		public function testBeforeChunk() {
			$chunk = $this->getMock('Midi\Chunk', array('getData', '__toString', 'toBinary', 'getLength'));
			$this->assertNull($this->obj->beforeChunk($chunk));
		}
		
		public function testAfterChunk() {
			$chunk = $this->getMock('Midi\Chunk', array('getData', '__toString', 'toBinary', 'getLength'));
			$this->assertNull($this->obj->afterChunk($chunk));
		}
		
		public function testGetPostProcessor() {
			$this->assertInstanceOf('Midi\Reporting\DefaultPostProcessor', $this->obj->getPostProcessor());
		}
		
	}

?>