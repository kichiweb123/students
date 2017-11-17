<?php
class TableStudentsGateway{
	const DB_ADDR = "localhost";
	const DB_LOGIN = "root";
	const DB_PASS = "";
	const DB_NAME = "table";

	public $_db = null;

	function __construct(){
		$this->_db = new mysqli(self::DB_ADDR, self::DB_LOGIN, self::DB_PASS, self::DB_NAME);
	}

	function addStudent($login, $password, $name, $second_name, $grup, $email, $score, $age, $local, $sex){

		
		if(!$this->_db->query("INSERT INTO data (login, pass, name, second_name, grup, email, score, age, localy, sex)
							VALUES('$login', '$password', '$name', '$second_name', '$grup', '$email', '$score', '$age', '$local', '$sex')")){
			echo $this->_db->error;
			}			
	}
	function getStudent($offset, $perPage, $sort = ''){

		$start = $perPage*$offset;

		if($sort){
			$sql = "SELECT name, second_name, grup, score FROM data ORDER BY $sort LIMIT $start,$perPage";
		}else{
			$sql = "SELECT name, second_name, grup, score FROM data ORDER BY score DESC LIMIT $start,$perPage";
		}

		
		$result = $this->_db->query($sql);
		echo $this->_db->error;


		$arr = array();
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$arr[] = $row;
		}
		return $arr;

	}
	function getPageCount($getStudentCount, $perPage){

		return ceil($getStudentCount/$perPage);	
	}

	function getStudentCount(){
		$sql = "SELECT * from data";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		return $this->_db->affected_rows;
	}

	function getAuthUser($login, $pass){
		$sql = "SELECT name, second_name, grup, email, score, age, localy, sex
				FROM data
				WHERE login = '{$login}'
				AND pass = '{$pass}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		if(!$result){
			echo "ошибка";
		}
		$arr = array();
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$arr[] = $row;
		}

		return $arr;
	}

	function refreshStudent($login, $pass, $name, $second_name, $grup, $email, $score, $age){
		if($name){
			$sql = "UPDATE data
					SET name = '$name'
					WHERE login = '{$login}'
					AND pass = '{$pass}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
	
		}	
		print_r($errors);
		if($second_name){
			$sql = "UPDATE data
					SET second_name = '$second_name'
					WHERE login = '{$login}'
					AND pass = '{$pass}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}
		if($grup){
			$sql = "UPDATE data
					SET grup = '$grup'
					WHERE login = '{$login}'
					AND pass = '{$pass}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}
		if($email){
			$sql = "UPDATE data
					SET email = '$email'
					WHERE login = '{$login}'
					AND pass = '{$pass}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}
		if($score){
			$sql = "UPDATE data
					SET score = '$score'
					WHERE login = '{$login}'
					AND pass = '{$pass}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}
		if($age){
			$sql = "UPDATE data
					SET age = '$age'
					WHERE login = '{$login}'
					AND pass = '{$pass}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}

	}

	function findPage($search, $offset, $perPage, $sort = ''){

		$start = $perPage*$offset;
		if($sort){
		$sql = "SELECT name, second_name, grup, score FROM data 
			WHERE name LIKE '%$search%'
			OR second_name LIKE '%$search%'
			OR grup LIKE '%$search%'
			OR score LIKE '%$search%' 
			ORDER BY $sort LIMIT $start,$perPage";
		}else{
		$sql = "SELECT name, second_name, grup, score FROM data 
				WHERE name LIKE '%$search%'
				OR second_name LIKE '%$search%'
				OR grup LIKE '%$search%'
				OR score LIKE '%$search%' 
				ORDER BY score DESC LIMIT $start,$perPage";
		}
		$result = $this->_db->query($sql);
		echo $this->_db->error;

		$arr = array();
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$arr[] = $row;
		}
		return $arr;
	}	

	function isLogin($login, $pass = ''){
			$sql = "SELECT login, pass
					FROM data
					";
		if($login){
			$result = $this->_db->query($sql);
			echo $this->_db->error;

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				if($row['login'] == $login){
					
					return true;
				}else{
				
					return false;
				}
			}
		}
		if($login and $pass){
			$result = $this->_db->query($sql);
			echo $this->_db->error;

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				if(($row['login'] == $login) and ($row['pass'] == $pass)){
					
					return true;
				}else{
				
					return false;
				}
			}
		}

	}

}


?>