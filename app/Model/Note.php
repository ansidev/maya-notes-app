<?php
class Note extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Notebook' => array(
			'className' => 'Notebook',
			'foreignKey' => 'notebook_id',
			'order' => 'Notebook.id ASC',
		)
	);

	// public $hasAndBelongsToMany = array(
 //        'Notebook' => array(
 //            'className' => 'Notebook',
 //            'joinTable' => 'notebooks_notes',
 //            'foreignKey' => 'note_id',
 //            'associationForeignKey' => 'notebook_id',
 //            'unique' => true,
 //            // 'conditions' => array('Comment.status' => '1'),
 //            // 'order' => 'Notebook.id DESC',
 //            // 'limit' => '5',
 //            // 'dependent' => true
 //        ),
 //    );

	public $validate = array(
		'note_title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a title for this note',
			),
		),
		'note_body' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter body for this note',
			),
		),
	);
}
?>