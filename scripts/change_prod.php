<?php
	require_once("connect.php");
	session_start();
	if(isset($_SESSION['user_id'])){
		if($_SESSION['group'] == 'admin'){
			
			$id = $_POST['id'];
			
			if(isset($_POST['name'])){
				if($_POST['name'] != NULL){
				$name = $_POST['name'];
				
				$name=urldecode($name);
				$name=iconv("UTF-8", "WINDOWS-1251", $name);
				$select_query = "SELECT * FROM product WHERE name = '{$name}';";
				$res = mysql_query($select_query);
				if(($row = mysql_fetch_assoc($res))){
					exit();
				}
				
				$rename_sql = mysql_query("SELECT name FROM product WHERE prod_id = ".$id);
				$row = mysql_fetch_assoc($rename_sql);
				rename("../img/prod/".$row['name'],"../img/prod/".$name);
				
				mysql_query("UPDATE product SET name = '{$name}' WHERE prod_id = ".$id);
				}
			}
			if(isset($_POST['price'])){
				if($_POST['price'] != NULL){
				$price = $_POST['price'];
				mysql_query("UPDATE product SET price = '{$price}' WHERE prod_id = ".$id);
				}
			}
			if(isset($_POST['discount'])){
				if($_POST['discount'] != NULL){
				$discount = $_POST['discount'];
				if($discount == 0){
					mysql_query("UPDATE product SET oldprice = NULL AND discount = NULL WHERE prod_id = ".$id);
				}
				else
				mysql_query("UPDATE product SET discount = '{$discount}' WHERE prod_id = ".$id);
			}
			}
			if(isset($_POST['oldprice'])){
				if($_POST['oldprice'] != NULL){
				$oldprice = $_POST['oldprice'];
				if($oldprice == 0){
					mysql_query("UPDATE product SET oldprice = NULL AND discount = NULL WHERE prod_id = ".$id);
				}
				else
				mysql_query("UPDATE product SET oldprice = '{$oldprice}' WHERE prod_id = ".$id);
			}
			}
			if(isset($_POST['description'])){
				if($_POST['description'] != NULL){
				$description = $_POST['description'];
				$description=urldecode($description);
				$description=iconv("UTF-8", "WINDOWS-1251", $description);
				mysql_query("UPDATE product SET description = '{$description}' WHERE prod_id = ".$id);
				}
			}
			
		}
	}
	exit();
?>
