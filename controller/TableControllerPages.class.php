<?php
class TableControllerPages{
	public $pageid;
	public $sort;

	function __construct(){
		$this->pageid = $_GET['id'];
		$this->sort = $_GET['sort'];
	}
}
?>