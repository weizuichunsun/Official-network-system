<?php
	// node->npm init 
	$define_host = "localhost";
	$define_user = "root";
	$define_pass = "12345678";
	$define_db="lanshan";

	$conn=mysql_connect($define_host,$define_user,$define_pass);
	
	if(!$conn){

		die("数据库连接失败".mysql_error());
	}

	mysql_select_db($define_db);
	mysql_query("SET NAMES UTF8");

?>
