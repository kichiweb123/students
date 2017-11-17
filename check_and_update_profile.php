<?php


$name = $_POST['name'];
$sname = $_POST['second_name'];
$grup = $_POST['grup'];
$email = $_POST['email'];
$score = $_POST['score'];
$age = $_POST['age'];


$val = new Validation();
$errors = $val->validateProfile($name, $sname, $score);
if(!$errors){
	$table->refreshStudent($login, $pass, $name, $sname, $grup, $email, $score, $age);
}
?>