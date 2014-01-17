<?php
	
	namespace Tmont\Midi\Tests\Reporting;
	
	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Reporting\FilePrinter;
	use Tmont\Midi\Reporting\Formatter;

	class FilePrinterTest extends PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testCreateFileObject() {
			$parser = $this->getMock('Tmont\Midi\Parsing\Parser', array('parse'));
			$this->obj = new FilePrinter(new Formatter(), $parser);
			$file = dirname(__DIR__) . '/data/file.txt';
			$this->assertInstanceOf('SplFileObject', $this->obj->createFileObject($file));
		}
		
		public function testPrintDataThrowsMidiException() {
			$parser = $this->getMock('Tmont\Midi\Parsing\Parser', array('parse'));
			$this->obj = new FakePrinter(new Formatter(), $parser);
			$this->setExpectedException('Tmont\Midi\MidiException');
			$this->obj->faker();
		}
		
		public function testSetFile() {
			$parser = $this->getMock('Tmont\Midi\Parsing\Parser', array('parse'));
			$this->obj = new FilePrinter(new Formatter(), $parser);
			$this->obj->setFile(dirname(__DIR__) . '/data/file.txt');
		}
		
	}
	
	class FakePrinter extends FilePrinter {
		
		public function faker() {
			$this->printData('foo');
		}
		
	}

?>