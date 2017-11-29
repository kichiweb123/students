<?php

class Student
{
	public $login;
	public $hash;
	public $name;
	public $sname;
	public $class;
	public $email;
	public $score;
	public $age;
	public $local;
	public $sex;

	function __construct(array $data)
	{
		$this->login = $data['login'];
		$this->hash = $data['hash'];
		$this->name = $data['name'];
		$this->sname = $data['second_name'];
		$this->class = $data['class'];
		$this->email = $data['email'];
		$this->score = $data['score'];
		$this->age = $data['birth_year'];
		$this->local = $data['local'];
		$this->sex = $data['sex'];
	}
}




?>