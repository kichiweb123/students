<?php
$login = $_POST['login'];
$pass = $_POST['pass'];
$name = $_POST['name'];
$sname = $_POST['second_name'];
$grup = $_POST['grup'];
$email = $_POST['email'];
$score = $_POST['score'];
$age = $_POST['age'];
$local = $_POST['local'];
$sex = $_POST['sex'];


$val = new Validation();
$errors = $val->validateStudent($login, $pass, $name, $sname, $grup, $email, $score, $age, $local, $sex);
$auth = new Authorisation();
if(!$errors){
$table->addStudent($login, $pass, $name, $sname, $grup, $email, $score, $age, $local, $sex);
$auth->authLogin($login, $pass);
header('Location: http://test1.ru/?id=edit_profile');

}
?>