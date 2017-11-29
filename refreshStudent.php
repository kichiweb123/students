<?php


$data['name'] = $_POST['name'];
$data['second_name'] = $_POST['second_name'];
$data['class'] = $_POST['class'];
$data['email'] = strtolower($_POST['email']);
$data['score'] = $_POST['score'];
$data['birth_year'] = $_POST['age'];


$student = new Student($data);


$errors = $container['Validation']->validateProfile($data['name'], $data['second_name'], $data['score'], $data['email']);
if(!$errors){
    try{
    $container['TableStudentsGateway']->refreshStudent($student);
    
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