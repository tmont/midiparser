<?php
	
	namespace Midi\Tests\Event;

	class TextEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\TextEvent('foobar!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('foobar!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::TEXT_EVENT, $this->obj->getSubtype());
		}
		
	}

?>