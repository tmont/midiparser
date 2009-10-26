<?php

	/**
	 * \Midi\Delta
	 *
	 * @package   Midi
	 * @copyright © 2009 Tommy Montgomery <http://phpmidiparser.com>
	 * @since     1.0
	 */

	namespace Midi;

	/**
	 * Represents a variable-length delta time
	 *
	 * @package Midi
	 * @since   1.0
	 */
	class Delta implements Chunk {
		
		/**
		 * @var int
		 */
		private $ticks;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  int $ticks The number of MIDI clock ticks in this delta event
		 */
		public function __construct($ticks) {
			$this->ticks = $ticks;
		}
		
		/**
		 * Describe this function
		 *
		 * @since 1.0
		 * 
		 * @return array
		 */
		public function getData() {
			return array($this->ticks);
		}
		
		/**
		 * @since 1.0
		 * @uses  Util::getDeltaByteSequence()
		 * 
		 * @return Util
		 */
		public function toBinary() {
			return Util\Util::getDeltaByteSequence($this->ticks);
		}
		
		/**
		 * @since 1.0
		 * 
		 * @return string
		 */
		public function __toString() {
			return 'Delta value: ' . $this->ticks;
		}
		
		/**
		 * @since 1.0
		 * @uses  toBinary()
		 * 
		 * @return int
		 */
		public function getLength() {
			return strlen($this->toBinary());
		}
		
	}

?>