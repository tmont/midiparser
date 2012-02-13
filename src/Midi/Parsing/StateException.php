<?php

	/**
	 * \Midi\Parsing\StateException
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */

	namespace Midi\Parsing;

	use Midi\MidiException;
	
	/**
	 * Exception for when a parser encounters an unexpected
	 * parse state
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */
	class StateException extends MidiException {}

?>