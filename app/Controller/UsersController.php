<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	// public $scaffold;
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register', 'logout');
		if(!$this->Auth->loggedIn()) {
			$this->Auth->authError = false;
		}
	}


	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		// $this->helpers['Paginator'] = array('ajax' => 'CustomJS');
	}

	public function view($id = null) {
		if(!$id) {
			throw new NotFoundException(__('User ID is invalid!'));
		}

		$this->User->id = $id;
		if(!$this->User->exists()) {
			throw new NotFoundException(__('User is not exist!'));
		}

		$this->set('user', $this->User->read(null, $id));
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
			if($this->User->save($this->request->data)) {
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

	public function register() {
		if($this->request->is('post')) {
			$this->User->create();
			if($this->User->save($this->request->data)) {
				$id = $this->User->id;
				$this->request->data['User'] = array_merge(
					$this->request->data['User'],
					array('id' => $id)
				);
				$this->Auth->login($this->request->data['User']);
				// $this->Session->setFlash(__('The user %s has been added!', h($this->request->data['User']['user_login'])));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add new user. Please try again!'));
		}
	}

	public function login() {
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				Debugger::debug($this->Auth->login());
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(
				__('Invalid username or password, try again!'),
				array(),
				'auth'
			);
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
?>