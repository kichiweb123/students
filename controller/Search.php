<?php

$offset = $_GET['p'];
$sort = $_GET['sort'];
$search = $_POST['search'];
$search1 = $_GET['search'];


if($search1){
    try{
    $cells = $container['TableStudentsGateway']->getStudent($offset, $perPage, $sort, $search1);
    $rows = $container['TableStudentsGateway']->getStudentCount($search1, $offset, $perPage);
    }catch(Exception $e){
        $error = $e->__toString();
        $error = $error."\r\n";
    
        if(is_file($file)){
            error_log($error, 3, $file);
        }
        include 'error.php';
        exit;
    }

}else{
    try{
    $rows = $container['TableStudentsGateway']->getStudentCount($search, $offset, $perPage);
    $cells = $container['TableStudentsGateway']->getStudent($offset, $perPage, $sort, $search);
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

require_once "../view/search.phtml";
$util = New Util();
$pages = $util->getPageCount($rows[0]['COUNT(*)'], $perPage);
require_once "../view/pages.phtml";
?>