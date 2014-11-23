<?php
App::uses('AppModel','Model');

class Notebook extends AppModel {
	public $hasMany = array(
        'Note' => array(
            'className' => 'Note',
            'foreignKey' => 'notebook_id',
            // 'conditions' => array('Comment.status' => '1'),
            'order' => 'Note.id DESC',
            // 'limit' => '5',
            'dependent' => true
        )        
    );
    public $belongTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
    );
}
?>