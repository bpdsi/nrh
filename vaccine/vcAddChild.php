<?php
	session_start();
	$person=$_SESSION["sess_Person"];
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	
	$GivenName=$_POST["GivenName"];
	$MiddleName=$_POST["MiddleName"];
	$FamilyName=$_POST["FamilyName"];
	$NickName=$_POST["NickName"];
	$Description=$_POST["Description"];
	
	$table=$_SESSION["sess_vcPrefix"]."_child";
	$query="
		insert into	$table
			(
				GivenName,
				MiddleName,
				FamilyName,
				NickName,
				Description,
				parent
			) values (
				'$GivenName',
				'$MiddleName',
				'$FamilyName',
				'$NickName',
				'$Description',
				'$person[PersonalID]'
			)
	";
	$result=mysql_query($query);
	echo "complete";