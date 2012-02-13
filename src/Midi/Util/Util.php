<?php

	/**
	 * \Midi\Util\Util
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @since      1.0
	 */

	namespace Midi\Util;
	
	use ReflectionFunction;
	
	/**
	 * Contains static utility methods
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @since      1.0
	 */
	class Util {
		
		private static $packer = null;
		
		//@codeCoverageIgnoreStart
		/**
		 * Constructor
		 *
		 * @since 1.0
		 * @ignore
		 */
		private function __construct() {}
		//@codeCoverageIgnoreEnd
		
		/**
		 * Unpacks a binary string into an array
		 *
		 * @since 1.0 
		 *
		 * @param  binary $byteSequence
		 * @param  string $limit        An integer or "*"
		 * @return array A zero-indexed array
		 */
		public static function unpack($byteSequence, $limit = '*') {
			return array_values(unpack('C' . $limit, $byteSequence));
		}
		
		/**
		 * Packs 8-bit integers into a binary string, ignoring null values
		 *
		 * @since 1.0
		 * 
		 * @param  int $ascii,... 8-bit unsigned integer
		 * @return binary
		 */
		public static function pack($ascii) {
			if (self::$packer === null) {
				self::$packer = new ReflectionFunction('pack');
			}
			
			$args = array_filter(func_get_args(), function($value) { return $value !== null; });
			array_unshift($args, 'C*');
			return self::$packer->invokeArgs($args);
		}
		
		/**
		 * Gets the number of MIDI clock ticks for the given
		 * delta binary sequence
		 *
		 * @since 1.0
		 * @uses  unpack()
		 * @todo  Support unsigned integers (maybe?)
		 *
		 * @param  string $byteSequence Delta byte sequence in binary
		 * @return int The number of ticks
		 */
		public static function getTicksFromDeltaByteSequence($byteSequence) {
			$bytes = array_reverse(self::unpack($byteSequence));
			$ticks = 0;
			$shift = 0;
			foreach ($bytes as $byte) {
				$ticks |= ($byte & 0x7F) << $shift;
				$shift += 7;
			}
			
			return $ticks;
		}
		
		/**
		 * Gets the byte sequence for the given delta value
		 *
		 * @since 1.0
		 * @uses  pack()
		 *
		 * @param  int $ticks The delta value
		 * @return string A binary string
		 */
		public static function getDeltaByteSequence($ticks) {
			$byteSequence[] = self::pack($ticks & 0x7F);
			$ticks        >>= 7;
			
			while ($ticks > 0) {
				$byteSequence[] = self::pack(($ticks & 0x7F) | 0x80);
				$ticks >>= 7;
			}
			
			return implode('', array_reverse($byteSequence));
		}
		
		/**
		 * Converts a binary (e.g. packed) byte sequence into a hexadecimal string
		 *
		 * @since 1.0
		 * @uses  binaryToHexCallback()
		 * @uses  unpack()
		 *
		 * @param  binary $byteSequence
		 * @return array Each element is a hex string
		 */
		public static function binaryToHex($byteSequence) {
			return array_map('Midi\Util\Util::binaryToHexCallback', self::unpack($byteSequence));
		}
		
		/**
		 * array_map() callback from {@link binaryToHex()}
		 *
		 * @since 1.0
		 * @see   binaryToHex()
		 *
		 * @param  mixed $value
		 * @return string
		 */
		private static function binaryToHexCallback($value) {
			return str_pad(strtoupper(dechex($value)), 2, '0', STR_PAD_LEFT);
		}

		/**
		 * Gets a user-friendly time signature
		 *
		 * @since 1.0.1
		 *
		 * @param  int $numerator
		 * @param  int $logarithmicDenominator The base 2 logarithm of the actual denominator
		 *                                     (e.g. 1 instead of 2, 2 instead of 4, 4 instead of 16, etc.)
		 * @return string
		 */
		public static function getTimeSignature($numerator, $logarithmicDenominator) {
			return $numerator . '/' . pow(2, $logarithmicDenominator);
		}
		
	}

?>