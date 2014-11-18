<?php
class Note extends AppModel {
	public $belongTo = array('User', 'Notebook');

	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'body' => array(
			'rule' => 'notEmpty'
		)
	);

	public function isOwnedBy($note_id, $user_id) {
		return $this->field('id', array('id' => $note_id, 'user_id' => $user_id)) !== false;
	}
}
?>