<?php

	/**
	 * \Midi\Event\SequenceNumberEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents a sequence number meta event
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 * @todo       Document what this event actually does
	 */
	class SequenceNumberEvent extends MetaEvent {
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  int $msb The most significant bits
		 * @param  int $lsb The least significant bits
		 */
		public function __construct($msb, $lsb) {
			parent::__construct(array($msb, $lsb));
		}
		
		/**
		 * @since 1.0
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return 'most significant bits: ' . $this->data[0] . ', least significant bits: ' . $this->data[1];
		}
		
		/**
		 * @since 1.0
		 * @uses  MetaEventType::SEQUENCE_NUMBER
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::SEQUENCE_NUMBER;
		}
		
	}

?>