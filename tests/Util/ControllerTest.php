<?php
	
	namespace Tmont\Midi\Tests\Util;

	use PHPUnit_Framework_TestCase;
	use Tmont\Midi\Util\Controller;

	class ControllerTest extends PHPUnit_Framework_TestCase {
		
		public function testGetControllerNameThrowsInvalidArgumentException() {
			$this->setExpectedException('InvalidArgumentException');
			Controller::getControllerName('f00');
		}
		
		public function testGetInstrumentName() {
			$controllerMap = array(
				Controller::BANK_SELECT => 'Bank Select',
				Controller::MODULATION => 'Modulation',
				Controller::BREATH_CONTROLLER => 'Breath Controller',
				Controller::FOOT_CONTROLLER => 'Foot Controller',
				Controller::PORTAMENTO_TIME => 'Portamento Time',
				Controller::DATA_ENTRY => 'Data Entry (most significant bits)',
				Controller::MAIN_VOLUME => 'Main Volume',
				Controller::BALANCE => 'Balance',
				Controller::PAN => 'Pan',
				Controller::EXPRESSION_CONTROLLER => 'Expression Controller',
				Controller::EFFECT_CONTROLLER1 => 'Effect Controller #1',
				Controller::EFFECT_CONTROLLER2 => 'Effect Controller #2',
				Controller::GENERAL_PURPOSE_CONTROLLER1 => 'General Purpose Controller #1',
				Controller::GENERAL_PURPOSE_CONTROLLER2 => 'General Purpose Controller #2',
				Controller::GENERAL_PURPOSE_CONTROLLER3 => 'General Purpose Controller #3',
				Controller::GENERAL_PURPOSE_CONTROLLER4 => 'General Purpose Controller #4',
				Controller::LSB0 => 'Bank Select (least significant bits)',
				Controller::LSB1 => 'Modulation (least significant bits)',
				Controller::LSB2 => 'Breath Controller (least significant bits)',
				Controller::LSB4 => 'Foot Controller (least significant bits)',
				Controller::LSB5 => 'Portamento Time (least significant bits)',
				Controller::LSB6 => 'Data Entry (least significant bits)',
				Controller::LSB7 => 'Main Volume (least significant bits)',
				Controller::LSB8 => 'Balance (least significant bits)',
				Controller::LSB10 => 'Pan (least significant bits)',
				Controller::LSB11 => 'Expression Controller (least significant bits)',
				Controller::LSB12 => 'Effect Controller #1 (least significant bits)',
				Controller::LSB13 => 'Effect Controller #2 (least significant bits)',
				Controller::LSB16 => 'General Purpose Controller #1 (least significant bits)',
				Controller::LSB17 => 'General Purpose Controller #2 (least significant bits)',
				Controller::LSB18 => 'General Purpose Controller #3 (least significant bits)',
				Controller::LSB19 => 'General Purpose Controller #4 (least significant bits)',
				Controller::DAMPER_PEDAL => 'Damper Pedal',
				Controller::PORTAMENTO => 'Portamento',
				Controller::SOSTENUTO => 'Sostenuto Pedal',
				Controller::SOFT_PEDAL => 'Soft Pedal',
				Controller::LEGATO_FOOTSWITCH => 'Legato Footswitch',
				Controller::HOLD2 => 'Hold',
				Controller::SOUND_CONTROLLER1 => 'Sound Controller #1',
				Controller::SOUND_CONTROLLER2 => 'Sound Controller #2',
				Controller::SOUND_CONTROLLER3 => 'Sound Controller #3',
				Controller::SOUND_CONTROLLER4 => 'Sound Controller #4',
				Controller::SOUND_CONTROLLER6 => 'Sound Controller #6',
				Controller::SOUND_CONTROLLER7 => 'Sound Controller #7',
				Controller::SOUND_CONTROLLER8 => 'Sound Controller #8',
				Controller::SOUND_CONTROLLER9 => 'Sound Controller #9',
				Controller::SOUND_CONTROLLER10 => 'Sound Controller #10',
				Controller::GENERAL_PURPOSE_CONTROLLER5 => 'General Purpose Controller #5',
				Controller::GENERAL_PURPOSE_CONTROLLER6 => 'General Purpose Controller #6',
				Controller::GENERAL_PURPOSE_CONTROLLER7 => 'General Purpose Controller #7',
				Controller::GENERAL_PURPOSE_CONTROLLER8 => 'General Purpose Controller #8',
				Controller::PORTAMENTO_CONTROL => 'Portamento Control',
				Controller::EFFECTS_DEPTH1 => 'Effects Depth #1',
				Controller::EFFECTS_DEPTH2 => 'Effects Depth #2',
				Controller::EFFECTS_DEPTH3 => 'Effects Depth #3',
				Controller::EFFECTS_DEPTH4 => 'Effects Depth #4',
				Controller::EFFECTS_DEPTH5 => 'Effects Depth #5',
				Controller::DATA_INCREMENT => 'Data Increment',
				Controller::DATA_DECREMENT => 'Data Decrement',
				Controller::NON_REGISTERED_PARAMETER_NUMBER_LSB => 'Non-registered Parameter Number (least significant bits)',
				Controller::NON_REGISTERED_PARAMETER_NUMBER_MSB => 'Non-registered Parameter Number (most significant bits)',
				Controller::REGISTERED_PARAMETER_NUMBER_LSB => 'Registered Parameter Number (least significant bits)',
				Controller::REGISTERED_PARAMETER_NUMBER_MSB => 'Registered Parameter Number (most significant bits)',
				Controller::MODE_MESSAGE1 => 'Mode Message #1',
				Controller::MODE_MESSAGE2 => 'Mode Message #2',
				Controller::MODE_MESSAGE3 => 'Mode Message #3',
				Controller::MODE_MESSAGE4 => 'Mode Message #4',
				Controller::MODE_MESSAGE5 => 'Mode Message #5',
				Controller::MODE_MESSAGE6 => 'Mode Message #6',
				Controller::MODE_MESSAGE7 => 'Mode Message #7'
			);
			
			foreach ($controllerMap as $controller => $name) {
				$this->assertEquals(Controller::getControllerName($controller), $name);
			}
		}

	}

?>