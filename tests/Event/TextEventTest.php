<?php
	
	namespace Tmont\Midi\Tests\Event;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Event\MetaEventType;
	use Tmont\Midi\Event\TextEvent;

	class TextEventTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var TextEvent
		 */
		private $obj;
		
		public function setUp() {
			$this->obj = new TextEvent('foobar!');
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testGetParamDescription() {
			$this->assertEquals('foobar!', $this->obj->getParamDescription());
		}
		
		public function testGetSubtype() {
			$this->assertSame(MetaEventType::TEXT_EVENT, $this->obj->getSubtype());
		}
		
	}

?>