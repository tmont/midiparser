<?php
	
	require_once dirname(dirname(__FILE__)) . '/src/Midi/bootstrap.php';
	
	use \Midi\Parsing\FileParser;
	use \Midi\Reporting\HtmlFormatter;
	use \Midi\Reporting\MultiFilePrinter;

	$file = dirname(__FILE__) . '/And_We_Die_Young.mid';
	
	$parser = new FileParser();
	$parser->load($file);
	
	$formatter = new HtmlFormatter();
	$formatter->setMultiFile(true);
	
	$printer = new MultiFilePrinter($formatter, $parser, dirname(__FILE__) . '/test');
	$printer->printAll();

?>