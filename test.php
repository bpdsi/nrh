<?php
	$host     = "localhost";
	$username = "npr";
	$password = "1234";
    $dbname="npr";
	$connect  = mysql_connect($host, $username, $password);
	mysql_select_db($dbname, $connect);
	$charset = "SET character_set_results=utf8"; mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	$charset = "SET character_set_client=utf8"; mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	//$charset = "SET character_set_results=utf8"; mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	$charset = "SET character_set_connection=utf8"; mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	
		$anm=split(",","PersonalID,HospitalNumber,CitizenID,Gender,GivenName,FamilyName,address,BirthDate,Nationality,Race,MotherName,MotherCID,FatherName,FatherCID,VisitingNumber,LabID,PersonalID,LabDate,Description,ResultLabID,UniversalTestID,ResultLab,UnitID");
		$where="";
		if(trim($CitizenID)!=""){
			$where=" where patient.CitizenID in( 3809900560555)  ";
		}
		
		//TransferReason, Description,NameSuffix,xxBirthPlace,xxxAddress,AdmissionNumber,Symtom,PhisicalExamination,LastDiagnosis,Emergency,
		$SqlString="
			select	patient.PersonalID,
					patient.HospitalNumber,
					patient.CitizenID,
					patient.Gender,
					patient.GivenName,
					patient.FamilyName,
					patient.address,
					patient.BirthDate,
					patient.Nationality,
					patient.Race,
					patient.MotherName,
					patient.MotherCID,
					patient.FatherName,
					patient.FatherCID,
					lab_test.VisitingNumber,
					lab_test.LabID,
					lab_test.PersonalID,
					lab_test.LabDate,
					lab_test.Description,
					lab_test_result.ResultLabID,
					lab_test_result.UniversalTestID,
					lab_test_result.ResultLab,
					lab_test_result.UnitID
			from	patient left join lab_test on patient.PersonalID=lab_test.PersonalID  
					left join  lab_test_result on lab_test.VisitingNumber=lab_test_result.VisitingNumber 
		".$where ;
		
		$SqlString="
			select	person.PersonalID,
					person.CitizenID,
					person.Gender,
					person.GivenName,
					person.FamilyName,
					person.BirthDate,
					person.Nationality,
					lab_test.VisitingNumber,
					lab_test.LabID,
					lab_test.PersonalID,
					lab_test.LabDate,
					lab_test.Description,
					lab_test_result.ResultLabID,
					lab_test_result.UniversalTestID,
					lab_test_result.ResultLab,
					lab_test_result.UnitID
			from	person left join lab_test on person.PersonalID=lab_test.PersonalID  
					left join  lab_test_result on lab_test.VisitingNumber=lab_test_result.VisitingNumber 
		".$where;
		
		mysql_query("update config set cfgValue='$SqlString.$where' where cfgName='$temp'");
		//echo $SqlString;						
		//*****************************vasu 13-11-2007************************
		$r=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
		$num=mysql_num_rows($r);
		$x=0;
		$stuff_array   = array(); 
		while($row=mysql_fetch_array($r)):
			$x=$x+1;
			//************* Per Record **********
			for($x=0;$x<count($anm)-1;$x++){
				if($x>0 and $x<=13){
					
					if($anm[$x]=="Gender"){
						if(trim($row["Gender"])=="2"){
							$return_value["patientDetail"]["Name"]["Gender"]="ผู้หญิง";
						}else{
							$return_value["patientDetail"]["Name"]["Gender"]="ชาย";
						}
	
					}elseif($anm[$x]=="Race"){
						$return_value["patientDetail"]["Name"]["Race"]="ไทย";
					}elseif($anm[$x]=="Nationality"){
						$return_value["patientDetail"]["Name"]["Nationality"]="ไทย";
					}elseif($anm[$x]=="Religion"){
						$return_value["patientDetail"]["Name"]["Religion"]="พุทธ";
					}else{
						$return_value["patientDetail"]["Name"][$anm[$x]]=$row[$x];
					}
				}elseif($x>13 and $x<=18){
					//echo $anm[$x];
					$return_value["labOrder"][$anm[$x]]=$row[$x];
				}else{
					$return_value["labOrderDetail"][$anm[$x]]=$row[$x];
				}
			}
			$stuff_array[]=$return_value;
			//************* End Record **********
		endwhile;	
		echo "<pre>";	
		print_r($stuff_array);
?>