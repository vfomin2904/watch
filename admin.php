<?php
	session_start();
	
	if (!isset($_SESSION['user_id']) || $_SESSION['group'] != 'admin') {
		header("Location: index.php?error_message=У вас нет прав доступа для просмотра данной страницы");
	}
	
	require_once ("scripts/connect.php"); 
	require_once ("scripts/view.php"); 
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
	<title>Администрирование</title>
	<meta http-equiv="Content-Type" type="text/html;charset UTF-8">
	<link href="css/admin.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="/img/icon.png" />
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/admin.js"></script>
</head>
<body>
<?php
	if(isset($_GET['error_message']))
	echo '<div class="error">'.$_GET['error_message'].'</div>';
	if(isset($_GET['success_message']))
	echo '<div class="success">'.$_GET['success_message'].'</div>';
?>
<header>
	<a href="index.php" id="back">Вернуться на сайт</a>
</header>
<nav id = "menu">
	<ul>
		<li class="active" num='0'>Добавить товар</li>
		<li num ='1'>Добавить отзыв</li>
		<li num ='2'>Вопросы пользователей</li>
		<li num='3'>Изменить описание товара</li>
	</ul>
</nav>
<div id="container">
	<div id="content">
		<form action="scripts/add_product.php" method="POST" enctype="multipart/form-data">
			<div class="title">Добавление нового товара</div>
			<label for="name">Название:</label>
			<input type="text" name="name" required><br>
			<label for="description">Описание:</label><br>
			<textarea rows="10" cols="52" name="description" required></textarea><br>
			<label for="price">Цена:</label>
			<input type="text" name="price" style="width:100px;" required>
			<label for="oldprice">Старая цена:</label>
			<input type="text" name="oldprice" style="width:100px;">
			<label for="discount">Скидка:</label>
			<input type="text" name="discount" style="width:100px;"><br>
			<label for="main_image">Главное изображение:</label>
			<input type="file" name="main_image" required><br>
			<label for="image">Дополнительные изображения:</label>
			<input type="file" name="image[]" required multiple><br>
			<p><input type="submit" value="Добавить товар"></p>
		</form>
		
		<form method="POST" enctype="multipart/form-data" style="display:none;">
			<div class="title">Добавление нового отзыва</div>
			<label for="name">Фамилия и имя пользователя:</label>
			<input type="text" name="name" required><br>
			<label for="date">Дата <span>(DD.MM.YY)</span>:</label>
			<input type="text" name="date" required><br>
			<label for="time">Время <span>(HH:MM)</span>:</label>
			<input type="text" name="time" required><br>
			<label for="review">Отзыв:</label>
			<textarea rows="10" cols="52" name="review" required></textarea><br>
			<p><input type="button" value="Добавить отзыв" id="send_review"></p>
		</form>
		<div id ="questions">
			<div class="quest_block">
						<div class="email">Email</div>
						<div class="question">Вопрос</div>
				</div>
			<?php
				$res = mysql_query("SELECT * FROM questions ORDER BY quest_id DESC LIMIT 20;");
				while($row = mysql_fetch_assoc($res)){
					$email=$row['email'];
					$question = $row['question'];
					echo '<div class="quest_block">
						<div class="email">'.$email.'</div>
						<div class="question">'.$question.'</div>
					</div>
					';
				}
			?>
		</div>
		<form action="scripts/change_prod.php" method="POST" enctype="multipart/form-data" style="display:none;">
			<div class="title">Изменение описания товара</div>
			<label for="id">ID товара:</label>
			<input type="text" name="id" required><br>
			<label for="name">Название:</label>
			<input type="text" name="name" ><br>
			<label for="description">Описание:</label><br>
			<textarea rows="10" cols="52" name="description" ></textarea><br>
			<label for="price">Цена:</label>
			<input type="text" name="price" style="width:100px;" >
			<label for="oldprice">Старая цена:</label>
			<input type="text" name="oldprice" style="width:100px;">
			<label for="discount">Скидка:</label>
			<input type="text" name="discount" style="width:100px;"><br>
			<input type="button" value="Изменить описание" id ="change_prod">
		</form>
	</div>
</div>
</body>
</html>