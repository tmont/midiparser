<?php
	
	namespace Midi\Tests\Reporting;
	
	use \Midi\Reporting\Printer;
	use \Midi\Reporting\Formatter;

	class PrinterTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testPrintAll() {
			$this->obj = $this->getMock(
				'Midi\Reporting\Printer',
				array('printNext', 'doPostProcessing'),
				array(new Formatter(), $this->getMock('Midi\Parsing\Parser', array('parse')))
			);
			
			$this->obj->expects($this->exactly(2))
			          ->method('printNext')
			          ->will($this->onConsecutiveCalls(true, false));
			$this->obj->expects($this->once())
			          ->method('doPostProcessing')
			          ->with(array('foo' => 'bar'));
			
			$this->obj->setParameter('foo', 'bar');
			$this->obj->printAll();
		}
		
		public function testDoPostProcessing() {
			$processor = $this->getMock('Midi\Reporting\PostProcessor', array('setParameter', 'execute'));
			$processor->expects($this->once())
			          ->method('setParameter')
			          ->with('foo', 'bar');
			$processor->expects($this->once())
			          ->method('execute');
			
			$formatter = $this->getMock('Midi\Reporting\Formatter', array('getPostProcessor'));
			$formatter->expects($this->once())
			          ->method('getPostProcessor')
			          ->will($this->returnValue($processor));
			
			$this->obj = new Printer($formatter, $this->getMock('Midi\Parsing\Parser', array('parse')));
			$this->obj->doPostProcessing(array('foo' => 'bar'));
		}
		
		public function testPrintEvent() {
			$event = $this->getMock('Midi\Event', array('getType', 'getLength', 'toBinary', '__toString', 'getData'));
			
			$formatter = $this->getMock('Midi\Reporting\Formatter', array('beforeEvent', 'formatEvent', 'afterEvent', 'beforeChunk', 'afterChunk'));
			$formatter->expects($this->once())
			          ->method('beforeChunk')
			          ->with($event);
			$formatter->expects($this->once())
			          ->method('beforeEvent');
			$formatter->expects($this->once())
			          ->method('formatEvent')
			          ->with($event);
			$formatter->expects($this->once())
			          ->method('afterEvent');
			$formatter->expects($this->once())
			          ->method('afterChunk')
			          ->with($event);
			
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$parser->expects($this->once())
			       ->method('parse')
			       ->will($this->returnValue($event));
			
			$this->obj = new Printer($formatter, $parser);
			$this->obj->printNext();
		}
		
		public function testPrintDelta() {
			$delta = new \Midi\Delta(100);
			
			$formatter = $this->getMock('Midi\Reporting\Formatter', array('beforeDelta', 'formatDelta', 'afterDelta', 'beforeChunk', 'afterChunk'));
			$formatter->expects($this->once())
			          ->method('beforeChunk')
			          ->with($delta);
			$formatter->expects($this->once())
			          ->method('beforeDelta');
			$formatter->expects($this->once())
			          ->method('formatDelta')
			          ->with($delta);
			$formatter->expects($this->once())
			          ->method('afterDelta');
			$formatter->expects($this->once())
			          ->method('afterChunk')
			          ->with($delta);
			
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$parser->expects($this->once())
			       ->method('parse')
			       ->will($this->returnValue($delta));
			
			$this->obj = new Printer($formatter, $parser);
			$this->obj->printNext();
		}
		
		public function testPrintTrackHeaderWithSizeGreaterThanZero() {
			$trackHeader = $this->getMock('Midi\TrackHeader', array('getSize'), array(), '', false);
			$trackHeader->expects($this->once())
			            ->method('getSize')
			            ->will($this->returnValue(10));
			
			$formatter = $this->getMock('Midi\Reporting\Formatter', array('beforeChunk', 'afterChunk', 'afterTrack', 'beforeTrack', 'beforeTrackHeader', 'formatTrackHeader', 'afterTrackHeader'));
			$formatter->expects($this->once())
			          ->method('beforeChunk')
			          ->with($trackHeader);
			$formatter->expects($this->once())
			          ->method('afterTrack');
			$formatter->expects($this->once())
			          ->method('beforeTrack');
			$formatter->expects($this->once())
			          ->method('beforeTrackHeader');
			$formatter->expects($this->once())
			          ->method('formatTrackHeader')
			          ->with($trackHeader);
			$formatter->expects($this->once())
			          ->method('afterTrackHeader');
			$formatter->expects($this->once())
			          ->method('afterChunk')
			          ->with($trackHeader);
			
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$parser->expects($this->once())
			       ->method('parse')
			       ->will($this->returnValue($trackHeader));
			
			$this->obj = $this->getMock('Midi\Reporting\Printer', array('isParsingTrack'), array($formatter, $parser));
			$this->obj->expects($this->once())
			          ->method('isParsingTrack')
			          ->will($this->returnValue(true));
			
			$this->obj->printNext();
		}
		
		public function testPrintTrackHeaderWithSizeEqualToZero() {
			$trackHeader = $this->getMock('Midi\TrackHeader', array('getSize'), array(), '', false);
			$trackHeader->expects($this->once())
			            ->method('getSize')
			            ->will($this->returnValue(0));
			
			$formatter = $this->getMock('Midi\Reporting\Formatter', array('beforeChunk', 'afterChunk', 'afterTrack', 'beforeTrack', 'beforeTrackHeader', 'formatTrackHeader', 'afterTrackHeader'));
			$formatter->expects($this->once())
			          ->method('beforeChunk')
			          ->with($trackHeader);
			$formatter->expects($this->never())
			          ->method('afterTrack');
			$formatter->expects($this->once())
			          ->method('beforeTrack');
			$formatter->expects($this->once())
			          ->method('beforeTrackHeader');
			$formatter->expects($this->once())
			          ->method('formatTrackHeader')
			          ->with($trackHeader);
			$formatter->expects($this->once())
			          ->method('afterTrackHeader');
			$formatter->expects($this->once())
			          ->method('afterChunk')
			          ->with($trackHeader);
			
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$parser->expects($this->once())
			       ->method('parse')
			       ->will($this->returnValue($trackHeader));
			
			$this->obj = new Printer($formatter, $parser);
			$this->obj->printNext();
			$this->assertFalse($this->obj->isParsingTrack());
		}
		
		public function testPrintFileHeader() {
			$fileHeader = $this->getMock('Midi\FileHeader', array(), array(), '', false);
			
			$formatter = $this->getMock('Midi\Reporting\Formatter', array('beforeChunk', 'afterChunk', 'beforeFile', 'beforeFileHeader', 'formatFileHeader', 'afterFileHeader'));
			$formatter->expects($this->once())
			          ->method('beforeChunk')
			          ->with($fileHeader);
			$formatter->expects($this->once())
			          ->method('beforeFile');
			$formatter->expects($this->once())
			          ->method('beforeFileHeader');
			$formatter->expects($this->once())
			          ->method('formatFileHeader')
			          ->with($fileHeader);
			$formatter->expects($this->once())
			          ->method('afterFileHeader');
			$formatter->expects($this->once())
			          ->method('afterChunk')
			          ->with($fileHeader);
			
			
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$parser->expects($this->once())
			       ->method('parse')
			       ->will($this->returnValue($fileHeader));
			
			$this->obj = new Printer($formatter, $parser);
			$this->obj->printNext();
		}
		
		public function testPrintEofWhileNotParsingTrack() {
			$formatter = $this->getMock('Midi\Reporting\Formatter', array('beforeChunk', 'afterChunk', 'afterTrack', 'afterFile'));
			$formatter->expects($this->never())
			          ->method('beforeChunk');
			$formatter->expects($this->never())
			          ->method('afterChunk');
			$formatter->expects($this->never())
			          ->method('afterTrack');
			$formatter->expects($this->once())
			          ->method('afterFile');
			
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$parser->expects($this->once())
			       ->method('parse')
			       ->will($this->returnValue(null));
			
			$this->obj = new Printer($formatter, $parser);
			$this->obj->printNext();
			$this->assertFalse($this->obj->isParsingTrack());
		}
		
		public function testPrintEofWhileParsingTrack() {
			$formatter = $this->getMock('Midi\Reporting\Formatter', array('beforeChunk', 'afterChunk', 'afterTrack', 'afterFile'));
			$formatter->expects($this->never())
			          ->method('beforeChunk');
			$formatter->expects($this->never())
			          ->method('afterChunk');
			$formatter->expects($this->once())
			          ->method('afterTrack');
			$formatter->expects($this->once())
			          ->method('afterFile');
			
			$parser = $this->getMock('Midi\Parsing\Parser', array('parse'));
			$parser->expects($this->once())
			       ->method('parse')
			       ->will($this->returnValue(null));
			
			$this->obj = $this->getMock('Midi\Reporting\Printer', array('isParsingTrack'), array($formatter, $parser));
			$this->obj->expects($this->once())
			          ->method('isParsingTrack')
			          ->will($this->returnValue(true));
			
			$this->obj->printNext();
		}
		
	}

?>