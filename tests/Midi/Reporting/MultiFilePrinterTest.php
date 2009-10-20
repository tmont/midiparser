<?php
	
	namespace Midi\Tests\Reporting;
	
	use \Midi\Reporting\MultiFilePrinter;
	use \Midi\Reporting\Formatter;

	class MultiFilePrinterTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testCreateFileObject() {
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$this->obj = new MultiFilePrinter(new Formatter(), $parser, dirname(__FILE__));
			$file = dirname(dirname(dirname(__FILE__))) . '/data/file.txt';
			$this->assertType('SplFileObject', $this->obj->createFileObject($file));
		}
		
		public function testPrintNext() {
			$fileHeader = $this->getMock('Midi\FileHeader', array(), array(), '', false);
			
			$formatter = $this->getMock(
				'Midi\Reporting\Formatter',
				array(
					'beforeFile',
					'afterFile',
					'beforeFileHeader',
					'beforeChunk',
					'formatFileHeader',
					'afterChunk',
					'afterFileHeader'
				)
			);
			
			$formatter->expects($this->once())
			          ->method('beforeFile')
			          ->will($this->returnValue('foo'));
			$formatter->expects($this->once())
			          ->method('afterFile')
			          ->will($this->returnValue('bar'));
			$formatter->expects($this->once())
			          ->method('beforeFileHeader')
			          ->with($fileHeader);
			$formatter->expects($this->once())
			          ->method('formatFileHeader')
			          ->with($fileHeader);
			$formatter->expects($this->once())
			          ->method('afterFileHeader')
			          ->with($fileHeader);
			$formatter->expects($this->once())
			          ->method('afterChunk')
			          ->with($fileHeader);
			$formatter->expects($this->once())
			          ->method('beforeChunk')
			          ->with($fileHeader);
			
			$file = $this->getMock('SplFileObject', array('fwrite'), array(), '', false);
			$file->expects($this->atLeastOnce())
			     ->method('fwrite');
			
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$parser->expects($this->exactly(2))
			       ->method('parse')
			       ->will($this->onConsecutiveCalls($fileHeader, null));
			
			$this->obj = $this->getMock('Midi\Reporting\MultiFilePrinter', array('createFileObject'), array($formatter, $parser));
			$this->obj->expects($this->any())
			          ->method('createFileObject')
			          ->will($this->returnValue($file));
			
			
			$this->obj->setParameter('max_file_size', 5);
			
			$this->assertTrue($this->obj->printNext());
			$this->assertFalse($this->obj->printNext());
		}
		
	}

?>