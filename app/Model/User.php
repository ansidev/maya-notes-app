<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $validate = array(
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'An email is required.'
			),
			'email' => array(
				'rule' => array('email', true),
				'required' => true,
				'message' => 'Email syntax is not valid.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				'message' => 'This email has already been taken.'
			)
		),
	);
}
?>
