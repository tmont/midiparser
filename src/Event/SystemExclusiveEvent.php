<?php

	/**
	 * \Tmont\Midi\Event\SystemExclusiveEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  � 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Tmont\Midi\Event;
	
	use Tmont\Midi\Event;
	use Tmont\Midi\Util\Util;
	
	/**
	 * Represents a system exclusive event
	 *
	 * These events are exclusive to the (duh) system. Meaning,
	 * each manufacturer can use these events in whatever way
	 * they choose.
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class SystemExclusiveEvent implements Event {
		
		/**
		 * @var array
		 */
		protected $data;
		
		/**
		 * Length of the data
		 *
		 * @var int
		 */
		protected $length;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  array $data
		 */
		public function __construct(array $data) {
			$this->length = count($data);
			$this->data   = $data;
		}
		
		/**
		 * Gets the length of this event in bytes
		 *
		 * @since 1.0
		 * @uses  Util::getDeltaByteSequence()
		 * 
		 * @return int
		 */
		public function getLength() {
			$lengthOfDelta = strlen(Util::getDeltaByteSequence($this->length));
			
			//sysex event (0xF0), length of data, data
			return 1 + $lengthOfDelta + $this->length;
		}
		
		/**
		 * Gets the string representation of this event
		 *
		 * @since 1.0
		 * @uses  EventType::getEventName()
		 * @uses  getType()
		 * 
		 * @return string
		 */
		public function __toString() {
			return EventType::getEventName($this->getType()) . ': manufacturer dependent';
		}
		
		/**
		 * Gets a binary representation of this event
		 *
		 * @since 1.0
		 * @uses  Util::getDeltaByteSequence()
		 * @uses  getType()
		 * @uses  Util::pack()
		 * 
		 * @return Midi
		 */
		public function toBinary() {
			$delta = Util::getDeltaByteSequence($this->length);
			return Util::pack($this->getType()) . $delta . implode('', $this->data);
		}
		
		/**
		 * Gets whether this is a divided system exclusive event
		 *
		 * In order to avoid delays in playback with very long
		 * sysex events, normal sysex events can be broken up into
		 * several divided events.
		 * 
		 *
		 * @since 1.0
		 * @uses  isNormal()
		 * @see   isNormal()
		 * 
		 * @return bool
		 */
		public function isDivided() {
			return !$this->isNormal();
		}
		
		/**
		 * Gets whether this is a normal system exclusive event
		 *
		 * Normal sysex events are signified by the last byte of data
		 * being 0xF7.
		 *
		 * @since 1.0
		 * @uses  Util::pack()
		 * @see   isDivided()
		 * 
		 * @return bool
		 */
		public function isNormal() {
			$byte = end($this->data);
			reset($this->data);
			return $byte === Util::pack(0xF7);
		}
		
		/**
		 * Gets the data associated with this event
		 *
		 * @since 1.0
		 * 
		 * @return array
		 */
		public function getData() {
			return $this->data;
		}
		
		/**
		 * Gets the event type
		 *
		 * @since 1.0
		 * @uses  EventType::SYSTEM_EXCLUSIVE
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::SYSTEM_EXCLUSIVE;
		}
		
	}

?>