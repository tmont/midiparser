<?php

	namespace Midi\Tests\Emit;
	
	use \Midi\Emit\File;
	use \Midi\Emit\Track;
	use \Midi\FileHeader;
	
	class FileTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		protected function setUp() {
			$this->obj = new File(240);
		}
		
		protected function tearDown() {
			$this->obj = null;
		}
		
		public function testGetDataForFormat0() {
			$track = $this->getMock('Midi\Emit\Track', array('getData'));
			$track->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue('track data'));
			
			$fileHeader = $this->getMock('Midi\FileHeader', array('toBinary'), array(), '', false);
			$fileHeader->expects($this->once())
			           ->method('toBinary')
			           ->will($this->returnValue('file header|'));
			
			$this->obj = $this->getMock('Midi\Emit\File', array('createFileHeader'), array(240));
			$this->obj->expects($this->once())
			          ->method('createFileHeader')
			          ->with(0, 1, 240)
			          ->will($this->returnValue($fileHeader));
			
			$this->obj->addTrack($track);
			
			$this->assertEquals('file header|track data', $this->obj->getData());
		}
		
		public function testGetDataForFormat1() {
			$track1 = $this->getMock('Midi\Emit\Track', array('getData'));
			$track1->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue('track 1 data|'));
			
			$track2 = $this->getMock('Midi\Emit\Track', array('getData'));
			$track2->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue('track 2 data'));
			
			$fileHeader = $this->getMock('Midi\FileHeader', array('toBinary'), array(), '', false);
			$fileHeader->expects($this->once())
			           ->method('toBinary')
			           ->will($this->returnValue('file header|'));
			
			$this->obj = $this->getMock('Midi\Emit\File', array('createFileHeader'), array(240));
			$this->obj->expects($this->once())
			          ->method('createFileHeader')
			          ->with(1, 2, 240)
			          ->will($this->returnValue($fileHeader));
			
			$this->obj->addTrack($track1);
			$this->obj->addTrack($track2);
			
			$this->assertEquals('file header|track 1 data|track 2 data', $this->obj->getData());
		}
		
		public function testGetDataWithZeroTracks() {
			$this->setExpectedException('Midi\MidiException', 'No tracks have been added');
			$this->obj->getData();
		}
		
		public function testGetDataForFormat0AndMultipleTracks() {
			$this->obj = new File(240, 0);
			$this->obj->addTrack(new Track(0));
			$this->obj->addTrack(new Track(0));
			
			$this->setExpectedException('Midi\MidiException', 'Cannot have multiple tracks in MIDI format 0');
			$this->obj->getData();
		}
		
		public function testCreateFileObject() {
			$file = dirname(dirname(dirname(__FILE__))) . '/data/file.txt';
			$this->assertInstanceOf('SplFileObject', $this->obj->createFileObject($file));
		}
		
		public function testCreateFileHeader() {
			$this->assertInstanceOf('Midi\FileHeader', $this->obj->createFileHeader(0, 1, 240));
		}
		
		public function testSave() {
			$file = $this->getMock('SplFileObject', array('fwrite'), array(), '', false);
			$file->expects($this->once())
			     ->method('fwrite')
			     ->with('foofy', 5);
			
			$this->obj = $this->getMock('Midi\Emit\File', array('createFileObject', 'getData'), array(), '', false);
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
			$this->assertInstanceOf('Midi\Util\Timer', $timer);
			$this->assertEquals(240, $timer->getTimeDivision());
		}
		
	}

?>