<?php

	require_once 'cli.php';

	$switches = new CliSwitchCollection();
	$switches->addSwitch(new CliSwitch('target',  't',  true, 'file',      'Where to write the output'))
	         ->addSwitch(new CliSwitch('name',    'n',  true, 'name',      'Product name'))
	         ->addSwitch(new CliSwitch('version', 'v',  true, 'version #', 'Product version'))
	         ->addSwitch(new CliSwitch('author',  'a',  true, 'name',      'Product author'))
	         ->addSwitch(new CliSwitch('since',   's',  true, 'version #', 'Value for @since tag in documentation'))
	         ->addSwitch(new CliSwitch('help',    'h',  false, null,       'Display this help message (also --usage)'))
	         ->addSwitch(new CliSwitch('usage',   null, false, null,       'Display this help message (also --help)'));

	array_shift($argv);
	$args = Cli::parseArgs($argv, $switches);
	
	$options = array_map('addslashes', $args['switches']);
	$date    = date('c');
	
	$code = <<<CODE
<?php

	/**
	 * \Midi\Version
	 *
	 * @package   Midi
	 * @since     $options[since]
	 */
	
	namespace Midi;
	
	/**
	 * Provides static properties such as version and author
	 *
	 * @package Midi
	 * @since   $options[since]
	 */
	final class Version {
		
		//@codeCoverageIgnoreStart
		/**
		 * @ignore
		 */
		private function __construct() {}
		//@codeCoverageIgnoreEnd
		
		/**
		 * The PHP MIDI Parser library version
		 *
		 * @var string
		 */
		const VERSION    = '$options[version]';
		
		/**
		 * The PHP MIDI Parser library author
		 *
		 * @var string
		 */
		const AUTHOR     = '$options[author]';
		
		/**
		 * The PHP MIDI Parser library full product name
		 *
		 * @var string
		 */
		const NAME       = '$options[name]';
		
		/**
		 * The build date in ISO 8601 format (date('c'))
		 *
		 * @var string
		 */
		const BUILD_DATE = '$date';
		
	}

?>
CODE;

	if (!file_put_contents($options['target'], $code)) {
		exit(1);
	}
	
	exit(0);

?>