<?php

$rows = $table->getStudentCount();
$offset = $_GET['p'];
$sort = $_GET['sort'];
$search = $_POST['search'];
$cells = $table->findPage($search, $offset, $perPage, $sort);



require_once "../view/search.phtml";

$pages = $table->getPageCount($rows, $perPage);
require_once "../view/pages.phtml";
?>