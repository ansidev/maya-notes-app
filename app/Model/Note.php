<?php
class Note extends AppModel {
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'body' => array(
			'rule' => 'notEmpty'
		)
	);

	public function isOwnedBy($note, $user) {
		return $this->field('id', array('id' => $note, 'user_id' => $user)) !== false;
	}
}
?>