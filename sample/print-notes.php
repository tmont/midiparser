<?php

	require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

	use \Tmont\Midi\Parsing\FileParser;
	use \Tmont\Midi\Event as Event;
	use \Tmont\Midi\Util\Note;

	$file = dirname(__FILE__) . '/And_We_Die_Young.mid';

	$parser = new FileParser();
	$parser->load($file);

	$currentTrackName = null;
	while ($chunk = $parser->parse()) {
		if ($chunk instanceof Event\TrackNameEvent) {
			$currentTrackName = $chunk->getParamDescription();
		} else if ($chunk instanceof Event\NoteOnEvent) {
			list($channel, $noteNumber, $velocity) = $chunk->getData();
			if ($velocity) {
				//MIDI generators often use a NOTE ON event with a velocity of 0
				//to stop playing a note in lieu of a NOTE OFF event
				$noteName = Note::getNoteName($noteNumber);
				echo $currentTrackName . ': [' . $channel . '] ' . $noteName .
					' (velocity=' . $velocity . ')' . PHP_EOL;
			}
		}
	}
