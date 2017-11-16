<?php
$login = $table->clearStr($_POST['login']);
$pass = $table->clearStr($_POST['pass']);
$name = $table->clearStr($_POST['name']);
$sname = $table->clearStr($_POST['second_name']);
$grup = $table->clearInt($_POST['grup']);
$email = $table->clearStr($_POST['email']);
$score = $table->clearInt($_POST['score']);
$age = $table->clearInt($_POST['age']);
$local = $_POST['local'];
$sex = $_POST['sex'];

$table->saveTable($login, $pass, $name, $sname, $grup, $email, $score, $age, $local, $sex);
if(!$errors){
setcookie("login", $login, 0x7FFFFFFF);
setcookie("pass", $pass, 0x7FFFFFFF);
header('Location: index.php?id=edit_profile');
}
?>