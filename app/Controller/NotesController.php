<?php
class NotesController extends AppController {
	var $name = "Notes";

	function index() {
		//Ham find() de lay cac record tu bang cua model
		//Ham set gui du lieu lay duoc den mot mang ten la notes
		$this->set('notes',$this->Note->find('all'));
	}
}
?>