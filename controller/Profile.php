<?php
$data = array();

$data['login'] = $_COOKIE['login'];
$data['hash'] = $_COOKIE['pass'];
$data['name'] = $_POST['name'];
$data['second_name'] = $_POST['second_name'];
$data['class'] = $_POST['class'];
$data['email'] = strtolower($_POST['email']);
$data['score'] = $_POST['score'];
$data['birth_year'] = $_POST['age'];
$data['id'] = $_GET['id'];

$student = new Student($data);

$errors = $container['Validation']->validateStudent($data);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!$errors){
	    try{

	    	$container['TableStudentsGateway']->refreshStudent($student);
	    
	    }catch(Exception $e){
	        $error = $e->__toString();
	        $error = $error."\r\n";
	        
	        if(is_file($file)){
	            error_log($error, 3, $file);
	        }
	        include 'error.php';
	        exit;
	    }

	}
}
try{


$editProf = $container['TableStudentsGateway']->getAuthUser($data['login'], $data['hash']);


}catch(Exception $e){
    $error = $e->__toString();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    include 'error.php';
    exit;
}

require_once "../view/forms.phtml";
?>

