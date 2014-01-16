<?php
	header('Content-Type: text/html; charset=utf-8');
	
	include "../function/functionPHP.php";
	host("nrh");
	
	$CitizenID=$_POST["CitizenID"];
	$Hospital=$_POST["Hospital"];
	
	$query="
		select	*
		from	person
		where	CitizenID='$CitizenID'
	";
	$result=mysql_query($query);
	$person=mysql_fetch_array($result);
	if(mysql_num_rows($result)==0){
		echo "notFound";
	}else{
		$query="
			select	*
			from	hospital_patient
			where	PersonalID='$person[PersonalID]'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$HospitalNumber=$row[HospitalNumber];
		echo "$person[CitizenID]:$HospitalNumber:$person[PersonName]:$person[Telephone]:$person[Email]:$person[Prefix]:$person[BloodGroupABO]:$person[BloodTypeRh]:".(dateRevert($person[BirthDate]));
	}