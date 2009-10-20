<?php

	/**
	 * Midi\Event\Parameterized
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @version    1.0
	 */

	namespace Midi\Event;

	/**
	 * Interface for classes that have parameters (e.g.
	 * {@link ChannelEvent}s
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @version    1.0
	 */
	interface Parameterized {
		
		/**
		 * Gets the description of the parameter(s)
		 *
		 * @version 1.0
		 *
		 * @return string
		 */
		public function getParamDescription();
		
	}

?>