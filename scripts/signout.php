<?php
	session_start();
	
	unset($_SESSION['user_id']);
	unset($_SESSION['group']);
	header("Location: ".$_GET['href']);
	exit();
?>