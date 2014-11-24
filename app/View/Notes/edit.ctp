<div class="container">
	<h1>Edit note</h1>
	<?php
		// pr($note);
        $notebooks = $this->Session->read('CurrentUser.notebooks');
        $book_arr = array();
        foreach ($notebooks as $book) {
        	if($book['Notebook']['permitted'] !== '1') {
        		// pr($book['Notebook']['permitted']);
        		$book_arr[$book['Notebook']['id']] = $book['Notebook']['book_name'];
        	}
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
		    	'options' => $book_arr,
		    	'default' => $note['Note']['notebook_id'],
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
				'value' => $note['Note']['note_title'],
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
				'value' => $note['Note']['note_body'],
				'rows' => '10',
				'div' => array(
					'class' => 'form-group'
				)
			)
		);
		echo $this->Form->input('id', array('type' => 'hidden'));

		echo $this->Form->submit(
			'Save changes',
			array(
				'class' => 'btn btn-primary'
			)
		);
	?>
</div>