<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $hasOne = array(
        'DropboxUser' => array(
            'className' => 'DropboxUser',
            'foreignKey' => 'email',
            // 'conditions' => array('Comment.status' => '1'),
            'order' => 'DropboxUser.uid ASC',
            'limit' => '1',	
            'dependent' => true
        )
    );	
	public $hasMany = array(
        'Notebook' => array(
            'className' => 'Notebook',
            'foreignKey' => 'user_id',
            // 'conditions' => array('Comment.status' => '1'),
            'order' => 'Notebook.id DESC',
            // 'limit' => '5',
            'dependent' => true
        ),
        'Note' => array(
            'className' => 'Note',
            'foreignKey' => 'user_id',
            // 'conditions' => array('Comment.status' => '1'),
            'order' => 'Note.id DESC',
            // 'limit' => '5',
            'dependent' => true
        )        
    );	
    public $validate = array(
		'user_email' => array(
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
		'user_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'A username is required.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				'message' => 'This username has already been taken.'
			),
			'username' => array(
				'rule' => '/^[a-z0-9_]{5,10}$/i',
				'required' => true,
				'message' => 'Only allow alphabets, numeric, underscore, length between 5 and 10.'
			)
		),
		'user_pass' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'A password is required.'
			),
			'passRegex' => array(
				'rule' => '/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/',
				'required' => true,
				'message' => 'The password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit.'
			)
		),
		'user_pass_confirm' => array(
			'isMatch' => array(
		        'rule' => array('isMatch', 'user_pass' ), 
				'required' => true,
		        'message' => 'Please re-enter your password twice so that the values match.'
	        )
		),
		'user_role' => array(
			'inList' => array(
				'rule' => array('inList', array('admin','user')),
				'message' => 'Please enter a valid role',
				'required' => true,
				'allowEmpty' => false
			)
		)
	);

	public function isMatch($field = array(), $compare_field = null ) { 
        foreach($field as $key => $value) { 
            $v1 = $value;
            $v2 = $this->data[$this->alias][$compare_field];
            if($v1 !== $v2) { 
                return false; 
            } else { 
                continue; 
            } 
        } 
        return true; 
    }
	
	public function beforeSave($option = array()) {
		pr($this->data);
		if(isset($this->data[$this->alias]['user_pass'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['user_pass'] = $passwordHasher->hash($this->data[$this->alias]['user_pass']);
			// debug($this->data[$this->alias]['user_pass']);
		}
		return true;
	}
}
?>	