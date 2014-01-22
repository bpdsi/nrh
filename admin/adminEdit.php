<?php
	include "../function/functionPHP.php";
	
	$CitizenID=$_POST["CitizenID"];
	$Prefix=$_POST["Prefix"];
	$PersonName=$_POST["Name"];
	$Telephone=$_POST["Telephone"];
	$Email=$_POST["Email"];
	$BirthTemp=explode("/", $_POST["BirthDate"]);
	$BirthDate=($BirthTemp[2]-543)."-".$BirthTemp[1]."-".$BirthTemp[0];
	$permission=$_POST["permission"];
	$hospcode=$_POST["hospcode"];
	
	
	$AdminID=$_POST["AdminID"];
	
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
		update	admin
		set		CitizenID='$CitizenID',
				Prefix='$Prefix',
				PersonName='$PersonName',
				GivenName='$GivenName',
				MiddleName='$MiddleName',
				FamilyName='$FamilyName',
				Telephone='$Telephone',
				Email='$Email',
				BirthDate='$BirthDate',
				permission='$permission'
		where	AdminID='$AdminID'
	";
	$result=mysql_query($query);
	
	$query="
		update	admin_hospital
		set		hospcode='$hospcode'
		where	AdminID='$AdminID'
	";
	$result=mysql_query($query);
	
	echo "complete";