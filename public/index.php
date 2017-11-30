<?php
ob_start();
header("Content-type: text/html; charset=utf-8");


function my_autoloader($class){
    if(is_file('../model/'.$class.'.php')){
        include '../model/'.$class.'.php';
    }elseif(is_file('../controller/'. $class . '.php')){
        include '../controller/'.$class.'.php';
    }
}

spl_autoload_register('my_autoloader');

$file = 'errors.log';
try{
$container['connect'] = new ConnectDb();
$container['TableStudentsGateway'] = new TableStudentsGateway($container['connect']);
$container['Authorisation'] = new Authorisation($container['TableStudentsGateway']);
$container['Validation'] = new Validation($container['TableStudentsGateway'], $container['Authorisation']);
}catch(Exception $e){
    $error = $e->__toString();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    include 'error.php';
    exit;
}
$cells = ""; /* ячейки под таблицу ассоциативную */
$perPage = 5;/*переменная отвечает за количество выводимых строк в таблице*/



$id = $_GET['id'];





    /* Начало хедера */


        $arr = $container['TableStudentsGateway']->getAuthUser($_COOKIE['login'], $_COOKIE['pass']);
        require_once "../view/header.phtml";



    /*Конец хедера */


    /*Начало контента*/




    
    
    switch($id){
        case 'registration':
            include '../controller/Registration.php';
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


   /*Конец контента */

   require_once '../view/footer.phtml';
?>