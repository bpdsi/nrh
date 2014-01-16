<?php
	session_start();
	include "../function/functionPHP.php";
	host("hrh");
	$User=$_POST["User"];
	$Password=$_POST["Password"];
	$query="
		select	*
		from	vcp_person
		where	User='$User'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(mysql_num_rows($result)==0 || aesDecrypt($row[Password])!=$Password){
		header("location:authenFail.php");
	}else{
		$_SESSION["sess_vc_User"]=$row[User];
		$_SESSION["sess_vc_Password"]=$row[Password];
		$_SESSION["sess_vc_Person"]=$row;
		$_SESSION["sess_vcPrefix"]="vcp";
		header("location:../vaccine");
	}