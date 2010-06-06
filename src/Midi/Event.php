<?php

	/**
	 * \Midi\Event
	 *
	 * @package   Midi
	 * @copyright © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since     1.0
	 */

	namespace Midi;
	
	use Midi\Chunk;

	/**
	 * Represents a MIDI event (meta, sysex or channel), but NOT 
	 * the delta time associated with each event
	 *
	 * @package Midi
	 * @since   1.0
	 */
	interface Event extends Chunk {
		
		/**
		 * Gets the event type
		 *
		 * @since 1.0
		 * @see   EventType
		 *
		 * @return  int
		 */
		public function getType();
		
	}

?>