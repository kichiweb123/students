<?php
$data = array();

$data['login'] = $_COOKIE['login'];
$data['hash'] = $_COOKIE['pass'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "../refreshStudent.php";
}
try{


$editProf = $container['TableStudentsGateway']->getAuthUser($data['login'], $data['hash']);


}catch(Exception $e){
    $error = $e->getMessage();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    header('Location: error.php');
    exit;
}

require_once "../view/forms.phtml";
?>

