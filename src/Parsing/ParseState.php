<?php
	
	/**
	 * \Tmont\Midi\Parsing\ParseState
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @copyright  � 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Tmont\Midi\Parsing;

	/**
	 * Represents the current state during parsing
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */
	final class ParseState {
	
		/**
		 * The next chunk is expected to be a file header
		 *
		 * @var int
		 */
		const FILE_HEADER  = 0;
		
		/**
		 * The next chunk is expected to be a track header
		 *
		 * @var int
		 */
		const TRACK_HEADER = 1;
		
		/**
		 * The next chunk is expected to be a delta time
		 *
		 * @var int
		 */
		const DELTA        = 2;
		
		/**
		 * The next chunk is expected to be a MIDI event
		 *
		 * @var int
		 */
		const EVENT        = 3;
		
		/**
		 * Parsing done, the end of the file is expected
		 *
		 * @var int
		 */
		const EOF          = 4;
	
	}

?>