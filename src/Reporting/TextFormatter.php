<?php

	/**
	 * \Tmont\Midi\Reporting\TextFormatter
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @copyright  � 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Tmont\Midi\Reporting;
	
	use Tmont\Midi\Delta;
	use Tmont\Midi\FileHeader;
	use Tmont\Midi\TrackHeader;
	use Tmont\Midi\Event;

	/**
	 * Formats parse results in plaintext
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	class TextFormatter extends Formatter {
		
		/**
		 * The indentation string
		 *
		 * @var string
		 */
		protected $indent;
		
		/**
		 * The number of the current track
		 *
		 * @var int
		 */
		protected $currentTrack;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->indent = '';
			$this->currentTrack = 1;
		}
		
		/**
		 * Centralized place to output text
		 *
		 * @since 1.0
		 * 
		 * @param  string $text
		 */
		protected function formatText($text) {
			return $this->indent . $text . "\n";
		}
		
		/**
		 * Increases the indentation
		 *
		 * @since 1.0
		 */
		protected function increaseIndent() {
			$this->indent .= '  ';
		}
		
		/**
		 * Decreases the indentation
		 *
		 * @since 1.0
		 */
		protected function decreaseIndent() {
			$this->indent = substr($this->indent, 0, -2);
		}
		
		/**
		 * @since 1.0
		 * @uses  formatText()
		 * @uses  increaseIndent()
		 *
		 * @return string
		 */
		public function beforeFile() {
			$text = $this->formatText('---- FILE START ----');
			$this->increaseIndent();
			return $text;
		}
		
		/**
		 * @since 1.0
		 * @uses  formatText()
		 * @uses  increaseIndent()
		 *
		 * @return string
		 */
		public function beforeFileHeader(FileHeader $fileHeader) {
			$text = $this->formatText('---- FILE HEADER ----');
			$this->increaseIndent();
			return $text;
		}
		
		/**
		 * @since 1.0
		 * @uses  FileHeader::getData()
		 * @uses  formatText()
		 * 
		 * @param  FileHeader $fileHeader
		 * @return string
		 */
		public function formatFileHeader(FileHeader $fileHeader) {
			list($format, $tracks, $timeDivision) = $fileHeader->getData();
			
			$text  = $this->formatText('format:        ' . $format);
			$text .= $this->formatText('tracks:        ' . $tracks);
			$text .= $this->formatText('time division: ' . $timeDivision);
			return $text;
		}
		
		/**
		 * @since 1.0
		 * @uses  decreaseIndent()
		 */
		public function afterFileHeader(FileHeader $fileHeader) {
			$this->decreaseIndent();
		}
		
		/**
		 * @since 1.0
		 * @uses  TrackHeader::getData()
		 * @uses  formatText()
		 * @uses  decreaseIndent()
		 * 
		 * @param  TrackHeader $trackHeader
		 * @return string
		 */
		public function formatTrackHeader(TrackHeader $trackHeader) {
			list($size) = $trackHeader->getData();
			
			$text = $this->formatText('---- TRACK ' . $this->currentTrack . ' (' . $size . ' bytes) ----');
			$this->currentTrack++;
			$this->increaseIndent();
			return $text;
		}
		
		/**
		 * @since 1.0
		 * @uses  Delta::getData()
		 * @uses  formatText()
		 * 
		 * @param  Delta $delta
		 *
		 * @return string
		 */
		public function formatDelta(Delta $delta) {
			list($ticks) = $delta->getData();
			return $this->formatText('delta: ' . $ticks);
		}
		
		/**
		 * @since 1.0
		 * @uses  formatText()
		 * @uses  Event::__toString()
		 * 
		 * @param  Event $event
		 * @return string
		 */
		public function formatEvent(Event $event) {
			return $this->formatText($event->__toString());
		}
		
		/**
		 * @since 1.0
		 * @uses  decreaseIndent()
		 */
		public function afterTrack() {
			$this->decreaseIndent();
		}
		
	}

?>