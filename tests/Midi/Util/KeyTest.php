<?php
	
	namespace Midi\Tests\Util;

	class KeyTest extends \PHPUnit_Framework_TestCase {
		
		public function testGetKeySignatureThrowsInvalidArgumentException() {
			$this->setExpectedException('InvalidArgumentException');
			\Midi\Util\Key::getKeySignature('f00', 'bar');
		}
		
		public function testGetInstrumentName() {
			$keyMap = array(
				\Midi\Util\Key::CMajor       => 'C Major',
				\Midi\Util\Key::GMajor       => 'G Major',
				\Midi\Util\Key::DMajor       => 'D Major',
				\Midi\Util\Key::AMajor       => 'A Major',
				\Midi\Util\Key::EMajor       => 'E Major',
				\Midi\Util\Key::BMajor       => 'B Major',
				\Midi\Util\Key::FSharpMajor  => 'F# Major',
				\Midi\Util\Key::CSharpMajor  => 'C# Major',
				
				\Midi\Util\Key::FMajor       => 'F Major',
				\Midi\Util\Key::BFlatMajor   => 'Bb Major',
				\Midi\Util\Key::EFlatMajor   => 'Eb Major',
				\Midi\Util\Key::AFlatMajor   => 'Ab Major',
				\Midi\Util\Key::DFlatMajor   => 'Db Major',
				\Midi\Util\Key::GFlatMajor   => 'Gb Major',
				\Midi\Util\Key::CFlatMajor   => 'Cb Major',
				
				\Midi\Util\Key::AMinor       => 'A Minor',
				\Midi\Util\Key::EMinor       => 'E Minor',
				\Midi\Util\Key::BMinor       => 'B Minor',
				\Midi\Util\Key::FSharpMinor  => 'F# Minor',
				\Midi\Util\Key::CSharpMinor  => 'C# Minor',
				\Midi\Util\Key::GSharpMinor  => 'G# Minor',
				\Midi\Util\Key::DSharpMinor  => 'D# Minor',
				\Midi\Util\Key::ASharpMinor  => 'A# Minor',
				
				\Midi\Util\Key::DMinor       => 'D Minor',
				\Midi\Util\Key::GMinor       => 'G Minor',
				\Midi\Util\Key::CMinor       => 'C Minor',
				\Midi\Util\Key::FMinor       => 'F Minor',
				\Midi\Util\Key::BFlatMinor   => 'Bb Minor',
				\Midi\Util\Key::EFlatMinor   => 'Eb Minor',
				\Midi\Util\Key::AFlatMinor   => 'Ab Minor'
			);
			
			foreach ($keyMap as $key => $name) {
				list($accidentals, $mode) = explode('|', $key);
				$this->assertEquals(\Midi\Util\Key::getKeySignature($accidentals, $mode), $name);
			}
		}

	}

?>