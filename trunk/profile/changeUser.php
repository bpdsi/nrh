<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	$PersonalID=$_POST["PersonalID"];
	$User=$_POST["User"];
	$Password=$_POST["Password"];
	
	$query="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(aesDecrypt($row[Password])==$Password){
		$query="
			update	person
			set		User='$User'
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