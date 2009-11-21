				<h2>Parse Report</h2>
				<div class="parse-summary">
					<p>
						<a href="/reports/<?php echo $row['report_id']; ?>/">View report</a> |
						<a href="/downloads/report/<?php echo $row['report_id']; ?>.zip">Download</a>
					</p>
					
					<table>
						<tr><th>File name</th><td><tt><?php echo $row['midi_filename']; ?></tt></td></tr>
						<tr><th>File size</th><td><tt><?php echo $row['midi_file_size']; ?></tt></td></tr>
						<tr><th>Report type</th><td><tt><?php echo $row['report_type']; ?></tt></td></tr>
						<tr><th>Created</th><td><tt><?php echo date('Y-m-d H:i:s', strtotime($row['created'])); ?></tt></td></tr>
					</table>
				</div>