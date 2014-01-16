# PHP MIDI Parser
[![Build Status](https://travis-ci.org/tmont/midiparser.png)](https://travis-ci.org/tmont/midiparser)

Licensed under [WTFPL](https://github.com/tmont/midiparser/blob/master/LICENSE)

## Installation
### Requirements
* PHP >= 5.3.0

## Usage
```php
//bootstrap the autoloader
require_once 'Midi/bootstrap.php';

use Midi\Parsing\FileParser;
use Midi\Reporting\TextFormatter;
use Midi\Reporting\Printer;

//create a new file parser
$parser = new FileParser();

//replace this path with the path to an actual MIDI file
$parser->load('/path/to/midi/file.mid');

//create a Printer object
$printer = new Printer(new TextFormatter(), $parser);

//output the parse result
$printer->printAll();
```

## Development
```bash
# install dependencies
composer install

# run tests
phpunit
 ```