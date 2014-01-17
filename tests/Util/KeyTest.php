<?php
	
	namespace Tmont\Midi\Tests\Util;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Util\Key;

	class KeyTest extends PHPUnit_Framework_TestCase {
		
		public function testGetKeySignatureThrowsInvalidArgumentException() {
			$this->setExpectedException('InvalidArgumentException');
			Key::getKeySignature('f00', 'bar');
		}
		
		public function testGetInstrumentName() {
			$keyMap = array(
				Key::CMajor       => 'C Major',
				Key::GMajor       => 'G Major',
				Key::DMajor       => 'D Major',
				Key::AMajor       => 'A Major',
				Key::EMajor       => 'E Major',
				Key::BMajor       => 'B Major',
				Key::FSharpMajor  => 'F# Major',
				Key::CSharpMajor  => 'C# Major',
				
				Key::FMajor       => 'F Major',
				Key::BFlatMajor   => 'Bb Major',
				Key::EFlatMajor   => 'Eb Major',
				Key::AFlatMajor   => 'Ab Major',
				Key::DFlatMajor   => 'Db Major',
				Key::GFlatMajor   => 'Gb Major',
				Key::CFlatMajor   => 'Cb Major',
				
				Key::AMinor       => 'A Minor',
				Key::EMinor       => 'E Minor',
				Key::BMinor       => 'B Minor',
				Key::FSharpMinor  => 'F# Minor',
				Key::CSharpMinor  => 'C# Minor',
				Key::GSharpMinor  => 'G# Minor',
				Key::DSharpMinor  => 'D# Minor',
				Key::ASharpMinor  => 'A# Minor',
				
				Key::DMinor       => 'D Minor',
				Key::GMinor       => 'G Minor',
				Key::CMinor       => 'C Minor',
				Key::FMinor       => 'F Minor',
				Key::BFlatMinor   => 'Bb Minor',
				Key::EFlatMinor   => 'Eb Minor',
				Key::AFlatMinor   => 'Ab Minor'
			);
			
			foreach ($keyMap as $key => $name) {
				list($accidentals, $mode) = explode('|', $key);
				$this->assertEquals(Key::getKeySignature($accidentals, $mode), $name);
			}
		}

	}

?>