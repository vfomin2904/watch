<?php
	mysql_connect("localhost","root","root") or die("<p>������ ��� ����������� � ���� ������:".mysql_error()."</p>");
	mysql_select_db('mysql') or handle_error("�������� �������� � ������������� ���� ������", mysql_error());
?>