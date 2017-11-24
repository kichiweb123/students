<?php
Class Util{
	function getPageCount($getStudentCount, $perPage){

        return ceil($getStudentCount/$perPage); 
    }
}
?>