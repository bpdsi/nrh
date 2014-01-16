<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	
	$eo_vcpID=$_POST["eo_vcpID"];
	$eo_Date_Service=$_POST["eo_Date_Service"];
	
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
		delete from	$table
		where		vcpID='$eo_vcpID' and
					Date_Service='$eo_Date_Service'
	";
	$result=mysql_query($query);
	
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
				'$Date_Service $hr:$mi:00',
				'$Vaccine_Code',
				'$Vaccine_Lot_Number'
			)
	";
	$result=mysql_query($query);
	
	header("location:vcCalendar.php?startYear=$startYear&startMon=$startMon");