<?php

	namespace Midi\Tests\Parsing;
	
	use \Midi\Parsing\TrackParser;
	use \Midi\Parsing\ParseState;
	
	class TrackParserTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new TrackParser();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetters() {
			$this->assertEquals(0, $this->obj->getExpectedTrackLength());
			$this->assertEquals(0, $this->obj->getParsedTrackLength());
		}
		
		public function testAfterSetFile() {
			//see http://www.phpunit.de/ticket/1046 for why we're mocking fgets() for no reason
			$file = $this->getMock('SplFileObject', array('fgets'), array(), '', false);
			$deltaParser = $this->getMock('Midi\Parsing\DeltaParser', array('setFile'), array(), '', false);
			$deltaParser->expects($this->once())
			            ->method('setFile')
			            ->with($file);
			
			$eventParser = $this->getMock('Midi\Parsing\EventParser', array('setFile'), array(), '', false);
			$eventParser->expects($this->once())
			            ->method('setFile')
			            ->with($file);
			
			$this->obj = new TrackParser($eventParser, $deltaParser);
			$this->obj->setFile($file);
		}
		
		public function testParseTrackHeader() {
			$header  = pack('C4', 0x4D, 0x54, 0x72, 0x6B);
			$header .= pack('C4', 0x00, 0x00, 0x00, 0x05);
			
			$chunk = $this->obj->parseTrackHeader($header);
			
			$this->assertType('Midi\TrackHeader', $chunk);
			$this->assertEquals(5, $chunk->getSize());
		}
		
		public function testParseTrackHeaderWithInvalidHeaderLength() {
			$this->setExpectedException('InvalidArgumentException');
			$this->obj->parseTrackHeader('foo');
		}
		
		public function testParseTrackHeaderWithInvalidHeader() {
			$header  = pack('C4', 0x4D, 0x54, 0x72, 0x6C);
			$header .= pack('C4', 0x00, 0x00, 0x00, 0x05);
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'Invalid track header, expected [4D 54 72 6B]');
			$this->obj->parseTrackHeader($header);
		}
		
		public function testParseWhileInTrackHeaderState() {
			$expectedChunk = $this->getMock('Midi\TrackHeader', array('getSize'), array(), '', false);
			$expectedChunk->expects($this->once())
			              ->method('getSize')
			              ->will($this->returnValue(10));
			
			$this->obj = $this->getMock('Midi\Parsing\TrackParser', array('getState', 'setState', 'parseTrackHeader', 'read'));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::TRACK_HEADER));
			$this->obj->expects($this->once())
			          ->method('setState')
			          ->with(ParseState::DELTA);
			$this->obj->expects($this->once())
			          ->method('parseTrackHeader')
			          ->with('foo')
			          ->will($this->returnValue($expectedChunk));
			$this->obj->expects($this->once())
			          ->method('read')
			          ->with(\Midi\TrackHeader::LENGTH, true)
			          ->will($this->returnValue('foo'));
			
			$chunk = $this->obj->parse();
			
			$this->assertEquals($expectedChunk, $chunk);
		}
		
		public function testParseWhileInDeltaState() {
			$expectedChunk = $this->getMock('Midi\Delta', array('getLength'), array(), '', false);
			$expectedChunk->expects($this->once())
			              ->method('getLength')
			              ->will($this->returnValue(10));
			
			$deltaParser = $this->getMock('Midi\Parsing\DeltaParser', array('parse'), array(), '', false);
			$deltaParser->expects($this->once())
			            ->method('parse')
			            ->will($this->returnValue($expectedChunk));
			
			$this->obj = $this->getMock('Midi\Parsing\TrackParser', array('getState', 'setState', 'checkTrackLength'), array(null, $deltaParser));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::DELTA));
			$this->obj->expects($this->once())
			          ->method('setState')
			          ->with(ParseState::EVENT);
			$this->obj->expects($this->once())
			          ->method('checkTrackLength')
			          ->with(10);
			
			$chunk = $this->obj->parse();
			$this->assertEquals($expectedChunk, $chunk);
		}
		
		public function testParseWithExceedingTrackLength() {
			$expectedChunk = $this->getMock('Midi\Chunk', array('getLength', 'getData', '__toString', 'toBinary'), array(), '', false);
			$expectedChunk->expects($this->once())
			              ->method('getLength')
			              ->will($this->returnValue(10));
			
			$eventParser = $this->getMock('Midi\Parsing\EventParser', array('parse'), array(), '', false);
			$eventParser->expects($this->once())
			            ->method('parse')
			            ->will($this->returnValue($expectedChunk));
			
			$this->obj = $this->getMock('Midi\Parsing\TrackParser', array('getState', 'getExpectedTrackLength', 'getParsedTrackLength'), array($eventParser));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::EVENT));
			$this->obj->expects($this->once())
			          ->method('getExpectedTrackLength')
			          ->will($this->returnValue(10));
			$this->obj->expects($this->once())
			          ->method('getParsedTrackLength')
			          ->will($this->returnValue(11));
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'Track data exceeds expected length (11/10)');
			$this->obj->parse();
		}
		
		public function testParseWhileInEventState1() {
			$expectedChunk = $this->getMock('Midi\Chunk', array('getLength', 'getData', '__toString', 'toBinary'), array(), '', false);
			$expectedChunk->expects($this->once())
			              ->method('getLength')
			              ->will($this->returnValue(10));
			
			$eventParser = $this->getMock('Midi\Parsing\EventParser', array('parse'), array(), '', false);
			$eventParser->expects($this->once())
			            ->method('parse')
			            ->will($this->returnValue($expectedChunk));
			
			
			$this->obj = $this->getMock('Midi\Parsing\TrackParser', array('getState', 'setState', 'getExpectedTrackLength', 'getParsedTrackLength'), array($eventParser));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::EVENT));
			$this->obj->expects($this->once())
			          ->method('setState')
			          ->with(ParseState::DELTA);
			
			//not necessary, but gets coverage on checkTrackLength()
			$this->obj->expects($this->any())
			          ->method('getExpectedTrackLength')
			          ->will($this->returnValue(10));
			$this->obj->expects($this->any())
			          ->method('getParsedTrackLength')
			          ->will($this->returnValue(1));
			
			$this->assertEquals($expectedChunk, $this->obj->parse());
		}
		
		public function testParseWhileInEventStateWithValidEndOfTrack() {
			$expectedChunk = $this->getMock('Midi\Event\EndOfTrackEvent', array('getLength'), array(), '', false);
			$expectedChunk->expects($this->once())
			              ->method('getLength')
			              ->will($this->returnValue(10));
			
			$eventParser = $this->getMock('Midi\Parsing\EventParser', array('parse'), array(), '', false);
			$eventParser->expects($this->once())
			            ->method('parse')
			            ->will($this->returnValue($expectedChunk));
			
			
			$this->obj = $this->getMock('Midi\Parsing\TrackParser', array('getState', 'setState', 'checkTrackLength', 'getExpectedTrackLength', 'getParsedTrackLength'), array($eventParser));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::EVENT));
			$this->obj->expects($this->once())
			          ->method('setState')
			          ->with(ParseState::TRACK_HEADER);
			
			$this->obj->expects($this->once())
			          ->method('checkTrackLength')
			          ->with(10);
			
			//simulate end of track
			$this->obj->expects($this->any())
			          ->method('getParsedTrackLength')
			          ->will($this->returnValue(10));
			$this->obj->expects($this->any())
			          ->method('getExpectedTrackLength')
			          ->will($this->returnValue(10));
			
			$this->assertEquals($expectedChunk, $this->obj->parse());
		}
		
		public function testParseWhileInEventStateWithInvalidEndOfTrack() {
			$expectedChunk = $this->getMock('Midi\Chunk', array('getLength', 'toBinary', 'getData', '__toString'), array(), '', false);
			$expectedChunk->expects($this->once())
			              ->method('getLength')
			              ->will($this->returnValue(10));
			
			$eventParser = $this->getMock('Midi\Parsing\EventParser', array('parse'), array(), '', false);
			$eventParser->expects($this->once())
			            ->method('parse')
			            ->will($this->returnValue($expectedChunk));
			
			
			$this->obj = $this->getMock('Midi\Parsing\TrackParser', array('getState', 'checkTrackLength', 'getExpectedTrackLength', 'getParsedTrackLength'), array($eventParser));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(ParseState::EVENT));
			
			$this->obj->expects($this->once())
			          ->method('checkTrackLength')
			          ->with(10);
			
			//simulate end of track
			$this->obj->expects($this->any())
			          ->method('getParsedTrackLength')
			          ->will($this->returnValue(10));
			$this->obj->expects($this->any())
			          ->method('getExpectedTrackLength')
			          ->will($this->returnValue(10));
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'Expected end of track');
			$this->obj->parse();
		}
		
		public function testParseWhileInInvalidState() {
			$this->obj = $this->getMock('Midi\Parsing\TrackParser', array('getState'));
			$this->obj->expects($this->once())
			          ->method('getState')
			          ->will($this->returnValue(-1));
			
			$this->setExpectedException('Midi\Parsing\StateException', 'Invalid state: -1');
			$this->obj->parse();
		}
		
		public function testDefaultState() {
			$this->assertEquals(ParseState::TRACK_HEADER, $this->obj->getState());
		}
		
	}

?>