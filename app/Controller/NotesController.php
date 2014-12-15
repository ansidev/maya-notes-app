<?php

class NotesController extends AppController {

    public $name = "Notes";
    // public $helpers = array('Form','Html','Session');
    public $components = array('Session');
    public $uses = array('User', 'Note', 'Notebook');

    public $paginate = array(
        'Note' => array(
            'limit' => 10,
            // 'fields' => array(
            //     'Note.id',
            //     'Note.note_title',
            //     'Note.note_body',
            //     'Note.note_modified'
            // ),
            'order' => array(
                'Note.user_id' => 'asc',
                'Note.note_modified' => 'desc'
            ),
        ),
    );

    public function beforeRender() {
        parent::beforeRender();
        if ($this->Auth->login()) {
            $this->layout = 'dashboard';
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index($arg = null) {
        // $this->Notebook->recursive = 0;
        $notes = $this->paginate(
                        'Note', array(
                    'Note.user_id' => $this->Auth->user('id'),
        ));
        // pr($notebooks); 
        if(!empty($this->params['requested'])) {
            return $notes;
        }
        $this->set('notes', $notes);
    }

    public function view($id = null) {
        $this->Note->recursive = 1;
        if ($id == null) {
            $note = $this->paginate(
                    'Note', array(
                'Note.user_id' => $this->Auth->user('id'),
                // 'Note.id' => $id,
                'Note.trashed' => FALSE
            ));
            // throw new NotFoundException(__('Empty ID! Please provide an id to view note!'));
            
        } else if ($id == 'trash') {
            $note = $this->paginate(
                    'Note', array(
                'Note.user_id' => $this->Auth->user('id'),
                'Note.id' => $id,
                'Note.trashed' => TRUE
            ));
        } else {
            if (!$this->Note->isOwnedBy($id, $this->Auth->user('id'))) {
                throw new ForbiddenException(__('You are not the owner'));
            }
            $note = $this->paginate(
                    'Note', array(
                'Note.user_id' => $this->Auth->user('id'),
                'Note.id' => $id,
                'Note.trashed' => FALSE
            ));
        }
        // pr($note);
        $this->set('note', $note);
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
        else if($this->request->is('get')) {
            $this->set('request', 'get');
            // $this->layout = 'dashboard';
        }
    }

    public function json($id = null) {
        $this->layout = 'ajax';
        $this->Note->recursive = 1;
        if ($id == null) {
            $note = $this->paginate(
                    'Note', array(
                'Note.user_id' => $this->Auth->user('id'),
                // 'Note.id' => $id,
                'Note.trashed' => FALSE
            ));
            // throw new NotFoundException(__('Empty ID! Please provide an id to view note!'));
            
        } else if ($id == 'trash') {
            $note = $this->paginate(
                    'Note', array(
                'Note.user_id' => $this->Auth->user('id'),
                'Note.id' => $id,
                'Note.trashed' => TRUE
            ));
        } else {
            if (!$this->Note->isOwnedBy($id, $this->Auth->user('id'))) {
                throw new ForbiddenException(__('You are not the owner'));
            }
            $note = $this->paginate(
                    'Note', array(
                'Note.user_id' => $this->Auth->user('id'),
                'Note.id' => $id,
            ));
        }
        $note[0]['Note']['note_body'] = htmlspecialchars_decode($note[0]['Note']['note_body']);
        // pr($note);
        $this->set('note', json_encode($note));
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
        else if($this->request->is('get')) {
            $this->set('request', 'get');
            // $this->layout = 'dashboard';
        }
    }

    public function add() {
        //Get list of all available current user's notebooks
        if ($this->Auth->login()) {
            $this->layout = 'default';
            if ($this->request->is('post')) {
                pr($this->request->data);
                $this->Note->create();
                // pr($this->request->data);
                $this->request->data['Note']['user_id'] = $this->Auth->user('id');
                $this->request->data['Note']['note_body'] = htmlspecialchars($this->request->data['Note']['note_body']);
                //Set default notebook if empty
                if (empty($this->request->data['Note']['notebook_id'])) {
                    $this->request->data['Note']['uncategorized'] = true;
                } else {
                    $this->request->data['Note']['uncategorized'] = false;
                }
                if ($this->Note->save($this->request->data)) {
                    $this->Session->setFlash(__('New note created successfully!'), 'flash_success');
                    return $this->redirect(array('controller' => 'notes'));
                } else {
                    $this->Session->setFlash(__('Unable to save note. Please try again!'), 'flash_warning');
                }
            }
        } else {
            throw new NotFoundException(__('Not found'));
        }
    }

    public function edit($id = null) {
        //Get list of all available current user's notebooks
        $notebooks = $this->__getAvailableNotebooks();
        $this->set('notebooks', $notebooks);

        if (!$id) {
            throw new NotFoundException(__('Note ID is invalid!'));
        }

        $note = $this->Note->findById($id);
        $this->set('note', $note);

        if (!$note) {
            throw new NotFoundException(__('Note is invalid!'));
        }
        if ($note['Note']['user_id'] != $this->Auth->User('id')) {
            throw new ForbiddenException(__('You are not allowed to edit this note!'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Note->id = $id;
            //Encode HTML before saving
            $this->request->data['Note']['note_body'] = htmlspecialchars($this->request->data['Note']['note_body']);

            //Set default notebook if empty
            if (empty($this->request->data['Note']['notebook_id'])) {
                $this->request->data['Note']['uncategorized'] = true;
            } else {
                $this->request->data['Note']['uncategorized'] = false;
            }
            if ($this->Note->save($this->request->data)) {
                $this->Session->setFlash(__('Your note has been updated!'), 'flash_success');
                return $this->redirect(array('controller' => 'notes'));
            }
            $this->Session->setFlash(__('Unable to update your note!'), 'flash_warning');
            // pr($this->request->data);
        }

        if (!$this->request->data) {
            $this->request->data = $note;
        }
    }

    public function moveToTrash($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Note ID is invalid!'));
        }

        $note = $this->Note->findById($id);
        $this->set('note', $note);
        if (!$note) {
            throw new NotFoundException(__('Note is invalid!'));
        }

        // if($this->request->is('get')) {
        // 	throw new MethodNotAllowedException();
        // }
        // else
        // if($this->request->is('post') || $this->request->is('put')) {
        $this->Note->id = $id;
        // $this->request->data = $note;
        $this->Note->saveField('trashed', true);
        // pr($note);
        // pr($this->request->data);
        if ($this->Note->saveField('trashed', true)) {
            $this->Session->setFlash(__('Your note has been moved to Trash!'), 'flash_success');
            return $this->redirect(array('controller' => 'notes'));
        }
        $this->Session->setFlash(__('Unable to move your note to trash!'), 'flash_warning');
        // 	}
        // }

        if (!$this->request->data) {
            $this->request->data = $note;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->request->is('post')) {
            // pr($this->Note->delete($id));
            if ($this->Note->delete()) {
                $this->Session->setFlash(__('The note ID %s has been deleted.', h($id)), 'flash_success');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

//	public function isAuthorized($user) {
//		//All registered user can create new notes
//		if($this->action === 'add') {
//			return true;
//		}
//
//		//Only admin can edit or delete
//		if(in_array($this->action, array('edit', 'delete'))) {
//			$noteId = (int) $this->request->params['pass']['0'];
//			if($this->Note->isOwnedBy($noteId, $user['id'])) {
//				return true;
//			}
//		}
//
//		return parent::isAuthorized($user);
//	}
}

?>