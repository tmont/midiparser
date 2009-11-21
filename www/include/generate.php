					<h2>Generate Parse Report</h2>
					<div class="inset">
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
					
						<h3>Recent Reports</h3>
						<div class="inset">
							<table class="recent-reports">
								<tr><td></td><th>MIDI File</th><th>Size</th><th>Type</th><th>Created</th></tr>
									
<?php
	
	$query = 'SELECT * from reports ORDER BY report_id DESC LIMIT 10';
	foreach (query($query) as $row) { ?>
								<tr>
									<td><a href="/report/<?php echo $row['report_id']; ?>">View</a></td>
									<td><tt><?php echo htmlspecialchars($row['midi_filename'], ENT_QUOTES); ?></tt></td>
									<td><tt><?php echo $row['midi_file_size']; ?></tt></td>
									<td><?php echo $row['report_type']; ?></td>
									<td><?php echo date('Y-m-d H:i:s', strtotime($row['created'])); ?></td>
								</tr>
<?php } ?>
							</table>
						</div>
					</div>