<h1>Users</h1>
	<div class="container">
	<?php echo $this->Html->link('Add user', array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-primary', 'type' => 'button')); ?>
	<?php if(empty('users')): ?> 
		There are no users in this list.
	<?php else: ?>
		<div class="row">
			<table class="table">
				<tr>
					<th>User ID</th>
					<th>Username</th>
					<th>Display name</th>
					<th>Password</th>
					<th>Email</th>
					<th>Homepage</th>
					<th>Registered</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			<?php foreach ($users as $user): ?>
				<tr>
					<td>
						<?php echo $user['User']['id']; ?>
					</td>
					<td>
						<?php echo $user['User']['user_login']; ?>
					</td>
					<td>
						<?php echo $user['User']['display_name']; ?>
					</td>
					<td>
						<?php echo $user['User']['user_pass']; ?>
					</td>
					<td>
						<?php echo $user['User']['user_email']; ?>
					</td>
					<td>
						<?php echo $user['User']['user_url']; ?>
					</td>
					<td>
						<?php echo $user['User']['user_registered']; ?>
					</td>
					<td>
						<?php 
							if($user['User']['user_status']) {
								echo 'Online';
							}
							else echo 'Offline';
						?>
					</td>
					<td>
						<?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'])); ?>
						<?php echo $this->Form->postLink(
							'Delete',
							array('action' => 'delete', $user['User']['id']),
							array('confirm' => 'Are you sure want to delete this user?')
						); 
						?>
					</td>

				</tr>
			<?php endforeach; ?>
			</table>
		</div>
	</div>
	<?php endif; ?>
	<?php unset($user); ?>	