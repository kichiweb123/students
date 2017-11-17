<?php

$numOfRows = $table->getStudentCount();
$offset = $_GET['p'];
$sort = $_GET['sort'];
$cells = $table->getStudent($offset, $perPage, $sort);

require_once "../view/table.phtml";
$pages = $table->getPageCount($numOfRows, $perPage);
require_once "../view/pages.phtml";
?>