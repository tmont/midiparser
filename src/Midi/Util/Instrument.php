<?php
	
	/**
	 * \Midi\Util\Instrument
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @since      1.0
	 */

	namespace Midi\Util;

	/**
	 * Enumeration representing each of the 128 MIDI instruments
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @since      1.0
	 */
	final class Instrument {
		/**
		 * Concert Grand (MIDI instrument 0)
		 *
		 * @var int
		 */
		const ConcertGrand              = 0;
		/**
		 * Piano (MIDI instrument 1)
		 *
		 * @var int
		 */
		const Piano                     = 1;
		/**
		 * Electric Piano (MIDI instrument 2)
		 *
		 * @var int
		 */
		const ElectricPiano             = 2;
		/**
		 * Honky Tonk (MIDI instrument 3)
		 *
		 * @var int
		 */
		const HonkyTonk                 = 3;
		/**
		 * Fender Rhodes Electric Piano (MIDI instrument 4)
		 *
		 * @var int
		 */
		const FenderRhodesElectricPiano = 4;
		/**
		 * Piano with Chorus (MIDI instrument 5)
		 *
		 * @var int
		 */
		const PianoWithChorus           = 5;
		/**
		 * Harpsichord (MIDI instrument 6)
		 *
		 * @var int
		 */
		const Harpsichord               = 6;
		/**
		 * Hohner Clavinet D6 (MIDI instrument 7)
		 *
		 * @var int
		 */
		const HohnerClavinetD6          = 7;
		/**
		 * Celesta (MIDI instrument 8)
		 *
		 * @var int
		 */
		const Celesta                   = 8;
		/**
		 * Glockenspiel (MIDI instrument 9)
		 *
		 * @var int
		 */
		const Glockenspiel              = 9;
		/**
		 * Music Box (MIDI instrument 10)
		 *
		 * @var int
		 */
		const MusicBox                  = 10;
		/**
		 * Vibraphone (MIDI instrument 11)
		 *
		 * @var int
		 */
		const Vibraphone                = 11;
		/**
		 * Marimba (MIDI instrument 12)
		 *
		 * @var int
		 */
		const Marimba                   = 12;
		/**
		 * Xylophone (MIDI instrument 13)
		 *
		 * @var int
		 */
		const Xylophone                 = 13;
		/**
		 * Tubular Bells (MIDI instrument 14)
		 *
		 * @var int
		 */
		const TubularBells              = 14;
		/**
		 * Dulcimer (MIDI instrument 15)
		 *
		 * @var int
		 */
		const Dulcimer                  = 15;
		/**
		 * Hammond Organ (MIDI instrument 16)
		 *
		 * @var int
		 */
		const HammondOrgan              = 16;
		/**
		 * Percussive Organ (MIDI instrument 17)
		 *
		 * @var int
		 */
		const PercussiveOrgan           = 17;
		/**
		 * Rock Organ (MIDI instrument 18)
		 *
		 * @var int
		 */
		const RockOrgan                 = 18;
		/**
		 * Church Organ (MIDI instrument 19)
		 *
		 * @var int
		 */
		const ChurchOrgan               = 19;
		/**
		 * Reed Organ (MIDI instrument 20)
		 *
		 * @var int
		 */
		const ReedOrgan                 = 20;
		/**
		 * Accordion (MIDI instrument 21)
		 *
		 * @var int
		 */
		const Accordion                 = 21;
		/**
		 * Harmonica (MIDI instrument 22)
		 *
		 * @var int
		 */
		const Harmonica                 = 22;
		/**
		 * Tango Accordion (MIDI instrument 23)
		 *
		 * @var int
		 */
		const TangoAccordion            = 23;
		/**
		 * Acoustic Guitar (nylon) (MIDI instrument 24)
		 *
		 * @var int
		 */
		const AcousticGuitarNylon       = 24;
		/**
		 * Acoustic Guitar (steel) (MIDI instrument 25)
		 *
		 * @var int
		 */
		const AcousticGuitarSteel       = 25;
		/**
		 * Electric Guitar (jazz) (MIDI instrument 26)
		 *
		 * @var int
		 */
		const ElectricGuitarJazz        = 26;
		/**
		 * Electric Guitar (clean) (MIDI instrument 27)
		 *
		 * @var int
		 */
		const ElectricGuitarClean       = 27;
		/**
		 * Electric Guitar (muted) (MIDI instrument 28)
		 *
		 * @var int
		 */
		const ElectricGuitarMuted       = 28;
		/**
		 * Electric Guitar (overdriven) (MIDI instrument 29)
		 *
		 * @var int
		 */
		const ElectricGuitarOverdriven  = 29;
		/**
		 * Electric Guitar (distorted) (MIDI instrument 30)
		 *
		 * @var int
		 */
		const ElectricGuitarDistorted   = 30;
		/**
		 * Guitar Harmonics (MIDI instrument 31)
		 *
		 * @var int
		 */
		const GuitarHarmonics           = 31;
		/**
		 * Double Bass (finger) (MIDI instrument 32)
		 *
		 * @var int
		 */
		const DoubleBassFinger          = 32;
		/**
		 * Electric Bass (finger) (MIDI instrument 33)
		 *
		 * @var int
		 */
		const ElectricBassFinger        = 33;
		/**
		 * Electric Bass (plectrum) (MIDI instrument 34)
		 *
		 * @var int
		 */
		const ElectricBassPlectrum      = 34;
		/**
		 * Fretless Bass (MIDI instrument 35)
		 *
		 * @var int
		 */
		const FretlessBass              = 35;
		/**
		 * Slap Bass 1 (MIDI instrument 36)
		 *
		 * @var int
		 */
		const SlapBass1                 = 36;
		/**
		 * Slap Bass 2 (MIDI instrument 37)
		 *
		 * @var int
		 */
		const SlapBass2                 = 37;
		/**
		 * Synthesizer Bass 1 (MIDI instrument 38)
		 *
		 * @var int
		 */
		const SynthesizerBass1          = 38;
		/**
		 * Synthesizer Bass 2 (MIDI instrument 39)
		 *
		 * @var int
		 */
		const SynthesizerBass2          = 39;
		/**
		 * Violin (MIDI instrument 40)
		 *
		 * @var int
		 */
		const Violin                    = 40;
		/**
		 * Viola (MIDI instrument 41)
		 *
		 * @var int
		 */
		const Viola                     = 41;
		/**
		 * Cello (MIDI instrument 42)
		 *
		 * @var int
		 */
		const Cello                     = 42;
		/**
		 * Double Bass (bowed) (MIDI instrument 43)
		 *
		 * @var int
		 */
		const DoubleBassBowed           = 43;
		/**
		 * Violin (tremolo) (MIDI instrument 44)
		 *
		 * @var int
		 */
		const ViolinTremolo             = 44;
		/**
		 * Violin (pizzicato) (MIDI instrument 45)
		 *
		 * @var int
		 */
		const ViolinPizzicato           = 45;
		/**
		 * Orchestra Harp (MIDI instrument 46)
		 *
		 * @var int
		 */
		const OrchestraHarp             = 46;
		/**
		 * Drum (MIDI instrument 47)
		 *
		 * @var int
		 */
		const Drum                      = 47;
		/**
		 * String Ensemble 1 (MIDI instrument 48)
		 *
		 * @var int
		 */
		const StringEnsemble1           = 48;
		/**
		 * String Ensemble 2 (MIDI instrument 49)
		 *
		 * @var int
		 */
		const StringEnsemble2           = 49;
		/**
		 * Synthesizer Strings 1 (MIDI instrument 50)
		 *
		 * @var int
		 */
		const SynthesizerStrings1       = 50;
		/**
		 * Synthesizer Strings 2 (MIDI instrument 51)
		 *
		 * @var int
		 */
		const SynthesizerStrings2       = 51;
		/**
		 * Choir Aahs (MIDI instrument 52)
		 *
		 * @var int
		 */
		const ChoirAahs                 = 52;
		/**
		 * Choir Oohs (MIDI instrument 53)
		 *
		 * @var int
		 */
		const ChoirOohs                 = 53;
		/**
		 * Synthesizer Voice (MIDI instrument 54)
		 *
		 * @var int
		 */
		const SynthesizerVoice          = 54;
		/**
		 * Orchestra Complete (MIDI instrument 55)
		 *
		 * @var int
		 */
		const OrchestraComplete         = 55;
		/**
		 * Trumpet (MIDI instrument 56)
		 *
		 * @var int
		 */
		const Trumpet                   = 56;
		/**
		 * Trombone (MIDI instrument 57)
		 *
		 * @var int
		 */
		const Trombone                  = 57;
		/**
		 * Tuba (MIDI instrument 58)
		 *
		 * @var int
		 */
		const Tuba                      = 58;
		/**
		 * Muted Trumpet (MIDI instrument 59)
		 *
		 * @var int
		 */
		const MutedTrumpet              = 59;
		/**
		 * Horn (MIDI instrument 60)
		 *
		 * @var int
		 */
		const Horn                      = 60;
		/**
		 * Brass Section (MIDI instrument 61)
		 *
		 * @var int
		 */
		const BrassSection              = 61;
		/**
		 * Synthesizer Brass 1 (MIDI instrument 62)
		 *
		 * @var int
		 */
		const SynthesizerBrass1         = 62;
		/**
		 * Synthesizer Brass 2 (MIDI instrument 63)
		 *
		 * @var int
		 */
		const SynthesizerBrass2         = 63;
		/**
		 * Soprano Saxophone (MIDI instrument 64)
		 *
		 * @var int
		 */
		const SopranoSaxophone          = 64;
		/**
		 * Alto Saxophone (MIDI instrument 65)
		 *
		 * @var int
		 */
		const AltoSaxophone             = 65;
		/**
		 * Tenor Saxophone (MIDI instrument 66)
		 *
		 * @var int
		 */
		const TenorSaxophone            = 66;
		/**
		 * Baritone Saxophone (MIDI instrument 67)
		 *
		 * @var int
		 */
		const BaritoneSaxophone         = 67;
		/**
		 * Oboe (MIDI instrument 68)
		 *
		 * @var int
		 */
		const Oboe                      = 68;
		/**
		 * English Horn (MIDI instrument 69)
		 *
		 * @var int
		 */
		const EnglishHorn               = 69;
		/**
		 * Bassoon (MIDI instrument 70)
		 *
		 * @var int
		 */
		const Bassoon                   = 70;
		/**
		 * Clarinet (MIDI instrument 71)
		 *
		 * @var int
		 */
		const Clarinet                  = 71;
		/**
		 * Piccolo Flute (MIDI instrument 72)
		 *
		 * @var int
		 */
		const PiccoloFlute              = 72;
		/**
		 * Flute (MIDI instrument 73)
		 *
		 * @var int
		 */
		const Flute                     = 73;
		/**
		 * Recorder (MIDI instrument 74)
		 *
		 * @var int
		 */
		const Recorder                  = 74;
		/**
		 * Pan Pipes (MIDI instrument 75)
		 *
		 * @var int
		 */
		const PanPipes                  = 75;
		/**
		 * Bottle Blow (MIDI instrument 76)
		 *
		 * @var int
		 */
		const BottleBlow                = 76;
		/**
		 * Shakuhachi (MIDI instrument 77)
		 *
		 * @var int
		 */
		const Shakuhachi                = 77;
		/**
		 * Whistle (MIDI instrument 78)
		 *
		 * @var int
		 */
		const Whistle                   = 78;
		/**
		 * Ocarina (MIDI instrument 79)
		 *
		 * @var int
		 */
		const Ocarina                   = 79;
		/**
		 * Square (synth) (MIDI instrument 80)
		 *
		 * @var int
		 */
		const SquareSynth               = 80;
		/**
		 * Saw Tooth (synth) (MIDI instrument 81)
		 *
		 * @var int
		 */
		const SawToothSynth             = 81;
		/**
		 * Caliope (synth) (MIDI instrument 82)
		 *
		 * @var int
		 */
		const CaliopeSynth              = 82;
		/**
		 * Chiff (synth) (MIDI instrument 83)
		 *
		 * @var int
		 */
		const ChiffSynth                = 83;
		/**
		 * Charang (synth) (MIDI instrument 84)
		 *
		 * @var int
		 */
		const CharangSynth              = 84;
		/**
		 * Voice (synth) (MIDI instrument 85)
		 *
		 * @var int
		 */
		const VoiceSynth                = 85;
		/**
		 * Fifth (synth) (MIDI instrument 86)
		 *
		 * @var int
		 */
		const FifthSynth                = 86;
		/**
		 * Brass+Lead (synth) (MIDI instrument 87)
		 *
		 * @var int
		 */
		const BrassLeadSynth            = 87;
		/**
		 * New Age (synth pad) (MIDI instrument 88)
		 *
		 * @var int
		 */
		const NewAgeSynthPad            = 88;
		/**
		 * Warm (synth pad) (MIDI instrument 89)
		 *
		 * @var int
		 */
		const WarmSynthPad              = 89;
		/**
		 * Polysynth (synth pad) (MIDI instrument 90)
		 *
		 * @var int
		 */
		const PolysynthSynthPad         = 90;
		/**
		 * Choir (synth pad) (MIDI instrument 91)
		 *
		 * @var int
		 */
		const ChoirSynthPad             = 91;
		/**
		 * Bowed (synth pad) (MIDI instrument 92)
		 *
		 * @var int
		 */
		const BowedSynthPad             = 92;
		/**
		 * Metallic (synth pad) (MIDI instrument 93)
		 *
		 * @var int
		 */
		const MetallicSynthPad          = 93;
		/**
		 * Halo (synth pad) (MIDI instrument 94)
		 *
		 * @var int
		 */
		const HaloSynthPad              = 94;
		/**
		 * Sweep (synth pad) (MIDI instrument 95)
		 *
		 * @var int
		 */
		const SweepSynthPad             = 95;
		/**
		 * Rain (synth effect) (MIDI instrument 96)
		 *
		 * @var int
		 */
		const RainSynthEffect           = 96;
		/**
		 * Soundtrack (synth effect) (MIDI instrument 97)
		 *
		 * @var int
		 */
		const SoundtrackSynthEffect     = 97;
		/**
		 * Crystal (synth effect) (MIDI instrument 98)
		 *
		 * @var int
		 */
		const CrystalSynthEffect        = 98;
		/**
		 * Atmosphere (synth effect) (MIDI instrument 99)
		 *
		 * @var int
		 */
		const AtmosphereSynthEffect     = 99;
		/**
		 * Brightness (synth effect) (MIDI instrument 100)
		 *
		 * @var int
		 */
		const BrightnessSynthEffect     = 100;
		/**
		 * Goblins (synth effect) (MIDI instrument 101)
		 *
		 * @var int
		 */
		const GoblinsSynthEffect        = 101;
		/**
		 * Echoes (synth effect) (MIDI instrument 102)
		 *
		 * @var int
		 */
		const EchoesSynthEffect         = 102;
		/**
		 * Sci Fi (synth effect) (MIDI instrument 103)
		 *
		 * @var int
		 */
		const SciFiSynthEffect          = 103;
		/**
		 * Sitar (MIDI instrument 104)
		 *
		 * @var int
		 */
		const Sitar                     = 104;
		/**
		 * Banjo (MIDI instrument 105)
		 *
		 * @var int
		 */
		const Banjo                     = 105;
		/**
		 * Shamisen (MIDI instrument 106)
		 *
		 * @var int
		 */
		const Shamisen                  = 106;
		/**
		 * Koto (MIDI instrument 107)
		 *
		 * @var int
		 */
		const Koto                      = 107;
		/**
		 * Kalimba (MIDI instrument 108)
		 *
		 * @var int
		 */
		const Kalimba                   = 108;
		/**
		 * Bagpipe (MIDI instrument 109)
		 *
		 * @var int
		 */
		const Bagpipe                   = 109;
		/**
		 * Fiddle (MIDI instrument 110)
		 *
		 * @var int
		 */
		const Fiddle                    = 110;
		/**
		 * Shanai (MIDI instrument 111)
		 *
		 * @var int
		 */
		const Shanai                    = 111;
		/**
		 * Tinkle Bell (MIDI instrument 112)
		 *
		 * @var int
		 */
		const TinkleBell                = 112;
		/**
		 * Agogo (MIDI instrument 113)
		 *
		 * @var int
		 */
		const Agogo                     = 113;
		/**
		 * Steel Drum (MIDI instrument 114)
		 *
		 * @var int
		 */
		const SteelDrum                 = 114;
		/**
		 * Woodblock (MIDI instrument 115)
		 *
		 * @var int
		 */
		const Woodblock                 = 115;
		/**
		 * Taiko-drum (MIDI instrument 116)
		 *
		 * @var int
		 */
		const Taikodrum                 = 116;
		/**
		 * Melodic Tom (MIDI instrument 117)
		 *
		 * @var int
		 */
		const MelodicTom                = 117;
		/**
		 * Synthesized Drum (MIDI instrument 118)
		 *
		 * @var int
		 */
		const SynthesizedDrum           = 118;
		/**
		 * Cymbal Hi-Hat (MIDI instrument 119)
		 *
		 * @var int
		 */
		const CymbalHiHat               = 119;
		/**
		 * Guitar Fret Noise (MIDI instrument 120)
		 *
		 * @var int
		 */
		const GuitarFretNoise           = 120;
		/**
		 * Breath Noise (MIDI instrument 121)
		 *
		 * @var int
		 */
		const BreathNoise               = 121;
		/**
		 * Seashore (MIDI instrument 122)
		 *
		 * @var int
		 */
		const Seashore                  = 122;
		/**
		 * Bird Song (MIDI instrument 123)
		 *
		 * @var int
		 */
		const BirdSong                  = 123;
		/**
		 * Telephone Ring (MIDI instrument 124)
		 *
		 * @var int
		 */
		const TelephoneRing             = 124;
		/**
		 * Helicopter (MIDI instrument 125)
		 *
		 * @var int
		 */
		const Helicopter                = 125;
		/**
		 * Applause (MIDI instrument 126)
		 *
		 * @var int
		 */
		const Applause                  = 126;
		/**
		 * Gunshot (MIDI instrument 127)
		 *
		 * @var int
		 */
		const Gunshot                   = 127;

		private static $instrumentMap = array(
			self::ConcertGrand              => 'Concert Grand',
			self::Piano                     => 'Piano',
			self::ElectricPiano             => 'Electric Piano',
			self::HonkyTonk                 => 'Honky Tonk',
			self::FenderRhodesElectricPiano => 'Fender Rhodes Electric Piano',
			self::PianoWithChorus           => 'Piano with Chorus',
			self::Harpsichord               => 'Harpsichord',
			self::HohnerClavinetD6          => 'Hohner Clavinet D6',
			self::Celesta                   => 'Celesta',
			self::Glockenspiel              => 'Glockenspiel',
			self::MusicBox                  => 'Music Box',
			self::Vibraphone                => 'Vibraphone',
			self::Marimba                   => 'Marimba',
			self::Xylophone                 => 'Xylophone',
			self::TubularBells              => 'Tubular Bells',
			self::Dulcimer                  => 'Dulcimer',
			self::HammondOrgan              => 'Hammond Organ',
			self::PercussiveOrgan           => 'Percussive Organ',
			self::RockOrgan                 => 'Rock Organ',
			self::ChurchOrgan               => 'Church Organ',
			self::ReedOrgan                 => 'Reed Organ',
			self::Accordion                 => 'Accordion',
			self::Harmonica                 => 'Harmonica',
			self::TangoAccordion            => 'Tango Accordion',
			self::AcousticGuitarNylon       => 'Acoustic Guitar (nylon)',
			self::AcousticGuitarSteel       => 'Acoustic Guitar (steel)',
			self::ElectricGuitarJazz        => 'Electric Guitar (jazz)',
			self::ElectricGuitarClean       => 'Electric Guitar (clean)',
			self::ElectricGuitarMuted       => 'Electric Guitar (muted)',
			self::ElectricGuitarOverdriven  => 'Electric Guitar (overdriven)',
			self::ElectricGuitarDistorted   => 'Electric Guitar (distorted)',
			self::GuitarHarmonics           => 'Guitar Harmonics',
			self::DoubleBassFinger          => 'Double Bass (finger)',
			self::ElectricBassFinger        => 'Electric Bass (finger)',
			self::ElectricBassPlectrum      => 'Electric Bass (plectrum)',
			self::FretlessBass              => 'Fretless Bass',
			self::SlapBass1                 => 'Slap Bass 1',
			self::SlapBass2                 => 'Slap Bass 2',
			self::SynthesizerBass1          => 'Synthesizer Bass 1',
			self::SynthesizerBass2          => 'Synthesizer Bass 2',
			self::Violin                    => 'Violin',
			self::Viola                     => 'Viola',
			self::Cello                     => 'Cello',
			self::DoubleBassBowed           => 'Double Bass (bowed)',
			self::ViolinTremolo             => 'Violin (tremolo)',
			self::ViolinPizzicato           => 'Violin (pizzicato)',
			self::OrchestraHarp             => 'Orchestra Harp',
			self::Drum                      => 'Drum',
			self::StringEnsemble1           => 'String Ensemble 1',
			self::StringEnsemble2           => 'String Ensemble 2',
			self::SynthesizerStrings1       => 'Synthesizer Strings 1',
			self::SynthesizerStrings2       => 'Synthesizer Strings 2',
			self::ChoirAahs                 => 'Choir Aahs',
			self::ChoirOohs                 => 'Choir Oohs',
			self::SynthesizerVoice          => 'Synthesizer Voice',
			self::OrchestraComplete         => 'Orchestra Complete',
			self::Trumpet                   => 'Trumpet',
			self::Trombone                  => 'Trombone',
			self::Tuba                      => 'Tuba',
			self::MutedTrumpet              => 'Muted Trumpet',
			self::Horn                      => 'Horn',
			self::BrassSection              => 'Brass Section',
			self::SynthesizerBrass1         => 'Synthesizer Brass 1',
			self::SynthesizerBrass2         => 'Synthesizer Brass 2',
			self::SopranoSaxophone          => 'Soprano Saxophone',
			self::AltoSaxophone             => 'Alto Saxophone',
			self::TenorSaxophone            => 'Tenor Saxophone',
			self::BaritoneSaxophone         => 'Baritone Saxophone',
			self::Oboe                      => 'Oboe',
			self::EnglishHorn               => 'English Horn',
			self::Bassoon                   => 'Bassoon',
			self::Clarinet                  => 'Clarinet',
			self::PiccoloFlute              => 'Piccolo Flute',
			self::Flute                     => 'Flute',
			self::Recorder                  => 'Recorder',
			self::PanPipes                  => 'Pan Pipes',
			self::BottleBlow                => 'Bottle Blow',
			self::Shakuhachi                => 'Shakuhachi',
			self::Whistle                   => 'Whistle',
			self::Ocarina                   => 'Ocarina',
			self::SquareSynth               => 'Square (synth)',
			self::SawToothSynth             => 'Saw Tooth (synth)',
			self::CaliopeSynth              => 'Caliope (synth)',
			self::ChiffSynth                => 'Chiff (synth)',
			self::CharangSynth              => 'Charang (synth)',
			self::VoiceSynth                => 'Voice (synth)',
			self::FifthSynth                => 'Fifth (synth)',
			self::BrassLeadSynth            => 'Brass+Lead (synth)',
			self::NewAgeSynthPad            => 'New Age (synth pad)',
			self::WarmSynthPad              => 'Warm (synth pad)',
			self::PolysynthSynthPad         => 'Polysynth (synth pad)',
			self::ChoirSynthPad             => 'Choir (synth pad)',
			self::BowedSynthPad             => 'Bowed (synth pad)',
			self::MetallicSynthPad          => 'Metallic (synth pad)',
			self::HaloSynthPad              => 'Halo (synth pad)',
			self::SweepSynthPad             => 'Sweep (synth pad)',
			self::RainSynthEffect           => 'Rain (synth effect)',
			self::SoundtrackSynthEffect     => 'Soundtrack (synth effect)',
			self::CrystalSynthEffect        => 'Crystal (synth effect)',
			self::AtmosphereSynthEffect     => 'Atmosphere (synth effect)',
			self::BrightnessSynthEffect     => 'Brightness (synth effect)',
			self::GoblinsSynthEffect        => 'Goblins (synth effect)',
			self::EchoesSynthEffect         => 'Echoes (synth effect)',
			self::SciFiSynthEffect          => 'Sci Fi (synth effect)',
			self::Sitar                     => 'Sitar',
			self::Banjo                     => 'Banjo',
			self::Shamisen                  => 'Shamisen',
			self::Koto                      => 'Koto',
			self::Kalimba                   => 'Kalimba',
			self::Bagpipe                   => 'Bagpipe',
			self::Fiddle                    => 'Fiddle',
			self::Shanai                    => 'Shanai',
			self::TinkleBell                => 'Tinkle Bell',
			self::Agogo                     => 'Agogo',
			self::SteelDrum                 => 'Steel Drum',
			self::Woodblock                 => 'Woodblock',
			self::Taikodrum                 => 'Taiko-drum',
			self::MelodicTom                => 'Melodic Tom',
			self::SynthesizedDrum           => 'Synthesized Drum',
			self::CymbalHiHat               => 'Cymbal Hi-Hat',
			self::GuitarFretNoise           => 'Guitar Fret Noise',
			self::BreathNoise               => 'Breath Noise',
			self::Seashore                  => 'Seashore',
			self::BirdSong                  => 'Bird Song',
			self::TelephoneRing             => 'Telephone Ring',
			self::Helicopter                => 'Helicopter',
			self::Applause                  => 'Applause',
			self::Gunshot                   => 'Gunshot'
		);
		
		/**
		 * Gets the name of the specified MIDI instrument
		 *
		 * @since 1.0
		 *
		 * @param  int $instrument One of the \Midi\Instrument constants
		 * @throws InvalidArgumentException
		 * @return string The friendly name of the MIDI instrument
		 */
		public static function getInstrumentName($instrument) {
			if (!isset(self::$instrumentMap[$instrument])) {
				throw new \InvalidArgumentException('Invalid instrument; use one of the \Midi\Instrument constants');
			}
			
			return self::$instrumentMap[$instrument];
		}
	}

?>