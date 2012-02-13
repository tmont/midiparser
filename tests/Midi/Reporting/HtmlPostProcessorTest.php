<?php
	
	namespace Midi\Tests\Reporting;
	
	use \Midi\Reporting\HtmlPostProcessor;

	class HtmlPostProcessorTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUP() {
			$this->obj = new HtmlPostProcessor();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testCreateFileObject() {
			$file = dirname(dirname(dirname(__FILE__))) . '/data/file.txt';
			$this->assertInstanceOf('SplFileObject', $this->obj->createFileObject($file));
		}
		
		public function testSetParameter() {
			$this->obj->setParameter('multi_file', false);
		}
		
		public function testExecute() {
			$dir = dirname(dirname(dirname(dirname(__FILE__)))) . '/src/Midi/Reporting/_html';
			$this->assertFileExists($dir . '/midiparser.js');
			$this->assertFileExists($dir . '/midiparser-multi.js');
			$this->assertFileExists($dir . '/midiparser.css');
			$this->assertFileExists($dir . '/row.png');
			$this->assertFileExists($dir . '/arrow_left.png');
			$this->assertFileExists($dir . '/arrow_right.png');
			$this->assertFileExists($dir . '/loading.gif');
			
			$file = $this->getMock('SplFileObject', array('fwrite'), array(), '', false);
			$file->expects($this->once())
			     ->method('fwrite');
			
			$this->obj = $this->getMock('Midi\Reporting\HtmlPostProcessor', array('copyFile', 'createFileObject'));
			$this->obj->expects($this->exactly(5))
			          ->method('copyFile');
			$this->obj->expects($this->once())
			          ->method('createFileObject')
			          ->will($this->returnValue($file));
			
			$this->obj->execute();
		}
		
	}

?>