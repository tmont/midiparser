<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Event\UnknownMetaEvent;

	class UnknownMetaEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var UnknownMetaEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new UnknownMetaEvent('yay!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('yay!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::UNKNOWN, $this->obj->getSubtype());
		}
		
	}

?>