<div class="container">
	<h1>Edit note</h1>
	<?php
		echo $this->Form->create(
			'Note',
			array(
				'role' => 'form'
			)
		);
		echo $this->Form->input(
			'title',
			array(
				'class' => 'form-control',
				'label' => 'Note title',
				'div' => array(
					'class' => 'form-group'
				)
			)
		);
		echo $this->Form->input(
			'body',
			array(
				'class' => 'form-control', 
				'label' => 'Note body',
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