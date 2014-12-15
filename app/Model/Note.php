<?php
class Note extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);

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
    public function isOwnedBy($note, $user) {
        return $this->field('id', array('id' => $note, 'user_id' => $user)) !== false;
    }
}
?>