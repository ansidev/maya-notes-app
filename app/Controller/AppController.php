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
			'loginRedirect'	=> array(
				'controller' => 'users',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login',
			),
			'authenticate' => array(
				'Form' => array(
                    'userModel' => 'User',
                   'passwordHasher' => 'Blowfish',
					'fields' => array(
						'user_email' => 'email',
						'user_pass' => 'password'
					),
				)
			),
			'authorize' => array('Controller')
		),
	);

	public function beforeFilter() {
		$this->Auth->allow('index', 'view');
		Security::setHash('blowfish');
	}

	public function isAuthorized($user) {
		//Any registered user can access public functions
		if(empty($this->request->params['admin'])) {
			return true;
		}
		//Only admin can access admin function
		if(isset($this->request->params['admin'])) {
			return (bool)($user['user_role'] === 'admin');
		}
		//Default deny
		return false;
	}
}
