<?php
class NotesController extends AppController {
	var $name = "Notes";
	public $helpers = array('Form','Html','Session');
	public $components = array('Session');

	function index() {
		//Ham find() de lay cac record tu bang cua model
		//Ham set gui du lieu lay duoc den mot mang ten la notes
		$this->set('notes',$this->Note->find('all'));
	}

	function view($id = null) {
		$note = $this->Note->findById($id);
		$this->set('note',$note);
	}

	function add() {
		if($this->request->is('post')) {
			$this->Note->create();
			$post_data = $this->request->data;
			if($this->Note->save($post_data)) {
				$this->Session->setFlash(__('New note created successfully!'));
				return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('Unable to save note. Please try again!'));
			}
		}
	}

	function edit($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Note ID is invalid!'));
		}
		
		$note = $this->Note->findById($id);
		if(!$note) {
			throw new NotFoundException(__('Note is invalid!'));			
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$this->Note->id = $id;
			$post_data = $this->request->data;
			if($this->Note->save($post_data)) {
				$this->Session->setFlash(__('Your note has been updated!'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your note!'));

		}

		if(!$this->request->data) {
			$this->request->data = $note;
		}
	}

	function delete($id = null) {
		if($this->request->is('post')) {
			if($this->Note->delete($id)) {
				$this->Session->setFlash(__('The note ID %s has been deleted.', h($id)));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
}
?>