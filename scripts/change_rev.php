<?php
	require_once("connect.php");
	
	$review = $_POST['review'];
	$review=urldecode($review);
    $review=iconv("UTF-8", "WINDOWS-1251", $review);

	$rev_id = $_POST['rev_id'];
	mysql_query("UPDATE reviews SET review = '{$review}' WHERE rev_id = ".$rev_id);
	exit();
?>
