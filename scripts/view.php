<?php
	function show_cart(){
		if (isset($_SESSION['user_id'])) {
			if($_SESSION['group'] == 'admin'){
					echo '<div id="door" class="out"><img src="../img/door.png"><span>Выход</span></div>
				<a href="admin.php">
					<div id="adm">
						Администрирование
					</div>
				</a>';
			}
			else{
				if(isset($_SESSION['cart'])){
					$count = count($_SESSION['cart']);
					if($count>10) $count = '10+';
				}
				else 
					$count = 0;
				echo '<div id="door" class="out"><img src="../img/door.png"><span>Выход</span></div>
				<a href="cart.php">
					<div id="cart" count = '.$count.'>
						<img src="../img/cart.png" id="imgcart">
						<a href ="cart.php">Корзина</a>
						<img src="../img/cart_'.$count.'.png" id="count">
					</div>
				</a>';
			}
		}
		else{
			if(isset($_SESSION['cart'])){
				$count = count($_SESSION['cart']);
				if($count>10) $count = '10+';
			}
			else 
				$count = 0;
			echo '<div id="door" class="in"><img src="../img/door.png"><span>Вход</span></div>
		<a href="cart.php">
			<div id="cart" count = '.$count.'>
				<img src="../img/cart.png" id="imgcart">
				<a href ="cart.php">Корзина</a>
				<img src="../img/cart_'.$count.'.png" id="count">
			</div>
		</a>';
		}
	}
?>