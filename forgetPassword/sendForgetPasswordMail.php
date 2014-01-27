<?php
	include "../function/functionPHP.php";

	host("nrh");
	
	$system=$_POST["system"];
	$message=$_POST["message"];
	
	if($_POST["CitizenID"]!=""){
		$CitizenID=$_POST["CitizenID"];
	}else if($_POST["User"]!=""){
		$User=$_POST["User"];
	}
	
	if($system=="healthDatabank"){
		if($CitizenID!=""){
			$query="
				select	*
				from	person
				where	CitizenID='$CitizenID'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				$row=mysql_fetch_array($result);
				$Email=$row[Email];
			}
		}else if($User!=""){
			$query="
				select	*
				from	person
				where	User='$User'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				$row=mysql_fetch_array($result);
				$Email=$row[Email];
			}
		}
		$PersonName=$row[PersonName];
	}else if($system=="vaccination"){
		if($CitizenID!=""){
			$query="
				select	*
				from	vcp_person
				where	CitizenID='$CitizenID'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				$row=mysql_fetch_array($result);
				$Email=$row[Email];
			}
		}else if($User!=""){
			$query="
				select	*
				from	vcp_person
				where	User='$User'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				$row=mysql_fetch_array($result);
				$Email=$row[Email];
			}
		}
		$PersonName=$row[PersonName];
	}
	
	if($system=="healthDatabank"){
		$systemName="ระบบฐานข้อมูลสุขภาพ (Personal Health Databank)";
	}else{
		$systemName="ระบบสมุดพกวัคซีน (Vaccination Pocket Book)";
	}
		
	$message=str_replace('\"','"',$message);
	
	sendMail($row[Email], $row[PersonName], "ระบบกู้คืนรหัสผ่าน $systemName", $message);
	echo "complete";