<?php
	
	namespace Midi\Tests\Parsing;
	
	use \Midi\Parsing\DeltaParser;
	use \Midi\Parsing\ParseState;

	class DeltaParserTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testDefaultState() {
			$this->obj = new DeltaParser();
			$this->assertEquals(ParseState::EOF, $this->obj->getState());
		}
		
		public function testParse() {
			$this->obj = $this->getMock('Midi\Parsing\DeltaParser', array('getDelta', 'getDeltaChunk'));
			$this->obj->expects($this->once())
			          ->method('getDelta')
			          ->will($this->returnValue(10));
			$this->obj->expects($this->once())
			          ->method('getDeltaChunk')
			          ->with(10)
			          ->will($this->returnValue('bar'));
			
			$this->assertEquals('bar', $this->obj->parse());
		}
		
		public function testGetDeltaChunk() {
			$this->obj = new DeltaParser();
			$chunk = $this->obj->getDeltaChunk(10);
			$this->assertType('Midi\Delta', $chunk);
		}
		
	}

?>