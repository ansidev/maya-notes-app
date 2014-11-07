<?php
class NotesController extends AppController {
	public $name = "Notes";
	public $helpers = array('Form','Html','Session');
	public $components = array('Session');

	public function index() {
		//Ham find() de lay cac record tu bang cua model
		//Ham set gui du lieu lay duoc den mot mang ten la notes
		$this->set('notes',$this->Note->find('all'));
	}

	public function view($id = null) {
		$note = $this->Note->findById($id);
		$this->set('note',$note);
	}

	public function add() {
		if($this->request->is('post')) {
			$this->request->data['Note']['user_id'] = $this->Auth->user('id');
			$this->Note->create();
			if($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('New note created successfully!'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Unable to save note. Please try again!'));
			}
		}
	}

	public function edit($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Note ID is invalid!'));
		}
		
		$note = $this->Note->findById($id);
		if(!$note) {
			throw new NotFoundException(__('Note is invalid!'));			
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$this->Note->id = $id;
			if($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('Your note has been updated!'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your note!'));

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
			if($this->Note->delete($id)) {
				$this->Session->setFlash(__('The note ID %s has been deleted.', h($id)));
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