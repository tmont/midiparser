					<h2>Quick Start</h2>
					
					<h3>Quick and Dirty</h3>
					<ol>
						<li>Download: <code>wget http://phpmidiparser.com/downloads/latest</code></li>
						<li>Extract: <code>tar xzvf php-midi-library-x.x.x.tar.gz</code></li>
						<li>Create script: <code>vi midilibtest.php</code></li>
						<li>Paste:
<pre class="code"><span class="block">&lt;?php</span>

    <span class="keyword">require_once</span> dirname<span class="block">(</span><span class="keyword">__FILE__</span><span class="block">)</span> . <span class="string">&apos;/php-midi-library-x.x.x/Midi/bootstrap.php&apos;</span>;

    <span class="keyword">use</span> \Midi\Parsing\FileParser;
    <span class="keyword">use</span> \Midi\Reporting\TextFormatter;
    <span class="keyword">use</span> \Midi\Reporting\Printer;

    <span class="variable">$parser</span> = <span class="keyword">new</span> FileParser<span class="block">(</span><span class="block">)</span>;
    <span class="variable">$parser</span>-&gt;load<span class="block">(</span><span class="string">&apos;/path/to/midi/file.mid&apos;</span><span class="block">)</span>;

    <span class="variable">$printer</span> = <span class="keyword">new</span> Printer<span class="block">(</span><span class="keyword">new</span> TextFormatter<span class="block">(</span><span class="block">)</span>, <span class="variable">$parser</span><span class="block">)</span>;
    <span class="variable">$printer</span>-&gt;printAll<span class="block">(</span><span class="block">)</span>;

<span class="block">?&gt;</span>
</pre>
						</li>
						<li>Save</li>
						<li>Run: <code>php midilibtest.php</code></li>
						<li>???</li>
						<li>Profit</li>
					</ol>
					
					<h3>Installation</h3>
					<ol>
						<li><a href="/downloads">Download </a>the default package</li>
						<li>Extract it somewhere</li>
						<li>
							To use the library in your code, all you need to do is include
							the bootstrap.php file, which is located at <code>Midi/bootstrap.php</code>.
						</li>
					</ol>
					
					<h3>Usage</h3>
					<p>
						When you include the bootstrapper, it <a href="http://php.net/autoload">autoloads</a>
						all the classes you&#039;ll need to use the library. Below is a code snippet that
						will parse a file named &quot;test.mid&quot; and use the <code>TextFormatter</code>
						to format the results. This will print the parse results out to stdout.
					</p>
					
<pre class="code"><span class="block">&lt;?php</span>

    <span class="keyword">require_once</span> <span class="string">&apos;Midi/bootstrap.php&apos;</span>;

    <span class="keyword">use</span> \Midi\Parsing\FileParser;
    <span class="keyword">use</span> \Midi\Reporting\TextFormatter;
    <span class="keyword">use</span> \Midi\Reporting\Printer;

    <span class="variable">$parser</span> = <span class="keyword">new</span> FileParser<span class="block">(</span><span class="block">)</span>;
    <span class="variable">$parser</span>-&gt;load<span class="block">(</span><span class="string">&apos;test.mid&apos;</span><span class="block">)</span>;

    <span class="variable">$printer</span> = <span class="keyword">new</span> Printer<span class="block">(</span><span class="keyword">new</span> TextFormatter<span class="block">(</span><span class="block">)</span>, <span class="variable">$parser</span><span class="block">)</span>;
    <span class="variable">$printer</span>-&gt;printAll<span class="block">(</span><span class="block">)</span>;

<span class="block">?&gt;</span>
</pre>
					<p>
						To get prettier results, like you can see in the <a href="/demo">demo</a>, use
						the <code>HtmlFormatter</code> along with the <code>MultiFilePrinter</code>.
						Note that using this combination of formatter and printer uses AJAX to
						do pagination, which means you need a webserver to view the results. Use the
						<code>FilePrinter</code> instead if a webserver is not available. This will
						make one giant HTML file rather than many, as the <code>MultiFilePrinter</code>
						does.
					</p>
					
					<p>
						When you run this code snippet, it will create a directory called &quot;test&quot;
						and place the resultant HTML files in there.
					</p>
					
<pre class="code"><span class="block">&lt;?php</span>
	
	<span class="keyword">require_once</span> <span class="string">&apos;Midi/bootstrap.php&apos;</span>;
	
	<span class="keyword">use</span> \Midi\Parsing\FileParser;
	<span class="keyword">use</span> \Midi\Reporting\HtmlFormatter;
	<span class="keyword">use</span> \Midi\Reporting\MultiFilePrinter;

	<span class="variable">$file</span> = <span class="string">&apos;test.mid&apos;</span>;
	
	<span class="variable">$parser</span> = <span class="keyword">new</span> FileParser<span class="block">(</span><span class="block">)</span>;
	<span class="variable">$parser</span>-&gt;load<span class="block">(</span><span class="variable">$file</span><span class="block">)</span>;
	
	<span class="variable">$formatter</span> = <span class="keyword">new</span> HtmlFormatter<span class="block">(</span><span class="block">)</span>;
	<span class="variable">$formatter</span>-&gt;setMultiFile<span class="block">(</span>true<span class="block">)</span>;
	
	<span class="variable">$printer</span> = <span class="keyword">new</span> MultiFilePrinter<span class="block">(</span><span class="variable">$formatter</span>, <span class="variable">$parser</span>, dirname<span class="block">(</span><span class="keyword">__FILE__</span><span class="block">)</span> . <span class="string">&apos;/test&apos;</span><span class="block">)</span>;
	<span class="variable">$printer</span>-&gt;printAll<span class="block">(</span><span class="block">)</span>;

<span class="block">?&gt;</span>
</pre>
					