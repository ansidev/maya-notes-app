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
		'DebugKit.Toolbar',
		'Session',
		// 'Security',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'loginRedirect'	=> array(
				'controller' => 'notes',
				'action' => 'index'
			),
			'loginError' => 'Invalid username or password. Please try again!',
			'logoutRedirect' => array(
				'controller' => '/',
				'action' => '',
			),
			'authenticate' => array(
				'Form' => array(
                    'userModel' => 'User',
                    'passwordHasher' => 'Blowfish',
					'fields' => array(
						'username' => 'user_name',
						'password' => 'user_pass'
					),
				)
			),
			'authorize' => array('Controller')
		),
	);
	public $helpers = array('Form','Html','Session');


	public function beforeFilter() {
		// Cache::clear();
		$this->Auth->allow('display');
		Security::setHash('blowfish');
		$this->set('is_admin', $this->isAdmin());
		$this->set('is_logged_in', $this->isLoggedIn());
		$this->set('users_id', $this->getUsersId());
		$this->set('users_user_name', $this->getUsersUserLogin());
		$this->set('users_display_name', $this->getUsersDisplayName());
	}

	function beforeRender() {
		// if($this->Auth->login()) {
		// 	$this->set('session', $this->Session);
		// }
	}

	//Check if current user is admin or not
	public function isAdmin() {
		if($this->Auth->user('user_role') === 'admin') {
			return true;
		}
		return false;
	}

	//Check if user is logged in or not
	public function isLoggedIn() {
		if($this->Auth->user()) {
			// $this->User->set('is_online', true);
			return true;
		}
		return false;
	}

	//Get logged in user 's 'id' field in table users
	public function getUsersId() {
		if($this->Auth->user()) {
			return $this->Auth->user('id');
		}
		return null;
	}

	//Get logged in user 's 'user_name' field in table users
	public function getUsersUserLogin() {
		if($this->Auth->user()) {
			return $this->Auth->user('user_name');
		}
		return null;
	}

	//Get logged in user 's 'display_name' field in table users
	public function getUsersDisplayName() {
		if($this->Auth->user()) {
			if(!empty($this->Auth->user('display_name'))) {
				return $this->Auth->user('display_name');
			}
			return $this->Auth->user('user_name');
		}
		return null;
	}


	public function isAuthorized() {
		//Any registered user can access public functions
		if($this->Auth->user()) {
			return true;
		}
		// //Only admin can access admin function
		// if(isset($this->request->params['admin'])) {
		// 	return (bool)($user['user_role'] === 'admin');
		// }
		//Default deny
		return false;
	}
}
