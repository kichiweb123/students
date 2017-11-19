<?php
$data = array();
$data['login'] = $_POST['login'];
$data['pass'] = $_POST['pass'];
$data['name'] = $_POST['name'];
$data['sname'] = $_POST['second_name'];
$data['grup'] = $_POST['grup'];
$data['email'] = $_POST['email'];
$data['score'] = $_POST['score'];
$data['age'] = $_POST['age'];
$data['local'] = $_POST['local'];
$data['sex'] = $_POST['sex'];


$val = new Validation();
$errors = $val->validateStudent($data);
$auth = new Authorisation();
if(!$errors){
try{
$table->addStudent($data);
}catch(Exception $e){
    $error = $e->getMessage();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    header('Location: error.php');
    exit;
}
$auth->authLogin($data['login'], $data['pass']);
header('Location: http://test1.ru/?id=edit_profile');

}
?>