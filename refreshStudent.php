<?php


$data['name'] = $_POST['name'];
$data['sname'] = $_POST['second_name'];
$data['class'] = $_POST['class'];
$data['email'] = strtolower($_POST['email']);
$data['score'] = $_POST['score'];
$data['age'] = $_POST['age'];



$errors = $container['Validation']->validateProfile($data['name'], $data['sname'], $data['score'], $data['email']);
if(!$errors){
    try{
    $container['TableStudentsGateway']->refreshStudent($data);
    }catch(Exception $e){
        $error = $e->getMessage();
        $error = $error."\r\n";
        
        if(is_file($file)){
            error_log($error, 3, $file);
        }
        header('Location: error.php');
        exit;
    }

}
?>