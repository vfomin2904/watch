<?php
	require_once("connect.php");
	session_start();
	
	
	if (!isset($_SESSION['user_id'])) {

		if (isset($_POST['email']) && isset($_POST['password'])) {
		$email = mysql_real_escape_string(trim($_REQUEST['email']));
		$password = mysql_real_escape_string(trim($_REQUEST['password']));
		$query = sprintf("SELECT user_id,groups,name FROM users " .
						 " WHERE email = '%s' AND " .
						 "       password = '%s';",
						 $email, crypt($password,$email));
			$results = mysql_query($query);

			if (mysql_num_rows($results)) {
			  $result = mysql_fetch_array($results);
			  $user_id = $result['user_id'];
			  $group = $result['groups'];
			  $name = $result['name'];
			  $_SESSION['user_id']= $user_id;
			  $_SESSION['group']= $group;
			  $_SESSION['name']= $name;
			  header("Location: ../".$_GET['href']);
			} else {
			  $error_message = "Неверное имя пользвателя или пароль";
			  header("Location: ../".$_GET['href']."?error_message=".$error_message);
			}
		}		
  }
?>
