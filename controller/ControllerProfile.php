<?php

$login = $_COOKIE['login'];
$pass = $_COOKIE['pass'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
	require_once "../refreshStudent.php";
}

$editProf = $table->getAuthUser($login, $pass);

require_once "../view/profile.phtml";
?>

