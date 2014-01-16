<?php
	session_start();
	include "../function/functionPHP.php";
	host("nrh");
	noCache();
	$vcpID=$_POST["vcpID"];
	
	$table=$_SESSION["sess_vcPrefix"]."_child";
	
	$query="
		delete from	$table
		where		vcpID='$vcpID'
	";
	$result=mysql_query($query);
	
	echo "complete";