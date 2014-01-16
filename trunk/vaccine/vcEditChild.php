<?php
	session_start();
	$person=$_SESSION["sess_Person"];
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	
	$vcpID=$_POST["vcpID"];
	$GivenName=$_POST["GivenName"];
	$MiddleName=$_POST["MiddleName"];
	$FamilyName=$_POST["FamilyName"];
	$NickName=$_POST["NickName"];
	$Description=$_POST["Description"];
	
	$table=$_SESSION["sess_vcPrefix"]."_child";
	
	$query="
		update	$table
		set		GivenName='$GivenName',
				MiddleName='$MiddleName',
				FamilyName='$FamilyName',
				NickName='$NickName',
				Description='$Description'
		where	vcpID='$vcpID'
	";
	
	$result=mysql_query($query);
	echo "complete";