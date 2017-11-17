<?php
class Authorisation{
	function authLogin($login, $pass){
		setcookie("login", "$login", 0x7FFFFFFF);
		setcookie("pass", "$pass", 0x7FFFFFFF);
	}

	function exitLogin(){
		setcookie("login", "", 1);
		setcookie("pass", "", 1);
	}
	

}
?>