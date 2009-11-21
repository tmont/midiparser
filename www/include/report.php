<?php

	$query = '
		SELECT * FROM reports
		WHERE report_id=' . $reportId;
	
	$row = query($query)->current();
	if ($row === null) {
		throw new Exception('Invalid report');
	}
	
	$title = $delimiter . 'Parse Report: ' . $row['midi_filename'];
	
?>
				<h2>Parse Report</h2>
				<div class="parse-summary">
					<p>
						<a href="/demo/report/<?php echo $row['report_id']; ?>/view">View report</a> |
						<a href="/downloads/report/<?php echo $row['report_id']; ?>.tar.gz">Download</a>
					</p>
					
					<ul>
						<li><strong>File name</strong>: <tt><?php echo $row['midi_filename']; ?></tt></li>
						<li><strong>File size</strong>: <tt><?php echo $row['midi_file_size']; ?></tt></li>
						<li><strong>Report type</strong>: <tt><?php echo $row['report_type']; ?></tt></li>
						<li><strong>Created</strong>: <tt><?php echo date('Y-m-d H:i:s', strtotime($row['created'])); ?></tt></li>
					</ul>
				</div>