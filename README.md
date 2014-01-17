# PHP MIDI Parser
[![Build Status](https://travis-ci.org/tmont/midiparser.png)](https://travis-ci.org/tmont/midiparser)

Licensed under [WTFPL](https://github.com/tmont/midiparser/blob/master/LICENSE)

## Installation
### Requirements
* PHP >= 5.3.0

## Usage
```php
use Tmont\Midi\Parsing\FileParser;
use Tmont\Midi\Reporting\TextFormatter;
use Tmont\Midi\Reporting\Printer;

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
vendor/bin/phpunit
 ```
 