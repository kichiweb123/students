<?php
class Authorisation{
	function authLogin($login, $pass){
		setcookie("login", "$login", 0x7FFFFFFF, '/', null, false, true);
		setcookie("pass", "$pass", 0x7FFFFFFF, '/', null, false, true);
	}

	function exitLogin(){
		setcookie("login", "", 1);
		setcookie("pass", "", 1);
	}
	

}
?>