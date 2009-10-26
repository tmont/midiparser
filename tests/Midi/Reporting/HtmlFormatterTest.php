<?php
	
	namespace Midi\Tests\Reporting;
	
	use \Midi\Reporting\HtmlFormatter;


	class HtmlFormatterTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new HtmlFormatter();
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testFormatOffset() {
			$this->assertEquals('<td><tt>0x00000064</tt></td>', $this->obj->formatOffset(100));
		}
		
		public function testBeforeFile() {
			$expected = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>MIDI Parse Results</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link type="text/css" href="./midiparser.css" rel="stylesheet"/>
		<script type="text/javascript" src="./midiparser.js"></script>
	</head>

	<body>
		
		<div id="wrapper">
			<div id="nav">
				<div class="nav" id="nav-previous" title="previous track"></div>
				<div class="nav" id="nav-next" title="next track"></div>
			</div>
			<div id="content">
				<table id="parse-results">

HTML;
			$this->assertEquals($expected, $this->obj->beforeFile());
		}
		
		public function testBeforeFileWithMultiFile() {
			$expected = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>MIDI Parse Results</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link type="text/css" href="./midiparser.css" rel="stylesheet"/>
		<script type="text/javascript" src="./midiparser.js"></script>
	</head>

	<body>
		<div id="page"> </div>
		<div id="wrapper">
			<div id="nav">
				<div class="nav" id="nav-previous" title="previous page"></div>
				<div class="nav" id="nav-next" title="next page"></div>
			</div>
			<div id="content">
				<table id="parse-results">

HTML;
			$this->obj = new HtmlFormatter();
			$this->obj->setMultiFile(true);
			$this->assertEquals($expected, $this->obj->beforeFile());
		}
		
		public function testBeforeChunkWithChannelEvent() {
			$chunk = $this->getMock('Midi\Event\ChannelEvent', array('getType', 'getParamDescription'), array(), '', false);
			$this->assertEquals('', $this->obj->beforeChunk($chunk));
		}
		
		public function testBeforeChunkWithMetaEvent() {
			$chunk = $this->getMock('Midi\Event\MetaEvent', array('getSubType', 'getParamDescription'), array(), '', false);
			$this->assertEquals('', $this->obj->beforeChunk($chunk));
		}
		
		public function testBeforeChunkWithDelta() {
			$chunk = $this->getMock('Midi\Delta', array(), array(), '', false);
			$this->assertEquals('', $this->obj->beforeChunk($chunk));
		}
		
		public function testBeforeChunkWithTrackHeader() {
			$this->obj = $this->getMock('Midi\Reporting\HtmlFormatter', array('formatOffset'));
			$this->obj->expects($this->any())
			          ->method('formatOffset')
			          ->will($this->returnValue('foo'));
			
			$chunk = $this->getMock('Midi\TrackHeader', array('getLength', 'toBinary'), array(), '', false);
			$chunk->expects($this->any())
			      ->method('toBinary')
			      ->will($this->returnValue(pack('C', 0x64)));
			$chunk->expects($this->any())
			      ->method('getLength')
			      ->will($this->returnValue(1));
			
			$this->assertEquals('<tr class="header">foo<td><tt>64</tt></td>', $this->obj->beforeChunk($chunk));
		}
		
		public function testBeforeChunkWithFileHeader() {
			$this->obj = $this->getMock('Midi\Reporting\HtmlFormatter', array('formatOffset'));
			$this->obj->expects($this->any())
			          ->method('formatOffset')
			          ->will($this->returnValue('foo'));
			
			$chunk = $this->getMock('Midi\FileHeader', array('getLength', 'toBinary'), array(), '', false);
			$chunk->expects($this->any())
			      ->method('toBinary')
			      ->will($this->returnValue(pack('C', 0x64)));
			$chunk->expects($this->any())
			      ->method('getLength')
			      ->will($this->returnValue(1));
			
			$this->assertEquals('<tr class="header">foo<td><tt>64</tt></td>', $this->obj->beforeChunk($chunk));
		}
		
		public function testAfterChunk() {
			$chunk = $this->getMock('Midi\Chunk', array('getLength', 'toBinary', '__toString', 'getData'));
			$this->assertEquals('</tr>', $this->obj->afterChunk($chunk));
		}
		
		public function testBeforeFileHeader() {
			$chunk = $this->getMock('Midi\FileHeader', array(), array(), '', false);
			$this->assertEquals("\t\t\t\t\t<tbody>\n", $this->obj->beforeFileHeader($chunk));
		}
		
		public function testFormatFileHeader() {
			$chunk = $this->getMock('Midi\FileHeader', array('getData'), array(), '', false);
			$chunk->expects($this->any())
			      ->method('getData')
			      ->will($this->returnValue(array('foo', 'bar', 'baz')));
			
			$this->assertEquals(
				'<td><a name="file-header"></a>MIDI file format: foo, # of tracks: bar, Time division: baz</td>',
				$this->obj->formatFileHeader($chunk)
			);
		}
		
		public function testAfterFileHeader() {
			$chunk = $this->getMock('Midi\FileHeader', array(), array(), '', false);
			$this->assertEquals("\t\t\t\t\t</tbody>\n", $this->obj->afterFileHeader($chunk));
		}
		
		public function testBeforeTrack() {
			$html = <<<HTML
					<tbody>
						<tr class="trackheader">
							<td colspan="3">
								<a class="track" id="track1" name="track1"></a>
								Track 1
							</td>
						</tr>
					</tbody>
					<tbody>

HTML;
		
			$this->assertEquals($html, $this->obj->beforeTrack());
		}
		
		public function testFormatTrackHeader() {
			$chunk = $this->getMock('Midi\TrackHeader', array('getData'), array(), '', false);
			$chunk->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue(array(10)));
			
			$this->assertEquals(
				'<td>Track size: 10 bytes</td>',
				$this->obj->formatTrackHeader($chunk)
			);
		}
		
		public function testBeforeEventWithNoDelta() {
			$chunk = $this->getMock('Midi\Event', array('getData', '__toString', 'getType', 'toBinary', 'getLength'));
			$this->assertEquals('', $this->obj->beforeEvent($chunk));
		}
		
		public function testBeforeEventWithChannelEvent() {
			$this->obj = $this->getMock('Midi\Reporting\HtmlFormatter', array('formatOffset'));
			$this->obj->expects($this->once())
			          ->method('formatOffset')
			          ->will($this->returnValue('foo'));
			
			$delta = $this->getMock('Midi\Delta', array('getData', 'toBinary', 'getLength'), array(), '', false);
			$delta->expects($this->once())
			      ->method('toBinary')
			      ->will($this->returnValue(pack('C2', 0x81, 0x7F)));
			$delta->expects($this->once())
			      ->method('getLength')
			      ->will($this->returnValue(2));
			
			$this->assertEquals('', $this->obj->beforeChunk($delta));
			
			$event = $this->getMock('Midi\Event\ChannelEvent', array('getType', 'getParamDescription', 'toBinary', 'getLength'), array(), '', false);
			$event->expects($this->once())
			      ->method('toBinary')
			      ->will($this->returnValue(pack('C8', 0x80, 0x40, 0x00, 0x00, 0x00, 0x90, 0x87, 0xA9)));
			$event->expects($this->once())
			      ->method('getLength')
			      ->will($this->returnValue(2));
			
			$expected = '<tr class="channel">foo<td><tt><span class="delta">81 7F</span> 80 40 00 00 00 90<br />87 A9</tt></td>';
			
			$this->assertEquals($expected, $this->obj->beforeEvent($event));
		}
		
		public function testBeforeEventWithMetaEvent() {
			//this could probably be extracted since it's identical to testBeforeEventWithChannelEvent...
			$this->obj = $this->getMock('Midi\Reporting\HtmlFormatter', array('formatOffset'));
			$this->obj->expects($this->once())
			          ->method('formatOffset')
			          ->will($this->returnValue('foo'));
			
			$delta = $this->getMock('Midi\Delta', array('getData', 'toBinary', 'getLength'), array(), '', false);
			$delta->expects($this->once())
			      ->method('toBinary')
			      ->will($this->returnValue(pack('C2', 0x81, 0x7F)));
			$delta->expects($this->once())
			      ->method('getLength')
			      ->will($this->returnValue(2));
			
			$this->assertEquals('', $this->obj->beforeChunk($delta));
			
			$event = $this->getMock('Midi\Event\MetaEvent', array('getSubtype', 'getParamDescription', 'toBinary', 'getLength'), array(), '', false);
			$event->expects($this->once())
			      ->method('toBinary')
			      ->will($this->returnValue(pack('C8', 0x80, 0x40, 0x00, 0x00, 0x00, 0x90, 0x87, 0xA9)));
			$event->expects($this->once())
			      ->method('getLength')
			      ->will($this->returnValue(2));
			
			$expected = '<tr class="meta">foo<td><tt><span class="delta">81 7F</span> 80 40 00 00 00 90<br />87 A9</tt></td>';
			
			$this->assertEquals($expected, $this->obj->beforeEvent($event));
		}
		
		public function testFormatEventWithNoDelta() {
			$chunk = $this->getMock('Midi\Event', array('getData', '__toString', 'getType', 'toBinary', 'getLength'));
			$this->assertEquals('', $this->obj->formatEvent($chunk));
		}
		
		public function testFormatEvent() {
			$delta = $this->getMock('Midi\Delta', array('getData'), array(), '', false);
			$delta->expects($this->once())
			      ->method('getData')
			      ->will($this->returnValue(array(10)));
			
			$this->assertEquals('', $this->obj->beforeChunk($delta));
			
			$chunk = $this->getMock('Midi\Event', array('getData', '__toString', 'getType', 'toBinary', 'getLength'));
			$chunk->expects($this->once())
			      ->method('__toString')
			      ->will($this->returnValue('foo'));
			
			$this->assertEquals(
				'<td><span class="delta">[10 ticks]</span> foo</td>',
				$this->obj->formatEvent($chunk)
			);
		}
		
		public function testAfterTrack() {
			$this->assertEquals("\t\t\t\t\t</tbody>\n", $this->obj->afterTrack());
		}
		
		public function testAfterFile() {
			$date = date('M j, Y');
			$expected = <<<HTML
				</table>
			</div>

			<div id="footer">
				<p>
					Generated by <a title="PHP MIDI Library 1.0" href="http://phpmidiparser.com/">PHP MIDI Library 1.0</a> in 10 seconds on $date \d\d?:\d\d:\d\d [AP]M
					<br />
					&copy; 2009 <a title="by Tommy Montgomery" href="http://tommymontgomery.com/">Tommy Montgomery</a>
				</p>
			</div>
		</div>
	</body>
</html>
HTML;

			$this->assertRegExp("@$expected@", $this->obj->afterFile(10, 11));
		}
		
		public function testAfterFileWithMultiFile() {
			$date = date('M j, Y');
			$expected = <<<HTML
				</table>
			</div>

			<div id="footer">
				<p>
					Generated by <a title="PHP MIDI Library 1.0" href="http://phpmidiparser.com/">PHP MIDI Library 1.0</a> on $date \d\d?:\d\d:\d\d [AP]M
					<br />
					&copy; 2009 <a title="by Tommy Montgomery" href="http://tommymontgomery.com/">Tommy Montgomery</a>
				</p>
			</div>
		</div>
	</body>
</html>
HTML;
			
			$this->obj = new HtmlFormatter();
			$this->obj->setMultiFile(true);
			$this->assertRegExp("@$expected@", $this->obj->afterFile(10, 11));
		}
		
		public function testGetPostProcessor() {
			$this->assertType('Midi\Reporting\HtmlPostProcessor', $this->obj->getPostProcessor());
		}
		
	}

?>