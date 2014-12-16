<div class="container">
	<div class="col-md-6 col-md-offset-3" id="dropbox-connect-form">
		<h1>Dropbox Connect</h1>
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
				'id',
				array(
					'class' => 'form-control',
					'label' => 'Dropbox ID',
					'type' => 'hidden',
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
					'type' => 'hidden',
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
					'type' => 'hidden',
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
					'type' => 'hidden',
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
					'type' => 'hidden',
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
				' Login via Dropbox',
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
		?>
	</div>
</div>
