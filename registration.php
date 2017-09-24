<?php
	session_start();
	require_once ("scripts/connect.php"); 
	require_once ("scripts/view.php"); 
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
	<title>Оформление заказа</title>
	<meta name="keywords" content = "купить часы, наручные часы, мужские часы">
	<meta http-equiv="Content-Type" type="text/html;charset UTF-8">
	<link href="css/index.css" rel="stylesheet" type="text/css">
	<link href="css/checkout.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="/img/icon.png" />
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/reg.js"></script>
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
		<form id="login_box" action="scripts/authorize.php?href=checkout.php" style="margin:0 auto" method="POST">
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
		<div id ="title">Регистрация</div>
		<form id="checkout_form" action="scripts/reg.php" style="margin:0 auto" method="POST">
		   <label for="FIO" style="margin-left:50px;margin-right:88px;">ФИО:</label>
		   <input name="FIO" type="text" id="FIO"></input><br>
		   <label for="enail" style="margin-left:50px;margin-right:86px;">Email:</label>
		   <input name="email" type="enail"></input><br>
		   <label for="pass" style="margin-left:50px;margin-right:75px;" >Пароль:</label>
		   <input name="pass" type="password"></input><br>
		   <label for="pass" style="margin-left:50px;margin-right:10px;" >Пароль (еще раз):</label>
		   <input name="pass" type="password"></input><br>
		   <p><input type="submit" value="Зарегистрироваться" id="reg"></p>
		</form>
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