<?php
	session_start();
	require_once ("scripts/connect.php"); 
	require_once ("scripts/view.php"); 
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
	<title>Наручные часы</title>
	<meta name="keywords" content = "купить часы, наручные часы, мужские часы">
	<meta http-equiv="Content-Type" type="text/html;charset UTF-8">
	<link href="css/index.css" rel="stylesheet" type="text/css">
	<link href="css/description.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="/img/icon.png" />
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/description.js"></script>
	<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
	<script src="//yastatic.net/share2/share.js"></script>
</head>
<body>
<div id="question">
		<img src="../img/x.png">
		<form id="question_box" action="scripts/send_question.php" style="margin:0 auto" method="POST">
			<p>Email:</p>
			<input type="email" name="email" required>
			<p>Ваш вопрос:</p>
			<textarea rows="10" cols="52" name="question" required></textarea>
			<p><input type="button" id="send_question" value = "Отправить вопрос"></p>
		</form>
</div>
<div id="login">
		<img src="../img/x.png">
		<?php
			if(isset($_GET['id']))
				echo '<form id="login_box" action="scripts/authorize.php?href=description.php?id='.$_GET['id'].'" style="margin:0 auto" method="POST">';
			else
				echo '<form id="login_box" action="scripts/authorize.php?href=description.php" style="margin:0 auto" method="POST">';
		?>
			<h2>Вход на сайт</h2>
			<p>Email:</p>
			<input type="email" name="email" required>
			<p>Пароль:</p>
			<input type="password" name="password" required>
			<div id="regRef"><a href="registration.php">Регистрация</a></div>
			<p><input type="submit" value="Войти на сайт"></p>
		</form>
</div>
<div id="overlay">
</div>
<?php
	if(isset($_GET['error_message']))
	echo '<div class="error">'.$_GET['error_message'].'</div>';
	if(isset($_GET['success_message']))
	echo '<div class="success">'.$_GET['success_message'].'</div>';
?>
<header>
	<div id="header_box">
		<a href="index.php"><img src="../img/logo.png"></a>
		<?php show_cart(); ?>
		<span id="mail">shop@youthwatch.ru</span>
	</div>
</header>
<nav id = "menu">
	<ul>
		<li><img src="../img/watch.png"><a href ="catalog.php">Каталог товаров</a></li>
		<li><img src="../img/Truck.png"><a href = "delivery.php">Доставка и оплата</a></li>
		<li><img src="../img/otzivi.png"><a href = "reviews.php">Отзывы</a></li>
		<li><img src="../img/support.png"><a href = "question.php">Задать вопрос</a></li>
	</ul>
