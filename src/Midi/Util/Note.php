<?php
	
	/**
	 * \Midi\Util\Note
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @copyright  © 2009 Tommy Montgomery <http://phpmidiparser.php/>
	 * @since      1.0
	 */

	namespace Midi\Util;
	
	/**
	 * Represents each MIDI note
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @since      1.0
	 */
	final class Note {
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CX       = 0;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharpX  = 1;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DX       = 2;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharpX  = 3;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const EX       = 4;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FX       = 5;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharpX  = 6;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GX       = 7;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharpX  = 8;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const AX       = 9;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharpX  = 10;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const BX       = 11;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C0       = 12;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp0  = 13;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D0       = 14;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp0  = 15;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E0       = 16;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F0       = 17;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp0  = 18;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G0       = 19;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp0  = 20;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A0       = 21;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp0  = 22;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B0       = 23;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C1       = 24;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp1  = 25;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D1       = 26;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp1  = 27;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E1       = 28;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F1       = 29;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp1  = 30;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G1       = 31;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp1  = 32;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A1       = 33;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp1  = 34;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B1       = 35;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C2       = 36;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp2  = 37;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D2       = 38;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp2  = 39;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E2       = 40;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F2       = 41;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp2  = 42;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G2       = 43;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp2  = 44;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A2       = 45;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp2  = 46;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B2       = 47;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C3       = 48;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp3  = 49;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D3       = 50;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp3  = 51;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E3       = 52;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F3       = 53;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp3  = 54;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G3       = 55;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp3  = 56;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A3       = 57;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp3  = 58;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B3       = 59;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C4       = 60;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp4  = 61;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D4       = 62;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp4  = 63;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E4       = 64;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F4       = 65;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp4  = 66;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G4       = 67;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp4  = 68;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A4       = 69;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp4  = 70;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B4       = 71;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C5       = 72;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp5  = 73;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D5       = 74;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp5  = 75;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E5       = 76;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F5       = 77;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp5  = 78;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G5       = 79;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp5  = 80;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A5       = 81;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp5  = 82;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B5       = 83;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C6       = 84;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp6  = 85;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D6       = 86;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp6  = 87;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E6       = 88;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F6       = 89;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp6  = 90;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G6       = 91;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp6  = 92;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A6       = 93;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp6  = 94;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B6       = 95;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C7       = 96;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp7  = 97;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D7       = 98;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp7  = 99;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E7       = 100;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F7       = 101;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp7  = 102;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G7       = 103;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp7  = 104;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A7       = 105;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp7  = 106;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B7       = 107;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C8       = 108;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp8  = 109;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D8       = 110;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp8  = 111;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E8       = 112;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F8       = 113;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp8  = 114;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G8       = 115;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const GSharp8  = 116;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const A8       = 117;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ASharp8  = 118;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const B8       = 119;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const C9       = 120;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CSharp9  = 121;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const D9       = 122;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const DSharp9  = 123;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const E9       = 124;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const F9       = 125;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const FSharp9  = 126;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const G9       = 127;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const AcousticBassDrum = 35;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const BassDrum1 = 36;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const SideStick = 37;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const AcousticSnare = 38;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const HandClap = 39;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ElectricSnare = 40;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LowFloorTom = 41;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ClosedHiHat = 42;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const HighFloorTom = 43;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const PedalHiHat = 44;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LowTom = 45;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const OpenHiHat = 46;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LowMidTom = 47;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const HiMidTom = 48;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CrashCymbal1 = 49;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const HighTom = 50;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const RideCymbal1 = 51;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ChineseCymbal = 52;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const RideBell = 53;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const Tambourine = 54;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const SplashCymbal = 55;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const Cowbell = 56;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const CrashCymbal2 = 57;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const Vibraslap = 58;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const RideCymbal2 = 59;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const HiBongo = 60;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LowBongo = 61;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const MuteHiConga = 62;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const OpenHiConga = 63;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LowConga = 64;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const HighTimbale = 65;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LowTimbale = 66;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const HighAgogo = 67;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LowAgogo = 68;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const Cabasa = 69;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const Maracas = 70;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ShortWhistle = 71;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LongWhistle = 72;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const ShortGuiro = 73;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LongGuiro = 74;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const Claves = 75;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const HiWoodBlock = 76;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const LowWoodBlock = 77;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const MuteCuica = 78;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const OpenCuica = 79;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const MuteTriangle = 80;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const OpenTriangle = 81;
		/**
		 * Describe this variable
		 *
		 * @var int
		 */
		const Shaker = 82;

		/**
		 * Maps note constants to their name
		 *
		 * @var array
		 */
		private static $noteMap = array(
			0 => 'CX',
			1 => 'C#X',
			2 => 'DX',
			3 => 'D#X',
			4 => 'EX',
			5 => 'FX',
			6 => 'F#X',
			7 => 'GX',
			8 => 'G#X',
			9 => 'AX',
			10 => 'A#X',
			11 => 'BX',
			12 => 'C0',
			13 => 'C#0',
			14 => 'D0',
			15 => 'D#0',
			16 => 'E0',
			17 => 'F0',
			18 => 'F#0',
			19 => 'G0',
			20 => 'G#0',
			21 => 'A0',
			22 => 'A#0',
			23 => 'B0',
			24 => 'C1',
			25 => 'C#1',
			26 => 'D1',
			27 => 'D#1',
			28 => 'E1',
			29 => 'F1',
			30 => 'F#1',
			31 => 'G1',
			32 => 'G#1',
			33 => 'A1',
			34 => 'A#1',
			35 => 'B1',
			36 => 'C2',
			37 => 'C#2',
			38 => 'D2',
			39 => 'D#2',
			40 => 'E2',
			41 => 'F2',
			42 => 'F#2',
			43 => 'G2',
			44 => 'G#2',
			45 => 'A2',
			46 => 'A#2',
			47 => 'B2',
			48 => 'C3',
			49 => 'C#3',
			50 => 'D3',
			51 => 'D#3',
			52 => 'E3',
			53 => 'F3',
			54 => 'F#3',
			55 => 'G3',
			56 => 'G#3',
			57 => 'A3',
			58 => 'A#3',
			59 => 'B3',
			60 => 'C4',
			61 => 'C#4',
			62 => 'D4',
			63 => 'D#4',
			64 => 'E4',
			65 => 'F4',
			66 => 'F#4',
			67 => 'G4',
			68 => 'G#4',
			69 => 'A4',
			70 => 'A#4',
			71 => 'B4',
			72 => 'C5',
			73 => 'C#5',
			74 => 'D5',
			75 => 'D#5',
			76 => 'E5',
			77 => 'F5',
			78 => 'F#5',
			79 => 'G5',
			80 => 'G#5',
			81 => 'A5',
			82 => 'A#5',
			83 => 'B5',
			84 => 'C6',
			85 => 'C#6',
			86 => 'D6',
			87 => 'D#6',
			88 => 'E6',
			89 => 'F6',
			90 => 'F#6',
			91 => 'G6',
			92 => 'G#6',
			93 => 'A6',
			94 => 'A#6',
			95 => 'B6',
			96 => 'C7',
			97 => 'C#7',
			98 => 'D7',
			99 => 'D#7',
			100 => 'E7',
			101 => 'F7',
			102 => 'F#7',
			103 => 'G7',
			104 => 'G#7',
			105 => 'A7',
			106 => 'A#7',
			107 => 'B7',
			108 => 'C8',
			109 => 'C#8',
			110 => 'D8',
			111 => 'D#8',
			112 => 'E8',
			113 => 'F8',
			114 => 'F#8',
			115 => 'G8',
			116 => 'G#8',
			117 => 'A8',
			118 => 'A#8',
			119 => 'B8',
			120 => 'C9',
			121 => 'C#9',
			122 => 'D9',
			123 => 'D#9',
			124 => 'E9',
			125 => 'F9',
			126 => 'F#9',
			127 => 'G9'
		);

		/**
		 * Maps drum constants to their name
		 *
		 * @var array
		 */
		public static $drumNoteMap = array(
			35 => 'AcousticBassDrum',
			36 => 'BassDrum1',
			37 => 'SideStick',
			38 => 'AcousticSnare',
			39 => 'HandClap',
			40 => 'ElectricSnare',
			41 => 'LowFloorTom',
			42 => 'ClosedHiHat',
			43 => 'HighFloorTom',
			44 => 'PedalHiHat',
			45 => 'LowTom',
			46 => 'OpenHiHat',
			47 => 'LowMidTom',
			48 => 'HiMidTom',
			49 => 'CrashCymbal1',
			50 => 'HighTom',
			51 => 'RideCymbal1',
			52 => 'ChineseCymbal',
			53 => 'RideBell',
			54 => 'Tambourine',
			55 => 'SplashCymbal',
			56 => 'Cowbell',
			57 => 'CrashCymbal2',
			58 => 'Vibraslap',
			59 => 'RideCymbal2',
			60 => 'HiBongo',
			61 => 'LowBongo',
			62 => 'MuteHiConga',
			63 => 'OpenHiConga',
			64 => 'LowConga',
			65 => 'HighTimbale',
			66 => 'LowTimbale',
			67 => 'HighAgogo',
			68 => 'LowAgogo',
			69 => 'Cabasa',
			70 => 'Maracas',
			71 => 'ShortWhistle',
			72 => 'LongWhistle',
			73 => 'ShortGuiro',
			74 => 'LongGuiro',
			75 => 'Claves',
			76 => 'HiWoodBlock',
			77 => 'LowWoodBlock',
			78 => 'MuteCuica',
			79 => 'OpenCuica',
			80 => 'MuteTriangle',
			81 => 'OpenTriangle',
			82 => 'Shaker'
		);
		
		/**
		 * Gets the friendly name of the drum note
		 *
		 * @since 1.0
		 *
		 * @param int $note One of the {@link Note} constants
		 * @throws InvalidArgumentException
		 * @return string
		 */
		public static function getDrumNoteName($note) {
			if (!isset(self::$drumNoteMap[$note])) {
				throw new \InvalidArgumentException('Invalid note name, use one of the \Midi\Util\Note constants');
			}
			
			return self::$drumNoteMap[$note];
		}
		
		/**
		 * Gets the friendly name of the MIDI note
		 *
		 * @since 1.0
		 *
		 * @param int $note One of the {@link Note} constants
		 * @throws InvalidArgumentException
		 * @return string
		 */
		public static function getNoteName($note) {
			if (!isset(self::$noteMap[$note])) {
				throw new \InvalidArgumentException('Invalid note name, use one of the \Midi\Util\Note constants');
			}
			
			return self::$noteMap[$note];
		}

	}

?>