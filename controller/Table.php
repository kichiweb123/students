<?php

$offset  = $_GET['p'];
$sort    = $_GET['sort'];
$search  = $_POST['search'];
$search1 = $_GET['search'];

if ($_GET['id'] == 'search') {
    if ($search1) {
        $find = $search1;
    } else {
        $find = $search;
    }
        try {
            $cells = $container['TableStudentsGateway']->getStudent($offset, $perPage, $sort, $find);
            $rows  = $container['TableStudentsGateway']->getStudentCount($find, $offset, $perPage);
        }
        catch (Exception $e) {
            $error = $e->__toString();
            $error = $error . "\r\n";
            
            if (is_file($file)) {
                error_log($error, 3, $file);
            }
            include 'error.php';
            exit;
        }
        
    
        require_once "../view/search.phtml";
} else {

    try {
        $rows = $container['TableStudentsGateway']->getStudentCount();
        $cells = $container['TableStudentsGateway']->getStudent($offset, $perPage, $sort);
    }
    catch (Exception $e) {
        $error = $e->__toString();
        $error = $error . "\r\n";
        
        if (is_file($file)) {
            error_log($error, 3, $file);
        }
        include 'error.php';
        
        exit;
    }
    
    require_once "../view/table.phtml";
}
$util  = New Util();
$pages = $util->getPageCount($rows[0]['COUNT(*)'], $perPage);
require_once "../view/pages.phtml";
?>