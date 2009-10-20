<?php
	
	namespace Midi\Tests\Event;

	class CopyrightNoticeEventTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Event\CopyrightNoticeEvent('© Tommy Montgomery');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('© Tommy Montgomery', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(\Midi\Event\MetaEventType::COPYRIGHT_NOTICE, $this->obj->getSubtype());
		}
		
	}

?>