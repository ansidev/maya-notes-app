<div class="container">
	<h1>Register</h1>
	<?php
		echo $this->Form->create(
			'User',
			array(
				'role' => 'form' //role="form"
			)
		);
		//User email input
		echo $this->Form->input(
			'user_email',
			array(
				'class' => 'form-control',
				'label' => 'Email',
				'div' => array(
					'class' => 'form-group'
				)
			)
		);
		//Username input
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
		//Password input
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
		echo $this->Form->submit(
			'Register',
			array(
				'class' => 'btn btn-primary'
			)
		);
	?>
</div>