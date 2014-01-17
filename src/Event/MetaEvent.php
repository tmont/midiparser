<?php

	/**
	 * \Tmont\Midi\Event\MetaEvent
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
	 * Base class for all meta events
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 * @todo       Still missing meta events 0xF1-0xFE
	 */
	abstract class MetaEvent implements Parameterized, Event {
		
		/**
		 * The length in bytes of the data
		 *
		 * @var mixed
		 */
		protected $length;
		
		/**
		 * The content of the meta event
		 *
		 * @var string|array
		 */
		protected $data;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  string|array $data
		 */
		public function __construct($data = null) {
			if (is_string($data)) {
				$this->length = strlen($data);
			} else if (is_array($data)) {
				$this->length = count($data);
			} else {
				$this->length = 0;
			}
			
			$this->data = $data;
		}
		
		/**
		 * Gets the length of this meta event in bytes
		 *
		 * @since 1.0
		 * @uses  Util::getDeltaByteSequence()
		 * 
		 * @return int
		 */
		public function getLength() {
			$lengthOfDelta = strlen(Util::getDeltaByteSequence($this->length));
			
			//meta event (0xFF), meta event type, length of data, data
			return 1 + 1 + $lengthOfDelta + $this->length;
		}
		
		/**
		 * Gets the string representation of this meta event
		 *
		 * @since 1.0
		 * @uses  EventType::getEventName()
		 * @uses  MetaEventType::getEventTypeName()
		 * @uses  getParamDescription()
		 * @uses  getType()
		 * @uses  getSubtype()
		 * 
		 * @return string
		 */
		public function __toString() {
			return MetaEventType::getEventTypeName($this->getSubtype()) . ': ' . $this->getParamDescription();
		}
		
		/**
		 * Gets the binary representation of this meta event
		 *
		 * @since 1.0
		 * @uses  Util::pack()
		 * @uses  Util::getDeltaByteSequence()
		 * @uses  getSubtype()
		 * 
		 * @return binary
		 */
		public function toBinary() {
			if (is_array($this->data)) {
				$data = '';
				foreach ($this->data as $datum) {
					$data .= Util::pack($datum);
				}
			} else {
				$data = $this->data;
			}
			
			return
				Util::pack($this->getType(), $this->getSubtype()) .
				Util::getDeltaByteSequence($this->length) .
				$data;
		}
		
		/**
		 * Gets the data associated with this meta event
		 *
		 * @since 1.0
		 * @uses  getSubtype()
		 * 
		 * @return array [0] => meta subtype, [1] => length, [2] => data
		 */
		public function getData() {
			return array(
				$this->getSubtype(),
				$this->length,
				$this->data
			);
		}
		
		/**
		 * Gets the event type
		 *
		 * @since 1.0
		 * @uses  EventType::META
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::META;
		}
		
		/**
		 * Gets the meta event subtype for this event
		 *
		 * @since 1.0
		 * 
		 * @return int
		 */
		public abstract function getSubtype();
		
	}

?>