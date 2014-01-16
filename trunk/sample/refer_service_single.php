<?php

require_once('./lib/nusoap.php');
include "common.php";
function QueryPatient($PersonID) {
$anm=split(",","PersonID,Name,Title,GivenName,FamilyName,NameSuffix,Gender,Birth,BirthPlace,Race,Nationality,Religion,Living,Address,Hospital,HospitalNumber,AdmissionNumber,Symtom,BloodType,BloodType,PhisicalExamination,FatherName,MotherName,SpouseName,FirstDiagnosis,LastDiagnosis,Emergency,TreatementRight,TransferReason,Description");
$where="";
if(trim($PersonID)!=""){
	$where=" where cid in( ".$PersonID.")  ";
}

//TransferReason, Description,NameSuffix,xxBirthPlace,xxxAddress,AdmissionNumber,Symtom,PhisicalExamination,LastDiagnosis,Emergency,
	$SqlString="select cid as PersonID,
					fname as Name,
					pname as Title,
					midname as GivenName,
					lname as FamilyName,
					patient.sex as Gender,
					birthday as Birth,
					citizenship as Race,
					nationality as Nationality,
					religion as Religion,
					death as Living,
					hcode as Hospital,
					patient.hn as HospitalNumber,
					bloodgrp as BloodType,
					concat(fathername,' ',fatherlname) as FatherName,
					concat(mathername,' ',motherlname) MotherName,
					concat(spsname,' ',spslname) as SpouseName,
					tname as FirstDiagnosis,
					pttype.name as TreatementRight
				from patient left join clinic_persist_icd on patient.hn=clinic_persist_icd.hn  
							left join icd101  on icd101.code=clinic_persist_icd.icd10 
							left join pttype on patient.pttype=pttype.pttype".$where ;
	//echo $SqlString;						
//*****************************vasu 13-11-2007************************
$r=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
$num=mysql_num_rows($r);
		$x=0;
		while($row=mysql_fetch_array($r)):
			$x=$x+1;
			//************* Per Record **********
			for($x=0;$x<count($anm)-1;$x++){
				if($x>0 and $x<=4){
					$return_value["patientDetail"]["Name"][$anm[$x]]=$row[$x];
				}else{
					if($anm[$x]=="BirthPlace" or $anm[$x]=="Address"){
					}else{
						$return_value["patientDetail"][$anm[$x]]=$row[$x];
					}
				}
				//echo $anm[$x].":=".$row[$x]."<br>";
			}
			//************* End Record **********
		endwhile;	
		//return array($return_value);
	
	$return_value =array("patientList"=>array("patientDetail" => array(
				"PersonID"=>"3939900078370",
				"Name"=>array("Title"=>"MR.",
				"Name"=>"Vasuthep",
				"GivenName"=>"x",
				"FamilyName"=>"Khunthong","Gender"),
				"Birth"=>date(19770527),
				"Race"=>"Thai",
				"Nationality"=>"Thai",
				"Religion"=>"Booda",
				"Living"=>"Y",
				"Hospital"=>"0000001",
				"HospitalNumber"=>"1111",
				"BloodType"=>"O",
				"FatherName"=>"Boonhai Khunthong",
				"MotherName"=>"Thitirat Khunthong",
				"SpouseName"=>"",
				"FirstDiagnosis"=>"",
				"TreatementRight"=>""),
				"patientDetail" => array(
				"PersonID"=>"3939900078999",
				"Name"=>array("Title"=>"MRS.",
				"Name"=>"VasuthepSS",
				"GivenName"=>"xS",
				"FamilyName"=>"SKhunthong","Gender"),
				"Birth"=>date(19770527),
				"Race"=>"SThai",
				"Nationality"=>"SThai",
				"Religion"=>"SBooda",
				"Living"=>"YS",
				"Hospital"=>"S0000001",
				"HospitalNumber"=>"S1111",
				"BloodType"=>"Os",
				"FatherName"=>"SBoonhai Khunthong",
				"MotherName"=>"SThitirat Khunthong",
				"SpouseName"=>"",
				"FirstDiagnosis"=>"",
				"TreatementRight"=>"")));
	return $return_value;
}

$operations = array("QueryRefer" => "QueryReferFunction");
$server = new soap_server("refer.wsdl"); 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
$server->service($HTTP_RAW_POST_DATA);  
//print_r( QueryPatient("'1111111111111'"));

?>
