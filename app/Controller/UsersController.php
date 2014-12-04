<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $name = 'Users';
	public $helpers = array('Session');
	public $components = array('Session');
    public $uses = array('Notebook', 'User');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register', 'logout');
		if(!$this->Auth->login()) {
			$this->Auth->authError = false;
		}
		else $this->Auth->authError = true;
	}

	public function beforeRender() {
		parent::beforeRender();
		if($this->Auth->login()) {
			$this->layout = 'dashboard';
		}
	}

	public function index() {
	}

	public function profile($action = null) {
		if(!$id) {
			throw new NotFoundException(__('User ID is invalid!'));
		}

		$this->User->user_id = $id;
		if(!$this->User->exists()) {
			throw new NotFoundException(__('User is not exist!'));
		}

		$this->set('user', $this->User->read(null, $id));
	}

	public function edit($id = null) {
		if(!$id) {
			throw new NotFoundException(__('User ID is invalid!'));
		}

		$this->User->user_id = $id;
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
		$this->request->allowMethod('post');
		$this->User->user_id = $id;
		if(!$this->User->exists()) {
			throw new NotFoundException('User is not exist!');
			
		}
		if($this->User->delete()) {
			$this->Session->setFlash(__('The user info has been deleted!'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Unable to delete user %s. Please try again', h($this->request->data['User']['user_login'])), 'flash_warning');
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
				// $notebooks = $this->Notebook->create()
				// $this->request->data .= $notebooks;
				// pr($this->request->data);
				$this->Auth->login($this->request->data['User']);
				$this->Session->setFlash(__('The user %s has been added!', h($this->request->data['User']['user_name'])), 'flash_success');
				return $this->redirect(array(
					'controller' => '/user'
					// 'action' => 'index'
					));
			}
			$this->Session->setFlash(__('Unable to add new user. Please try again!'), 'flash_warning');
		}
	}

	public function login() {
        if($this->Auth->User()) {
            $this->redirect(array(
            	'controller' => 'user'
            	// 'action' => 'index'
        	));
        }
		if($this->request->is('post')) {
			// pr($this->request->data);
			// pr($this->Auth->login());
			// $data = $this->request->data;
			// //Get user information
			// $user = $this->User->find(
			// 	'first',
			// 	array(
			// 		'conditions' => array(
			// 			'User.user_login' => $data['User']['user_login'],
			// 			// 'User.user_pass' => $hashedPassword
			// 		),
			// 		'recursive' => -1
			// 	)
			// );
			// //Get hashed password stored in database for request username
			// $hashedPassword = $user['User']['user_pass'];
			// //Check if password is valid
			// $check = $hashedPassword === Security::hash(
			// 	$data['User']['user_pass'],
			// 	'blowfish',
			// 	$hashedPassword
			// );
			// if(!empty($user) && $check && $this->Auth->login($user)) {
			if($this->Auth->login()) {
				// pr($this->Auth->redirectUrl());
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				// debug($this->request->data);
				// debug($this->Auth->login());
				// debug($this->Session->read());
			}
			$this->Session->setFlash(
				__('Invalid username or password, try again!'),
				'flash_danger'
			);
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	// public function isAuthorized($user) {
	// 	// All registered user can create new notes
	// 	if($this->action === 'add') {
	// 		return true;
	// 	}

	// 	//Only admin can edit or delete
	// 	if(in_array($this->action, array('edit', 'delete'))) {
	// 		$noteId = (int) $this->request->params['pass']['0'];
	// 		if($this->Note->isOwnedBy($noteId, $user['id'])) {
	// 			return true;
	// 		}
	// 	}
	// 	return parent::isAuthorized($user);
	// }
}
?>