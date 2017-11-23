<?php
/*Класс нужен для проверки форм*/
class Validation{
    function validateStudent(array $data){
        $errors = array();

        if(!$data['login']){
            $errors['login'] = 'Заполните логин';
        }
        if(!$data['pass']){
            $errors['pass'] = 'Заполните пароль';
        }
        if((strlen($data['name'])>25) or !$data['name']){
            $errors['name'] = 'Ошибка в имени';
        }
        if((strlen($data['sname'])>25) or !$data['sname']){
            $errors['second_name'] = 'Ошибка в фамилии';    
        }
        if(!$data['grup']){
            $errors['grup'] = 'Заполните группу';
        }
        if(!$data['email']){
            $errors['email'] = 'Заполните email';
        }
        if($data['score']>300 or $data['score'] == 0){
            $errors['score'] = 'Ошибка в баллах ЕГЭ';
        }
        if(!$data['age']){
            $errors['age'] = 'Заполните год рождения';
        }
        if(!$data['local']){
            $errors['local'] = 'Выберите место проживания';
        }
        if(!$data['sex']){
            $errors['sex'] = 'Выберите пол';
        }

        $check = new TableStudentsGateway();

        if($check->isLogin($data['login'])){
            $errors['login_exsist'] = "Такой логин уже зарегистрирован";
        }
        if($check->checkEmailForForms($data['email'])){
            $errors['email_exsist'] = "Такой емейл уже зарегистрирован";
        }
        return $errors;


    }
    function validateProfile($name, $second_name, $score, $email){
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

        $check = new TableStudentsGateway();
        if($check->checkEmailForForms($email)){
            $errors['email_exsist'] = "Такой емейл уже зарегистрирован";
        }
        return $errors;

    }
}
?>