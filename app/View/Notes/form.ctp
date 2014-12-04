<div class="summernote container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-12">
			<h1>New note</h1>
			<?php
				echo $this->Form->create(
					'Note',
					array(
						'role' => 'form'
					)
				);
				echo $this->Form->input(
					'Notebook.book_name',
					array(
				    	'options' => $notebooks,
				    	'default' => $uncategorized,
				    	'empty' => 'Choose one:',
				    	'label' => 'Notebook',
			    		'class' => 'form-control',
				    	'div' => array(
				    		'class' => 'form-group'
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
