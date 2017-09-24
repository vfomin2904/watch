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
	<link href="css/reviews.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="/img/icon.png" />
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/reviews.js"></script>
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
		<form id="login_box" action="scripts/authorize.php?href=reviews.php" style="margin:0 auto" method="POST">
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
	<?php
		if(isset($_SESSION['user_id'])){
			echo '<input id="send_rev" class="rev_unlock" type="button" value="�������� �����"></input>';
		}
		else echo '<input id="send_rev" class="rev_lock" type="button" value="�������� �����"></input>';
	?>
		<p id="title">������ �����������</p>
		<form id="rev_form" action="scripts/send_review.php" method="POST">
			<div id="rev_title">��� ����� � ����� ��������:</div>
			<textarea rows="10" cols="52" name="rev_text" required id="write_rev"></textarea>
			<input type="submit" value="�������� �����"></input>
			<div id="hide">������</div>
		</form>
		<?php
		$select_query;
		$count_query = mysql_query("SELECT COUNT(1) FROM reviews");
		$count = mysql_fetch_array( $count_query );
		$count_page = intval($count[0]/10)+1;
		if(($count[0]%10)==0) $count_page--;
		
		if (isset($_GET['page']) && ($_GET['page'])>0 && ($_GET['page'])<=$count_page){
			$page = (int)$_GET['page'] - 1;
			$skip = $page*10;
			$select_query = "SELECT rev_id,name, review,date,time,user_id FROM reviews ORDER BY rev_id DESC LIMIT ".$skip.", 10;";
		}
		else {
			$select_query = "SELECT rev_id,name, review,date,time,user_id FROM reviews ORDER BY rev_id DESC LIMIT 10;";
		}
			$res = mysql_query($select_query);
	
			while ($row = mysql_fetch_assoc($res)){
            $name = $row['name'];
			$review = $row['review'];
			$review = preg_replace("/\r\n|\n|\r/", "<br>", $row['review']);
			$date = $row['date'];
			$time = $row['time'];
			$user_id = $row['user_id'];
			$rev_id = $row['rev_id'];
            echo '<div class="review" rev_id='.$rev_id.'>';
			echo '<p class="name">'.$name.'  <span style="font-size:13px;"> '.$date.' '.$time.'</span></p>';
			if(isset($_SESSION['user_id'])){
				if($_SESSION['user_id'] == $user_id || $_SESSION['group'] == 'admin'){
					echo '<div class="remove">�������</div>';
					echo '<div class="change">��������</div>';
				}
			}
			echo '<p style="clear:both; margin-left:15px;font-family:Comic Sans, Comic Sans MS, cursive;">'.$review.'</p>';
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
						echo '<li><a href="reviews.php?page='.$i.'">'.$i.'</a></li>';
					 }
				}
				else{
					echo '<li><a href="reviews.php?page=1">1</a></li>';
					if(($current_page-3)>1)
					echo '<li>....</li>';
					for($i=$current_page-3;$i!=$current_page+3;$i++){
						if($i>1 && $i<$count_page){
							 if($i == $_GET['page'])
							 echo '<li>'.$i.'</li>';
								else
								echo '<li><a href="reviews.php?page='.$i.'">'.$i.'</a></li>';
							}
					}
					if(($current_page+3)<$count_page)
					echo '<li>....</li>';
					echo '<li><a href="reviews.php?page='.$count_page.'">'.$count_page.'</a></li>';
				}
				echo '</ul>';
				echo '</nav>';
		?>
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