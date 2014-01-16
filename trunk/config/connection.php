<?php
	$host_db="localhost";
	$user_db="npr";
	$password_db="1234";
	$database_name="hos";
	$conDB=mysql_connect($host_db,$user_db,$password_db) or die ("Something is going wrong");
	
	mysql_query("SET character_set_connection = UTF8")or die(mysql_error());
	mysql_query("SET character_set_client = UTF8")or die(mysql_error());
	mysql_query("SET character_set_results = UTF8")or die(mysql_error());
	mysql_query("SET NAMES UTF8")or die(mysql_error());
	$objDB=mysql_select_db($database_name);
?>