<?php

	/**
	 * \Midi\Reporting\Formatter
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
	use Midi\Event;

	/**
	 * Default (empty) class for formatting parse results
	 *
	 * Use in conjunction with {@link Printer}.
	 *
	 * @package    Midi
	 * @subpackage Reporting
	 * @since      1.0
	 */
	class Formatter {
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {}
		
		/**
		 * Before a file is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeFile() {}
		
		/**
		 * Before a chunk is parsed
		 *
		 * @since 1.0
		 *
		 * @param  Chunk $chunk
		 * @return string
		 */
		public function beforeChunk(Chunk $chunk) {}
		
		/**
		 * After a chunk is parsed
		 *
		 * @since 1.0
		 *
		 * @param  Chunk $chunk
		 * @return string
		 */
		public function afterChunk(Chunk $chunk) {}
		
		/**
		 * Before a file header is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeFileHeader(FileHeader $fileHeader) {}
		
		/**
		 * Formats a file header
		 *
		 * @since 1.0
		 * 
		 * @param  FileHeader $fileHeader
		 * @return string
		 */
		public function formatFileHeader(FileHeader $fileHeader) {}
		
		/**
		 * After a file header is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function afterFileHeader(FileHeader $fileHeader) {}
		
		/**
		 * Before a track is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeTrack() {}
		
		/**
		 * Before a track header is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeTrackHeader(TrackHeader $trackHeader) {}
		
		/**
		 * Formats a track header
		 *
		 * @since 1.0
		 * 
		 * @param  TrackHeader $trackHeader
		 * @return string
		 */
		public function formatTrackHeader(TrackHeader $trackHeader) {}
		
		/**
		 * After a track header is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function afterTrackHeader(TrackHeader $trackHeader) {}
		
		/**
		 * Before a delta time is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeDelta(Delta $delta) {}
		
		/**
		 * Formts a delta time
		 *
		 * @since 1.0
		 * 
		 * @param  Delta $delta
		 * @return string
		 */
		public function formatDelta(Delta $delta) {}
		
		/**
		 * After a delta time is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function afterDelta(Delta $delta) {}
		
		/**
		 * Before an event is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function beforeEvent(Event $event) {}
		
		/**
		 * Formats an event
		 *
		 * @since 1.0
		 * 
		 * @param  Event $event
		 * @return string
		 */
		public function formatEvent(Event $event) {}
		
		/**
		 * After an event is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function afterEvent(Event $event) {}
		
		/**
		 * After a track is parsed
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function afterTrack() {}
		
		/**
		 * After a file is parsed
		 *
		 * @since 1.0
		 *
		 * @param  float $parseTime The elapsed time for parsing in seconds
		 * @param  float $totalTime The total time (parsing + formatting + printing) in seconds
		 * @return string
		 */
		public function afterFile($parseTime, $totalTime) {}
		
		/**
		 * Gets the post-print processor for this formatter
		 *
		 * @since 1.0
		 *
		 * @return PostProcessor
		 */
		public function getPostProcessor() {
			return new DefaultPostProcessor();
		}
		
	}

?>