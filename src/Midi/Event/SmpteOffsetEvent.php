<?php

	/**
	 * \Midi\Event\SmpteOffsetEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Midi\Event;
	
	use InvalidArgumentException;
	
	/**
	 * Class SmpteOffsetEvent
	 *
	 * @package    Midi
	 * @subpackage Event
	 * @since      1.0
	 */
	class SmpteOffsetEvent extends MetaEvent {
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * 
		 * @param  int $frameRate Valid values: 0 (24fps), 1 (25fps), 2 (30fps drop frame), 3 (30fps)
		 * @param  int $hour      Valid values: 0-23
		 * @param  int $min       Valid values: 0-59
		 * @param  int $second    Valid values: 0-59
		 * @param  int $frame     Valid values: 0-59
		 * @param  int $subframe  Valid values: 0-99
		 */
		public function __construct($frameRate, $hour, $min, $second, $frame, $subframe) {
			parent::__construct(array(($frameRate << 5) | $hour, $min, $second, $frame, $subframe));
		}
		
		/**
		 * @since 1.0
		 * @uses  getFrameRateDescription()
		 * 
		 * @return string
		 */
		public function getParamDescription() {
			$frameRate = self::getFrameRateDescription(($this->data[0] >> 5) & 0xFF);
			$hour      = $this->data[0] & 0x1F;
			$minute    = $this->data[1];
			$second    = $this->data[2];
			$frame     = $this->data[3];
			$subFrame  = $this->data[4];
			
			return $hour . 'h ' . $minute . 'm ' . $second . 's ' . $frame . '.' . $subFrame . 'f @ ' . $frameRate;
		}
		
		/**
		 * Gets the user-friendly description of the different
		 * frame rate types
		 *
		 * @since 1.0
		 * 
		 * @param  int $frameRate Valid values: 0-3
		 * @throws InvalidArgumentException
		 * @return string
		 */
		public static function getFrameRateDescription($frameRate) {
			switch ($frameRate) {
				case 0:
					return '24fps';
				case 1:
					return '25fps';
				case 2:
					return '30fps (drop frame)';
				case 3:
					return '30fps';
				default:
					throw new InvalidArgumentException('Invalid frame rate');
			}
		}
		
		/**
		 * @since 1.0
		 * @uses  MetaEventType::SMPTE_OFFSET
		 * 
		 * @return int
		 */
		public function getSubtype() {
			return MetaEventType::SMPTE_OFFSET;
		}
		
	}

?>