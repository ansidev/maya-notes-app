<?php
class NotesController extends AppController {
	public $name = "Notes";
	// public $helpers = array('Form','Html','Session');
	public $components = array('Session');
	public $uses = array('User', 'Note', 'Notebook');

	public function beforeRender() {
		parent::beforeRender();
	}

	public function beforeFilter() {
		parent::beforeFilter();
		
	}

    private function __getAvailableNotebooks() {
		return $this->Note->Notebook->find(
			'list',
			array(
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
			'list',
			array(
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

    private function __getUncategorizedId() {
    	$this->Notebook->recursive = 0;
		$query = $this->Notebook->find(
			'first',
			array(
				'conditions' => array(
					'user_id' => $this->Auth->User('id'),
					'default_book' => true,
					'book_name' => 'Uncategorized'
				)
				// 'fields' => array(
				// 	'Notebook.book_name'
				// )
			)
		);
		return $query['Notebook']['id'];
    }

    private function __getTrashId() {
    	$this->Notebook->recursive = 0;
    	$zero = "0";
		$query = $this->Notebook->find(
			'first',
			array(
				'conditions' => array(
					'user_id' => $this->Auth->User('id'),
					'default_book' => true,
					// 'permitted' => (string)(0 + 0),
					'book_name' => 'Trash'
				)
				// 'fields' => array(
				// 	'Notebook.book_name'
				// )
			)
		);
		// debug($query);	
		return $query['Notebook']['id'];
    }

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
		// $this->User->Note->recursive = 1;
		$this->Notebook->recursive = 1;
		// $this->set('total', $this->User->Note->find(
		// 	'count',
		// 	array(
		// 		'conditions' => array(
		// 			'Note.user_id' => $this->Auth->User('id')
		// 		),
		// 	)
		// ));
		// $this->set('curr_user_notes', $this->User->Note->find(
		// 	'all',
		// 	array(
		// 		'conditions' => array(
		// 			'Note.user_id' => $this->Auth->User('id')
		// 		),
		// 		'contains' => array(
		// 			'Notebook',
		// 			'User' => array(
		// 				'contains' => false
		// 			)
		// 		)
		// 	)
		// ));
		// $this->set('curr_user_notebooks', $this->Notebook->find(
		// 	'all',
		// 	array(
		// 		'conditions' => array(
		// 			'Notebook.user_id' => $this->Auth->User('id')
		// 		),
		// 		'contains' => array(
		// 			'Note' => array(
		// 				'order' => 'Note.note_modified DESC'
		// 			)
		// 		),
		// 		// 'limit' => 10,
		// 	)
		// ));
		//Get normal default notebooks
		$arr1 = $this->Notebook->find(
			'all',
			array(
				'conditions' => array(
					'user_id' => $this->Auth->User('id'),
					'default_book' => true,
					'book_permission' => 'one',
				),
				// 'fields' => array(
				// 	'id',
				// 	'book_name',
				// ),
			)
		);
		//Get user-defined notebooks
		$arr2 = $this->Notebook->find(
			'all',
			array(
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
			'all',
			array(
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
		// pr($arr1);
		// pr($arr2);
		// pr($arr3);
		// foreach ($arr1 as $key => $value) {
		// 	pr($key);
		// 	pr($value);
		// }
		$curr_user_notebooks = $this->__mergeNotebooks($arr1, $arr2);
		$curr_user_notebooks = $this->__mergeNotebooks($curr_user_notebooks, $arr3);
		// pr($curr_user_notebooks);
		$this->set('curr_user_notebooks', $curr_user_notebooks);
	}

	public function view($id = null) {
		$note = $this->Note->findById($id);
		$this->set('note', $note);
	}

	public function add() {
		//Get list of all available current user's notebooks
		$notebooks = $this->__getAvailableNotebooks();
		$this->set('notebooks', $notebooks);

		//Get id of notebook Uncategorized
		$uncategorized = $this->__getUncategorizedId();
		$this->set('uncategorized', $uncategorized);
		if($this->Auth->login()) {
			$this->layout = 'default';
			if($this->request->is('post')) {
				pr($this->request->data);
				$this->Note->create();
				// pr($this->request->data);
				$this->request->data['Note']['user_id'] = $this->Auth->user('id');
				$this->request->data['Note']['note_body'] = htmlspecialchars($this->request->data['Note']['note_body']);
				//Set default notebook if empty
				if(empty($this->request->data['Notebook'])) {
					$this->request->data['Note']['notebook_id'] = $uncategorized;
				}
				// pr($this->request->data);
				if($this->Note->save($this->request->data)) {
					$this->Session->setFlash(__('New note created successfully!'), 'flash_success');
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Unable to save note. Please try again!'), 'flash_warning');
				}
			}
		}
		else {
			throw new NotFoundException(__('Not found'));
		}
	}

	// public function form() {
	// 	//Get list of all available current user's notebooks
	// 	// $notebooks = $this->__getNoteBook();
	// 	$notebooks = $this->Note->Notebook->find('list', array('fields' => array('id', 'book_name')));
	// 	$this->set('notebooks', $notebooks);

	// 	//Get id of notebook Uncategorized
	// 	$uncategorized = $this->__getUncategorizedId();
	// 	$this->set('uncategorized', $uncategorized);
	// 	if($this->Auth->login()) {
	// 		$this->layout = 'default';
	// 		if($this->request->is('post')) {
	// 			pr($this->request->data);
	// 			$this->Note->create();
	// 			// pr($this->request->data);
	// 			$this->request->data['Note']['user_id'] = $this->Auth->user('id');
	// 			$this->request->data['Note']['note_body'] = htmlspecialchars($this->request->data['Note']['note_body']);
	// 			//Set default notebook if empty
	// 			if(empty($this->request->data['Note']['notebook_id'])) {
	// 				$this->request->data['Note']['notebook_id'] = $uncategorized;
	// 			}
	// 			if($this->Note->save($this->request->data)) {
	// 				$this->Session->setFlash(__('New note created successfully!'), 'flash_success');
	// 				return $this->redirect(array('action' => 'index'));
	// 			} else {
	// 				$this->Session->setFlash(__('Unable to save note. Please try again!'), 'flash_warning');
	// 			}
	// 		}
	// 	}
	// 	else {
	// 		throw new NotFoundException(__('Not found'));
	// 	}
	// }

	public function edit($id = null) {
		//Get list of all available current user's notebooks
		$notebooks = $this->__getAvailableNotebooks();
		$this->set('notebooks', $notebooks);

		//Get id of notebook Uncategorized
		$uncategorized = $this->__getUncategorizedId();

		if(!$id) {
			throw new NotFoundException(__('Note ID is invalid!'));
		}
		
		$note = $this->Note->findById($id);
		$this->set('note', $note);
		pr($note);
		if(!$note) {
			throw new NotFoundException(__('Note is invalid!'));
		}
		if($note['Note']['user_id'] != $this->Auth->User('id')) {
			throw new ForbiddenException(__('You are not allowed to edit this note!'));
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$this->Note->id = $id;
			//Encode HTML before saving
			$this->request->data['Note']['note_body'] = htmlspecialchars($this->request->data['Note']['note_body']);

			//Set default notebook if empty
			if(empty($this->request->data['Note']['notebook_id'])) {
				$this->request->data['Note']['notebook_id'] = $uncategorized;
			}
			if($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('Your note has been updated!'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your note!'), 'flash_warning');

		}

		if(!$this->request->data) {
			$this->request->data = $note;
		}
	}

	public function moveToTrash($id = null) {
		$trash_id = $this->__getTrashId();
		if(!$id) {
			throw new NotFoundException(__('Note ID is invalid!'));
		}
		
		$note = $this->Note->findById($id);
		$this->set('note', $note);
		if(!$note) {
			throw new NotFoundException(__('Note is invalid!'));			
		}

		// if($this->request->is('get')) {
		// 	throw new MethodNotAllowedException();
			
		// }
		// else {
		// if($this->request->is('post') || $this->request->is('put')) {
			$this->Note->id = $id;
			$this->Note->saveField('notebook_id', $trash_id);
			if($this->Note->saveField('notebook_id', $trash_id)) {
			// $this->request->data['Note']['notebook_id'] = $trash_id;
			// if($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('Your note has been moved to Trash!'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to move your note to trash!'), 'flash_warning');

		// }

		if(!$this->request->data) {
			$this->request->data = $note;
		}
	}

	public function delete($id = null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
			
		}
		if($this->request->is('post')) {
			// pr($this->Note->delete($id));
			if($this->Note->delete()) {
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