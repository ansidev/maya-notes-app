<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class DropboxUser extends AppModel {
	public $primaryKey = 'uid';
	public $hasOne = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_email',
            // 'conditions' => array('Comment.status' => '1'),
            'order' => 'User.id DESC',
            'limit' => '1',
            'dependent' => true
        )
    );
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

	// public function isMatch($field = array(), $compare_field = null ) {
 //        foreach($field as $key => $value) {
 //            $v1 = $value;
 //            $v2 = $this->data[$this->alias][$compare_field];
 //            if($v1 !== $v2) {
 //                return false;
 //            } else {
 //                continue;
 //            }
 //        }
 //        return true;
 //    }

	// public function beforeSave($option = array()) {
	// 	pr($this->data);
	// 	if(isset($this->data[$this->alias]['user_pass'])) {
	// 		$passwordHasher = new BlowfishPasswordHasher();
	// 		$this->data[$this->alias]['user_pass'] = $passwordHasher->hash($this->data[$this->alias]['user_pass']);
	// 		// debug($this->data[$this->alias]['user_pass']);
	// 	}
	// 	return true;
	// }
}
?>
