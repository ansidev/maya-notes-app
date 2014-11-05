<div class="container">
	<h1>Add user</h1>
	<?php
		echo $this->Form->create(
			'User',
			array(
				'role' => 'form'
			)
		);
		echo $this->Form->input(
			'user_login',
			array(
				'class' => 'form-control',
				'label' => 'Username',
				'div' => array(
					'class' => 'form-group'
				)
			)
		);
		echo $this->Form->input(
			'user_pass',
			array(
				'class' => 'form-control',
				'label' => 'Password',
				'type' => 'password',
				'div' => array(
					'class' => 'form-group'
				)
			)
		);
		echo $this->Form->input(
			'user_role',
			array(
				'class' => 'form-control',
				'label' => 'Password',
				'option' => array(
					'admin' => 'Admin',
					'user' => 'User'
				),
				'div' => array(
					'class' => 'form-group'
				)
			)
		);
		echo $this->Form->submit(
			'Save note',
			array(
				'class' => 'btn btn-primary'
			)
		);
	?>
</div>