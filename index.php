<?php
ob_start();
header("Content-type: text/html; charset=utf-8");
require_once "Table.class.php";
$table = new Table();
$cells = ""; /* ячейки под таблицу ассоциативную */

if(($_SERVER["REQUEST_METHOD"] == "POST") and ($_SERVER['QUERY_STRING'] == "id=registration")){
	require_once "save_table.php";
}


$id = $table->clearStr($_GET['id']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Абитуриент</title>
	<link href="bootstrap.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
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

выфолзщлывощфыловщофывдлыофдэлвоыфдлвофоыдвдыфрвоыждрыфолдвтолыфвитжолыфивлиыфлвилыфивлиыфожлвижлоыфивжлиыолж
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