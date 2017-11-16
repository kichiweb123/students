<?php
class TableControllerCookie{
	public $login;
	public $pass;

	function __construct(){
		$this->login = $_COOKIE['login'];
		$this->pass = $_COOKIE['pass'];
	}
}
?>