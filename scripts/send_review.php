<?php
	require '../scripts/connect.php';
	session_start();
	if(isset($_POST['date'])){
		$name = $_POST['name'];
		$user_id = $_SESSION['user_id'];
		$rev_text = $_POST['rev_text'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		
		$rev_text=urldecode($rev_text);
		$rev_text=iconv("UTF-8", "WINDOWS-1251", $rev_text);
		$name=urldecode($name);
		$name=iconv("UTF-8", "WINDOWS-1251", $name);
		
		$insert_sql = "INSERT INTO reviews (name, review,date,time,user_id)" .
		"VALUES('{$name}', '{$rev_text}','{$date}', '{$time}','{$user_id}');";
		mysql_query($insert_sql);
		exit();
	}
	else{
		date_default_timezone_set('Europe/Moscow');
		$date = date("d.m.y");
		$time = date("H").":".date("i");
		
		$name = $_SESSION['name'];
		$user_id = $_SESSION['user_id'];
		$rev_text = $_POST['rev_text'];
		
		
		$search_sql = 'SELECT * FROM reviews WHERE user_id = '.$user_id.' AND date = "'.$date.'";';
		$search_rev = mysql_query($search_sql);
		
		if(mysql_fetch_assoc($search_rev)){
			header("Location: ../reviews.php?id=".$prod_id.'&error_message=Вы уже оставляли сегодня отзыв');
			exit();
		}
		
		$insert_sql = "INSERT INTO reviews (name, review,date,time,user_id)" .
		"VALUES('{$name}', '{$rev_text}','{$date}', '{$time}','{$user_id}');";
		mysql_query($insert_sql);
		header("Location: ../reviews.php");
	}
?>