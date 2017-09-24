<?php
	require '../scripts/connect.php';
	session_start();
	
	if(isset($_SESSION['user_id'])){
		if($_SESSION['group'] == 'admin'){
			
			
			$name = $_POST['name'];
			$price = $_POST['price'];
			$description = $_POST['description'];
			
			$select_query = "SELECT * FROM product WHERE name = '{$name}';";
			$res = mysql_query($select_query);
		
			if(($row = mysql_fetch_assoc($res))){
				$error_message="Товар с данным названием уже существует";
				header("Location: ../admin.php?error_message=".$error_message);
				exit();
			}
			
			
			if (!is_dir('../img/prod/'.$name)) {
				mkdir('../img/prod/'.$name);
			}
			
			if(!(getimagesize($_FILES['main_image']['tmp_name']))){
					$error_message="Выбранный файл не является изображением";
					rmdir('../img/prod/'.$name);
					header("Location: ../admin.php?error_message=".$error_message);
					exit();
				}
				$str = substr(strrchr($_FILES["main_image"]["name"], '.'), 1);
				$tmp_name = $_FILES["main_image"]["tmp_name"];
				move_uploaded_file($tmp_name, "../img/prod/$name/0.$str");
			
			
			
			foreach ($_FILES["image"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["image"]["tmp_name"][$key];
				$str = substr(strrchr($_FILES["image"]["name"][$key], '.'), 1);
				$filename = ($key+1).'.'.$str;
				
				if(!(getimagesize($_FILES['image']['tmp_name'][$key]))){
					$error_message="Выбранный файл не является изображением";
					rmdir('../img/prod/'.$name);
					header("Location: ../admin.php?error_message=".$error_message);
					exit();
				}
					move_uploaded_file($tmp_name, "../img/prod/$name/$filename");
				}
			}
			date_default_timezone_set('Europe/Moscow');
			$date = date("d.m.y");
			
			if($_POST['oldprice'] != NULL){
				$oldprice = $_POST['oldprice'];
				$discount = $_POST['discount'];
				$insert_sql = "INSERT INTO product (name, oldprice,price,description,discount)" .
				"VALUES('{$name}', '{$oldprice}','{$price}','{$description}','{$discount}');";
				mysql_query($insert_sql);
			}
			else{
				$insert_sql = "INSERT INTO product (name,price,description)" .
				"VALUES('{$name}','{$price}','{$description}');";
				mysql_query($insert_sql);
			}
			
			header("Location: ../admin.php?success_message=Товар успешно добавлен в каталог");
		}
	}
	exit();
?>