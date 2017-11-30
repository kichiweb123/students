<?php
/*Класс нужен для установки, удаления кук*/
class Authorisation{
	public $tableStudentGateway;
    function __construct(TableStudentsGateway $TableStudentsGateway){
        $this->tableStudentGateway = $TableStudentsGateway;
    }

    function authLogin($login, $pass){
        setcookie("login", "$login", strtotime('+10 years'), '/', null, false, true);
        setcookie("pass", "$pass", strtotime('+10 years'), '/', null, false, true);
    }

    function exitLogin(){
        setcookie("login", "", time() - 3600);
        setcookie("pass", "", time() - 3600);
    }
    


}
?>