					<h2>Generate Parse Report</h2>
					
					<div class="report-form">
<?php 
	
	if (isset($_SESSION['report-error'])) {
		$error = htmlspecialchars($_SESSION['report-error']);
		unset($_SESSION['report-error']);
		
?>
						<div class="error"><?php echo $error; ?></div>
<?php } ?>
						<form method="post" action="/generate" enctype="multipart/form-data">
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