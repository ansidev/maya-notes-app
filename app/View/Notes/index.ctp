<h1>Notes</h1>
	<div class="container">
	<?php echo $this->Html->link('Add note', array('controller' => 'notes', 'action' => 'add'), array('class' => 'btn btn-primary', 'type' => 'button')); ?>
	<?php if(empty('notes')): ?> 
		There are no notes in this list.
	<?php else: ?>
		<div class="row">
			<table class="table">
				<tr>
					<th>Note ID</th>
					<th>Note Title</th>
					<th>Note Body</th>
					<th>Status</th>
					<th>Created</th>
					<th>Modified</th>
					<th>Actions</th>
				</tr>
			<?php foreach ($notes as $note): ?>
				<tr>
					<td>
						<?php echo $note['Note']['id']; ?>
					</td>
					<td>
						<?php echo $note['Note']['title']; ?>
					</td>
					<td>
						<?php echo $note['Note']['body']; ?>
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
						<?php echo $this->Html->link('Edit', array('action' => 'edit', $note['Note']['id'])); ?>
						<?php echo $this->Form->postLink(
							'Delete',
							array('action' => 'delete', $note['Note']['id']),
							array('confirm' => 'Are you sure want to delete this post?')
						); 
						?>
					</td>

				</tr>
			<?php endforeach; ?>
			</table>
		</div>
	</div>
	<?php unset($note); ?>
	<?php endif; ?>