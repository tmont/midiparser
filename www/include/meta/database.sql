UPDATE news SET content='<p>
	PHP MIDI Parser 1.0 has been released, along with the site
	dedicated to it. It&#039;s obviously total overkill, but I had
	fun making it.
</p>
<p>
	Check out the <a href="/demo">demo</a> page to get a feel
	for what this library can do. The <a href="/docs/">API
	documentation</a> is also available to help with using the
	library.
</p>
<p>
	The PHP MIDI Parser library is basically set of well-defined
	APIs for parsing a MIDI file. It also comes with a set of
	output generators (textual and HTML) that display the results
	of a parse. Every part of the library was built with
	extensibility and customizability in mind, so that others
	could easily adapt it to their needs.
</p>
<p>
	Viewing the <a href="/docs/">documentation</a> will help
	developers get started in using the APIs, and how everything
	is wired together.
</p>
<p>
	Thanks for coming, and <a href="/contact">drop me a
	line</a> to report bugs or if you have any questions.
</p>'
WHERE news_id=1;

CREATE TABLE `reports` (
	`report_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`ip` varchar(15) NOT NULL,
	`midi_filename` varchar(200) NOT NULL,
	`midi_file_hash` char(32) NOT NULL,
	`midi_file_size` int(10) unsigned NOT NULL,
	`report_type` enum('html','text') NOT NULL DEFAULT 'text',
	`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`report_id`),
	KEY `hash_and_report` (`midi_file_hash`,`report_type`)
) ENGINE=InnoDB default charset=utf8;

insert into reports (ip, midi_filename, midi_file_hash, midi_file_size, report_type) values ('127.0.0.1', 'And_We_Die_Young.mid', 'b31aa911330d4ff788fd357f0b2e684d', 32263, 'html');