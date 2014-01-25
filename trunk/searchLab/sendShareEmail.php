<?php
	include "../function/functionPHP.php";
	if(!patientAuthenticated()){
		exit();
	}
	host("nrh");
	
	$targetEmail=$_POST["targetEmail"];
	$msg=$_POST["msg"];
	$PersonalID=$_POST["PersonalID"];

	$query="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	
	$message=str_replace('\"','"',$message);
	
	sendMail($targetEmail, $row[PersonName], "ข้อมูลผลการตรวจจากห้องปฏิบัติการ", $msg);
	
	echo "complete";