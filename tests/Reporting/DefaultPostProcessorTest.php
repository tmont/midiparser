<?php
	
	namespace Tmont\Midi\Tests\Reporting;
	
	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Reporting\DefaultPostProcessor;

	class DefaultPostProcessorTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var DefaultPostProcessor
		 */
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