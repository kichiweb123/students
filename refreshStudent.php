<?php


$data['name'] = $_POST['name'];
$data['sname'] = $_POST['second_name'];
$data['grup'] = $_POST['grup'];
$data['email'] = $_POST['email'];
$data['score'] = $_POST['score'];
$data['age'] = $_POST['age'];


$val = new Validation();
$errors = $val->validateProfile($data['name'], $data['sname'], $data['score']);
if(!$errors){
    try{
    $table->refreshStudent($data);
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