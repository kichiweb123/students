<?php
try{
$numOfRows = $table->getStudentCount();
}catch(Exception $e){
    $error = $e->getMessage();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    header('Location: error.php');
    exit;
}
$offset = $_GET['p'];

$sort = false;

$whiteList = array('name', 'second_name', 'grup');

foreach($whiteList as $list){
    if($list == $_GET['sort']){
        $sort = $_GET['sort'];
    }
}


try{
$cells = $table->getStudent($offset, $perPage, $sort);
}catch(Exception $e){
    $error = $e->getMessage();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    header('Location: error.php');
    
    exit;
}

require_once "../view/table.phtml";
$pages = $table->getPageCount($numOfRows, $perPage);
require_once "../view/pages.phtml";
?>