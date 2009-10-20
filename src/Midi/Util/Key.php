<?php

	/**
	 * \Midi\Util\Key
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @copyright  2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Util;
	
	/**
	 * Collection of constants representing the most common
	 * key signatures
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @since      1.0
	*/
	final class Key {
		/**
		 * 0 flats, 0 sharps
		 *
		 * @var string
		 */
		const CMajor      = '0|0';
		
		/**
		 * 1 sharp
		 *
		 * @var string
		 */
		const GMajor      = '1|0';
		/**
		 * 2 sharps
		 *
		 * @var string
		 */
		const DMajor      = '2|0';
		/**
		 * 3 sharps
		 *
		 * @var string
		 */
		const AMajor      = '3|0';
		/**
		 * 4 sharps
		 *
		 * @var string
		 */
		const EMajor      = '4|0';
		/**
		 * 5 sharps
		 *
		 * @var string
		 */
		const BMajor      = '5|0';
		/**
		 * 6 sharps
		 *
		 * @var string
		 */
		const FSharpMajor = '6|0';
		/**
		 * 7 sharps
		 *
		 * @var string
		 */
		const CSharpMajor = '7|0';
		
		/**
		 * 1 flat
		 *
		 * @var string
		 */
		const FMajor      = '255|0';
		/**
		 * 2 flats
		 *
		 * @var string
		 */
		const BFlatMajor  = '254|0';
		/**
		 * 3 flats
		 *
		 * @var string
		 */
		const EFlatMajor  = '253|0';
		/**
		 * 4 flats
		 *
		 * @var string
		 */
		const AFlatMajor  = '252|0';
		/**
		 * 5 flats
		 *
		 * @var string
		 */
		const DFlatMajor  = '251|0';
		/**
		 * 6 flats
		 *
		 * @var string
		 */
		const GFlatMajor  = '250|0';
		/**
		 * 7 flats
		 *
		 * @var string
		 */
		const CFlatMajor  = '249|0';
		
		/**
		 * 0 sharps, 0 flats
		 *
		 * @var string
		 */
		const AMinor      = '0|1';
		
		/**
		 * 1 sharp
		 *
		 * @var string
		 */
		const EMinor      = '1|1';
		/**
		 * 2 sharps
		 *
		 * @var string
		 */
		const BMinor      = '2|1';
		/**
		 * 3 sharps
		 *
		 * @var string
		 */
		const FSharpMinor = '3|1';
		/**
		 * 4 sharps
		 *
		 * @var string
		 */
		const CSharpMinor = '4|1';
		/**
		 * 5 sharps
		 *
		 * @var string
		 */
		const GSharpMinor = '5|1';
		/**
		 * 6 sharps
		 *
		 * @var string
		 */
		const DSharpMinor = '6|1';
		/**
		 * 7 sharps
		 *
		 * @var string
		 */
		const ASharpMinor = '7|1';
		
		/**
		 * 1 flat
		 *
		 * @var string
		 */
		const DMinor      = '249|1';
		/**
		 * 2 flats
		 *
		 * @var string
		 */
		const GMinor      = '250|1';
		/**
		 * 3 flats
		 *
		 * @var string
		 */
		const CMinor      = '251|1';
		/**
		 * 4 flats
		 *
		 * @var string
		 */
		const FMinor      = '252|1';
		/**
		 * 5 flats
		 *
		 * @var string
		 */
		const BFlatMinor  = '253|1';
		/**
		 * 6 flats
		 *
		 * @var string
		 */
		const EFlatMinor = '254|1';
		/**
		 * 7 flats
		 *
		 * @var string
		 */
		const AFlatMinor  = '255|1';
		
		private static $keyMap = array(
			self::CMajor       => 'C Major',
			self::GMajor       => 'G Major',
			self::DMajor       => 'D Major',
			self::AMajor       => 'A Major',
			self::EMajor       => 'E Major',
			self::BMajor       => 'B Major',
			self::FSharpMajor  => 'F# Major',
			self::CSharpMajor  => 'C# Major',
			
			self::FMajor       => 'F Major',
			self::BFlatMajor   => 'Bb Major',
			self::EFlatMajor   => 'Eb Major',
			self::AFlatMajor   => 'Ab Major',
			self::DFlatMajor   => 'Db Major',
			self::GFlatMajor   => 'Gb Major',
			self::CFlatMajor   => 'Cb Major',
			
			self::AMinor       => 'A Minor',
			self::EMinor       => 'E Minor',
			self::BMinor       => 'B Minor',
			self::FSharpMinor  => 'F# Minor',
			self::CSharpMinor  => 'C# Minor',
			self::GSharpMinor  => 'G# Minor',
			self::DSharpMinor  => 'D# Minor',
			self::ASharpMinor  => 'A# Minor',
			
			self::DMinor       => 'D Minor',
			self::GMinor       => 'G Minor',
			self::CMinor       => 'C Minor',
			self::FMinor       => 'F Minor',
			self::BFlatMinor   => 'Bb Minor',
			self::EFlatMinor   => 'Eb Minor',
			self::AFlatMinor   => 'Ab Minor'
		);
		
		/**
		 * Gets the friendly name of the key signature
		 *
		 * @since 1.0
		 *
		 * @param  int $accidentals 0 + # of sharps or 256 - # of flats
		 * @param  int $mode        0 for major, 1 for minor
		 * @throws InvalidArgumentException
		 * @return string
		 */
		public static function getKeySignature($accidentals, $mode) {
			if (!isset(self::$keyMap[$accidentals . '|' . $mode])) {
				throw new \InvalidArgumentException('Invalid key signature');
			}
			
			return self::$keyMap[$accidentals . '|' . $mode];
		}
	}

?>