<?php

	/**
	 * Tmont\Midi\Event\ChannelAftertouchEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  � 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Tmont\Midi\Event;
	
	/**
	 * Represents a channel aftertouch channel event
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 * @todo       Document what this event actually does
	 */
	class ChannelAftertouchEvent extends ChannelEvent {
		
		/**
		 * @since 1.0
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return 'aftertouch pressure [' . $this->param1 . ']';
		}
		
		/**
		 * @since 1.0
		 * @uses  EventType::CHANNEL_AFTERTOUCH
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::CHANNEL_AFTERTOUCH;
		}
		
		/**
		 * @since 1.0
		 * 
		 * @return int
		 */
		public function getLength() {
			return 2;
		}
		
	}

?>