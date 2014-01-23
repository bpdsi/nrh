<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	
	$Password=$_POST["Password"];
	$PasswordN=$_POST["PasswordN"];
	$PasswordC=$_POST["PasswordC"];
		
	$AdminID=$_SESSION["admin_Person"]["AdminID"];
	
	$query="
		select	*
		from	admin
		where	AdminID='$AdminID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(aesDecrypt($row[Password])!=$Password){
		echo "missPassword";
	}else{
		$PasswordN=aesEncrypt($PasswordN);
		$query="
			update	admin
			set		Password='$PasswordN'
			where	AdminID='$AdminID'
		";
		$result=mysql_query($query);
		$_SESSION["admin_Password"]=$PasswordN;
		echo "complete";
	}