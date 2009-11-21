<?php
	
	namespace Midi\Tests\Reporting;
	
	use \Midi\Reporting\FilePrinter;
	use \Midi\Reporting\Formatter;

	class FilePrinterTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testCreateFileObject() {
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$this->obj = new FilePrinter(new Formatter(), $parser);
			$file = dirname(dirname(dirname(__FILE__))) . '/data/file.txt';
			$this->assertType('SplFileObject', $this->obj->createFileObject($file));
		}
		
		public function testPrintDataThrowsMidiException() {
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$this->obj = new FakePrinter(new Formatter(), $parser);
			$this->setExpectedException('Midi\MidiException');
			$this->obj->faker();
		}
		
		public function testSetFile() {
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$this->obj = new FilePrinter(new Formatter(), $parser);
			$this->obj->setFile(dirname(dirname(dirname(__FILE__))) . '/data/file.txt');
		}
		
	}
	
	class FakePrinter extends FilePrinter {
		
		public function faker() {
			$this->printData('foo');
		}
		
	}

?>