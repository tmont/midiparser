					<h2>Demo</h2>
					
					<h3>Sample MIDI File</h3>
					<p>
						Ever wanted to see what Alice in Chains&#039; <em>And We Die Young</em> MIDIfied
						looks like internally? The answer invariably is <strong>OH GOD YES</strong>. 
						This report was generated using the 
						<a href="/docs/api/Midi/Reporting/MultiFilePrinter.html"><code>MultiFilePrinter</code></a> and the
						<a href="/docs/api/Midi/Reporting/HtmlFormatter.html"><code>HtmlFormatter</code></a>.
					</p>
					
					<p>
						<strong>Note</strong>: the HTML that is generated uses
						<a href="http://www.css3.info/preview/attribute-selectors/">CSS3 selectors</a>, 
						which means you need a browser capable of handling that to effectively view
						the results. Firefox 3.5+, Opera 9.5+ and Google Chrome will all suffice. IE
						and other browsers will render correctly, but they won&#039;t be as pretty.
					</p>
					
					<ul>
						<li><a href="/demo/report/1">HTML Report</a></li>
						<li><a href="/downloads/And_We_Die_Young.mid">MIDI file</a></li>
					</ul>
					
					<h3>Generate Your Own Parse Report</h3>
					<div class="report-form">
<?php 
	
	if (isset($_SESSION['report-error'])) {
		$error = htmlspecialchars(unserialize($_SESSION['report-error'])->getMessage());
		unset($_SESSION['report-error']);
		
?>
						<div class="error"><?php echo $error; ?></div>
<?php } ?>
						<form method="post" action="/demo/report" enctype="multipart/form-data">
							<table>
								<tr>
									<th>MIDI File</th>
									<td><input type="file" name="midi_file"/></td>
								</tr>
								<tr>
									<th>Report Type</th>
									<td>
										<input type="radio" id="type_text" value="text" name="report_type" checked="checked"/><label for="type_text">Text</label>
										<input type="radio" id="type_html" value="html" name="report_type"/><label for="type_html">HTML</label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" value="Generate Report"/></td>
								</tr>
							</table>
						</form>
					</div>