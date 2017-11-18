<?php

$offset = $_GET['p'];
$sort = $_GET['sort'];
$search = $_POST['search'];
$search1 = $_GET['search'];


if($search1){
	$cells = $table->findPage($search1, $offset, $perPage, $sort);
	$rows = $table->getStudentCount($search1, $offset, $perPage);
}else{
	$rows = $table->getStudentCount($search, $offset, $perPage);
	$cells = $table->findPage($search, $offset, $perPage, $sort);
}

require_once "../view/search.phtml";

$pages = $table->getPageCount($rows, $perPage);
require_once "../view/pages.phtml";
?>