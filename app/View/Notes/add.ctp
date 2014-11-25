<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-sm-12">
			<h1>Add note</h1>
			<?php
		        $notebooks = $this->Session->read('CurrentUser.notebooks');
		        $book_arr = array();
		        foreach ($notebooks as $book) {
		        	if($book['Notebook']['default_book'] == false || $book['Notebook']['permitted'] !== '0') {
		        		// pr($book['Notebook']['permitted']);
		        		$book_arr[$book['Notebook']['id']] = $book['Notebook']['book_name'];
		        	}
		        	if($book['Notebook']['default_book'] == true && $book['Notebook']['permitted'] === '0' && $book['Notebook']['book_name'] == 'Uncategorized') {
		        		$book_arr[$book['Notebook']['id']] = $book['Notebook']['book_name'];
		        		$default = $book['Notebook']['id'];
		        	}
		        }
		        // pr($book_arr);
				echo $this->Form->create(
					'Note',
					array(
						'role' => 'form'
					)
				);
				echo $this->Form->input(
					'notebook_id',
					array(
				    	'options' => $book_arr,
				    	'default' => $default,
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
						'div' => array(
							'class' => 'form-group'
						)
					)
				);
				echo $this->Form->input(
					'note_body',
					array(
						'class' => 'form-control', 
						'label' => 'Note body',
						'rows' => '10',
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
	</div>
</div>