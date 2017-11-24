<?php
$data = array();
$data['login'] = strtolower($_POST['login']);
$data['pass'] = $_POST['pass'];
$data['name'] = $_POST['name'];
$data['sname'] = $_POST['second_name'];
$data['class'] = $_POST['class'];
$data['email'] = strtolower($_POST['email']);
$data['score'] = $_POST['score'];
$data['age'] = $_POST['age'];
$data['local'] = $_POST['local'];
$data['sex'] = $_POST['sex'];


$hash = password_hash($data['pass'], PASSWORD_DEFAULT);
$data['hash'] = $hash;


$errors = $container['Validation']->validateStudent($data);

if(!$errors){
try{
$container['TableStudentsGateway']->addStudent($data);
}catch(Exception $e){
    $error = $e->getMessage();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    header('Location: error.php');
    exit;
}

$container['Authorisation']->authLogin($data['login'], $data['hash']);
header('Location: http://test1.ru/?id=edit_profile');

}
?>