<?php

	/**
	 * \Midi\Event\ChannelEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	use \Midi\Event;
	use \Midi\Util\Util;

	/**
	 * Represents events that are associated with a channel
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	abstract class ChannelEvent implements Event, Parameterized {
		
		/**
		 * The channel this event is associated with (0-15)
		 *
		 * @var int
		 */
		protected $channel;
		
		/**
		 * @var int
		 */
		protected $param1;
		
		/**
		 * @var int
		 */
		protected $param2;
		
		/**
		 * @var bool
		 */
		private $isContinuation;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  int  $channel        4-bit integer
		 * @param  int  $param1         8-bit integer
		 * @param  int  $param2         8-bit integer
		 * @param  bool $isContinuation
		 */
		public function __construct($channel, $param1, $param2 = null, $isContinuation = false) {
			$this->channel        = $channel;
			$this->param1         = $param1;
			$this->param2         = $param2;
			$this->isContinuation = $isContinuation;
		}
		
		/**
		 * Gets a string representation of this event
		 *
		 * @since 1.0
		 * @uses    EventType::getEventName()
		 * @uses    getType()
		 * @uses    getParamDescription()
		 * 
		 * @return string
		 */
		public function __toString() {
			return EventType::getEventName($this->getType()) . ' (channel ' . $this->channel . '): ' . $this->getParamDescription();
		}
		
		/**
		 * Gets a binary representation of this event
		 *
		 * @since 1.0
		 * @uses  Util::pack()
		 * 
		 * @return binary
		 */
		public function toBinary() {
			$binary = ($this->isContinuation()) ? '' : Util::pack($this->getType() | $this->channel);
			$binary .= Util::pack($this->param1, $this->param2);
			return $binary;
		}
		
		/**
		 * Gets the data associated with this event
		 *
		 * @since 1.0
		 * 
		 * @return array [0] => channel, [1] => param1, [2] => param2
		 */
		public function getData() {
			return array(
				$this->channel,
				$this->param1,
				$this->param2
			);
		}
		
		/**
		 * Gets the length of this event in bytes
		 *
		 * @since 1.0
		 * 
		 * @return int
		 */
		public function getLength() {
			return ($this->isContinuation) ? 2 : 3;
		}
		
		/**
		 * Sets whether this event is a continuation event
		 *
		 * @since 1.0
		 *
		 * @param  bool $isContinuation
		 * @return bool
		 */
		public function setContinuation($isContinuation) {
			$this->isContinuation = (bool)$isContinuation;
		}
		
		/**
		 * Gets whether this event is a continuation event
		 *
		 * @since 1.0
		 *
		 * @return bool
		 */
		public function isContinuation() {
			return $this->isContinuation;
		}
		
	}

?>