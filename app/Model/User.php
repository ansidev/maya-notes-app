<?php
class User extends AppModel {
	public $validate = array(
		'user_login' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),
		'user_pass' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'user_role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin','user')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		),
	);

	public function beforeSave($option = array()) {
		if(isset($this->data[$this->alias]['user_pass'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['user_pass'] = $passwordHasher->hash($this->data[$this->alias]['user_pass']);
		}
		return true;
	}
}
?>	