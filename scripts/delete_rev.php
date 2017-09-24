<?php
	require_once("connect.php");
	
	$rev_id = $_POST['rev_id'];
	mysql_query("DELETE FROM reviews WHERE rev_id =".$rev_id);
	exit();
?>
