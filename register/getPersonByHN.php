<?php
	header('Content-Type: text/html; charset=utf-8');
	
	include "../function/functionPHP.php";
	host("nrh");
	
	$HospCode=$_POST["HospCode"];
	$HospitalNumber=$_POST["HospitalNumber"];
	
	$query="
		select	*
		from	hospital_patient
		where	HospCode='$HospCode'and
				HospitalNumber='$HospitalNumber'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$PersonalID=$row[PersonalID];
	
	$query="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$person=mysql_fetch_array($result);
	
	echo json_encode($person);