</nav>
<div id="container">
	<div id="line">
	</div>
	<div id="content">
	<?php
	if(isset($_GET['id'])){
		$prod_id = $_GET['id'];
		
		$select_query = "SELECT * FROM product WHERE  prod_id = '{$prod_id}';";
		$res = mysql_query($select_query);
		
			if(!($row = mysql_fetch_assoc($res))){
				header("Location: catalog.php?error_message=Искомого товара не существует");
				exit();
			}
	
		
            $name = $row['name'];
			$price = $row['price'];
			$oldprice = $row['oldprice'];
			$discount = $row['discount'];
			$description = $row['description'];
			$prod_id = $row['prod_id'];
			$images = scandir("img/prod/".$name);
			date_default_timezone_set('Europe/Moscow');
			$date = date("d.m.y");
			
			echo '<div id="describe_box">
			<div id="info_box" prod_id="'.$prod_id.'">
				<div id="prodname">'.$name.'</div>
				<div id="describe">
					<h3>Описание</h3>
					<p>'.$description.'</p>
				</div>';
				if($oldprice != NULL){
					echo '<div id="oldprice">'.$oldprice.' руб</div>
					<div id="discount">Скидка '.$discount.'%</div>';
				}
				echo '<div id="price">'.$price.' руб</div>';
				if(!isset($_SESSION['cart'][$prod_id]))
							echo '<div id="buyhref"><div id="buybutton">В корзину</div></div>';
						else
							echo '<div id="buyhref"><div id="addbutton">Добавлено</div></div>';
				echo '</div>
				<div id="photo_box">
				<img src="../img/prod/'.$name.'/'.$images[2].'">
				<div id="mini_photo">
					<img class="active" src="../img/prod/'.$name.'/'.$images[2].'">';
					for ($i = 3; $i < count($images); $i++){
					echo	'<img src="../img/prod/'.$name.'/'.$images[$i].'">';
					}
			echo	'</div>
			</div>
		</div>';
         
		echo '<div id="reviews_box">
			<p id="rev_title">Отзывы</p>';
			if(!isset($_SESSION['user_id']))
				echo '<div id="login_rev" class="login_rev">Войти и написать отзыв</div>';
			else{
				echo '<div id="login_rev" class="write_rev">Написать отзыв</div>';
				echo '<div id="send_rev_box">';
				echo '<div class="username"><div class="name">'.$_SESSION['name'].'</div><div class="date">'.$date.'</div></div>';
				echo '<form id="rev_form" action="scripts/send_prodreview.php?id='.$_GET['id'].'" method="POST">
						<div class="title">Достоинства:</div>
						<textarea rows="5" cols="52" name="dignity"  id="write_rev"></textarea>
						<div class="title">Недостатки:</div>
						<textarea rows="5" cols="52" name="limitations"  id="write_rev"></textarea>
						<div class="title">Комментарии:</div>
						<textarea rows="5" cols="52" name="comments" id="write_rev"></textarea>
						<input type="submit" value="Оставить отзыв"></input>
						<div id="hide">Скрыть</div>
					</form></div>';
					
			}
				
			$select_query = "SELECT * FROM rev_product WHERE  prod_id = '{$prod_id}' ORDER BY revprod_id DESC;";
			$res = mysql_query($select_query);
		
			if(!($row = mysql_fetch_assoc($res))){
				echo '<p style="margin-top:30px;">К данному товару никто оставлял отзывов. Станьте первым!</p>';
			}
			else{
				do{
					$username = $row['name'];
					$date = $row['date'];
					$dignity = $row['dignity'];
					$limitations = $row['limitations'];
					$comments = $row['comments'];
					$dignity = preg_replace("/\r\n|\n|\r/", "<br>", $row['dignity']);
					$limitations = preg_replace("/\r\n|\n|\r/", "<br>", $row['limitations']); 
					$comments = preg_replace("/\r\n|\n|\r/", "<br>", $row['comments']); 					
					echo	'<div class="review_block">';
					echo	'<div class="username"><div class="name">'.$username.'</div><div class="date">'.$date.'</div></div>
							<div class="review">';
							if($dignity != NULL){
								echo'<div class="worth">
									<div class="worth_title">Достоинства</div>
									<p class="worth_text">'.$dignity.'</p>
								</div>';
							}
							if($limitations != NULL){
							echo'	<div class="worth">
									<div class="worth_title">Недостатки</div>
									<p class="worth_text">'.$limitations.'</p>
								</div>';
							}
							if($comments != NULL){
								echo '<div class="worth">
									<div class="worth_title">Комментарии</div>
									<p class="worth_text">'.$comments.'</p>
								</div>';
							}
						echo	'</div>
						</div>';
				}while($row = mysql_fetch_assoc($res));
				echo	'</div>';
			}
			echo	'</div">';
	}
	else{
		header("Location: catalog.php");
		exit();
	}
		?>
		</div>
	</div>
</div>
<footer>
	<img src="../img/logo_footer.png">
	<div id="footer_box">
		<div id="footer_block">
			<nav id="footer_menu">
				<ul>
					<li><a href ="catalog.php">Каталог товаров</a></li>
					<li><a href = "delivery.php">Доставка и оплата</a></li>
					<li><a href = "reviews.php">Отзывы</a></li>
					<li><a href = "question.php">Задать вопрос</a></li>
				</ul>
			</nav>
			<div id="footer_mail">
				По вопросам обращаться на email: <span style="text-decoration:underline;">shop@youthwatch.ru</span>
			</div>
		</div>
		<div id="share">
			<div class="ya-share2" style="float:right;margin-right:10px;" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus" data-counter=""></div>
		</div>
	</div>
</footer>
</body>
</html>