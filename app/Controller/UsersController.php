<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $name = 'Users';
    public $helpers = array('Session');
    public $components = array(
        // 'Auth',
        'Session',
    );
    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
    }

    public function beforeRender() {
        parent::beforeRender();
        if ($this->Auth->login()) {
            $this->layout = 'dashboard';
        }
    }

    public function index() {

    }

    public function login() {
        if($this->request->is('post')) {
            if($this->Auth->User()) {
                $this->redirect(array(
                    'controller' => 'notes',
                    'action' => 'index'
                ));
            }
            $id = $this->User->find(
                'first',
                array(
                    'conditions' => array('User.id' => $this->request->data['User']['id'])
                )
            );
            if(!empty($id)) {
                $this->Auth->login($this->request->data['User']);
                $this->Session->setFlash(__('The Dropbox user %s has been added!', h($this->request->data['User']['email'])), 'flash_success');
                return $this->redirect(array(
                    'controller' => 'notes',
                    'action' => 'index'
                    ));
            }
            $this->User->create();
            if($this->User->save($this->request->data)) {
                $this->Auth->login($this->request->data['User']);
                $this->Session->setFlash(__('The Dropbox user %s has been added!', h($this->request->data['User']['email'])), 'flash_success');
                return $this->redirect(array(
                    'controller' => 'notes',
                    'action' => 'index'
                    ));
            }
            $this->Session->setFlash(__('Unable to add new Dropbox user. Please try again!'), 'flash_warning');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}

?>
