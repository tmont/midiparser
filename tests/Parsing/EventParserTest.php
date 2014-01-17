<?php
	
	namespace Tmont\Midi\Tests\Parsing;
	
	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Parsing\ParseState;
	use Tmont\Midi\Parsing\EventParser;

	class EventParserTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var EventParser
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new EventParser();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testDefaultState() {
			$this->assertEquals(ParseState::EOF, $this->obj->getState());
		}
		
		public function testParseNormalChannelEvent() {
			$file = $this->getMock('SplTempFileObject', array('fseek'));
			
			$bytes = $this->onConsecutiveCalls(
				pack('C', 0x80),
				pack('C2', 0x64, 0x65),
				pack('C', 0x64),
				pack('C2', 0x64, 0x00)
			);
			
			$event1 = $this->getMock('Tmont\Midi\Event\ChannelEvent', array('getType', 'getParamDescription'), array(), '', false);
			$event2 = $this->getMock('Tmont\Midi\Event\ChannelEvent', array('setContinuation', 'getType', 'getParamDescription'), array(), '', false);
			$event2->expects($this->once())
			       ->method('setContinuation');
			
			$channelEventFactory = $this->getMock('Tmont\Midi\Event\EventFactory', array('createChannelEvent'));
			$channelEventFactory
				->expects($this->exactly(2))
				->method('createChannelEvent')
				->will($this->onConsecutiveCalls($event1, $event2));
				   
			//normal channel event
			$this->obj = $this->getMock('Tmont\Midi\Parsing\EventParser', array('read'), array($channelEventFactory));
			$this->obj->expects($this->exactly(4))
			          ->method('read')
			          ->will($bytes);
			
			//continuation event
			$file->expects($this->once())
			     ->method('fseek')
			     ->with(-1, SEEK_CUR);
			
			$this->obj->setFile($file);
			$this->assertEquals($event1, $this->obj->parse());
			$this->assertEquals($event2, $this->obj->parse());
		}
		
		public function testParseSpecialChannelEvent() {
			$file = $this->getMock('SplTempFileObject', array('fseek'));
			
			$bytes = $this->onConsecutiveCalls(
				pack('C', 0xC0),
				pack('C', 0x64),
				pack('C', 0x64),
				pack('C', 0x64)
			);
			
			$event1 = $this->getMock('Tmont\Midi\Event\ChannelEvent', array('getType', 'getParamDescription'), array(), '', false);
			$event2 = $this->getMock('Tmont\Midi\Event\ChannelEvent', array('setContinuation', 'getType', 'getParamDescription'), array(), '', false);
			$event2->expects($this->once())
			       ->method('setContinuation');
			
			
			$channelEventFactory = $this->getMock('Tmont\Midi\Event\EventFactory', array('createChannelEvent'));
			$channelEventFactory
				->expects($this->exactly(2))
				->method('createChannelEvent')
				->with(0xC0, 0x00, 0x64, null)
				->will($this->onConsecutiveCalls($event1, $event2));
			
			//normal channel event
			$this->obj = $this->getMock('Tmont\Midi\Parsing\EventParser', array('read'), array($channelEventFactory));
			$this->obj->expects($this->exactly(4))
			          ->method('read')
			          ->will($bytes);
			
			//continuation event
			$file->expects($this->once())
			     ->method('fseek')
			     ->with(-1, SEEK_CUR);
			
			$this->obj->setFile($file);
			$this->assertEquals($event1, $this->obj->parse());
			$this->assertEquals($event2, $this->obj->parse());
		}
		
		public function testParseChannelEventWithoutContinuation() {
			//normal channel event
			$this->obj = $this->getMock('Tmont\Midi\Parsing\EventParser', array('read'));
			$this->obj->expects($this->once())
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(0x7F));
			
			$this->setExpectedException('Tmont\Midi\Parsing\ParseException');
			$this->obj->parse();
		}
		
		public function testParseMetaEvent() {
			$eventFactory = $this->getMock('Tmont\Midi\Event\EventFactory', array('createMetaEvent'));
			$eventFactory
				->expects($this->once())
				->method('createMetaEvent')
				//->with(0x20, pack('C3', 0x21, 0x22, 0x23))
				->will($this->returnValue('yay for meta!'));
			
			
			$this->obj = $this->getMock('Tmont\Midi\Parsing\EventParser', array('read', 'getDelta'), array($eventFactory));
			$this->obj->expects($this->at(0))
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(pack('C', 0xFF)));
			$this->obj->expects($this->at(1))
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(pack('C', 0x20)));
			$this->obj->expects($this->at(2))
			          ->method('read')
			          //->with(3, true) wtf?
			          ->will($this->returnValue(pack('C3', 0x21, 0x22, 0x23)));
			
			$this->obj->expects($this->once())
			          ->method('getDelta')
			          ->will($this->returnValue(3));
			
			$this->assertEquals('yay for meta!', $this->obj->parse());
		}
		
		public function testParseSystemExclusiveEvent() {
			$eventFactory = $this->getMock('Tmont\Midi\Event\EventFactory', array('createSystemExclusiveEvent'));
			$eventFactory
				->expects($this->once())
				->method('createSystemExclusiveEvent')
				//->with(array('f', 'o', 'o')) //wtf? phpunit bug?
				->will($this->returnValue('yay for sysex!'));
			
			$this->obj = $this->getMock('Tmont\Midi\Parsing\EventParser', array('read', 'getDelta'), array($eventFactory));
			$this->obj->expects($this->at(0))
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(pack('C', 0xF0)));
			$this->obj->expects($this->at(1))
			          ->method('read')
			          //->with(3, true) wtf?
			          ->will($this->returnValue('foo'));
			
			$this->obj->expects($this->once())
			          ->method('getDelta')
			          ->will($this->returnValue(3));
			
			$this->assertEquals('yay for sysex!', $this->obj->parse());
		}
		
		public function testParseUnknownEvent() {
			//normal channel event
			$this->obj = $this->getMock('Tmont\Midi\Parsing\EventParser', array('read'));
			$this->obj->expects($this->once())
			          ->method('read')
			          ->with(1, true)
			          ->will($this->returnValue(pack('C', 0xF3)));
			
			$this->setExpectedException('Tmont\Midi\Parsing\ParseException', 'Unsupported event type: 0xF3');
			$this->obj->parse();
		}
		
	}

?>