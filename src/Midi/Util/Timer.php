<?php

	/**
	 * \Midi\Util\Timer
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Util;
	
	/**
	 * Class for calculating human-usable musical time divisions
	 * from the internal MIDI clock ticks
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @since      1.0
	 */
	class Timer {
		
		/**
		 * The number of ticks per quarter note
		 *
		 * @var int
		 */
		protected $timeDivision;
		
		/**
		 * Storage for triplet division calculations
		 *
		 * @var array
		 */
		protected $triplets;
		
		/**
		 * Constructor
		 *
		 * @since 1.0
		 *
		 * @param  int $timeDivision The number of ticks per quarter note
		 * @throws InvalidArgumentException
		 * @throws DomainException
		 */
		public function __construct($timeDivision) {
			if (!is_int($timeDivision)) {
				throw new \InvalidArgumentException('1st argument must be an integer');
			}
			if ($timeDivision < 1) {
				throw new \DomainException('Time division must be greater than zero');
			}
			
			$this->timeDivision = $timeDivision;
			$this->triplets     = array();
		}
		
		/**
		 * Gets the time division
		 *
		 * @since 1.0
		 *
		 * @return int
		 */
		public final function getTimeDivision() {
			return $this->timeDivision;
		}
		
		/**
		 * Gets the number of ticks needed for the specified
		 * note division
		 *
		 * @since 1.0
		 *
		 * @param  int $division The note division
		 * @return int
		 */
		protected function getTicksForNoteDivision($division) {
			return (int)floor($this->timeDivision / $division);
		}
		
		/**
		 * Gets the number of ticks needed for a 64th note
		 *
		 * @since 1.0
		 * @uses  getTicksForNoteDivision()
		 *
		 * @return int
		 */
		public final function sixtyFourthNote() {
			return $this->getTicksForNoteDivision(16);
		}
		
		/**
		 * Gets the number of ticks needed for a 32nd note
		 *
		 * @since 1.0
		 * @uses  getTicksForNoteDivision()
		 *
		 * @return int
		 */
		public final function thirtySecondNote() {
			return $this->getTicksForNoteDivision(8);
		}
		
		/**
		 * Gets the number of ticks needed for a sixteenth note
		 *
		 * @since 1.0
		 * @uses  getTicksForNoteDivision()
		 *
		 * @return int
		 */
		public final function sixteenthNote() {
			return $this->getTicksForNoteDivision(4);
		}
		
		/**
		 * Gets the number of ticks needed for an eighth note
		 *
		 * @since 1.0
		 * @uses  getTicksForNoteDivision()
		 *
		 * @return int
		 */
		public final function eighthNote() {
			return $this->getTicksForNoteDivision(2);
		}
		
		/**
		 * Gets the number of ticks needed for a quarter note
		 *
		 * @since 1.0
		 * @uses  getTicksForNoteDivision()
		 *
		 * @return int
		 */
		public final function quarterNote() {
			return $this->getTicksForNoteDivision(1);
		}
		
		/**
		 * Gets the number of ticks needed for a half note
		 *
		 * @since 1.0
		 * @uses  getTicksForNoteDivision()
		 *
		 * @return int
		 */
		public final function halfNote() {
			return $this->getTicksForNoteDivision(.5);
		}
		
		/**
		 * Gets the number of ticks needed for a whole note
		 *
		 * @since 1.0
		 * @uses  getTicksForNoteDivision()
		 *
		 * @return int
		 */
		public final function wholeNote() {
			return $this->getTicksForNoteDivision(.25);
		}
		
		/**
		 * Dot-izes the number of ticks
		 *
		 * @since 1.0
		 *
		 * @param  int $ticks
		 * @return int
		 */
		public function dot($ticks) {
			return (int)floor($ticks * 1.5);
		}
		
		/**
		 * Triplet-izes the number of ticks
		 *
		 * @since 1.0
		 * @uses  resolveTriplet()
		 *
		 * @param  int $ticks
		 * @return int
		 */
		public function triplet($ticks) {
			$tripletTicks = (int)floor($ticks / 3);
			if (isset($this->triplets[$ticks])) {
				if ($this->triplets[$ticks]=== $tripletTicks * 2) {
					$tripletTicks = $this->resolveTriplet($ticks);
				} else {
					$this->triplets[$ticks] += $tripletTicks;
				}
			} else {
				$this->triplets[$ticks] = $tripletTicks;
			}
			
			return $tripletTicks;
		}
		
		/**
		 * Resolves rounding errors when calculating triplets
		 *
		 * For example, when calculating the number of ticks for
		 * a triplet that should be 100 ticks long, the default
		 * division will be 33, 33 and 33 for each note of the
		 * triplet. That can mess up your calculations later on
		 * since the division is one tick short of what it should
		 * be. This method will solve those rounding errors by
		 * returning the remainder for the third note of the triplet,
		 * e.g. 33, 33 and 34 for a total tick count of 100.
		 *
		 * This function should not be used directly unless you're
		 * trying to calculate a triplet rest. Use {@link triplet()}
		 * for actual triplets of notes.
		 *
		 * @since 1.0
		 * @uses  resolveTriplet()
		 *
		 * @param  int $ticks
		 * @throws RuntimeException if the triplet division has not been registered
		 * @return int
		 */
		public function resolveTriplet($ticks) {
			if (!isset($this->triplets[$ticks])) {
				throw new \RuntimeException('This triplet division has not been registered');
			}
			
			$resolvedTicks = $ticks - $this->triplets[$ticks];
			unset($this->triplets[$ticks]);
			return $resolvedTicks;
		}
		
		/**
		 * Stoccato-izes the number of ticks
		 *
		 * @since 1.0
		 *
		 * @param  int $ticks
		 * @return int
		 */
		public function stoccato($ticks) {
			return (int)floor($ticks * .75);
		}
		
		/**
		 * un-Stoccato-izes the number of ticks
		 *
		 * @since 1.0
		 *
		 * @param  int $ticks
		 * @return int
		 */
		public function unstoccato($ticks) {
			return $ticks - $this->stoccato($ticks);
		}
		
	}

?>