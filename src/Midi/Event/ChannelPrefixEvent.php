<?php

	/**
	 * \Midi\Event\ChannelPrefixEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @version    1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents the channel prefix meta event
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @version    1.0
	 * @todo       Document what this event actually does
	 */
	class ChannelPrefixEvent extends MetaEvent {
		
		/**
		 * Constructor
		 *
		 * @version 1.0
		 * 
		 * @param  int $channel Valid values: 0-15
		 */
		public function __construct($channel) {
			parent::__construct(array($channel));
		}
		
		/**
		 * @version 1.0
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return 'channel: ' . $this->data[0];
		}
		
		/**
		 * @version 1.0
		 * @uses    MetaEventType::CHANNEL_PREFIX
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::CHANNEL_PREFIX;
		}
		
	}

?>