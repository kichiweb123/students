<?php
/*Класс нужен для установки, удаления кук*/
class Authorisation{
	public $tableStudentGateway;
    function __construct(TableStudentsGateway $TableStudentsGateway){
        $this->tableStudentGateway = $TableStudentsGateway;
    }
    function isLogin($login, $pass = false){
    	$result = $this->tableStudentGateway->getLoginPass();
    	if($login and $pass){
    		while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $hash = password_verify($pass, $row['password_hash']);
                if(($row['login'] == $login) and ($hash)){
                    
                    return $row['password_hash'];
                }
            }
    	}

    	if($login){
    		while($row = $result->fetch_array(MYSQLI_ASSOC)){

                if($row['login'] == $login){
                
                    return true;
                }
    	}
        }
	}

    function isEmailUsed($email){
        $result = $this->tableStudentGateway->getEmail();

        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            
                if($row['email'] == $email){
                    
                    return true;
                }
    }
    }
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