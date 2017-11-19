<?php
ob_start();
header("Content-type: text/html; charset=utf-8");


function my_autoloader($class){
    if(is_file('../model/'.$class.'.php')){
        include '../model/'.$class.'.php';
    }else{
        include '../controller/'.$class.'.php';
    }
}

spl_autoload_register('my_autoloader');

$file = 'errors.log';

try{
$table = new TableStudentsGateway();
}catch(Exception $e){
    $error = $e->getMessage();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    header('Location: error.php');
    exit;
}
$cells = ""; /* ячейки под таблицу ассоциативную */
$perPage = 5;/*переменная отвечает за количество выводимых строк в таблице*/
if(($_SERVER["REQUEST_METHOD"] == "POST") and ($_GET['id'] == "registration")){
    require_once "../saveStudent.php";
}


$id = $_GET['id'];


?>



    <!-- Начало хедера -->

    <?php
        $arr = $table->getAuthUser($_COOKIE['login'], $_COOKIE['pass']);
        require_once "../view/header.phtml";
    ?>


    <!-- Конец хедера -->


    <!-- Начало контента -->


<?php

    
    
    switch($id){
        case 'registration':
            include '../view/forms.phtml';
            break;
        case 'login':
            include '../controller/Login.php';
            break;
        case 'edit_profile':
            include '../controller/Profile.php';
            break;
        case 'del_cook':
            include '../del_cook.php';
            break;
        case 'search':
            include '../controller/Search.php';
            break;
        default:
            include '../controller/Table.php'; 
    }
    
ob_flush();
?>

    <!-- Конец контента -->


</body>
</html>