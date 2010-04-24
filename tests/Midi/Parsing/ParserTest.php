<?php

	namespace Midi\Tests\Parsing;
	
	use \Midi\Parsing\ParseState;
	use \Midi\Parsing\Parser;

	class ParserTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = $this->getMock('Midi\Parsing\Parser', array('parse'));
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testCreateFileObject() {
			$this->assertType('SplFileObject', $this->obj->createFileObject(__FILE__));
		}
		
		public function testLoad() {
			//see http://www.phpunit.de/ticket/1046 for why we're mocking fgets() for no reason
			$file = $this->getMock('SplFileObject', array('fgets'), array(), '', false);
			
			$this->obj = $this->getMock('Midi\Parsing\Parser', array('parse', 'createFileObject'));
			$this->obj->expects($this->once())
			          ->method('createFileObject')
			          ->with(__FILE__)
			          ->will($this->returnValue($file));
			
			$this->obj->load(__FILE__);
		}
		
		public function testSetFile() {
			//see http://www.phpunit.de/ticket/1046 for why we're mocking fgets() for no reason
			$file = $this->getMock('SplFileObject', array('fgets'), array(), '', false);
			$this->obj->setFile($file);
		}
		
		public function testGetSetState() {
			$this->obj = new FakeParser();
			$this->assertEquals(ParseState::EOF, $this->obj->getState());
			$this->obj->testSetState(-1);
			$this->assertEquals(-1, $this->obj->getState());
		}
		
		public function testReadWithSuccess() {
			$file = $this->getMock('SplFileObject', array('fgetc', 'valid'), array(), '', false);
			$file->expects($this->exactly(2))
			     ->method('fgetc')
			     ->will($this->onConsecutiveCalls('x', 'y'));
			$file->expects($this->atLeastOnce())
			     ->method('valid')
			     ->will($this->returnValue(true));
			
			$this->obj = new FakeParser();
			$this->obj->setFile($file);
			$this->assertEquals('xy', $this->obj->testReadFalse());
		}
		
		public function testReadWithLessThanExpectedCount() {
			$file = $this->getMock('SplFileObject', array('fgetc', 'valid'), array(), '', false);
			$file->expects($this->once())
			     ->method('fgetc')
			     ->will($this->returnValue('x'));
			$file->expects($this->exactly(2))
			     ->method('valid')
			     ->will($this->onConsecutiveCalls(true, false));
			
			$this->obj = new FakeParser();
			$this->obj->setFile($file);
			$this->assertEquals('x', $this->obj->testReadFalse());
		}
		
		public function testReadWithEpicFail() {
			$file = $this->getMock('SplFileObject', array('fgetc', 'valid'), array(), '', false);
			$file->expects($this->once())
			     ->method('fgetc')
			     ->will($this->returnValue('x'));
			$file->expects($this->exactly(2))
			     ->method('valid')
			     ->will($this->onConsecutiveCalls(true, false));
			
			$this->obj = new FakeParser();
			$this->obj->setFile($file);
			
			$this->setExpectedException('Midi\Parsing\ParseException', 'Unexpected EOF');
			$this->obj->testReadTrue();
		}
		
		public function testGetDelta() {
			$file = $this->getMock('SplFileObject', array('valid'), array(), '', false);
			$file->expects($this->any())
			     ->method('valid')
			     ->will($this->returnValue(true));
			
			$this->obj = $this->getMock('Midi\Tests\Parsing\FakeParser', array('read'));
			$this->obj->expects($this->exactly(2))
			          ->method('read')
			          ->will($this->onConsecutiveCalls(pack('C', 0x81), pack('C', 0x7F)));
			
			$this->obj->setFile($file);
			
			$this->assertEquals(255, $this->obj->testGetDelta());
		}
		
		public function testDefaultState() {
			$this->assertEquals(ParseState::EOF, $this->obj->getState());
		}
		
	}
	
	class FakeParser extends Parser {
		
		public function parse() {
			
		}
		
		public function testGetDelta() {
			return $this->getDelta();
		}
		
		public function testReadFalse() {
			return $this->read(2);
		}
		
		public function testReadTrue() {
			return $this->read(2, true);
		}
		
		public function testSetState() {
			$this->setState(-1);
		}
		
	}

?>