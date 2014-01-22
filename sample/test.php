<?php
	
	require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
	
	use \Tmont\Midi\Parsing\FileParser;
	use \Tmont\Midi\Reporting\HtmlFormatter;
	use \Tmont\Midi\Reporting\MultiFilePrinter;

	$file = dirname(__FILE__) . '/And_We_Die_Young.mid';
	
	$parser = new FileParser();
	$parser->load($file);
	
	$formatter = new HtmlFormatter();
	$formatter->setMultiFile(true);
	
	$printer = new MultiFilePrinter($formatter, $parser, dirname(__FILE__) . '/test');
	$printer->printAll();

?>