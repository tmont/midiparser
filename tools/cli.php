<?php

	/**
	 * Cli, Usage, CliSwitch, CliSwitchCollection
	 *
	 * @package Cli
	 * @author  Tommy Montgomery
	 * @version 1.0
	 * @since   1.0
	 */

	/**
	 * Cli helper
	 *
	 * @package Cli
	 * @author  Tommy Montgomery
	 * @version 1.0
	 * @since   1.0
	 */
	class Cli {
		
		/**
		 * Constructor
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 */
		private function __construct() {}
		
		/**
		 * Parses command line arguments
		 *
		 * @param  array $args
		 * @return array
		 */
		public static function parseArgs(array $args, CliSwitchCollection $switches) {
			$parsed = array(
				'switches' => array(),
				'args'     => array()
			);
			
			$last = null;
			$switch = null;
			foreach ($args as $arg) {
				if (strpos($arg, '-') === 0) {
					$last = (substr($arg, 0, 2) === '--') ? substr($arg, 2) : substr($arg, 1);
					$switch = $switches->getSwitch($last);
					if ($switch !== null) {
						$parsed['switches'][$switch->longName] = true;
					}
				} else if ($switch !== null) {
					if ($switch->value !== null) {
						$parsed['switches'][$switch->longName] = $arg;
					} else {
						$parsed['args'][] = $arg;
					}
					
					$switch = null;
				} else {
					$parsed['args'][] = $arg;
				}
			}
			
			return $parsed;
		}
		
	}
	
	/**
	 * Simple struct representing a command line switch
	 *
	 * @package Cli
	 * @author  Tommy Montgomery
	 * @version 1.0
	 * @since   1.0
	 */
	class CliSwitch {
		
		/**
		 * Long name of the switch
		 *
		 * @var string
		 */
		public $longName;
		
		/**
		 * Short name of the switch
		 *
		 * @var string
		 */
		public $shortName;
		
		/**
		 * Shether this switch is required or optional
		 *
		 * @var bool
		 */
		public $required;
		
		/**
		 * The value of the switch
		 *
		 * @var string
		 */
		public $value;
		
		/**
		 * Description of the switch
		 *
		 * @var mixed
		 */
		public $description;
		
		/**
		 * Constructor
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * 
		 * @param  string $longName
		 * @param  string $shortName
		 * @param  bool   $required
		 * @param  string $value
		 * @param  string $description
		 */
		public function __construct($longName, $shortName = '', $required = true, $value = null, $description = '') {
			$this->longName    = $longName;
			$this->shortName   = $shortName;
			$this->required    = $required;
			$this->value       = $value;
			$this->description = $description;
		}
	}
	
	/**
	 * Represents a collection of {@link CliSwitch}es
	 *
	 * @package Cli
	 * @author  Tommy Montgomery
	 * @version 1.0
	 * @since   1.0
	 */
	class CliSwitchCollection implements IteratorAggregate {
		
		/**
		 * @var array
		 */
		private $switches;
		
		/**
		 * @var CliSwitch
		 */
		private $switchArg;
		
		/**
		 * Constructor
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 */
		public function __construct() {
			$this->switches  = array();
			$this->switchArg = null;
		}
		
		/**
		 * Adds a switch to the collection
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * 
		 * @param  CliSwitch $switch
		 * @return CliSwitchCollection
		 */
		public function addSwitch(CliSwitch $switch) {
			if ($switch->longName === null) {
				$this->switchArg = $switch;
			} else {
				$this->switches[] = $switch;
			}
			
			return $this;
		}
		
		/**
		 * Gets a switch by its short or long name
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * 
		 * @param  string $longOrShortName
		 * @return CliSwitch|null
		 */
		public function getSwitch($longOrShortName) {
			foreach ($this->switches as $switch) {
				if ($switch->longName == $longOrShortName || $switch->shortName == $longOrShortName) {
					return $switch;
				}
			}
			
			return null;
		}
		
		/**
		 * Segregates the switches into required and optional
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * 
		 * @return array Array with keys "required" and "optional"
		 */
		public function segregateSwitches() {
			$switches = array(
				'required' => array(),
				'optional' => array()
			);
			foreach ($this->switches as $switch) {
				if ($switch->required) {
					$switches['required'][] = $switch;
				} else {
					$switches['optional'][] = $switch;
				}
			}
			
			return $switches;
		}
		
		/**
		 * Gets the switch representing the arguments
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * 
		 * @return CliSwitch
		 */
		public function getSwitchArg() {
			return $this->switchArg;
		}
		
		/**
		 * Gets an iterator
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * 
		 * @return ArrayIterator
		 */
		public function getIterator() {
			return new ArrayIterator($this->switches);
		}
		
	}

	/**
	 * Helpful class for printing usage
	 *
	 * @package Cli
	 * @author  Tommy Montgomery
	 * @version 1.0
	 * @since   1.0
	 */
	class Usage {
		
		/**
		 * @var array
		 */
		private $switches;
		
		/**
		 * Name of the program
		 *
		 * @var string
		 */
		private $name;
		
		/**
		 * Name of the script
		 *
		 * @var string
		 */
		private $script;
		
		/**
		 * Description of the program
		 *
		 * @var string
		 */
		private $description;
		
		/**
		 * Copyright information
		 *
		 * @var string
		 */
		private $copyright;
		
		/**
		 * @var int
		 */
		private $maxSwitchLength;
		
		/**
		 * Max line length
		 *
		 * @var int
		 */
		const LINE_LENGTH = 80;
		
		/**
		 * Constructor
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * 
		 * @param  string $name
		 * @param  string $script
		 * @param  string $description
		 * @param  string $author
		 * @param  string $date
		 */
		public function __construct($name, $script, $description, $author = null, $date = null) {
			$this->switches = array(array(), array());
			$this->maxSwitchLength = 0;
			$this->script = $script;
			$this->name = $name;
			$this->description = $description;
			$this->copyright = 
				($date !== null)
				? 'Copyright (c) ' . $date . (($author !== null) ? " $author" : '')
				: (($author !== null) ? "by $author" : '');
		}
		
		/**
		 * Magic function __get
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * 
		 * @param  mixed $key
		 * @throws InvalidArgumentException
		 * @return mixed
		 * @ignore
		 */
		public function __get($key) {
			if ($key === 'switches') {
				return $this->switches;
			}
			
			throw new InvalidArgumentException('Invalid property');
		}
		
		/**
		 * Sets the switch collection
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * @uses    CliSwitchCollection::getIterator()
		 * 
		 * @param  CliSwitchCollection $switches
		 */
		public function setSwitches(CliSwitchCollection $switches) {
			$this->switches = $switches;
			
			$this->maxSwitchLength = 0;
			foreach ($switches->getIterator() as $switch) {
				// + 2 for left padding
				// + 2 for double-hyphen
				$length = 2 + strlen($switch->longName) + 2;
				
				// + 1 for left padding
				// + 1 for hyphen
				// + 1 for openening parenthesis
				// + 1 for closing parenthesis
				$length += (strlen($switch->shortName) > 0) ? 1 + 1 + 1 + strlen($switch->shortName) + 1 : 0;
				//echo $length . "\n";
				$this->maxSwitchLength = max($this->maxSwitchLength, $length);
			}
		}
		
		/**
		 * Gets a string representation of this object
		 *
		 * @author  Tommy Montgomery
		 * @version 1.0
		 * @since   1.0
		 * @uses    CliSwitchCollection::segregateSwitches()
		 * 
		 * @return string
		 */
		public function __toString() {
			$this->maxSwitchLength += 2;
			$usage  = $this->name . "\n";
			$usage .= (!empty($this->copyright)) ? '  ' . $this->copyright . "\n" : '';
			$usage .= "\n";
			
			$usage .= $this->description;
			$usage .= "\n\n";
			
			$usage .= "USAGE\n";
			$usageData = '  ' . $this->script;
			
			$switchData = "REQUIRED\n";
			
			$switches = $this->switches->segregateSwitches();
			
			foreach ($switches['required'] as $switch) {
				$usageData .= ' --' . $switch->longName;
				if ($switch->value !== null) {
					$usageData .= ' ' . $switch->value;
				}
				
				$x = '  --' . $switch->longName;
				if (!empty($switch->shortName)) {
					$x .= str_repeat(' ', $this->maxSwitchLength - 5 - strlen($x)) . '(-' . $switch->shortName . ')';
				}
				
				$x .= str_repeat(' ' , $this->maxSwitchLength - strlen($x));
				$x .= wordwrap($switch->description, self::LINE_LENGTH - strlen($x), "\n" . str_repeat(' ', strlen($x))) . "\n";
				$switchData .= $x;
			}
			
			$arg = $this->switches->getSwitchArg();
			if ($arg !== null) {
				$x = '  ' . $arg->value;
				$x .= str_repeat(' ' , $this->maxSwitchLength - strlen($x));
				$x .= wordwrap($arg->description, self::LINE_LENGTH - strlen($x), "\n" . str_repeat(' ', strlen($x))) . "\n";
				$switchData .= $x;
			}
			
			$switchData .= "\nOPTIONAL\n";
			foreach ($switches['optional'] as $switch) {
				$usageData .= ' [--' . $switch->longName;
				if ($switch->value !== null) {
					$usageData .= ' ' . $switch->value;
				}
				$usageData .= ']';
				
				$x = '  --' . $switch->longName;
				if (!empty($switch->shortName)) {
					$x .= str_repeat(' ', $this->maxSwitchLength - 5 - strlen($x)) . '(-' . $switch->shortName . ')';
				}
				
				$x .= str_repeat(' ' , $this->maxSwitchLength - strlen($x));
				$x .= wordwrap($switch->description, self::LINE_LENGTH - strlen($x), "\n" . str_repeat(' ', strlen($x))) . "\n";
				$switchData .= $x;
			}
			
			if ($arg !== null) {
				$usageData .= ' ' . $arg->value;
			}
			
			$usage .= wordwrap($usageData, self::LINE_LENGTH - 2, "\n  ");
			$usage .= "\n\n" . $switchData . "\n";
			
			return $usage;
		}
		
	}
	
?>