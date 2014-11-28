<div class="summernote container">
	<h1>Edit note</h1>
	<?php
        $book_arr = array();
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
		    	'default' => $note['Note']['notebook_id'],
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
				'class' => 'form-control sn-editor', 
				'label' => 'Note body',
				'value' => htmlspecialchars_decode($note['Note']['note_body']), //decode HTML before display
				'rows' => '10',
				'div' => array(
					'class' => 'form-group'
				)
			)
		);
		echo $this->Form->input('id', array('type' => 'hidden'));

		echo $this->Html->tag(
			'button',
			'Save changes',
			array(
				'class' => 'btn btn-primary',
				'type' => 'submit'
			)
		);
	?>
</div>