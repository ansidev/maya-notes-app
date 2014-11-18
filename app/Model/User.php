<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $hasMany = array(
        'Notebook' => array(
            'className' => 'Notebook',
            'foreignKey' => 'user_id',
            // 'conditions' => array('Comment.status' => '1'),
            'order' => 'Notebook.id ASC',
            // 'limit' => '5',
            'dependent' => true
        ),
        'Note' => array(
            'className' => 'Note',
            'foreignKey' => 'user_id',
            // 'conditions' => array('Comment.status' => '1'),
            'order' => 'Note.id ASC',
            // 'limit' => '5',
            'dependent' => true
        )        
    );	
    public $validate = array(
		'user_email' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'An email is required.'
			)
		),
		'user_login' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required.'
			)
		),
		'user_pass' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required.'
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
			// debug($this->data[$this->alias]['user_pass']);
		}
		return true;
	}
}
?>	