<?php
	require '../scripts/connect.php';
			
			$delivery = $_POST['delivery'];
			$pay = $_POST['pay'];
			$city = $_POST['city'];
			$street = $_POST['street'];
			$house = $_POST['house'];
			$apartment = $_POST['apartment'];
			$access = $_POST['access'];
			$floor = $_POST['floor'];
			$index = $_POST['index'];
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$patronymic = $_POST['patronymic'];
			$tel = $_POST['tel'];
			$email = $_POST['email'];
			$comment = $_POST['comment'];
			
			switch ($delivery) {
				case 1:
					$delivery = "��������";
					break;
				case 2:
					$delivery = "������ ������";
					break;
			}
			switch ($pay) {
				case 1:
					$delivery = "��������� �������";
					break;
				case 2:
					$delivery = "���������� ���������";
					break;
				case 3:
					$delivery = "���������� ��������";
					break;
			}
			
			$insert_sql = "INSERT INTO checkout (delivery, pay,city,street,house,apartment,access,floor,ind,name,surname,patronymic,tel,email,comments)" .
				"VALUES('{$delivery}', '{$pay}','{$city}','{$street}','{$house}','{$apartment}','{$access}','{$floor}','{$index}','{$name}','{$surname}','{$patronymic}','{$tel}','{$email}','{$comment}');";
			$res = 	mysql_query($insert_sql);
			if($res){
				switch ($_POST['pay']) {
				case 2:
					$delivery = "���������� ���������";
					break;
				default:
					header("Location: ../index.php?success_message=����� ������� ��������");
					exit();
			}	
			}
			
			header("Location: ".$_SERVER['HTTP_REFERER']."?error_message=������ ��� ���������� ������.���������� �����.");
			exit();
?>