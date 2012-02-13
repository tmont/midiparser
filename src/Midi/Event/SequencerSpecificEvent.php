<?php

	/**
	 * \Midi\Event\SequencerSpecificEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a sequencer specific meta event
	 *
	 * These events provide ways for the MIDI sequencer to communicate
	 * with the MIDI device. Their data is manufacturer specific.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class SequencerSpecificEvent extends MetaEvent {
		
		/**
		 * @since 1.0
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return 'read the manufacturer\'s manual';
		}
		
		/**
		 * @since 1.0
		 * @uses  MetaEventType::SEQUENCER_SPECIFIC
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::SEQUENCER_SPECIFIC;
		}
		
	}

?>