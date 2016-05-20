<?php

	require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

	use Tmont\Midi\Delta;
	use Tmont\Midi\Emit as Emit;
	use Tmont\Midi\Event as Event;
	use Tmont\Midi\Util\Controller;
	use Tmont\Midi\Util\Instrument;
	use Tmont\Midi\Util\Note;
	use Tmont\Midi\Util\Timer;

	$midiFile = dirname(__FILE__) . '/emit-test.midi';

	$timer = new Timer(240);

	$file = new Emit\File($timer->getTimeDivision(), 1);

	$headerTrack = new Emit\Track();

	$headerTrack
		->appendEvent(new Event\TrackNameEvent('Metadata track'))
		->appendEvent(new Event\TimeSignatureEvent(4, 4))
		->appendEvent(new Event\SetTempoEvent(400000))
		->appendEvent(new Event\EndOfTrackEvent());

	$dataTrack = new Emit\Track();
	$channel = 0;
	$volume = 127;
	$mainVolume = 20;
	$dataTrack
		->appendEvent(new Event\TrackNameEvent('Sad Accordion'))
		->appendEvent(new Event\ProgramChangeEvent($channel, Instrument::Accordion))
		->appendEvent(new Event\ControllerEvent($channel, Controller::MAIN_VOLUME, $mainVolume))
		->appendEvent(new Event\NoteOnEvent($channel, Note::A4, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::A4, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\NoteOnEvent($channel, Note::CSharp5, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::CSharp5, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\NoteOnEvent($channel, Note::E5, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::E5, 0), new Delta($timer->eighthNote()))

		->appendEvent(new Event\ControllerEvent($channel, Controller::MAIN_VOLUME, $mainVolume += 10))

		->appendEvent(new Event\NoteOnEvent($channel, Note::A5, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::A5, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\NoteOnEvent($channel, Note::G5, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::G5, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\NoteOnEvent($channel, Note::A5, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::A5, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\ControllerEvent($channel, Controller::MAIN_VOLUME, $mainVolume += 10))

		->appendEvent(new Event\NoteOnEvent($channel, Note::F5, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::F5, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\NoteOnEvent($channel, Note::E5, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::E5, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\ControllerEvent($channel, Controller::MAIN_VOLUME, $mainVolume += 10))
		->appendEvent(new Event\NoteOnEvent($channel, Note::A4, $volume))
		->appendEvent(new Event\NoteOnEvent($channel, Note::D5, $volume))

		->appendEvent(new Event\NoteOnEvent($channel, Note::G4, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::G4, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\ControllerEvent($channel, Controller::MAIN_VOLUME, $mainVolume += 10))
		->appendEvent(new Event\NoteOnEvent($channel, Note::F4, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::F4, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\NoteOnEvent($channel, Note::E4, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::E4, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\NoteOnEvent($channel, Note::F4, $volume))
		->appendEvent(new Event\NoteOffEvent($channel, Note::F4, 0), new Delta($timer->eighthNote()))
		->appendEvent(new Event\NoteOnEvent($channel, Note::D4, $volume))
		->appendEvent(new Event\ControllerEvent($channel, Controller::MAIN_VOLUME, $mainVolume += 10))
		->appendEvent(new Event\NoteOffEvent($channel, Note::D4, 0), new Delta($timer->halfNote()))
		->appendEvent(new Event\NoteOffEvent($channel, Note::A4, 0))
		->appendEvent(new Event\NoteOffEvent($channel, Note::D5, 0))

		->appendEvent(new Event\EndOfTrackEvent());

	$file
		->addTrack($headerTrack)
		->addTrack($dataTrack)
		->save($midiFile);

	echo "Midi file saved to ${midiFile}" . PHP_EOL;
