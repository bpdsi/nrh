<?php
	session_start();
	include '../function/functionPHP.php';
	noCache();
	host("nrh");
	
	$PersonalID=$_POST["PersonalID"];
	$PasswordO=$_POST["PasswordO"];
	$PasswordN=$_POST["PasswordN"];
	
	$query="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(aesDecrypt($row[Password])==$PasswordO){
		$query="
			update	person
			set		Password='".aesEncrypt($PasswordN)."'
			where	PersonalID='$PersonalID'
		";
		$result=mysql_query($query);
		
		$query="
			select	*
			from	person
			where	PersonalID='$PersonalID'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		
		$_SESSION["sess_User"]=$row[User];
		$_SESSION["sess_Password"]=$row[Password];
		$_SESSION["sess_Person"]=$row;
		
		echo "complete";
	}else{
		echo "notAuthenticated";
	}