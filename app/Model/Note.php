<?php
class Note extends AppModel {
	public $belongTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Notebook' => array(
			'className' => 'Notebook',
			'foreignKey' => 'notebook_id'
		)
	);

	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'body' => array(
			'rule' => 'notEmpty'
		)
	);
}
?>