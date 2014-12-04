<?php

class NotebooksController extends AppController {

    public $name = "Notebook";
    public $components = array('Session', 'RequestHandler');
    public $helpers = array('Js', 'Paginator');
    public $uses = array('User', 'Note', 'Notebook');

    function beforeRender() {
        parent::beforeRender();
        if($this->params['action'] == 'view') {
        	// $this->layout = 'ajax';
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

    public function view($id = null) {
    	// pr($this->Auth->User('id'));
        $this->set('title', 'Note');
        if ($id == null || $id == 'all') {
            $notes = $this->paginate('Note', array(
            	'Note.user_id' => $this->Auth->user('id'),
                'Note.trashed' => FALSE
            ));
        } else if ($id == 'trash') {
            $notes = $this->paginate(
                    'Note', array(
                'Note.user_id' => $this->Auth->user('id'),
                'Note.notebook_id' => $id,
                'Note.trashed' => TRUE
            ));
            $this->set('title', 'Trash');
        } else if ($id == 'uncategorized') {
            $notes = $this->paginate(
                    'Note', array(
            	'Note.user_id' => $this->Auth->user('id'),
                'Note.uncategorized' => TRUE
            ));
            $this->set('title', 'Uncategorized');
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
        $this->set('notes', $notes);
       if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
       }
       else if($this->request->is('get')) {
       		$this->set('request', 'get');
			// $this->layout = 'dashboard';
       }
    }

}

?>