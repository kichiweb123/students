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

		
			$stmt = $this->_db->prepare("INSERT INTO data(login, pass, name, second_name, grup, email, score, age, localy, sex)
							VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssssssss", $login, $password, $name, $second_name, $grup, $email, $score, $age, $local, $sex);
			$stmt->execute();
			echo $this->_db->error;
				
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

	function getStudentCount($search = '', $offset = '', $perPage =''){
		$start = $perPage*$offset;
		if($search){
		$sql = "SELECT name, second_name, grup, score FROM data 
				WHERE name LIKE '%$search%'
				OR second_name LIKE '%$search%'
				OR grup LIKE '%$search%'
				OR score LIKE '%$search%' 
				ORDER BY score DESC";
		}else{
		$sql = "SELECT * from data";
		}
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		return $this->_db->affected_rows;
	}

	function getAuthUser($login, $pass){
		$stmt = $this->_db->prepare("SELECT name, second_name, grup, email, score, age, localy, sex
				FROM data
				WHERE login = ?
				AND pass = ?");
		$stmt->bind_param("ss", $login, $pass);
		$stmt->execute();
		$result = $stmt->get_result();
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
			$stmt = $this->_db->prepare("UPDATE data
					SET name = ?
					WHERE login = ?
					AND pass = ?");
			$stmt->bind_param("sss", $name, $login, $pass);
			$stmt->execute();

		echo $this->_db->error;
	
		}	
		if($second_name){
			$stmt = $this->_db->prepare("UPDATE data
					SET second_name = ?
					WHERE login = ?
					AND pass = ?");
			$stmt->bind_param("sss", $second_name, $login, $pass);
			$stmt->execute();
		echo $this->_db->error;
		}
		if($grup){
			$stmt = $this->_db->prepare("UPDATE data
					SET grup = ?
					WHERE login = ?
					AND pass = ?");
			$stmt->bind_param("sss", $grup, $login, $pass);
			$stmt->execute();
		echo $this->_db->error;
		}
		if($email){
			$stmt = $this->_db->prepare("UPDATE data
					SET email = ?
					WHERE login = ?
					AND pass = ?");
			$stmt->bind_param("sss", $email, $login, $pass);
			$stmt->execute();
		echo $this->_db->error;
		}
		if($score){
			$stmt = $this->_db->prepare("UPDATE data
					SET score = ?
					WHERE login = ?
					AND pass = ?");
			$stmt->bind_param("sss", $score, $login, $pass);
			$stmt->execute();
		echo $this->_db->error;
		}
		if($age){
			$stmt = $this->_db->prepare("UPDATE data
					SET age = ?
					WHERE login = ?
					AND pass = ?");
			$stmt->bind_param("sss", $age, $login, $pass);
			$stmt->execute();
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