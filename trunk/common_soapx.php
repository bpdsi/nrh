<?
	$host     = "localhost";
	$username = "npr";
	$password = "1234";
    $dbname="hos";
	$connect  = mysql_connect($host, $username, $password);
	mysql_select_db($dbname, $connect);
	$charset = "SET character_set_results=utf8"; mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	$charset = "SET character_set_client=utf8"; mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	//$charset = "SET character_set_results=utf8"; mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	$charset = "SET character_set_connection=utf8"; mysql_query($charset) or die('Invalid query: ' . mysql_error());
	mysql_query("SET NAMES UTF8")or die(mysql_error()); 
?>
