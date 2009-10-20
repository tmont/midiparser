<?php
	
	namespace Midi\Tests\Reporting;
	
	use \Midi\Reporting\DefaultPostProcessor;

	class DefaultPostProcessorTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new DefaultPostProcessor();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testSetParameter() {
			$this->assertNull($this->obj->setParameter('foo', 'bar'));
		}
		
		public function testExecute() {
			$this->assertNull($this->obj->execute());
		}
		
	}

?>