<div class="summernote container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-12">
			<h1>Add note</h1>
			<?php
				$temp = $this->requestAction('notebooks/index/direction:asc');
				foreach ($temp as $value) {
					$notebooks[$value['Notebook']['id']] = $value['Notebook']['book_name'];
				}
				echo $this->Form->create(
					'Note',
					array(
						'role' => 'form'
					)
				);
				echo $this->Form->input(
					'notebook_id',
					array(
				    	'options' => $notebooks,
				    	'type' => 'select',
				    	'empty' => 'Choose one:',
				    	'label' => 'Notebook',
			    		'class' => 'form-control',
				    	'div' => array(
				    		'class' => 'form-group',
			    		)
					)
				);			
				echo $this->Form->input(
					'note_title',
					array(
						'class' => 'form-control',
						'label' => 'Note title',
						'value' => 'Untitled',
						'div' => array(
							'class' => 'form-group'
						)
					)
				);
				echo $this->Form->input(
					'note_body',
					array(
						'class' => 'form-control sn-editor', 
						'label' => 'Note body',
						'value' => '&nbsp;',
						'rows' => '10',
						'div' => array(
							'class' => 'form-group'
						)
					)
				);
				echo $this->Html->tag(
					'button',
					'Save note',
					array(
						'class' => 'btn btn-primary',
						'type' => 'submit'
					)
				);
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#sidebar").toggleClass("toggled")
	$("#main").toggleClass("toggled")
	$('#menu-toggle').css('display', 'none')
</script>