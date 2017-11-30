<?php
if(($_SERVER["REQUEST_METHOD"] == "POST") and ($_GET['id'] == "registration")){
$data = array();
$data['login'] = strtolower($_POST['login']);
$data['pass'] = $_POST['pass'];
$data['name'] = $_POST['name'];
$data['second_name'] = $_POST['second_name'];
$data['class'] = $_POST['class'];
$data['email'] = strtolower($_POST['email']);
$data['score'] = $_POST['score'];
$data['birth_year'] = $_POST['age'];
$data['local'] = $_POST['local'];
$data['sex'] = $_POST['sex'];
$data['id'] = $_GET['id'];

$hash = password_hash($data['pass'], PASSWORD_DEFAULT);
$data['hash'] = $hash;


$student = new Student($data);

$errors = $container['Validation']->validateStudent($data);

    
	if(!$errors){
		try{
			$container['TableStudentsGateway']->addStudent($student);
		}catch(Exception $e){
		    $error = $e->__toString();
		    $error = $error."\r\n";
		    
			    if(is_file($file)){
			        error_log($error, 3, $file);
			    }
		    include 'error.php';
		    exit;
		}

		$container['Authorisation']->authLogin($data['login'], $data['hash']);
		header('Location: http://test1.ru/?id=edit_profile');

	}
}

require_once "../view/forms.phtml"
?>