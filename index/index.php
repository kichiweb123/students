<?php
ob_start();
header("Content-type: text/html; charset=utf-8");


function my_autoloader($class){
	if(is_file('../model/'.$class.'.class.php')){
		include '../model/'.$class.'.class.php';
	}else{
		include '../controller/'.$class.'.class.php';
	}
}

spl_autoload_register('my_autoloader');
$table = new TableStudentsGateway();
$cells = ""; /* ячейки под таблицу ассоциативную */
$perPage = 5;/*переменная отвечает за количество выводимых строк в таблице*/
if(($_SERVER["REQUEST_METHOD"] == "POST") and ($_SERVER['QUERY_STRING'] == "id=registration")){
	require_once "../save_table.php";
}


$id = $_GET['id'];


?>



	<!-- Начало хедера -->

	<?php
		require_once "../view/header.phtml";
	?>


	<!-- Конец хедера -->


	<!-- Начало контента -->


<?php

	
	
	switch($id){
		case 'registration':
			include '../view/registration.phtml';
			break;
		case 'login':
			include '../controller/ControllerLogin.php';
			break;
		case 'edit_profile':
			include '../controller/ControllerProfile.php';
			break;
		case 'del_cook':
			include '../del_cook.php';
			break;
		case 'search':
			include '../controller/ControllerSearch.php';
			break;
		default:
			include '../controller/ControllerTable.php'; 
	}
	
ob_flush();
?>

	<!-- Конец контента -->


</body>
</html>