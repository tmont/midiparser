<?php
	
	namespace Tmont\Midi\Tests\Reporting;
	
	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Reporting\HtmlPostProcessor;

	class HtmlPostProcessorTest extends PHPUnit_Framework_TestCase {
		/**
		 * @var HtmlPostProcessor
		 */
		private $obj;
		
		public function setUP() {
			$this->obj = new HtmlPostProcessor();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testCreateFileObject() {
			$file = dirname(__DIR__) . '/data/file.txt';
			$this->assertInstanceOf('SplFileObject', $this->obj->createFileObject($file));
		}
		
		public function testSetParameter() {
			$this->obj->setParameter('multi_file', false);
		}
		
		public function testExecute() {
			$dir = dirname(dirname(__DIR__)) . '/src/Reporting/_html';
			$this->assertFileExists($dir . '/midiparser.js');
			$this->assertFileExists($dir . '/midiparser-multi.js');
			$this->assertFileExists($dir . '/midiparser.css');
			$this->assertFileExists($dir . '/row.png');
			$this->assertFileExists($dir . '/arrow_left.png');
			$this->assertFileExists($dir . '/arrow_right.png');
			$this->assertFileExists($dir . '/loading.gif');
			
			$file = $this->getMock('SplTempFileObject', array('fwrite'));
			$file->expects($this->once())
			     ->method('fwrite');
			
			$this->obj = $this->getMock('Tmont\Midi\Reporting\HtmlPostProcessor', array('copyFile', 'createFileObject'));
			$this->obj->expects($this->exactly(5))
			          ->method('copyFile');
			$this->obj->expects($this->once())
			          ->method('createFileObject')
			          ->will($this->returnValue($file));
			
			$this->obj->execute();
		}
		
	}

?>