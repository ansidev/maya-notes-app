<div class="container">
	<div class="col-md-6 col-md-offset-3" id="dropbox-connect-form">
		<h1>Dropbox Connect</h1>
		<?php
			echo $this->Form->create(
				'DropboxUser',
				array(
					'role' => 'form',
					'url' => array(
						'controller' => 'dropbox_users',
						'action' => 'login'
					)
				)
			);
		?>
		<?php
			echo $this->Form->input(
				'uid',
				array(
					'class' => 'form-control',
					'label' => 'Dropbox ID',
					'div' => array(
						'class' => 'form-group'
					)
				)
			);
			echo $this->Form->input(
				'email',
				array(
					'class' => 'form-control',
					'label' => 'Email',
					'div' => array(
						'class' => 'form-group'
					)
				)
			);
			echo $this->Form->input(
				'display_name',
				array(
					'class' => 'form-control',
					'label' => 'Display name',
					'div' => array(
						'class' => 'form-group'
					)
				)
			);
			echo $this->Form->input(
				'country',
				array(
					'class' => 'form-control',
					'label' => 'Country',
					'div' => array(
						'class' => 'form-group'
					)
				)
			);
			echo $this->Form->input(
				'referral_link',
				array(
					'class' => 'form-control',
					'label' => 'Referral link',
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
				' Dropbox Connect',
				array(
					'class' => 'fa fa-dropbox',
				)
			);
			echo $this->Html->tag(
				'button',
				$icon,
				array(
					'id' => 'dropbox-login',
					'class' => 'btn btn-primary pull-left',
					'style' => 'margin-left: 5px; display: none',
					'type' => 'submit'
					)
				);
			$icon = $this->Html->tag(
				'span',
				' Connect with Dropbox',
				array(
					'class' => 'fa fa-dropbox',
				)
			);
			echo $this->Html->tag(
				'button',
				$icon,
				array(
					'id' => 'dropbox-connect',
					'class' => 'btn btn-primary pull-left',
					'style' => 'margin-left: 5px'
					)
				);
			if(!$is_logged_in) {
				$icon = $this->Html->tag(
					'span',
					' Login',
					array(
						'class' => 'fa fa-sign-in',
					)
				);
				echo $this->Html->link(
					$icon,
					array(
						'controller' => 'users',
						'action' => 'login'
					),
					array(
						'class' => 'btn btn-primary pull-left',
						'id' => 'user-login-link',
						'style' => 'margin-left: 5px',
						'escape' => false
					)
				);
			}
		?>
	</div>
</div>
