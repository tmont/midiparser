<?php

	namespace Midi\Tests\Parsing;
	
	use \Midi\Parsing\FileParser;
	use \Midi\Parsing\ParseState;
	
	class FileParserTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		protected function setUp() {
			$this->obj = new FileParser();
		}
		
		protected function tearDown() {
			$this->obj = null;
		}
		
		private function commonStateTest($state) {
			$chunk = $this->getMock('Midi\Chunk', array('getLength', '__toString', 'toBinary', 'getData'));
			
			$trackParser = $this->getMock('Midi\Parsing\TrackParser', array('parse', 'getState'), array(), '', false);
			$trackParser->expects($this->once())
			            ->method('parse')
			            ->will($this->returnValue($chunk));
			$trackParser->expects($this->once())
			            ->method('getState')
			            ->will($this->returnValue(-1));
			
			$this->obj = $this->getMock('Midi\Parsing\FileParser', array('getState', 'setState'), array($trackParser));
			$this->obj->expects($this->atLeastOnce())
			          ->method('getState')
			          ->will($this->returnValue($state));
			$this->obj->expects($this->atLeastOnce())
			          ->method('setState')
			          ->with(-1);
			
			$parseChunk = $this->obj->parse();
			
			$this->assertEquals($chunk, $parseChunk);
		}
		
		public function testGetters() {
			$this->assertEquals(0, $this->obj->getTracksExpected());
			$this->assertEquals(0, $this->obj->getTracksParsed());
		}
		
		public function testLoad() {
			$file = $this->getMock('SplFileObject', array(), array(), '', false);
			$trackParser = $this->getMock('Midi\Parsing\TrackParser', array('setFile'), array(), '', false);
			
			//called by afterLoad()
			$trackParser->expects($this->once())
			            ->method('setFile')
			            ->with($file);
			
			$this->obj = new FileParser($trackParser);
			$this->obj->load($file);
		}
		
		public function testParseFileHeader() {
			$header  = pack('C4', 0x4D, 0x54, 0x68, 0x64); //header
			$header .= pack('C4', 0x00, 0x00, 0x00, 0x06); //chunk size
			$header .= pack('C2', 0x00, 0x01); //format
			$header .= pack('C2', 0x00, 0x02); //tracks
			$header .= pack('C2', 0x00, 0xF0); //time division
			
			$chunk = $this->obj->parseFileHeader($header);
			$this->assertType('Midi\FileHeader', $chunk);
			
			list($format, $tracks, $timeDivision) = $chunk->getData();
			$this->assertEquals(1, $format);
			$this->assertEquals(2, $tracks);
			$this->assertEquals(240, $timeDivision);
		}
		
		public function testParseFileHeaderWithInvalidHeaderSize() {
			$this->setExpectedException('InvalidArgumentException');
			$this->obj->parseFileHeader('x');
		}
		
		public function testParseFileHeaderWithInvalidHeader() {
			$header  = pack('C4', 0x4D, 0x54, 0x68, 0x65); //header
			$header .= pack('C4', 0x00, 0x00, 0x00, 0x06); //chunk size
			$header .= pack('C2', 0x00, 0x01); //format
			$header .= pack('C2', 0x00, 0x02); //tracks
			$header .= pack('C2', 0x00, 0xF0); //time division
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'Invalid file header, expected byte sequence [4D 54 68 64]');
			$this->obj->parseFileHeader($header);
		}
		
		public function testParseFileHeaderWithInvalidChunkSize() {
			$header  = pack('C4', 0x4D, 0x54, 0x68, 0x64); //header
			$header .= pack('C4', 0x00, 0x00, 0x00, 0x07); //chunk size
			$header .= pack('C2', 0x00, 0x01); //format
			$header .= pack('C2', 0x00, 0x02); //tracks
			$header .= pack('C2', 0x00, 0xF0); //time division
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'File header chunk size must be [00 00 00 06]');
			$this->obj->parseFileHeader($header);
		}
		
		public function testParseFileHeaderWithInvalidFormat() {
			$header  = pack('C4', 0x4D, 0x54, 0x68, 0x64); //header
			$header .= pack('C4', 0x00, 0x00, 0x00, 0x06); //chunk size
			$header .= pack('C2', 0x07, 0x01); //format
			$header .= pack('C2', 0x00, 0x02); //tracks
			$header .= pack('C2', 0x00, 0xF0); //time division
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'MIDI file format must be 0, 1 or 2 (got ' . 0x701 . ')');
			$this->obj->parseFileHeader($header);
		}
		
		public function testParseWhileInFileHeaderState() {
			$header = $this->getMock('Midi\FileHeader', array('getSize'), array(), '', false);
			$header->expects($this->any())
			       ->method('getSize')
			       ->will($this->returnValue(10));
			
			$this->obj = $this->getMock('Midi\Parsing\FileParser', array('getState', 'read', 'parseFileHeader'), array(), '', false);
			$this->obj->expects($this->once())
			          ->method('read')
			          ->with(14, true)
			          ->will($this->returnValue('foo'));
			$this->obj->expects($this->once())
			          ->method('parseFileHeader')
			          ->with('foo')
			          ->will($this->returnValue($header));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::FILE_HEADER));
			
			$chunk = $this->obj->parse();
			
			$this->assertType('Midi\FileHeader', $chunk);
			$this->assertEquals(10, $chunk->getSize());
		}
		
		public function testParseWhileInTrackHeaderState() {
			$chunk = $this->getMock('Midi\Chunk', array('getLength', '__toString', 'toBinary', 'getData'));
			
			$trackParser = $this->getMock('Midi\Parsing\TrackParser', array('parse', 'getState'), array(), '', false);
			$trackParser->expects($this->once())
			            ->method('parse')
			            ->will($this->returnValue($chunk));
			$trackParser->expects($this->once())
			            ->method('getState')
			            ->will($this->returnValue(ParseState::TRACK_HEADER));
			
			$this->obj = $this->getMock('Midi\Parsing\FileParser', array('getState', 'setState', 'getTracksExpected', 'getTracksParsed'), array($trackParser));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::TRACK_HEADER));
			$this->obj->expects($this->once())
			          ->method('setState')
			          ->with(ParseState::EOF);
			
			//fake like we've parsed all of the tracks in the file
			$this->obj->expects($this->once())
			          ->method('getTracksExpected')
			          ->will($this->returnValue(3));
			$this->obj->expects($this->once())
			          ->method('getTracksParsed')
			          ->will($this->returnValue(3));
			
			$parseChunk = $this->obj->parse();
			
			$this->assertEquals($chunk, $parseChunk);
		}
		
		public function testParseWhileInDeltaState() {
			$this->commonStateTest(ParseState::DELTA);
		}
		
		public function testParseWhileInEventState() {
			$this->commonStateTest(ParseState::EVENT);
		}
		
		public function testParseWhileInEofState() {
			$file = $this->getMock('SplFileObject', array('fgetc', 'eof'), array(), '', false);
			$file->expects($this->once())
			     ->method('fgetc');
			$file->expects($this->once())
			     ->method('eof')
			     ->will($this->returnValue(true));
			
			$this->obj = $this->getMock('Midi\Parsing\FileParser', array('getState'), array(), '', false);
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::EOF));
			$this->obj->setFile($file);
			
			$this->assertNull($this->obj->parse());
		}
		
		public function testParseWhileInEofStateWhenFileIsNotAtEof() {
			$file = $this->getMock('SplFileObject', array('fgetc', 'eof'), array(), '', false);
			$file->expects($this->once())
			     ->method('fgetc');
			$file->expects($this->once())
			     ->method('eof')
			     ->will($this->returnValue(false));
			
			$this->obj = $this->getMock('Midi\Parsing\FileParser', array('getState'), array(), '', false);
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::EOF));
			
			$this->obj->setFile($file);
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'Expected EOF');
			$this->obj->parse();
		}
		
		public function testParseWithInvalidState() {
			$this->obj = $this->getMock('Midi\Parsing\FileParser', array('getState'), array(), '', false);
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(-1));
			
			$this->setExpectedException('Midi\Parsing\StateException');
			$this->obj->parse();
		}
		
		public function testDefaultState() {
			$this->assertEquals(ParseState::FILE_HEADER, $this->obj->getState());
		}
		
	}

?>