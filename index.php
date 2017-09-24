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
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="/img/icon.png" />
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
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
		<form id="login_box" action="scripts/authorize.php?href=index.php" style="margin:0 auto" method="POST">
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
		<div id="slide">
			<img src="../img/left.png" class="arrow" style="left:5px;">
			<img src="../img/right.png" class="arrow" style="right:5px;">
			<div id="slide_inner">
				<img src="../img/watch-4.jpg">
				<img src="../img/watch-2.jpg">
				<img src="../img/watch-1.jpg">
				<img src="../img/watch-3.jpg">
			</div>
		</div>
		<div id="spec_offer">Специальные предложения</div>
			<div id = "spec_box">
			<?php
				$spec_mas = [40,49,42,41];
				foreach($spec_mas as $prod_id){
					$res = mysql_query("SELECT * FROM product WHERE prod_id = ".$prod_id);
					while($row = mysql_fetch_assoc($res)){
						$img = scandir("img/prod/".$row['name']);
					echo '
						<div class="spec_inner" prod_id="'.$prod_id.'">
						<img src="../img/'.$row['discount'].'proc.png" class="proc">
					<div class="img_box">	<img src="../img/prod/'.$row['name'].'/'.$img[2].'" class="specwatch"></div>
						<a class="prodname" href="description.php?id='.$prod_id.'">'.$row['name'].'</a>
						<div class="oldprice">'.$row['oldprice'].' руб</div>
						<div class="newprice">'.$row['price'].' руб</div>';
						if(isset($_SESSION['cart'][$prod_id]))
							echo '<div class="buyhref"><div class="addbutton">В корзине</div></div>';
						else
							echo '<div class="buyhref"><div class="buybutton">Купить</div></div>';
						echo '</div>';
					}
				}
			?>
			</div>
			<div id="info">
			Приобретая часы, мужчина должен осознавать, что такой аксессуар станет частью его имиджа, деловые партнеры обязательно отметят стильную модель известного бренда. Такой показатель материального достатка становится необходимостью для человека, ведущего бизнес. Как говорится, встречаю по одежке, а для мужчины наручные часы – это неотъемлемый элемент образа. Если представитель сильного пола действительно хочет чтобы его воспринимали, как успешного лидера своей компании, приобретение дорогих часов просто необходимо. Девушка может украсить свою прекрасную ручку и кольцами и изысканными браслетами, такие аксессуары для мужчин уместны только в отдельных случаях, а вот наручные часы – это отличная возможность, придя на любое мероприятие привлечь внимание окружающих.Поэтому приобретая часы, мужчина должен осознавать, что такой аксессуар станет частью его имиджа, деловые партнеры обязательно отметят стильную модель известного бренда. Такой показатель материального достатка становится необходимостью для человека, ведущего бизнес. Как говорится, встречаю по одежке, а для мужчины наручные часы – это неотъемлемый элемент образа.
			</div>
		<div id ="advantages">Наши преимущества</div>
			<div id="adv_box">
				<div class="adv_block">
					<img src="../img/delivery.png">
					<div class="adv_text">Бесплатная доставка</div>
				</div>
				<div class="adv_block">
					<img src="../img/price.png">
					<div class="adv_text">Доступные<br>цены</div>
				</div>
				<div class="adv_block">
					<img src="../img/return.png">
					<div class="adv_text">Возврат товаров<br>с браком</div>
				</div>
				<div class="adv_block">
					<img src="../img/card.png">
					<div class="adv_text">Возможность безналичной оплаты</div>
				</div>
				<div class="adv_block">
					<img src="../img/hands.png">
					<div class="adv_text">Индивидуальный подход</div>
				</div>
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