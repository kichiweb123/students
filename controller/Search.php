<?php

$offset = $_GET['p'];
$sort = false;
$whiteList = array('name', 'second_name', 'class');
foreach($whiteList as $list){
    if($list == $_GET['sort']){
        $sort = $_GET['sort'];
    }
}

$search = $_POST['search'];
$search1 = $_GET['search'];


if($search1){
    try{
    $cells = $table->findPage($search1, $offset, $perPage, $sort);
    $rows = $table->getStudentCount($search1, $offset, $perPage);
    }catch(Exception $e){
        $error = $e->getMessage();
        $error = $error."\r\n";
    
        if(is_file($file)){
            error_log($error, 3, $file);
        }
        header('Location: error.php');
        exit;
    }

}else{
    try{
    $rows = $container['TableStudentsGateway']->getStudentCount($search, $offset, $perPage);
    $cells = $container['TableStudentsGateway']->findPage($search, $offset, $perPage, $sort);
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

require_once "../view/search.phtml";
$util = New Util();
$pages = $util->getPageCount($rows, $perPage);
require_once "../view/pages.phtml";
?>