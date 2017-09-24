<?php
	mysql_connect("localhost","root","root") or die("<p>Ошибка при подключении к базе данных:".mysql_error()."</p>");
	mysql_select_db('mysql') or handle_error("Возникла проблема с конфигурацией базы данных", mysql_error());
?>