<?php
/*Класс нужен для проверки форм*/
class Validation{
    public $tableStudentGateway;
    public $authorisation;
    function __construct(TableStudentsGateway $TableStudentsGateway, Authorisation $Authorisation){
        $this->tableStudentGateway = $TableStudentsGateway;
        $this->authorisation = $Authorisation;
    }

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
        if((strlen($data['second_name'])>25) or !$data['second_name']){
            $errors['second_name'] = 'Ошибка в фамилии';    
        }
        if(!$data['class']){
            $errors['class'] = 'Заполните группу';
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

        

        if($this->tableStudentGateway->getLoginPass($data['login'], false, true)){
            $errors['login_exsist'] = "Такой логин уже зарегистрирован";
        }
        if($this->tableStudentGateway->isEmailUsed($data['email'])){
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

        if($this->tableStudentGateway->isEmailUsed($email)){
            $errors['email_exsist'] = "Такой емейл уже зарегистрирован";
        }
        return $errors;

    }
}
?>