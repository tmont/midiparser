<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\CopyrightNoticeEvent;
	use Tmont\Midi\Event\MetaEventType;

	class CopyrightNoticeEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var CopyrightNoticeEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new CopyrightNoticeEvent('© Tommy Montgomery');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('© Tommy Montgomery', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::COPYRIGHT_NOTICE, $this->obj->getSubtype());
		}
		
	}

?>