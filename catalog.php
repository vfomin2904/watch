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
	<link href="css/catalog.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="/img/icon.png" />
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/catalog.js"></script>
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
		<form id="login_box" action="scripts/authorize.php?href=catalog.php" style="margin:0 auto" method="POST">
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
		<div id="product_box">
			<?php
				$select_query;
				$onpage=10;
				$count_query = mysql_query("SELECT COUNT(1) FROM product");
				$count = mysql_fetch_array( $count_query );
				$count_page = intval($count[0]/$onpage)+1;
				if(($count[0]%$onpage)==0) $count_page--;
				
				if (isset($_GET['page']) && ($_GET['page'])>0 && ($_GET['page'])<=$count_page){
					$page = (int)$_GET['page'] - 1;
					$skip = $page*$onpage;
					$select_query = "SELECT * FROM product ORDER BY prod_id DESC LIMIT ".$skip.", ".$onpage.";";
				}
				else {
					$select_query = "SELECT * FROM product ORDER BY prod_id DESC LIMIT ".$onpage.";";
				}
					$res = mysql_query($select_query);
			
					while ($row = mysql_fetch_assoc($res)){
					$name = $row['name'];
					$price = $row['price'];
					$oldprice = $row['oldprice'];
					$short_desc = $row['short_desc'];
					$prod_id = $row['prod_id'];
					$description = $row['description'];
					$discount = $row['discount'];
					
					if(mb_strlen($description)>190){
						$description = mb_strimwidth($description, 0, 190, "...");
					}
					
					$img = scandir("img/prod/".$name);
					
						echo '<div class="prod_window" prod_id='.$prod_id.'>';
						echo '<a href="description.php?id='.$prod_id.'"><img src="../img/prod/'.$name.'/'.$img[2].'"></a>';
						echo '<div class="info_box">';
						echo '<div class="prodname"><a href="description.php?id='.$prod_id.'">'.$name.'</a></div>';
						echo '<div class="describe">'.$description.'</div>';
						if($oldprice != NULL){
							echo '<div class="discount">Скидка '.$discount.'%</div>';
							echo '<div class="oldprice">'.$oldprice.' руб</div>';
							echo '<div class="newprice">'.$price.' руб</div>';
						}
						else
							echo '<div class="price">'.$price.' руб</div>';
						if(!isset($_SESSION['cart'][$prod_id]))
							echo '<div class="buyhref"><div class="buybutton">В корзину</div></div></div>';
						else
							echo '<div class="buyhref"><div class="addbutton">Добавлено</div></div></div>';
						echo '</div>';
				 }
				 
				 $current_page=1;
				 
				 if(isset($_GET['page']))
					 $current_page = $_GET['page'];
				 
				echo '<nav id="count_page">';
				echo '<ul>';
				if($count_page<=10){
					 for($i = 1;$i<=$count_page;$i++){
						 if($i == $current_page)
							 echo '<li>'.$i.'</li>';
						else
						echo '<li><a href="catalog.php?page='.$i.'">'.$i.'</a></li>';
					 }
				}
				else{
					echo '<li><a href="catalog.php?page=1">1</a></li>';
					if(($current_page-3)>1)
					echo '<li>....</li>';
					for($i=$current_page-3;$i!=$current_page+3;$i++){
						if($i>1 && $i<$count_page){
							 if($i == $_GET['page'])
							 echo '<li>'.$i.'</li>';
								else
								echo '<li><a href="catalog.php?page='.$i.'">'.$i.'</a></li>';
							}
					}
					if(($current_page+3)<$count_page)
					echo '<li>....</li>';
					echo '<li><a href="catalog.php?page='.$count_page.'">'.$count_page.'</a></li>';
				}
				echo '</ul>';
				echo '</nav>';
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