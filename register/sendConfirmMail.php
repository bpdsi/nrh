<?php
	include "../function/functionPHP.php";
	if(!staffAuthenticated()){
		exit();
	}
	host("nrh");
	$PersonalID=$_POST["PersonalID"];
	$message=$_POST["message"];
	$query="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	
	$message=str_replace('\"','"',$message);
	
	sendMail($row[Email], $row[PersonName], "ยืนยันการสมัคร เข้าใช้ NPR Data Bank", $message);