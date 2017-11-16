<?php
class TableModel{
	const DB_ADDR = "localhost";
	const DB_LOGIN = "root";
	const DB_PASS = "";
	const DB_NAME = "table";

	public $_db = null;

	function __construct(){
		$this->_db = new mysqli(self::DB_ADDR, self::DB_LOGIN, self::DB_PASS, self::DB_NAME);
	}

	function saveTable(){
		global $login;
		global $password;
		$data = new TableControllerRegistration();
		$login = $data->login;
		$password = $data->pass;
		$name = $data->name;
		$second_name = $data->sname;
		$grup = $data->grup;
		$email = $data->email;
		$score = $data->score;
		$age = $data->age;
		$local = $data->local;
		$sex = $data->sex;


		global $errors;
		$error = array();


		if(!$login){
			$errors['login'] = 'Заполните логин';
		}
		if(!$password){
			$errors['pass'] = 'Заполните пароль';
		}
		if((strlen($name)>15) or !$name){
			$errors['name'] = 'Ошибка в имени';
		}
		if((strlen($second_name)>15) or !$second_name){
			$errors['second_name'] = 'Ошибка в фамилии';	
		}
		if(!$grup){
			$errors['grup'] = 'Заполните группу';
		}
		if(!$email){
			$errors['email'] = 'Заполните email';
		}
		if($score>300 or $score == 0){
			$errors['score'] = 'Ошибка в баллах ЕГЭ';
		}
		if(!$age){
			$errors['age'] = 'Заполните год рождения';
		}
		if(!$local){
			$errors['local'] = 'Выберите место проживания';
		}
		if(!$sex){
			$errors['sex'] = 'Выберите пол';
		}
		$sql = "SELECT login FROM data";
		$res = $this->_db->query($sql);
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			
			if($row['login'] == $login){
				$errors['login_exsist'] = "Такой логин уже зарегистрирован";
			}
		}

		if(!$errors){
		if(!$this->_db->query("INSERT INTO data (login, pass, name, second_name, grup, email, score, age, localy, sex)
							VALUES('$login', '$password', '$name', '$second_name', '$grup', '$email', '$score', '$age', '$local', '$sex')")){
			echo $this->_db->error;
			}		
		}
		
		
	}
	function getTable($numOfRows, $perPage){
		$data = new TableControllerPages();
		$page = $data->pageid;
		$sort = $data->sort;

		$start = $page*$perPage;

		switch($sort){
			case 'name':
				$sql = "SELECT name, second_name, grup, score FROM data ORDER BY name LIMIT $start,$perPage";
				break;
			case 'second_name':
				$sql = "SELECT name, second_name, grup, score FROM data ORDER BY second_name LIMIT $start,$perPage";
				break;
			case 'grup':
				$sql = "SELECT name, second_name, grup, score FROM data ORDER BY grup LIMIT $start,$perPage";
				break;
			default:
				$sql = "SELECT name, second_name, grup, score FROM data ORDER BY score DESC LIMIT $start,$perPage";
		}
		
		$result = $this->_db->query($sql);
		if(!$result){
			echo "ошибка";
		}
		$arr = array();
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$arr[] = $row;
		}
		return $arr;
	}
	function pages($numOfRows, $perPage){
		global $numOfPages;
		global $page;
		$data = new TableControllerPages;
		$page = $data->pageid;
		$sort = $data->sort;
		$numOfPages = ceil($numOfRows/$perPage);	
	}

	function numOfRows(){
		$sql = "SELECT * from data";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		return $this->_db->affected_rows;
	}

	function editProfile(){
		$data = new TableControllerCookie();
		$login = $data->login;
		$pass = $data->pass;

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

	function checkAndUpdateProfile(){
		$data = new TableControllerRegistration();
		$name = $data->name;
		$second_name = $data->sname;
		$grup = $data->grup;
		$email = $data->email;
		$score = $data->score;
		$age = $data->age;

		$cookie = new TableControllerCookie();
		$login = $cookie->login;
		$pass = $cookie->pass;
		

		if($name){
			$sql = "UPDATE data
					SET name = '$name'
					WHERE login = '{$login}'
					AND pass = '{$pass}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;

		}
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

	function login(){
		$sql = "SELECT login, pass
				FROM data
				";
		$result = $this->_db->query($sql);
		echo $this->_db->error;

		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			
			if(($row['login'] == $_POST['login']) and ($row['pass'] == $_POST['pass'])){
				setcookie("login", "{$row['login']}", 0x7FFFFFFF);
				setcookie("pass", "{$row['pass']}", 0x7FFFFFFF);
				return true;
			}else{
				return false;
			}
		}
	}

	function search(){
		global $search;
		$data = new TableControllerSearch();
		$search = $data->search;


		$sql = "SELECT name, second_name, grup, score FROM data 
				WHERE name LIKE '%$search%'
				OR second_name LIKE '%$search%'
				OR grup LIKE '%$search%'
				OR score LIKE '%$search%'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;

		$arr = array();
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$arr[] = $row;
		}
		return $arr;
	}

}
?>