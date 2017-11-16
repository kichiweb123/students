<?php
class TableControllerSearch{
	public $search;

	function __construct(){
		$this->search = $_POST['search'];
	}
}
?>