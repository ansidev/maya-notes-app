<div class="container">
	<div class="col-md-4 col-md-offset-4">
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
					'label' => 'Email *',
					'type' => 'email',
					'placeholder' => 'Enter your email',
					'div' => array(
						'class' => 'form-group'
					)
				)
			);
			//Username input
			echo $this->Form->input(
				'user_name',
				array(
					'class' => 'form-control',
					'label' => 'Username *',
					'type' => 'text',
					'placeholder' => 'Enter your username',
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
					'label' => 'Password *',
					'type' => 'password',
					'placeholder' => 'Enter your password',
					'div' => array(
						'class' => 'form-group'
					)
				)
			);
			//Confirm password
			echo $this->Form->input(
				'user_pass_confirm',
				array(
					'class' => 'form-control',
					'label' => 'Confirm Password *',
					'type' => 'password',
					'placeholder' => 'Retype your password',
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
</div>