<?php

class NotesController extends AppController {

    public $name = "Notes";
    // public $helpers = array('Form','Html','Session');
    public $components = array('Session');
    public $uses = array('User', 'Note', 'Notebook');

    public $paginate = array(
        'Note' => array(
            'limit' => 10,
            'fields' => array(
                'Note.id',
                'Note.note_title',
                'Note.note_body',
                'Note.note_modified'
            ),
            'order' => array(
                'Note.user_id' => 'asc',
                'Note.note_modified' => 'desc'
            ),
        ),
    );

    public function beforeRender() {
        parent::beforeRender();
    }

    public function beforeFilter() {
        parent::beforeFilter();
    }

    private function __getAvailableNotebooks() {
        return $this->Note->Notebook->find(
                        'list', array(
                    'conditions' => array(
                        'user_id' => $this->Auth->User('id'),
                        // 'default_book' => true,
                        'NOT' => array(
                            'book_name' => array('Shared', 'Trash'),
                            'book_permission' => 'zero',
                        )
                    ),
                    'fields' => array(
                        'id',
                        'book_name',
                    )
                        )
        );
    }

    private function __getAllNotebooks() {
        return $this->Note->Notebook->find(
                        'list', array(
                    'conditions' => array(
                        'user_id' => $this->Auth->User('id'),
                        'default_book' => true,
                        'NOT' => array(
                            'book_name' => array('Shared', 'Trash'),
                        )
                    ),
                    'fields' => array(
                        'id',
                        'book_name',
                    )
                        )
        );
    }

    //   private function __getUncategorizedId() {
    //   	$this->Notebook->recursive = 0;
    // $query = $this->Notebook->find(
    // 	'first',
    // 	array(
    // 		'conditions' => array(
    // 			'user_id' => $this->Auth->User('id'),
    // 			'default_book' => true,
    // 			'book_permission' => 'zero',
    // 			// 'book_key' => 'uncategorized-' . $this->Auth->User('id'),
    // 		)
    // 		// 'fields' => array(
    // 		// 	'Notebook.book_name'
    // 		// )
    // 	)
    // );
    // return $query['Notebook']['id'];
    //   }
    //   private function __getTrashId() {
    //   	$this->Notebook->recursive = 0;
    //   	$zero = "0";
    // $query = $this->Notebook->find(
    // 	'first',
    // 	array(
    // 		'conditions' => array(
    // 			'Notebook.user_id' => $this->Auth->User('id'),
    // 			'default_book' => true,
    // 			'book_permission' => 'zero',
    // 			// 'book_key' => 'trash-' . $this->Auth->User('id'),
    // 		)
    // 		// 'fields' => array(
    // 		// 	'Notebook.book_name'
    // 		// )
    // 	)
    // );
    // // pr($query);	
    // return $query['id'];
    //   }

    private function __mergeNotebooks($notebook1, $notebook2) {
        $notebook = array();
        foreach ($notebook1 as $key => $value) {
            $notebook[] = $value;
        }
        foreach ($notebook2 as $key => $value) {
            $notebook[] = $value;
        }
        return $notebook;
    }

    public function index() {
        $this->layout = 'dashboard';
        // $this->set('user_id', $this->Auth->User('id'));
        // $notes = $this->paginate('Note');
        // pr($notes);
        // $this->set('notes', $notes);
        $this->Note->recursive = 1;
        $this->Notebook->recursive = 1;
        // Get all notes of current user
        $curr_user_notes = $this->Note->find(
                'all', array(
            'conditions' => array(
                'Note.user_id' => $this->Auth->User('id'),
            ),
            'order' => array('note_modified DESC'),
                )
        );
        $this->set('curr_user_notes', $curr_user_notes);
        // Get count values
        $all_total = $this->Note->find(
                'list', array(
            'conditions' => array(
                'Note.user_id' => $this->Auth->User('id'),
            ),
            'order' => array('note_modified DESC'),
                )
        );
        $this->set('all_total', count($all_total));
        $uncategorized_total = $this->Note->find(
                'list', array(
            'conditions' => array(
                'Note.user_id' => $this->Auth->User('id'),
                'Note.uncategorized' => true,
            ),
            'order' => array('note_modified DESC'),
                )
        );
        $this->set('uncategorized_total', count($uncategorized_total));
        $shared_total = $this->Note->find(
                'list', array(
            'conditions' => array(
                'Note.user_id' => $this->Auth->User('id'),
                'Note.shared' => true,
            ),
            'order' => array('note_modified DESC'),
                )
        );
        $this->set('shared_total', count($shared_total));
        $trashed_total = $this->Note->find(
                'list', array(
            'conditions' => array(
                'Note.user_id' => $this->Auth->User('id'),
                'Note.trashed' => true,
            ),
            'order' => array('note_modified DESC'),
                )
        );
        $this->set('trashed_total', count($trashed_total));
        // Get normal default notebooks
        $arr1 = $this->Notebook->find(
                'all', array(
            'conditions' => array(
                'user_id' => $this->Auth->User('id'),
                'default_book' => true,
            ),
                // 'fields' => array(
                // 	'id',
                // 	'book_name',
                // ),
                )
        );
        //Get user-defined notebooks
        $arr2 = $this->Notebook->find(
                'all', array(
            'conditions' => array(
                'user_id' => $this->Auth->User('id'),
                'default_book' => false,
            ),
                // 'fields' => array(
                // 	'id',
                // 	'book_name',
                // ),
                )
        );
        //Get special default notebooks
        $arr3 = $this->Notebook->find(
                'all', array(
            'conditions' => array(
                'user_id' => $this->Auth->User('id'),
                'default_book' => true,
                'book_permission' => 'zero',
            ),
                // 'fields' => array(
                // 	'id',
                // 	'book_name',
                // ),
                )
        );
        $curr_user_notebooks = $this->__mergeNotebooks($arr1, $arr2);
        $curr_user_notebooks = $this->__mergeNotebooks($curr_user_notebooks, $arr3);
        // pr($curr_user_notebooks);
        $this->set('curr_user_notebooks', $curr_user_notebooks);
        // $this->set('trash_id', $this->__getTrashId());
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
                'Note.trashed' => FALSE
            ));
        }
        $note[0]['Note']['note_body'] = htmlspecialchars_decode($note[0]['Note']['note_body']);
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
        $notebooks = $this->__getAvailableNotebooks();
        $this->set('notebooks', $notebooks);

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
                    return $this->redirect(array('controller' => 'user'));
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
                return $this->redirect(array('controller' => 'user'));
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
            return $this->redirect(array('controller' => 'user'));
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