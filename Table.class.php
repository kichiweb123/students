
<?php

class Table{
	const DB_ADDR = "localhost";
	const DB_LOGIN = "root";
	const DB_PASS = "";
	const DB_NAME = "table";


	public $_db = null;

	function __construct(){
		$this->_db = new mysqli(self::DB_ADDR, self::DB_LOGIN, self::DB_PASS, self::DB_NAME);
	}

	function saveTable($login, $password, $name, $second_name, $grup, $email, $score, $age, $local, $sex){
		global $errors;
		$error = array();
		global $errorForTable;
		$errorForTable = array();
		if(!$login){
			$errors['login'] = 'Заполните логин';
		}
		if(!$password){
			$errors['pass'] = 'Заполните пароль';
		}
		if($name>15 or !$name){
			$errors['name'] = 'Ошибка в имени';
		}
		if($second_name>15 or !$second_name){
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
			
			if($row['login'] == $_POST['login']){
				$errors['login_exsist'] = "Такой логин уже зарегистрирован";
			}
		}

		if(!$errors){
		if(!$this->_db->query("INSERT INTO data (login, pass, name, second_name, grup, email, score, age, localy, sex)
							VALUES('$login', '$password', '$name', '$second_name', '$grup', '$email', '$score', '$age', '$local', '$sex')")){
			echo $this->_db->error;
			}		
		}
		
		echo $errors['login'];
	}

	function getTable($sort, $numOfRows, $perPage){

		$numOfPages = ceil($numOfRows/$perPage);
		$page = $_GET['id'];
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
		$page = $_GET['id'];
		$sort = $_GET['sort'];
		$numOfPages = ceil($numOfRows/$perPage);
		echo "<div class='pag_num'>";
		if(!$page == 0){
			echo "<a href='?id=".($page-1)."&sort={$_GET['sort']}'>Назад </a>";
		}
		for($i=0; $i<$numOfPages; $i++){
			if($sort){
			echo "<a href='?id={$i}&sort={$_GET['sort']}'>".($i+1)."</a>";
			}else{
				echo "<a href='?id={$i}'>".($i+1)."</a>";
			}
		}
		if(!($page == ($numOfPages-1))){
			echo "<a href='?id=".($page+1)."&sort={$_GET['sort']}'> Вперед</a>";

		}
		echo "</div>";
	}
	function editProfile(){
		$sql = "SELECT name, second_name, grup, email, score, age, localy, sex
				FROM data
				WHERE login = '{$_COOKIE['login']}'
				AND pass = '{$_COOKIE['pass']}'";
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

	function checkAndUpdateProfile($name, $second_name, $grup, $email, $score, $age){
		if($name){
			$sql = "UPDATE data
					SET name = '$name'
					WHERE login = '{$_COOKIE['login']}'
					AND pass = '{$_COOKIE['pass']}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;

		}
		if($second_name){
			$sql = "UPDATE data
					SET second_name = '$second_name'
					WHERE login = '{$_COOKIE['login']}'
					AND pass = '{$_COOKIE['pass']}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}
		if($grup){
			$sql = "UPDATE data
					SET grup = '$grup'
					WHERE login = '{$_COOKIE['login']}'
					AND pass = '{$_COOKIE['pass']}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}
		if($email){
			$sql = "UPDATE data
					SET email = '$email'
					WHERE login = '{$_COOKIE['login']}'
					AND pass = '{$_COOKIE['pass']}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}
		if($score){
			$sql = "UPDATE data
					SET score = '$score'
					WHERE login = '{$_COOKIE['login']}'
					AND pass = '{$_COOKIE['pass']}'";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		}
		if($age){
			$sql = "UPDATE data
					SET age = '$age'
					WHERE login = '{$_COOKIE['login']}'
					AND pass = '{$_COOKIE['pass']}'";
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



	function search($search){
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

	function numOfRows(){
		$sql = "SELECT * from data";
		$result = $this->_db->query($sql);
		echo $this->_db->error;
		return $this->_db->affected_rows;
	}

	function clearStr($str){
		return trim(strip_tags($str));
	}


	function clearInt($int){
		return abs((int)$int);
	}


}
?>
