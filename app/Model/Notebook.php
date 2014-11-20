<?php
App::uses('AppModel','Model');

class Notebook extends AppModel {
	public $hasMany = 'Note';
}
?>