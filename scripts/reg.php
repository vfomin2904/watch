<?php
	require '../scripts/connect.php';
	
	$email = $_POST['email'];
	$name = $_POST['FIO'];
	$password = crypt($_POST['pass'],$email);
	$search_sql = "SELECT * FROM users WHERE email = '{$email}';";
	$search_rev = mysql_query($search_sql);
	
	if(mysql_fetch_assoc($search_rev)){
		header("Location: ../registration.php?error_message=Данный email уже зарегистрирован");
		exit();
	}
	else{
		$insert_sql = "INSERT INTO users (name,email,password,groups)" .
		"VALUES('{$name}', '{$email}','{$password}', 'user')";
		mysql_query($insert_sql);
	}
	header("Location: ../index.php?success_message= Пользователь успешно зарегистрирован");
	exit();
?>