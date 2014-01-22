<?php
	include "../function/functionPHP.php";
	
	$hospcode=$_POST["hospcode"];
	$CitizenID=$_POST["CitizenID"];
	$Prefix=$_POST["Prefix"];
	$PersonName=$_POST["Name"];
	$Telephone=$_POST["Telephone"];
	$Email=$_POST["Email"];
	$BirthTemp=explode("/", $_POST["BirthDate"]);
	$BirthDate=($BirthTemp[2]-543)."-".$BirthTemp[1]."-".$BirthTemp[0];
	$User=$_POST["User"];
	$Password=$_POST["PasswordN"];
	$permission=$_POST["permission"];
	
	$NameTemp=explode(" ", $PersonName);
	if(count($NameTemp)==2){
		$GivenName=$NameTemp[0];
		$FamilyName=$NameTemp[1];
		$MiddleName='';
	}else{
		$GivenName=$NameTemp[0];
		$MiddleName=$NameTemp[1];
		$FamilyName=$NameTemp[2];
	}
	
	$query="
		select	max(AdminID) as 'lastAdminID'
		from	admin
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$AdminID=$row[lastAdminID]+1;
	
	$query="
		insert into	admin
			(
				AdminID,
				CitizenID,
				Prefix,
				PersonName,
				GivenName,
				MiddleName,
				FamilyName,
				Telephone,
				Email,
				BirthDate,
				User,
				Password,
				permission,
				ConfirmDate
			) values (
				'$AdminID',
				'$CitizenID',
				'$Prefix',
				'$PersonName',
				'$GivenName',
				'$MiddleName',
				'$FamilyName',
				'$Telephone',
				'$Email',
				'$BirthDate',
				'$User',
				'".aesEncrypt($Password)."',
				'$permission',
				CURRENT_TIMESTAMP
			)
	";
	$result=mysql_query($query);
	
	$query="
		insert into	admin_hospital
			(
				AdminID,
				hospcode
			) values (
				'$AdminID',
				'$hospcode'
			)
	";
	$result=mysql_query($query);
	
	echo "complete";