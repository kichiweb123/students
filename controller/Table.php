<?php
try{
$numOfRows = $container['TableStudentsGateway']->getStudentCount();

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

$whiteList = array('name', 'second_name', 'class');

foreach($whiteList as $list){
    if($list == $_GET['sort']){
        $sort = $_GET['sort'];
    }
}


try{
$cells = $container['TableStudentsGateway']->getStudent($offset, $perPage, $sort);
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
$util = New Util();
$pages = $util->getPageCount($numOfRows, $perPage);
require_once "../view/pages.phtml";
?>