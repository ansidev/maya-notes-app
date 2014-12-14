<?php

App::uses('AppController', 'Controller');

class DropboxUsersController extends AppController {

    public $name = 'DropboxUsers';
    public $helpers = array('Session');
    public $components = array(
        // 'Auth',
        'Session',
        // 'Dropbox.DropboxApi'
    );
    public $uses = array('User', 'DropboxUser');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'register', 'logout');
        // if (!$this->Auth->login()) {
        //     $this->Auth->authError = false;
        // } else
        //     $this->Auth->authError = true;
    }

    public function beforeRender() {
        parent::beforeRender();
        // if($this->params['action'] == 'integrate_dropbox_account' || $this->params['action'] == 'login_via_dropbox') {
        //     $this->layout = 'ajax';
        // }
        if ($this->Auth->login()) {
            $this->layout = 'dashboard';
        }
    }

    public function index() {

    }
    public function login() {
        if($this->request->is('post')) {
            // pr($this->request->data);
            // pr($this->data);
            $this->DropboxUser->create();
            if($this->DropboxUser->save($this->request->data)) {
                $uid = $this->DropboxUser->uid;
                $this->request->data['DropboxUser'] = array_merge(
                    $this->request->data['DropboxUser'],
                    array('uid' => $uid)
                );
                // $notebooks = $this->Notebook->create()
                // $this->request->data .= $notebooks;
                // pr($this->request->data);
                $this->Auth->login($this->request->data['DropboxUser']);
                $this->Session->setFlash(__('The Dropbox user %s has been added!', h($this->request->data['DropboxUser']['uid'])), 'flash_success');
                return $this->redirect(array(
                    'controller' => 'notebooks',
                    'action' => 'index'
                    ));
            }
            $this->Session->setFlash(__('Unable to add new Dropbox user. Please try again!'), 'flash_warning');
        }
    }

}

?>
