<?php
ob_start();
header("Content-type: text/html; charset=utf-8");


function my_autoloader($class){
	if(is_file('model/'.$class.'.class.php')){
		include 'model/'.$class.'.class.php';
	}else{
		include 'controller/'.$class.'.class.php';
	}
}

spl_autoload_register('my_autoloader');
$table = new TableModel();
$cells = ""; /* ячейки под таблицу ассоциативную */

if(($_SERVER["REQUEST_METHOD"] == "POST") and ($_SERVER['QUERY_STRING'] == "id=registration")){
	require_once "save_table.php";
}


$id = $_GET['id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Абитуриент</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php


?>
<div class="container-fluid">


	<!-- Начало хедера -->

	<?php
		require_once "header.php";
	?>


	<!-- Конец хедера -->


	<!-- Начало контента -->


<?php

	
	
	switch($id){
		case 'registration':
			include 'registration.php';
			break;
		case 'login':
			include 'login.php';
			break;
		case 'edit_profile':
			include 'edit_profile.php';
			break;
		case 'del_cook':
			include 'del_cook.php';
			break;
		case 'search':
			include 'search.php';
			break;
		default:
			include 'table.php'; 
	}
	
ob_flush();
?>

	<!-- Конец контента -->
</div>

</body>
</html>