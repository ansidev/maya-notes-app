<?php

class NotebooksController extends AppController {

    public $name = "Notebook";
    public $components = array('Session', 'RequestHandler');
    public $helpers = array('Js', 'Paginator');
    public $uses = array('User', 'Note', 'Notebook');
    public $paginate = array(
        // 'Notebook' => array(
        //     'limit' => 10,
        //     'order' => array(
        //         'Notebook.user_id' => 'asc',
        //         'Notebook.id' => 'asc',
        //         'Notebook.book_name' => 'asc'
        //     ),
        // ),
        'Note' => array(
            'limit' => 10,
            'fields' => array(
                'Note.id',
                'Note.user_id',
                'Note.note_title',
                'Note.note_modified',
                'Note.trashed'
            ),
            'order' => array(
                'Note.user_id' => 'asc',
                'Note.note_modified' => 'desc'
            ),
        ),
    );

    function beforeRender() {
        parent::beforeRender();
        if($this->params['action'] == 'json') {
        	$this->layout = 'ajax';
        }
        else {
        	$this->layout = 'panel';
        }
    }

    function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        $this->Notebook->recursive = 1;
        $this->set(
                'notebooks', $this->paginate(
                        'Notebook', array(
                    'Notebook.user_id' => $this->Auth->user('id'),
        )));
        $notes = $this->paginate('Note', array(
        	'Note.user_id' => $this->Auth->user('id'),
            'Note.trashed' => FALSE
        ));
        $this->set('notes', $notes);
    }

    public function json($id = null) {
        $this->layout = 'ajax';
        $this->Note->recursive = 0;
        if ($id == null || $id == 'all') {
            $notes = $this->paginate(
                'Note',
                array(
            	'Note.user_id' => $this->Auth->user('id'),
                'Note.trashed' => FALSE
                ),
                array(
                    'Note.note_title'
                )
            );
        } else if ($id == 'trash') {
            $notes = $this->paginate(
                    'Note', array(
                'Note.user_id' => $this->Auth->user('id'),
                'Note.trashed' => TRUE
            ));
        } else if ($id == 'uncategorized') {
            $notes = $this->paginate(
                    'Note', array(
            	'Note.user_id' => $this->Auth->user('id'),
                'Note.uncategorized' => TRUE
            ));
        } else {
			if (!$this->Notebook->isOwnedBy($id, $this->Auth->user('id'))) {
	            throw new ForbiddenException(__('You are not the owner'));
	        }
            $notes = $this->paginate(
                    'Note', array(
            	// 'Note.user_id' => $this->Auth->user('id'),
                'Note.notebook_id' => $id,
                'Note.trashed' => FALSE
            ));
        }
        $this->set('notes', json_encode($notes));
    }

}

?>