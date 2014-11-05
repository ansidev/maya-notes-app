<?php
class UsersController extends AppController {
	public $scaffold;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'logout');
	}


	public function index() {
		$this->User->recursive = 0;
		$this->set('user' => $this->paginate());
	}

	public function view($id = null) {
		if(!$id) {
			throw new NotFoundException(__('User ID is invalid!'));
		}

		$this->User->id = $id;
		if(!$this->User->exists()) {
			throw new NotFoundException(__('User is not exist!'));
		}

		$this->set('user' => $this->User->read(null, $id));
	}

	public function add() {
		if($this->request->is('post')) {
			$this->User->create();
			if($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user %s has been added!', h($this->request->data['User']['user_login'])));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add new user. Please try again!'));
		}
	}

	public function edit($id = null) {
		if(!$id) {
			throw new NotFoundException(__('User ID is invalid!'));
		}

		$this->User->id = $id;
		if(!$this->User->exists()) {
			throw new NotFoundException(__('User is not exist!'));
		}

		if($this->request->is('post') || $this->request->is('put')) {
\			if($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The user info has been updated!'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update the user info. Please try again!'));

		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['user_pass']);
		}
	}

	public function delete($id = null) {
		$this->request->onlyAllow('post');
		$this->User->id = $id;
		if(!$this->User->exists()) {
			throw new NotFoundException('User is not exist!');
			
		}
		if($this->User->delete()) {
			$this->Session->setFlash(__('The user info has been deleted!'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Unable to delete user %s. Please try again', h($this->request->data['User']['user_login'])));
		return $this->redirect(array('action' => 'index'));
	}

	public function login() {
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Invalid username or password, try again!'));
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
?>