<?php 
	// pr(Debugger::trace());
?>

<div class="container">
	<div class="col-md-4 col-md-offset-4">
		<h1>Login</h1>	
		<?php
			$this->element(
				'flash_danger',
				array (
					'message' => $this->Session->flash('auth')
				)
			);
		?>
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
		<?php 
			echo $this->Form->input(
				'user_name',
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
			$icon = $this->Html->tag(
				'span',
				'',
				array(
					'class' => 'glyphicon glyphicon-arrow-left',
				)
			);
			echo $this->Html->link(
				$icon,
				array(
					'controller' => '/'
				),
				array(
					'class' => 'btn btn-primary pull-left',
					'escape' => false
					)
				);
			$icon = $this->Html->tag(
				'span',
				' Login',
				array(
					'class' => 'fa fa-sign-in',
				)
			);
			echo $this->Html->tag(
				'button',
				$icon,
				array(
					'class' => 'btn btn-primary pull-left',
					'type' => 'submit',
					'style' => 'margin-left: 5px',
					)
				);
			$icon = $this->Html->tag(
				'span',
				' Login via Dropbox',
				array(
					'class' => 'fa fa-dropbox',
				)
			);
			echo $this->Html->link(
				$icon,
				array(
					'controller' => 'users',
					'action' => 'dropbox_connect'
				),
				array(
					'class' => 'btn btn-primary pull-left',
					'id' => 'user-login-link',
					'style' => 'margin-left: 5px',
					'escape' => false
				)
			);
		?>
	</div>
</div>