<?php

	/**
	 * \Midi\Event\ChannelEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @version    1.0
	 */

	namespace Midi\Event;
	
	use \Midi\Event;

	/**
	 * Represents events that are associated with a channel
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @version    1.0
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
		 * Constructor
		 *
		 * @version 1.0
		 * 
		 * @param  int $channel Valid values: 0-15
		 * @param  int $param1  8-bit integer
		 * @param  int $param2  8-bit integer
		 */
		public function __construct($channel, $param1, $param2 = null) {
			$this->channel = $channel;
			$this->param1  = $param1;
			$this->param2  = $param2;
		}
		
		/**
		 * Gets a string representation of this event
		 *
		 * @version 1.0
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
		 * @version 1.0
		 * @uses    Util::pack()
		 * 
		 * @return binary
		 */
		public function toBinary() {
			return \Midi\Util\Util::pack($this->getType() | $this->channel, 2, $this->param1, $this->param2);
		}
		
		/**
		 * Gets the data associated with this event
		 *
		 * @version 1.0
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
		 * @version 1.0
		 * 
		 * @return int
		 */
		public function getLength() {
			return 3;
		}
		
	}

?>