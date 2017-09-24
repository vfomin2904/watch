<?php
	require '../scripts/connect.php';
	session_start();
	
	date_default_timezone_set('Europe/Moscow');
	$date = date("d.m.y");
	
	$name = $_SESSION['name'];
	$user_id = $_SESSION['user_id'];
	$dignity = $_POST['dignity'];
	$limitations = $_POST['limitations'];
	$comments = $_POST['comments'];
	$prod_id = $_GET['id'];
	
	$search_sql = 'SELECT * FROM rev_product WHERE user_id = '.$user_id.' AND date = "'.$date.'" AND prod_id ='.$prod_id.';';
	$search_rev = mysql_query($search_sql);
	
	if(mysql_fetch_assoc($search_rev)){
		header("Location: ../description.php?id=".$prod_id.'&error_message=Вы уже оставляли сегодня отзыв к данному товару');
		exit();
	}
	if($dignity != NULL || $limitations != NULL || $comments != NULL){
		$insert_sql = "INSERT INTO rev_product (name,date,dignity,limitations,comments,user_id,prod_id)" .
		"VALUES('{$name}', '{$date}','{$dignity}', '{$limitations}','{$comments}',{$user_id},{$prod_id});";
		mysql_query($insert_sql);
	}
	header("Location: ../description.php?id=".$prod_id.'#login_rev');
	exit();
?>