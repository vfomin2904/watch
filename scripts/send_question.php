<?php
	require '../scripts/connect.php';
	
	$email = $_POST['email'];
	$question = $_POST['question'];
	$question=urldecode($question);
	$question=iconv("UTF-8", "WINDOWS-1251", $question);
	$insert_sql = "INSERT INTO questions (email, question)" .
	"VALUES('{$email}', '{$question}');";
	mysql_query($insert_sql);
	exit();
?>