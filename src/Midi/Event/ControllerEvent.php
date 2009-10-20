<?php

	/**
	 * \Midi\Event\ControllerEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	/**
	 * Represents controller updates for a particular channel
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 * @see        Controller
	 */
	class ControllerEvent extends ChannelEvent {
		
		/**
		 * Gets a description of each controller type
		 *
		 * @version 1.0
		 * @todo    Implement each controller type
		 * 
		 * @return string
		 */
		public function getControllerDetail() {
			switch ($this->param1) {
				default:
					return 'value [' . $this->param2 . ']';
			}
		}
		
		/**
		 * @since 1.0
		 * @uses  Controller::getControllerName()
		 * @uses  getControllerDetail()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			return \Midi\Util\Controller::getControllerName($this->param1) . ' ' . $this->getControllerDetail();
		}
		
		/**
		 * @since 1.0
		 * @uses  EventType::CONTROLLER
		 * 
		 * @return int
		 */
		public function getType() {
			return EventType::CONTROLLER;
		}
		
	}

?>