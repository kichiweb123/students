<?php
class TableControllerRegistration{
	public $login;
	public $pass;
	public $name;
	public $sname;
	public $grup;
	public $email;
	public $score;
	public $age;
	public $local;
	public $sex;

	function __construct(){
		$this->login = $_POST['login'];
		$this->pass = $_POST['pass'];
		$this->name = $_POST['name'];
		$this->sname = $_POST['second_name'];
		$this->grup = $_POST['grup'];
		$this->email = $_POST['email'];
		$this->score = $_POST['score'];
		$this->age = $_POST['age'];
		$this->local = $_POST['local'];
		$this->sex = $_POST['sex'];
	}
}
?>