<?php
	session_start();
	include "../function/functionPHP.php";
	host("nrh");
	noCache();
	
	$vcpID=$_GET["vcpID"];
	$Date_Service=$_GET["Date_Service"];
	$startYear=$_GET["startYear"];
	$startMon=$_GET["startMon"];
	
	$table=$_SESSION["sess_vcPrefix"]."_vaccination";
	
	$query="
		delete from	$table
		where		vcpID='$vcpID' and
					Date_Service='$Date_Service'
	";
	$result=mysql_query($query);
	
	header("location:vcCalendar.php?startYear=$startYear&startMon=$startMon");