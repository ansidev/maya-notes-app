<h2>Notes</h2>
<?php if(empty('notes')): ?> 
	There are no notes in this list.
<?php else: ?>
	<table class="table">
		<tr>
			<th>Title</th>
			<th>Content</th>
			<th>Status</th>
			<th>Created</th>
			<th>Modified</th>
			<th>Actions</th>
		</tr>
	<?php foreach ($notes as $note): ?>
		<tr>
			<td>
				<?php echo $note['Note']['title']; ?>
			</td>
			<td>
				<?php echo $note['Note']['content']; ?>
			</td>
			<td>
				<?php
					if($note['Note']['done'])
						echo "Finished";
					else
						echo "In progress";
				?>
			</td>
			<td>
				<?php echo $note['Note']['note_created']; ?>
			</td>
			<td>
				<?php echo $note['Note']['note_modified']; ?>
			</td>
			<td>
				// Action will be added later.
			</td>

		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>