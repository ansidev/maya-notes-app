<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        // 'DebugKit.Toolbar',
        'Session',
        // 'Security',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'loginRedirect' => array(
                'controller' => 'notes',
            ),
            'loginError' => 'Invalid username or password. Please try again!',
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login',
            ),            
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'id',
                    ),
                )
            ),
            'authorize' => array('Controller')
        ),
    );
    public $helpers = array('Form', 'Html', 'Session');
    public $paginate = array(
        'Note' => array(
            'limit' => 10,
            'order' => array(
                'Note.user_id' => 'asc',
                'Note.id' => 'asc',
                'Note.note_title' => 'asc'
            ),
        ),
    );

    public function beforeFilter() {
        $this->Auth->allow('display');
        Security::setHash('blowfish');
        $this->set('is_logged_in', $this->isLoggedIn());
        $this->set('id', $this->getDropboxUserId());
        $this->set('email', $this->getDropboxUserEmail());
        $this->set('display_name', $this->getDropboxUserDisplayName());
    }

    function beforeRender() {
        if ($this->Auth->login()) {
            $this->set('session', $this->Session);
        }
    }

    //Check if user is logged in or not
    public function isLoggedIn() {
        if ($this->Auth->user()) {
            // $this->User->set('is_online', true);
            return true;
        }
        return false;
    }

    //Get logged in user 's 'id' field in table users
    public function getDropboxUserId() {
        if ($this->Auth->user()) {
            return $this->Auth->user('id');
        }
        return null;
    }

    //Get logged in user 's 'user_name' field in table users
    public function getDropboxUserEmail() {
        if ($this->Auth->user()) {
            return $this->Auth->user('email');
        }
        return null;
    }

    // Get Dropbox User 's display name
    public function getDropboxUserDisplayName() {
        if ($this->Auth->user()) {
            return $this->Auth->user('display_name');
        }
        return null;
    }

    public function isAuthorized() {
        //Any logged in user can access public functions
        if ($this->Auth->user()) {
            return true;
        }
        //Default deny
        return false;
    }

}
