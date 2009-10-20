<?php
	
	namespace Midi\Tests\Util;

	class ControllerTest extends \PHPUnit_Framework_TestCase {
		
		public function testGetControllerNameThrowsInvalidArgumentException() {
			$this->setExpectedException('InvalidArgumentException');
			\Midi\Util\Controller::getControllerName('f00');
		}
		
		public function testGetInstrumentName() {
			$controllerMap = array(
				\Midi\Util\Controller::BANK_SELECT => 'Bank Select',
				\Midi\Util\Controller::MODULATION => 'Modulation',
				\Midi\Util\Controller::BREATH_CONTROLLER => 'Breath Controller',
				\Midi\Util\Controller::FOOT_CONTROLLER => 'Foot Controller',
				\Midi\Util\Controller::PORTAMENTO_TIME => 'Portamento Time',
				\Midi\Util\Controller::DATA_ENTRY => 'Data Entry (most significant bits)',
				\Midi\Util\Controller::MAIN_VOLUME => 'Main Volume',
				\Midi\Util\Controller::BALANCE => 'Balance',
				\Midi\Util\Controller::PAN => 'Pan',
				\Midi\Util\Controller::EXPRESSION_CONTROLLER => 'Expression Controller',
				\Midi\Util\Controller::EFFECT_CONTROLLER1 => 'Effect Controller #1',
				\Midi\Util\Controller::EFFECT_CONTROLLER2 => 'Effect Controller #2',
				\Midi\Util\Controller::GENERAL_PURPOSE_CONTROLLER1 => 'General Purpose Controller #1',
				\Midi\Util\Controller::GENERAL_PURPOSE_CONTROLLER2 => 'General Purpose Controller #2',
				\Midi\Util\Controller::GENERAL_PURPOSE_CONTROLLER3 => 'General Purpose Controller #3',
				\Midi\Util\Controller::GENERAL_PURPOSE_CONTROLLER4 => 'General Purpose Controller #4',
				\Midi\Util\Controller::LSB0 => 'Bank Select (least significant bits)',
				\Midi\Util\Controller::LSB1 => 'Modulation (least significant bits)',
				\Midi\Util\Controller::LSB2 => 'Breath Controller (least significant bits)',
				\Midi\Util\Controller::LSB4 => 'Foot Controller (least significant bits)',
				\Midi\Util\Controller::LSB5 => 'Portamento Time (least significant bits)',
				\Midi\Util\Controller::LSB6 => 'Data Entry (least significant bits)',
				\Midi\Util\Controller::LSB7 => 'Main Volume (least significant bits)',
				\Midi\Util\Controller::LSB8 => 'Balance (least significant bits)',
				\Midi\Util\Controller::LSB10 => 'Pan (least significant bits)',
				\Midi\Util\Controller::LSB11 => 'Expression Controller (least significant bits)',
				\Midi\Util\Controller::LSB12 => 'Effect Controller #1 (least significant bits)',
				\Midi\Util\Controller::LSB13 => 'Effect Controller #2 (least significant bits)',
				\Midi\Util\Controller::LSB16 => 'General Purpose Controller #1 (least significant bits)',
				\Midi\Util\Controller::LSB17 => 'General Purpose Controller #2 (least significant bits)',
				\Midi\Util\Controller::LSB18 => 'General Purpose Controller #3 (least significant bits)',
				\Midi\Util\Controller::LSB19 => 'General Purpose Controller #4 (least significant bits)',
				\Midi\Util\Controller::DAMPER_PEDAL => 'Damper Pedal',
				\Midi\Util\Controller::PORTAMENTO => 'Portamento',
				\Midi\Util\Controller::SOSTENUTO => 'Sostenuto Pedal',
				\Midi\Util\Controller::SOFT_PEDAL => 'Soft Pedal',
				\Midi\Util\Controller::LEGATO_FOOTSWITCH => 'Legato Footswitch',
				\Midi\Util\Controller::HOLD2 => 'Hold',
				\Midi\Util\Controller::SOUND_CONTROLLER1 => 'Sound Controller #1',
				\Midi\Util\Controller::SOUND_CONTROLLER2 => 'Sound Controller #2',
				\Midi\Util\Controller::SOUND_CONTROLLER3 => 'Sound Controller #3',
				\Midi\Util\Controller::SOUND_CONTROLLER4 => 'Sound Controller #4',
				\Midi\Util\Controller::SOUND_CONTROLLER6 => 'Sound Controller #6',
				\Midi\Util\Controller::SOUND_CONTROLLER7 => 'Sound Controller #7',
				\Midi\Util\Controller::SOUND_CONTROLLER8 => 'Sound Controller #8',
				\Midi\Util\Controller::SOUND_CONTROLLER9 => 'Sound Controller #9',
				\Midi\Util\Controller::SOUND_CONTROLLER10 => 'Sound Controller #10',
				\Midi\Util\Controller::GENERAL_PURPOSE_CONTROLLER5 => 'General Purpose Controller #5',
				\Midi\Util\Controller::GENERAL_PURPOSE_CONTROLLER6 => 'General Purpose Controller #6',
				\Midi\Util\Controller::GENERAL_PURPOSE_CONTROLLER7 => 'General Purpose Controller #7',
				\Midi\Util\Controller::GENERAL_PURPOSE_CONTROLLER8 => 'General Purpose Controller #8',
				\Midi\Util\Controller::PORTAMENTO_CONTROL => 'Portamento Control',
				\Midi\Util\Controller::EFFECTS_DEPTH1 => 'Effects Depth #1',
				\Midi\Util\Controller::EFFECTS_DEPTH2 => 'Effects Depth #2',
				\Midi\Util\Controller::EFFECTS_DEPTH3 => 'Effects Depth #3',
				\Midi\Util\Controller::EFFECTS_DEPTH4 => 'Effects Depth #4',
				\Midi\Util\Controller::EFFECTS_DEPTH5 => 'Effects Depth #5',
				\Midi\Util\Controller::DATA_INCREMENT => 'Data Increment',
				\Midi\Util\Controller::DATA_DECREMENT => 'Data Decrement',
				\Midi\Util\Controller::NON_REGISTERED_PARAMETER_NUMBER_LSB => 'Non-registered Parameter Number (least significant bits)',
				\Midi\Util\Controller::NON_REGISTERED_PARAMETER_NUMBER_MSB => 'Non-registered Parameter Number (most significant bits)',
				\Midi\Util\Controller::REGISTERED_PARAMETER_NUMBER_LSB => 'Registered Parameter Number (least significant bits)',
				\Midi\Util\Controller::REGISTERED_PARAMETER_NUMBER_MSB => 'Registered Parameter Number (most significant bits)',
				\Midi\Util\Controller::MODE_MESSAGE1 => 'Mode Message #1',
				\Midi\Util\Controller::MODE_MESSAGE2 => 'Mode Message #2',
				\Midi\Util\Controller::MODE_MESSAGE3 => 'Mode Message #3',
				\Midi\Util\Controller::MODE_MESSAGE4 => 'Mode Message #4',
				\Midi\Util\Controller::MODE_MESSAGE5 => 'Mode Message #5',
				\Midi\Util\Controller::MODE_MESSAGE6 => 'Mode Message #6',
				\Midi\Util\Controller::MODE_MESSAGE7 => 'Mode Message #7'
			);
			
			foreach ($controllerMap as $controller => $name) {
				$this->assertEquals(\Midi\Util\Controller::getControllerName($controller), $name);
			}
		}

	}

?>