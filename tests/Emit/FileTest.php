<?php

	namespace Tmont\Midi\Tests\Emit;
	
	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Emit\File;
	use Tmont\Midi\Emit\Track;

	class FileTest extends PHPUnit_Framework_TestCase {

		/**
		 * @var File
		 */
		private $obj;
		
		protected function setUp() {
			$this->obj = new File(240);
		}
		
		protected function tearDown() {
			$this->obj = null;
		}
		
		public function testGetDataForFormat0() {
			$track = $this->getMock('Tmont\Midi\Emit\Track', array('getData'));
			$track->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue('track data'));
			
			$fileHeader = $this->getMock('Tmont\Midi\FileHeader', array('toBinary'), array(), '', false);
			$fileHeader->expects($this->once())
			           ->method('toBinary')
			           ->will($this->returnValue('file header|'));
			
			$this->obj = $this->getMock('Tmont\Midi\Emit\File', array('createFileHeader'), array(240));
			$this->obj->expects($this->once())
			          ->method('createFileHeader')
			          ->with(0, 1, 240)
			          ->will($this->returnValue($fileHeader));
			
			$this->obj->addTrack($track);
			
			$this->assertEquals('file header|track data', $this->obj->getData());
		}
		
		public function testGetDataForFormat1() {
			$track1 = $this->getMock('Tmont\Midi\Emit\Track', array('getData'));
			$track1->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue('track 1 data|'));
			
			$track2 = $this->getMock('Tmont\Midi\Emit\Track', array('getData'));
			$track2->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue('track 2 data'));
			
			$fileHeader = $this->getMock('Tmont\Midi\FileHeader', array('toBinary'), array(), '', false);
			$fileHeader->expects($this->once())
			           ->method('toBinary')
			           ->will($this->returnValue('file header|'));
			
			$this->obj = $this->getMock('Tmont\Midi\Emit\File', array('createFileHeader'), array(240));
			$this->obj->expects($this->once())
			          ->method('createFileHeader')
			          ->with(1, 2, 240)
			          ->will($this->returnValue($fileHeader));
			
			$this->obj->addTrack($track1);
			$this->obj->addTrack($track2);
			
			$this->assertEquals('file header|track 1 data|track 2 data', $this->obj->getData());
		}
		
		public function testGetDataWithZeroTracks() {
			$this->setExpectedException('Tmont\Midi\MidiException', 'No tracks have been added');
			$this->obj->getData();
		}
		
		public function testGetDataForFormat0AndMultipleTracks() {
			$this->obj = new File(240, 0);
			$this->obj->addTrack(new Track(0));
			$this->obj->addTrack(new Track(0));
			
			$this->setExpectedException('Tmont\Midi\MidiException', 'Cannot have multiple tracks in MIDI format 0');
			$this->obj->getData();
		}
		
		public function testCreateFileObject() {
			$file = dirname(__DIR__) . '/data/file.txt';
			$this->assertInstanceOf('SplFileObject', $this->obj->createFileObject($file));
		}
		
		public function testCreateFileHeader() {
			$this->assertInstanceOf('Tmont\Midi\FileHeader', $this->obj->createFileHeader(0, 1, 240));
		}
		
		public function testSave() {
			$file = $this->getMock('SplTempFileObject', array('fwrite'));
			$file->expects($this->once())
			     ->method('fwrite')
			     ->with('foofy', 5);
			
			$this->obj = $this->getMock('Tmont\Midi\Emit\File', array('createFileObject', 'getData'), array(), '', false);
			$this->obj->expects($this->once())
			          ->method('createFileObject')
			          ->with('some kind of file')
			          ->will($this->returnValue($file));
			$this->obj->expects($this->once())
			          ->method('getData')
			          ->will($this->returnValue('foofy'));
			
			$this->assertEquals(5, $this->obj->save('some kind of file'));
		}
		
		public function testGetTimer() {
			$timer = $this->obj->getTimer();
			$this->assertInstanceOf('Tmont\Midi\Util\Timer', $timer);
			$this->assertEquals(240, $timer->getTimeDivision());
		}
	}

?>