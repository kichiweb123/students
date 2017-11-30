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

        if(!$data['login'] and $data['id'] == 'registration'){
            $errors['login'] = 'Заполните логин';
        }
        if(!$data['pass'] and $data['id'] == 'registration'){
            $errors['pass'] = 'Заполните пароль';
        }
        if((strlen($data['name'])>25)){
            $errors['name'] = 'Ошибка в имени';
        }
        if(!$data['name'] and $data['id'] == 'registration'){
            $errors['name'] = 'Заполните имя';
        }
        if(strlen($data['second_name'])>25){
            $errors['second_name'] = 'Ошибка в фамилии';    
        }
        if(!$data['second_name'] and $data['id'] == 'registration'){
            $errors['second_name'] = 'Заполните фамилию';
        }
        if(!$data['class'] and $data['id'] == 'registration'){
            $errors['class'] = 'Заполните группу';
        }
        if(!$data['email'] and $data['id'] == 'registration'){
            $errors['email'] = 'Заполните email';
        }
        if($data['score'] != ""){
            if($data['score']>300 or !ctype_digit($data['score']) or $data['score']<0){
                $errors['score'] = 'Ошибка в баллах ЕГЭ';
            }
        }
        if(!$data['score'] and $data['id'] == 'registration'){
                $errors['score'] = 'Заполните баллы ЕГЭ';
        }

        if($data['birth_year'] != ""){
            if($data['birth_year']<1970 or $data['birth_year']>2000 or !ctype_digit($data['birth_year'])){
                $errors['age'] = 'Ошибка в годе рождения';
            }
        }
        if(!$data['birth_year'] and $data['id'] == 'registration'){
            $errors['age'] = 'Заполните год рождения';
        }
        if(!$data['local'] and $data['id'] == 'registration'){
            $errors['local'] = 'Выберите место проживания';
        }
        if(!$data['sex'] and $data['id'] == 'registration'){
            $errors['sex'] = 'Выберите пол';
        }

        
        if($data['id'] == 'registration'){
            if($this->tableStudentGateway->getLoginPass($data['login'], false, true)){
                $errors['login_exsist'] = "Такой логин уже зарегистрирован";
            }
        }
        if($this->tableStudentGateway->isEmailUsed($data['email'])){
            $errors['email_exsist'] = "Такой емейл уже зарегистрирован";
        }
        return $errors;


    }

}
?>