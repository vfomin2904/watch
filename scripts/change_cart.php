<?php
	session_start();
	$id = $_POST['id'];
	if(isset($_POST['cur_count'])){
		$cur_count = $_POST['cur_count'];
		$_SESSION['cart'][$id] = $cur_count;
		exit();
	}
	unset($_SESSION['cart'][$id]);
	exit();
?>