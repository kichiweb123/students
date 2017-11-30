<?php 
$login = strtolower($_POST['login']);
$pass = $_POST['pass'];

$hash = $container['TableStudentsGateway']->getLoginPass($login, $pass);

if($hash){
	$container['Authorisation']->authLogin($login, $hash);

}

require_once "../view/login.phtml";
?>

