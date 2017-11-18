<?php
/*Класс нужен для проверки форм*/
class Validation{
	function validateStudent($login, $password, $name, $second_name, $grup, $email, $score, $age, $local, $sex){
		$errors = array();

		if(!$login){
			$errors['login'] = 'Заполните логин';
		}
		if(!$password){
			$errors['pass'] = 'Заполните пароль';
		}
		if((strlen($name)>25) or !$name){
			$errors['name'] = 'Ошибка в имени';
		}
		if((strlen($second_name)>25) or !$second_name){
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

		$check = new TableStudentsGateway();

		if($check->isLogin($login, $pass)){
				$errors['login_exsist'] = "Такой логин уже зарегистрирован";
			}
		return $errors;

	}
	function validateProfile($name, $second_name, $score){
		$errors = array();

		if((strlen($name)>25)){
			$errors['name'] = 'Ошибка в имени';
		}
		if((strlen($second_name)>25)){
			$errors['second_name'] = 'Ошибка в фамилии';	
		}
		if($score>300 or $score<0){
			$errors['score'] = 'Ошибка в баллах ЕГЭ';
		}
		return $errors;

	}
}
?>