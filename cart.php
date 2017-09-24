<?php
	session_start();
	require_once ("scripts/connect.php"); 
	require_once ("scripts/view.php"); 
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
	<title>�������� ����</title>
	<meta name="keywords" content = "������ ����, �������� ����, ������� ����">
	<meta http-equiv="Content-Type" type="text/html;charset UTF-8">
	<link href="css/index.css" rel="stylesheet" type="text/css">
	<link href="css/cart.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="/img/icon.png" />
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/cart.js"></script>
	<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
	<script src="//yastatic.net/share2/share.js"></script>
</head>
<body>
<div id="question">
		<img src="../img/x.png">
		<form id="question_box" action="scripts/send_question.php" style="margin:0 auto" method="POST">
			<p>Email:</p>
			<input type="email" name="email" required>
			<p>��� ������:</p>
			<textarea rows="10" cols="52" name="question" required></textarea>
			<p><input type="button" id="send_question" value = "��������� ������"></p>
		</form>
</div>
<div id="login">
		<img src="../img/x.png">
		<form id="login_box" action="scripts/authorize.php?href=cart.php" style="margin:0 auto" method="POST">
			<h2>���� �� ����</h2>
			<p>Email:</p>
			<input type="email" name="email" required>
			<p>������:</p>
			<input type="password" name="password" required>
			<div id="regRef"><a href="registration.php">�����������</a></div>
			<p><input type="submit" value="����� �� ����"></p>
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
		<li><img src="../img/watch.png"><a href ="catalog.php">������� �������</a></li>
		<li><img src="../img/Truck.png"><a href = "delivery.php">�������� � ������</a></li>
		<li><img src="../img/otzivi.png"><a href = "reviews.php">������</a></li>
		<li><img src="../img/support.png"><a href = "question.php">������ ������</a></li>
	</ul>
</nav>
<div id="container">
	<div id="line">
	</div>
	<div id="content">
		<div id="cart_box">
		<?php 
		if(!(empty($_SESSION['cart']))){
			$mas = $_SESSION['cart'];
			foreach($mas as $cart){
				$id = key($mas);
				
					
					$select_sql="SELECT * FROM product WHERE prod_id = ".$id;
					$res = mysql_query($select_sql);
						while($row = mysql_fetch_assoc($res)){
							$name = $row['name'];
							$price = $row['price'];
							$oldprice = $row['oldprice'];
							$short_desc = $row['short_desc'];
							$prod_id = $row['prod_id'];
							$description = $row['description'];
							$discount = $row['discount'];
							$image = scandir("img/prod/".$name);
					
							if(mb_strlen($description)>150){
								$description = mb_strimwidth($description, 0, 150, "...");
							}
							echo '<p id="empt" style="display:none;">���� ������� �����</p>';		
							echo '<div class="product" id='.$prod_id.'>
								<a href="description.php?id='.$prod_id.'"><img src="../img/prod/'.$name.'/'.$image[2].'"></a>
								<div class="param">
									<div class="prod_info">
										<a class="prodname" href="description.php?id='.$id.'">'.$name.'</a>
										<div class="desc">'.$description.'</div>
									</div>
									<div class="count_col">
										<img src="../img/arr_left.png" style="float:left; margin-left:20px;">
										<input type="text" name="count" value="'.$cart.'" required disabled>
										<img src="../img/arr_right.png">
										<div class="price" price="'.$price.'"><span>'.$price.'</span> ���</div>
										<div class="delete">������� �� �������</div>
									</div>
								</div>
							</div>';
						}
					
				next($mas);
			}
			echo '<div id="totalPrice">= <span></span> ���</div>
								<a href="checkout.php"><div id="order">�������� �����</div></a>';
		}
		else echo '<p id="empt">���� ������� �����</p>';
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
					<li><a href ="catalog.php">������� �������</a></li>
					<li><a href = "delivery.php">�������� � ������</a></li>
					<li><a href = "reviews.php">������</a></li>
					<li><a href = "question.php">������ ������</a></li>
				</ul>
			</nav>
			<div id="footer_mail">
				�� �������� ���������� �� email: <span style="text-decoration:underline;">shop@youthwatch.ru</span>
			</div>
		</div>
		<div id="share">
			<div class="ya-share2" style="float:right;margin-right:10px;" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus" data-counter=""></div>
		</div>
	</div>
</footer>
</body>
</html>