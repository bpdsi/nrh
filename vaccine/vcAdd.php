<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	
	$vcpID=$_POST["vcpID"];
	$HospCode=$_POST["HospCode"];
	$Date_Service=$_POST["Date_Service"];
	$Vaccine_Code=$_POST["Vaccine_Code"];
	$Vaccine_Lot_Number=$_POST["Vaccine_Lot_Number"];
	$startYear=$_POST["startYear"];
	$startMon=$_POST["startMon"];
	$hr=$_POST["hr"];
	$mi=$_POST["mi"];
	
	$table=$_SESSION["sess_vcPrefix"]."_vaccination";
	$query="
		insert into	$table
			(
				vcpID,
				HospCode,
				Date_Service,
				Vaccine_Code,
				Vaccine_Lot_Number
			) values (
				'$vcpID',
				'$HospCode',
				'$Date_Service $hr:$mi',
				'$Vaccine_Code',
				'$Vaccine_Lot_Number'
			)
	";
	$result=mysql_query($query);
	
	header("location:vcCalendar.php?startYear=$startYear&startMon=$startMon");