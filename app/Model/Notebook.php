<?php
App::uses('AppModel','Model');

class Notebook extends AppModel {
    public $name = 'Notebook';
    // public $actAs = array('Tree');
    // public $hasAndBelongsToMany = array(
    //     'Note' => array(
    //         'className' => 'Note',
    //         'joinTable' => 'notebooks_notes',
    //         'foreignKey' => 'notebook_id',
    //         'associationForeignKey' => 'note_id',
    //         'unique' => true,
    //         // 'conditions' => array('Comment.status' => '1'),
    //         'order' => 'Note.note_modified DESC',
    //         // 'limit' => '5',
    //         // 'dependent' => true
    //     ),
    // );
    public $hasMany = array(
        'Note' => array(
            'className' => 'Note',
            'foreignKey' => 'notebook_id',
            // 'conditions' => array('Comment.status' => '1'),
            'order' => 'Note.note_modified DESC',
            // 'limit' => '5',
            'dependent' => true,
        ),
    );

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        ),
    );

    public $validate = array(
        'book_key' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter a key for this notebook',
                'required' => false,
                'allowEmpty' => false,
                'on' => null,
                'last' => true,
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This key is already in use',
            ),
        ),
        'book_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter a name for this notebook',
                'required' => false,
                'allowEmpty' => false,
                'on' => null,
                'last' => true,
            ),
        ),
        'default_book' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Incorrect value',
            ),
        ),
        'book_permission' => array(
            'inList' => array(
                'rule' => array('inList', array('0','1','2','3')),
                'message' => 'Please enter a valid permission for this notebook',
                'required' => true,
                'allowEmpty' => false
            )
        ),
    );
}
?>