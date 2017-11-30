<?php
Class Util{
	function getPageCount($getStudentCount, $perPage){

        return ceil($getStudentCount/$perPage); 
    }

    function generateUrlForPagination(array $atr, $nameUrl){
    	$atr_str = http_build_query($atr);
    	$url = "<a href='?{$atr_str}'>{$nameUrl}</a>";
    	return $url;
    }
}
?>