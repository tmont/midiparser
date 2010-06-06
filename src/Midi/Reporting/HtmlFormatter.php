<?php

	/**
	 * \Midi\Reporting\HtmlFormatter
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Reporting;
	
	use Midi\Chunk;
	use Midi\Delta;
	use Midi\FileHeader;
	use Midi\TrackHeader;
	use Midi\Version;
	use Midi\Event;
	use Midi\Event\ChannelEvent;
	use Midi\Event\MetaEvent;
	use Midi\Util\Util;

	/**
	 * Formats parse results in HTML
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	class HtmlFormatter extends Formatter {
		
		/**
		 * The number of the current track
		 *
		 * @var int
		 */
		protected $currentTrack;
		
		/**
		 * @var int
		 */
		protected $offset;
		
		/**
		 * @var bool
		 */
		private $multiFile;
		
		/**
		 * @var Delta
		 */
		private $delta;
		
		/**
		 * @since 1.0
		 */
		public function __construct() {
			$this->currentTrack = 0;
			$this->offset       = 0;
			$this->multiFile    = false;
			$this->delta        = null;
		}
		
		/**
		 * Sets whether this formatter is for multiple HTML files
		 * or a single HTML file
		 *
		 * @since 1.0
		 *
		 * @param  bool $multiFile
		 */
		public function setMultiFile($multiFile) {
			$this->multiFile = (bool)$multiFile;
		}
		
		/**
		 * Formats the file pointer offset
		 *
		 * @since 1.0
		 *
		 * @param  int $offset
		 * @return string
		 */
		public function formatOffset($offset) {
			$offset = '0x' . strtoupper(str_pad(dechex($offset), 8, '0', STR_PAD_LEFT));
			return "<td><tt>$offset</tt></td>";
		}
		
		/**
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeFile() {
			$page = ($this->multiFile) ? '<div id="page"> </div>' : '';
			$title = ($this->multiFile) ? 'page' : 'track';
			
			return <<<HTML
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
		$page
		<div id="wrapper">
			<div id="nav">
				<div class="nav" id="nav-previous" title="previous $title"></div>
				<div class="nav" id="nav-next" title="next $title"></div>
			</div>
			<div id="content">
				<table id="parse-results">

HTML;
		}
		
		/**
		 * @since 1.0
		 * @uses  getChunkClass()
		 * @uses  formatOffset()
		 * @uses  Util::binaryToHex()
		 * @uses  Chunk::toBinary()
		 * @uses  Chunk::getLength()
		 *
		 * @param  Chunk $chunk
		 * @return string
		 */
		public function beforeChunk(Chunk $chunk) {
			$text = '';
			
			if ($chunk instanceof Delta) {
				$this->delta = $chunk;
			} else if (!($chunk instanceof Event)) {
				$class = $this->getChunkClass($chunk);
				$text = "<tr class=\"$class\">" . $this->formatOffset($this->offset);
				$text .= '<td><tt>' . wordwrap(implode(' ', Util::binaryToHex($chunk->toBinary())), 23, '<br />') . '</tt></td>';
				$this->offset += $chunk->getLength();
			}
			
			return $text;
		}
		
		/**
		 * Gets the CSS class for the chunk type
		 *
		 * @since 1.0
		 *
		 * @param  Chunk $chunk
		 * @return string
		 */
		private function getChunkClass(Chunk $chunk) {
			if ($chunk instanceof ChannelEvent) {
				return 'channel';
			} else if ($chunk instanceof MetaEvent) {
				return 'meta';
			} else {
				return 'header';
			}
		}
		
		/**
		 * @since 1.0
		 *
		 * @param  Chunk $chunk
		 * @return string
		 */
		public function afterChunk(Chunk $chunk) {
			return $chunk instanceof Delta ? '' : '</tr>';
		}
		
		/**
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeFileHeader(FileHeader $fileHeader) {
			return "\t\t\t\t\t<tbody>\n";
		}
		
		/**
		 * @since 1.0
		 * @uses  FileHeader::getData()
		 * 
		 * @param  FileHeader $fileHeader
		 * @return string
		 */
		public function formatFileHeader(FileHeader $fileHeader) {
			list($format, $tracks, $timeDivision) = $fileHeader->getData();
			$text  = '<td><a name="file-header"></a>';
			$text .= "MIDI file format: $format, # of tracks: $tracks, Time division: $timeDivision";
			$text .= '</td>';
			return $text;
		}
		
		/**
		 * @since 1.0
		 *
		 * @param  FileHeader $fileHeader
		 * @return string
		 */
		public function afterFileHeader(FileHeader $fileHeader) {
			return "\t\t\t\t\t</tbody>\n";
		}
		
		/**
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeTrack() {
			$this->currentTrack++;
			$track = 'track' . $this->currentTrack;
			return <<<HTML
					<tbody>
						<tr class="trackheader">
							<td colspan="3">
								<a class="track" id="$track" name="$track"></a>
								Track $this->currentTrack
							</td>
						</tr>
					</tbody>
					<tbody>

HTML;
		}
		
		/**
		 * @since 1.0
		 * @uses  TrackHeader::getData()
		 * 
		 * @param  TrackHeader $trackHeader
		 * @return string
		 */
		public function formatTrackHeader(TrackHeader $trackHeader) {
			list($size) = $trackHeader->getData();
			return "<td>Track size: $size bytes</td>";
		}
		
		/**
		 * @since 1.0
		 * @uses  getChunkClass()
		 * @uses  formatOffset()
		 * @uses  Delta::toBinary()
		 * @uses  Util::binaryToHex()
		 * @uses  Event::toBinary()
		 * @uses  Event::getLength()
		 * @uses  Delta::getLength()
		 * 
		 * @param  Event $event
		 * @return string
		 */
		public function beforeEvent(Event $event) {
			if ($this->delta === null) {
				return '';
			}
			
			$class = $this->getChunkClass($event);
			$text = "<tr class=\"$class\">" . $this->formatOffset($this->offset);
			
			// -- all of this goofy looking math just formats everything prettily -- //
			$deltaHex = Util::binaryToHex($this->delta->toBinary());
			$delta = '<span class="delta">' . wordwrap(implode(' ', $deltaHex), 23, '<br />') . '</span>';
			
			$eventHex = Util::binaryToHex($event->toBinary());
			
			$lineLength = 23 - (strlen(implode(' ', $deltaHex)) % 23);
			
			$eventSegment = wordwrap(implode(' ', $eventHex), $lineLength, '|');
			$bar = strpos($eventSegment, '|');
			if ($bar !== false) {
				$eventSegment = substr($eventSegment, 0, $bar) . '<br />' . wordwrap(substr($eventSegment, $bar + 1), 23, '<br />');
			}
			// -- end goofiness -- //
			
			$text .= '<td><tt>' . $delta . ' ' . $eventSegment . '</tt></td>';
			$this->offset += $event->getLength() + $this->delta->getLength();
			return $text;
		}
		
		/**
		 * @since 1.0
		 * @uses  Event::__toString()
		 * 
		 * @param  Event $event
		 * @return string
		 */
		public function formatEvent(Event $event) {
			if ($this->delta === null) {
				return '';
			}
			
			list($ticks) = $this->delta->getData();
			return '<td><span class="delta">[' . $ticks . ' ticks]</span> ' . (string)$event . '</td>';
		}
		
		/**
		 * @since 1.0
		 *
		 * @return string
		 */
		public function afterTrack() {
			return "\t\t\t\t\t</tbody>\n";
		}
		
		/**
		 * @since 1.0
		 *
		 * @param  float $parseTime
		 * @param  float $totalTime
		 * @return string
		 */
		public function afterFile($parseTime, $totalTime) {
			if ($this->multiFile) {
				//irrelevant for multi file mode, since each file is truncated to a certain length
				$parseTime = '';
			} else {
				$parseTime = ' in ' . round($parseTime, 3) . ' seconds';
			}
			
			$date   = date('M j, Y g:i:s A');
			$name   = Version::NAME . ' ' . Version::VERSION;
			$author = Version::AUTHOR;
			
			return <<<HTML
				</table>
			</div>

			<div id="footer">
				<p>
					Generated by <a title="$name" href="http://phpmidiparser.com/">$name</a>$parseTime on $date
					<br />
					&copy; 2009 <a title="by $author" href="http://tommymontgomery.com/">$author</a>
				</p>
			</div>
		</div>
	</body>
</html>
HTML;
		}
		
		/**
		 * @since 1.0
		 *
		 * @return HtmlPostProcessor
		 */
		public function getPostProcessor() {
			return new HtmlPostProcessor();
		}
		
	}

?>