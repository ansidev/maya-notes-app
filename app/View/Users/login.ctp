<!-- login.ctp -->
<?php pr(Debugger::trace()); ?>

<div class="container">
	<?php echo $this->Session->flash('auth'); ?>
	<?php 		
		echo $this->Form->create(
			'User',
			array(
				'role' => 'form',
				'url' => array(
					'controller' => 'users',
					'action' => 'login'
				)
			)
		);
	?>
	<fieldset>
		<legend>
			<?php echo __('Please enter your username and password!'); ?>
		</legend>
		<?php 
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
			echo $this->Form->submit(
				__('Login'),
				array(
					'class' => 'btn btn-primary'
				)
			);
		?>
	</fieldset>
</div>