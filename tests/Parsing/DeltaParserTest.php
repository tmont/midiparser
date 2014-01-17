<?php
	
	namespace Tmont\Midi\Tests\Parsing;
	
	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Parsing\DeltaParser;
	use Tmont\Midi\Parsing\ParseState;

	class DeltaParserTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var DeltaParser
		 */
		private $obj;
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testDefaultState() {
			$this->obj = new DeltaParser();
			$this->assertEquals(ParseState::EOF, $this->obj->getState());
		}
		
		public function testParse() {
			$this->obj = $this->getMock('Tmont\Midi\Parsing\DeltaParser', array('getDelta', 'getDeltaChunk'));
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
			$this->assertInstanceOf('Tmont\Midi\Delta', $chunk);
		}
		
	}

?>