<?php

	/**
	 * \Tmont\Midi\Parsing\DeltaParser
	 *
	 * @package   Midi
	 * @copyright � 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since     1.0
	 */

	namespace Tmont\Midi\Parsing;
	
	use Tmont\Midi\Delta;

	/**
	 * Class for parsing delta times
	 *
	 * @package Midi
	 * @since   1.0
	 */
	class DeltaParser extends Parser {
		
		/**
		 * Creates a Delta object
		 *
		 * @since 1.0
		 * 
		 * @param  int $ticks The number of MIDI clock ticks
		 * @return Delta
		 */
		public function getDeltaChunk($ticks) {
			return new Delta($ticks);
		}
		
		/**
		 * @since 1.0
		 * @uses  getDeltaChunk()
		 * @uses  getDelta()
		 * 
		 * @return Chunk
		 */
		public function parse() {
			return $this->getDeltaChunk($this->getDelta());
		}
		
	}

?>