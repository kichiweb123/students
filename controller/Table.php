<?php
try{
$numOfRows = $container['TableStudentsGateway']->getStudentCount();

}catch(Exception $e){
    $error = $e->__toString();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    include 'error.php';
    exit;
}
$offset = $_GET['p'];

$sort = $_GET['sort'];



try{
$cells = $container['TableStudentsGateway']->getStudent($offset, $perPage, $sort);
}catch(Exception $e){
    $error = $e->__toString();
    $error = $error."\r\n";
    
    if(is_file($file)){
        error_log($error, 3, $file);
    }
    include 'error.php';
    
    exit;
}

require_once "../view/table.phtml";
$util = New Util();
$pages = $util->getPageCount($numOfRows[0]['COUNT(*)'], $perPage);

require_once "../view/pages.phtml";
?>