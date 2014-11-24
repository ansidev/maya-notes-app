<?php
class NotesController extends AppController {
	public $name = "Notes";
	// public $helpers = array('Form','Html','Session');
	public $components = array('Session');
	public $uses = array('User', 'Note', 'Notebook');

	public function beforeRender() {
		parent::beforeRender();
	}

	public function index() {
		$this->layout = 'dashboard';
		// $this->Note->recursive = 1;
		// $this->Note->contain();
		// pr($this->Note->find('all', array('contain' => 'Notebook')));
		//Ham find() de lay cac record tu bang cua model
		//Ham set gui du lieu lay duoc den mot mang ten la notes
		// $this->set('users', $this->paginate());
		$temp = $this->User->Notebook->findAllByUserId($this->Auth->User('id'));
		// $temp = $this->User->Notebook->findAllByDefaultBookOrUserId(
		// 		'1',
		// 		$this->Auth->User('id'),
		// 		array(
		// 			'Notebook.id',
		// 			'Notebook.book_name'
		// 		)
		// 	);
		// pr($temp);
		$this->set('curr_user_notebooks', $temp);
		if($this->Session->check('CurrentUser.notebooks')) {
			$this->Session->delete('CurrentUser.notebooks');
			$this->Session->write('CurrentUser.notebooks', $temp);
		}
		else {
			$this->Session->write('CurrentUser.notebooks', $temp);
		}
	}

	public function view($id = null) {
		$note = $this->Note->findById($id);
		$this->set('note',$note);
	}

	public function add() {
		if($this->Auth->login()) {
			$this->layout = 'default';
			if($this->request->is('post')) {
				$this->Note->create();
				$this->request->data['Note']['user_id'] = $this->Auth->user('id');
				if($this->Note->save($this->request->data)) {
					$this->Session->setFlash(__('New note created successfully!'), 'flash_success');
					return $this->redirect(array('controller' => 'users', 'action' => 'index'));
				} else {
					$this->Session->setFlash(__('Unable to save note. Please try again!'), 'flash_warning');
				}
			}
		}
		else {
			throw new NotFoundException(__('Not found'));
		}
	}

	public function edit($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Note ID is invalid!'));
		}
		
		$note = $this->Note->findById($id);
		$this->set('note', $note);
		if(!$note) {
			throw new NotFoundException(__('Note is invalid!'));			
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$this->Note->id = $id;
			// pr($this->request->data);
			if($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('Your note has been updated!'), 'flash_success');
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your note!'), 'flash_warning');

		}

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