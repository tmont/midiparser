<?php

	/**
	 * Tmont\Midi\Chunk
	 *
	 * @package   Midi
	 * @copyright � 2009 Tommy Montgomery <http://phpmidiparser.com>
	 * @since     1.0
	 */

	namespace Tmont\Midi;

	/**
	 * Represents a MIDI chunk (event, delta time, file header, etc.)
	 *
	 * @package Midi
	 * @since   1.0
	 */
	interface Chunk {
		
		/**
		 * Gets the data associated with this chunk
		 *
		 * @since 1.0
		 *
		 * @return array
		 */
		public function getData();
		
		/**
		 * Gets the string representation of this chunk
		 *
		 * @since 1.0
		 *
		 * @return string
		 */
		public function __toString();
		
		/**
		 * Gets the binary representation of this chunk
		 *
		 * @since 1.0
		 *
		 * @return binary
		 */
		public function toBinary();
		
		/**
		 * Gets the length of this chunk in bytes
		 *
		 * @since 1.0
		 *
		 * @return int
		 */
		public function getLength();
		
	}

?>