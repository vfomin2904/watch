<?php
	require '../scripts/connect.php';
	session_start();
	$count = $_POST['count'];
	$id = $_POST['id'];
	$_SESSION['cart'][$id] = $count;
	exit();
?>