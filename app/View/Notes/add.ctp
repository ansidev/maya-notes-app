<div class="summernote container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-12">
			<h1>Add note</h1>
			<?php
				// pr($curr_user_notebooks);
		        // $book_arr = array();
		        // foreach ($curr_user_notebooks as $book) {
		        // 	if($book['Notebook']['default_book'] == false || $book['Notebook']['permitted'] !== '0') {
		        // 		// pr($book['Notebook']['permitted']);
		        // 		$book_arr[$book['Notebook']['id']] = $book['Notebook']['book_name'];
		        // 	}
		        // 	if($book['Notebook']['default_book'] == true && $book['Notebook']['permitted'] === '0' && $book['Notebook']['book_name'] == 'Uncategorized') {
		        // 		$book_arr[$book['Notebook']['id']] = $book['Notebook']['book_name'];
		        // 		$default = $book['Notebook']['id'];
		        // 	}
		        // }
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
