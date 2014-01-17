<?php

	/**
	 * \Tmont\Midi\Util\Controller
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @copyright  � 2009 Tommy Montgomery <http://phpmidiparser.com/>
	 * @since      1.0
	 */

	namespace Tmont\Midi\Util;
	
	/**
	 * Enumeration representing the different MIDI controllers
	 *
	 * @package    Midi
	 * @subpackage Util
	 * @since      1.0
	 */
	final class Controller {
		/**
		 * Bank Select
		 *
		 * @var int
		 */
		const BANK_SELECT                         = 0x0;
		/**
		 * Modulation
		 *
		 * @var int
		 */
		const MODULATION                          = 0x1;
		/**
		 * Breath Controller
		 *
		 * @var int
		 */
		const BREATH_CONTROLLER                   = 0x2;
		/**
		 * Foot Controller
		 *
		 * @var int
		 */
		const FOOT_CONTROLLER                     = 0x4;
		/**
		 * Portamento Time
		 *
		 * @var int
		 */
		const PORTAMENTO_TIME                     = 0x5;
		/**
		 * Data Entry (most significant bits)
		 *
		 * @var int
		 */
		const DATA_ENTRY                          = 0x6;
		/**
		 * Main Volume
		 *
		 * @var int
		 */
		const MAIN_VOLUME                         = 0x7;
		/**
		 * Balance
		 *
		 * @var int
		 */
		const BALANCE                             = 0x8;
		/**
		 * Pan
		 *
		 * @var int
		 */
		const PAN                                 = 0xA;
		/**
		 * Expression Controller
		 *
		 * @var int
		 */
		const EXPRESSION_CONTROLLER               = 0xB;
		/**
		 * Effect Controller #1
		 *
		 * @var int
		 */
		const EFFECT_CONTROLLER1                  = 0xC;
		/**
		 * Effect Controller #2
		 *
		 * @var int
		 */
		const EFFECT_CONTROLLER2                  = 0xD;
		/**
		 * General Purpose Controller #1
		 *
		 * @var int
		 */
		const GENERAL_PURPOSE_CONTROLLER1         = 0x10;
		/**
		 * General Purpose Controller #2
		 *
		 * @var int
		 */
		const GENERAL_PURPOSE_CONTROLLER2         = 0x11;
		/**
		 * General Purpose Controller #3
		 *
		 * @var int
		 */
		const GENERAL_PURPOSE_CONTROLLER3         = 0x12;
		/**
		 * General Purpose Controller #4
		 *
		 * @var int
		 */
		const GENERAL_PURPOSE_CONTROLLER4         = 0x13;
		/**
		 * Bank Select (least significant bits)
		 *
		 * @var int
		 */
		const LSB0                                = 0x20;
		/**
		 * Modulation (least significant bits)
		 *
		 * @var int
		 */
		const LSB1                                = 0x21;
		/**
		 * Breath Controller (least significant bits)
		 *
		 * @var int
		 */
		const LSB2                                = 0x22;
		/**
		 * Foot Controller (least significant bits)
		 *
		 * @var int
		 */
		const LSB4                                = 0x24;
		/**
		 * Portamento Time (least significant bits)
		 *
		 * @var int
		 */
		const LSB5                                = 0x25;
		/**
		 * Data Entry (least significant bits)
		 *
		 * @var int
		 */
		const LSB6                                = 0x26;
		/**
		 * Main Volume (least significant bits)
		 *
		 * @var int
		 */
		const LSB7                                = 0x27;
		/**
		 * Balance (least significant bits)
		 *
		 * @var int
		 */
		const LSB8                                = 0x28;
		/**
		 * Pan (least significant bits)
		 *
		 * @var int
		 */
		const LSB10                               = 0x2A;
		/**
		 * Expression Controller (least significant bits)
		 *
		 * @var int
		 */
		const LSB11                               = 0x2B;
		/**
		 * Effect Controller #1 (least significant bits)
		 *
		 * @var int
		 */
		const LSB12                               = 0x2C;
		/**
		 * Effect Controller #2 (least significant bits)
		 *
		 * @var int
		 */
		const LSB13                               = 0x2D;
		/**
		 * General Purpose Controller #1 (least significant bits)
		 *
		 * @var int
		 */
		const LSB16                               = 0x30;
		/**
		 * General Purpose Controller #2 (least significant bits)
		 *
		 * @var int
		 */
		const LSB17                               = 0x31;
		/**
		 * General Purpose Controller #3 (least significant bits)
		 *
		 * @var int
		 */
		const LSB18                               = 0x32;
		/**
		 * General Purpose Controller #4 (least significant bits)
		 *
		 * @var int
		 */
		const LSB19                               = 0x33;
		/**
		 * Damper Pedal
		 *
		 * @var int
		 */
		const DAMPER_PEDAL                        = 0x40;
		/**
		 * Portamento
		 *
		 * @var int
		 */
		const PORTAMENTO                          = 0x41;
		/**
		 * Sostenuto Pedal
		 *
		 * @var int
		 */
		const SOSTENUTO                           = 0x42;
		/**
		 * Soft Pedal
		 *
		 * @var int
		 */
		const SOFT_PEDAL                          = 0x43;
		/**
		 * Legato Footswitch
		 *
		 * @var int
		 */
		const LEGATO_FOOTSWITCH                   = 0x44;
		/**
		 * Hold
		 *
		 * @var int
		 */
		const HOLD2                               = 0x45;
		/**
		 * Sound Controller #1
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER1                   = 0x46;
		/**
		 * Sound Controller #2
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER2                   = 0x47;
		/**
		 * Sound Controller #3
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER3                   = 0x48;
		/**
		 * Sound Controller #4
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER4                   = 0x49;
		/**
		 * Sound Controller #6
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER6                   = 0x4B;
		/**
		 * Sound Controller #7
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER7                   = 0x4C;
		/**
		 * Sound Controller #8
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER8                   = 0x4D;
		/**
		 * Sound Controller #9
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER9                   = 0x4E;
		/**
		 * Sound Controller #10
		 *
		 * @var int
		 */
		const SOUND_CONTROLLER10                  = 0x4F;
		/**
		 * General Purpose Controller #5
		 *
		 * @var int
		 */
		const GENERAL_PURPOSE_CONTROLLER5         = 0x50;
		/**
		 * General Purpose Controller #6
		 *
		 * @var int
		 */
		const GENERAL_PURPOSE_CONTROLLER6         = 0x51;
		/**
		 * General Purpose Controller #7
		 *
		 * @var int
		 */
		const GENERAL_PURPOSE_CONTROLLER7         = 0x52;
		/**
		 * General Purpose Controller #8
		 *
		 * @var int
		 */
		const GENERAL_PURPOSE_CONTROLLER8         = 0x53;
		/**
		 * Portamento Control
		 *
		 * @var int
		 */
		const PORTAMENTO_CONTROL                  = 0x54;
		/**
		 * Effects Depth #1
		 *
		 * @var int
		 */
		const EFFECTS_DEPTH1                      = 0x5B;
		/**
		 * Effects Depth #2
		 *
		 * @var int
		 */
		const EFFECTS_DEPTH2                      = 0x5C;
		/**
		 * Effects Depth #3
		 *
		 * @var int
		 */
		const EFFECTS_DEPTH3                      = 0x5D;
		/**
		 * Effects Depth #4
		 *
		 * @var int
		 */
		const EFFECTS_DEPTH4                      = 0x5E;
		/**
		 * Effects Depth #5
		 *
		 * @var int
		 */
		const EFFECTS_DEPTH5                      = 0x5F;
		/**
		 * Data Increment
		 *
		 * @var int
		 */
		const DATA_INCREMENT                      = 0x60;
		/**
		 * Data Decrement
		 *
		 * @var int
		 */
		const DATA_DECREMENT                      = 0x61;
		/**
		 * Non-registered Parameter Number (least significant bits)
		 *
		 * @var int
		 */
		const NON_REGISTERED_PARAMETER_NUMBER_LSB = 0x62;
		/**
		 * Non-registered Parameter Number (most significant bits)
		 *
		 * @var int
		 */
		const NON_REGISTERED_PARAMETER_NUMBER_MSB = 0x63;
		/**
		 * Registered Parameter Number (least significant bits)
		 *
		 * @var int
		 */
		const REGISTERED_PARAMETER_NUMBER_LSB     = 0x64;
		/**
		 * Registered Parameter Number (most significant bits)
		 *
		 * @var int
		 */
		const REGISTERED_PARAMETER_NUMBER_MSB     = 0x65;
		/**
		 * Mode Message #1
		 *
		 * @var int
		 */
		const MODE_MESSAGE1                       = 0x79;
		/**
		 * Mode Message #2
		 *
		 * @var int
		 */
		const MODE_MESSAGE2                       = 0x7A;
		/**
		 * Mode Message #3
		 *
		 * @var int
		 */
		const MODE_MESSAGE3                       = 0x7B;
		/**
		 * Mode Message #4
		 *
		 * @var int
		 */
		const MODE_MESSAGE4                       = 0x7C;
		/**
		 * Mode Message #5
		 *
		 * @var int
		 */
		const MODE_MESSAGE5                       = 0x7D;
		/**
		 * Mode Message #6
		 *
		 * @var int
		 */
		const MODE_MESSAGE6                       = 0x7E;
		/**
		 * Mode Message #7
		 *
		 * @var int
		 */
		const MODE_MESSAGE7                       = 0x7F;
		
		/**
		 * @ignore
		 */
		private static $controllerMap = array(
			self::BANK_SELECT                         => 'Bank Select',
			self::MODULATION                          => 'Modulation',
			self::BREATH_CONTROLLER                   => 'Breath Controller',
			self::FOOT_CONTROLLER                     => 'Foot Controller',
			self::PORTAMENTO_TIME                     => 'Portamento Time',
			self::DATA_ENTRY                          => 'Data Entry (most significant bits)',
			self::MAIN_VOLUME                         => 'Main Volume',
			self::BALANCE                             => 'Balance',
			self::PAN                                 => 'Pan',
			self::EXPRESSION_CONTROLLER               => 'Expression Controller',
			self::EFFECT_CONTROLLER1                  => 'Effect Controller #1',
			self::EFFECT_CONTROLLER2                  => 'Effect Controller #2',
			self::GENERAL_PURPOSE_CONTROLLER1         => 'General Purpose Controller #1',
			self::GENERAL_PURPOSE_CONTROLLER2         => 'General Purpose Controller #2',
			self::GENERAL_PURPOSE_CONTROLLER3         => 'General Purpose Controller #3',
			self::GENERAL_PURPOSE_CONTROLLER4         => 'General Purpose Controller #4',
			self::LSB0                                => 'Bank Select (least significant bits)',
			self::LSB1                                => 'Modulation (least significant bits)',
			self::LSB2                                => 'Breath Controller (least significant bits)',
			self::LSB4                                => 'Foot Controller (least significant bits)',
			self::LSB5                                => 'Portamento Time (least significant bits)',
			self::LSB6                                => 'Data Entry (least significant bits)',
			self::LSB7                                => 'Main Volume (least significant bits)',
			self::LSB8                                => 'Balance (least significant bits)',
			self::LSB10                               => 'Pan (least significant bits)',
			self::LSB11                               => 'Expression Controller (least significant bits)',
			self::LSB12                               => 'Effect Controller #1 (least significant bits)',
			self::LSB13                               => 'Effect Controller #2 (least significant bits)',
			self::LSB16                               => 'General Purpose Controller #1 (least significant bits)',
			self::LSB17                               => 'General Purpose Controller #2 (least significant bits)',
			self::LSB18                               => 'General Purpose Controller #3 (least significant bits)',
			self::LSB19                               => 'General Purpose Controller #4 (least significant bits)',
			self::DAMPER_PEDAL                        => 'Damper Pedal',
			self::PORTAMENTO                          => 'Portamento',
			self::SOSTENUTO                           => 'Sostenuto Pedal',
			self::SOFT_PEDAL                          => 'Soft Pedal',
			self::LEGATO_FOOTSWITCH                   => 'Legato Footswitch',
			self::HOLD2                               => 'Hold',
			self::SOUND_CONTROLLER1                   => 'Sound Controller #1',
			self::SOUND_CONTROLLER2                   => 'Sound Controller #2',
			self::SOUND_CONTROLLER3                   => 'Sound Controller #3',
			self::SOUND_CONTROLLER4                   => 'Sound Controller #4',
			self::SOUND_CONTROLLER6                   => 'Sound Controller #6',
			self::SOUND_CONTROLLER7                   => 'Sound Controller #7',
			self::SOUND_CONTROLLER8                   => 'Sound Controller #8',
			self::SOUND_CONTROLLER9                   => 'Sound Controller #9',
			self::SOUND_CONTROLLER10                  => 'Sound Controller #10',
			self::GENERAL_PURPOSE_CONTROLLER5         => 'General Purpose Controller #5',
			self::GENERAL_PURPOSE_CONTROLLER6         => 'General Purpose Controller #6',
			self::GENERAL_PURPOSE_CONTROLLER7         => 'General Purpose Controller #7',
			self::GENERAL_PURPOSE_CONTROLLER8         => 'General Purpose Controller #8',
			self::PORTAMENTO_CONTROL                  => 'Portamento Control',
			self::EFFECTS_DEPTH1                      => 'Effects Depth #1',
			self::EFFECTS_DEPTH2                      => 'Effects Depth #2',
			self::EFFECTS_DEPTH3                      => 'Effects Depth #3',
			self::EFFECTS_DEPTH4                      => 'Effects Depth #4',
			self::EFFECTS_DEPTH5                      => 'Effects Depth #5',
			self::DATA_INCREMENT                      => 'Data Increment',
			self::DATA_DECREMENT                      => 'Data Decrement',
			self::NON_REGISTERED_PARAMETER_NUMBER_LSB => 'Non-registered Parameter Number (least significant bits)',
			self::NON_REGISTERED_PARAMETER_NUMBER_MSB => 'Non-registered Parameter Number (most significant bits)',
			self::REGISTERED_PARAMETER_NUMBER_LSB     => 'Registered Parameter Number (least significant bits)',
			self::REGISTERED_PARAMETER_NUMBER_MSB     => 'Registered Parameter Number (most significant bits)',
			self::MODE_MESSAGE1                       => 'Mode Message #1',
			self::MODE_MESSAGE2                       => 'Mode Message #2',
			self::MODE_MESSAGE3                       => 'Mode Message #3',
			self::MODE_MESSAGE4                       => 'Mode Message #4',
			self::MODE_MESSAGE5                       => 'Mode Message #5',
			self::MODE_MESSAGE6                       => 'Mode Message #6',
			self::MODE_MESSAGE7                       => 'Mode Message #7'
		);
		
		/**
		 * Gets the description of a controller
		 *
		 * @since 1.0
		 * @todo  Fix the name of this method
		 *
		 * @param  int $controller One of the {@link Controller} constants
		 * @throws InvalidArgumentException
		 * @return string
		 */
		public static function getControllerName($controller) {
			if (!isset(self::$controllerMap[$controller])) {
				throw new \InvalidArgumentException('Invalid controller');
			}
			
			return self::$controllerMap[$controller];
		}
		
	}
	
?>