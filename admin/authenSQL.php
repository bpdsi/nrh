<?php
	session_start();
	include "../function/functionPHP.php";
	host("nrh");
	$User=$_POST["User"];
	$Password=$_POST["Password"];
	$query="
		select	*
		from	admin
		where	User='$User' and
				status='enable'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(mysql_num_rows($result)==0 || aesDecrypt($row[Password])!=$Password){
		header("location:authenFail.php");
	}else{
		$_SESSION["admin_User"]=$row[User];
		$_SESSION["admin_Password"]=$row[Password];
		$_SESSION["admin_permission"]=$row[permission];
		
		$queryHos="
			select	*
			from	admin_hospital
			where	AdminID='$row[AdminID]'
		";
		$resultHos=mysql_query($queryHos);
		$rowHos=mysql_fetch_array($resultHos);
		
		$_SESSION["admin_hospcode"]=$rowHos[hospcode];
		
		$_SESSION["admin_Person"]=$row;
		header("location:../admin");
	}