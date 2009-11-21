<?php

	$query = '
		SELECT * FROM news
		ORDER BY created DESC
		LIMIT 10';
	
	foreach (query($query) as $row) { ?>
					<div class="newsitem">
						<h2>
							<span class="timestamp" title="<?php echo date('c', strtotime($row['created'])); ?>"><?php echo date('F j, Y g:i A', strtotime($row['created'])); ?></span>
							<?php echo escape($row['title']); ?>
						</h2>
						<div class="post inset"><?php echo $row['content']; ?></div>
					</div>

<?php }

?>
