					<h2>News</h2>
					<div id="news">
<?php

	$query = '
		SELECT * FROM news
		ORDER BY created DESC
		LIMIT 10';
	
	foreach (query($query) as $row) { ?>
						<div class="newsitem">
							<h3><?php echo escape($row['title']); ?></h3>
							<p class="timestamp"><?php echo date('F j, Y g:i A', strtotime($row['created'])); ?></p>
							<p class="post"><?php echo escape($row['content']); ?></p>
						</div>

<?php }

?>
					</div>