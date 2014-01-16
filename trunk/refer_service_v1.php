<?php

require_once('./lib/nusoap.php');
include "common_soap.php";
function getDoctor($doctorID){
	$sql="select * from doctor where";
}
function getHos($hospcode) { 
	$anm=split(",","Hospital,HospitalName,Address,CallSign,ContactPerson,Telephone");
	if($hospcode<>""){
	//ContactPerson,Telephone,
		$SqlString="select hospcode as Hospital,
						concat(hospcode.hosptype,' ',hospcode.name) as HospitalName,
						full_name as Address,
						po_code as CallSign
					from hospcode left join thaiaddress on 
							hospcode.amppart=thaiaddress.amppart and
							hospcode.chwpart=thaiaddress.chwpart and
							hospcode.tmbpart=thaiaddress.tmbpart
					where hospcode in( ".$hospcode.")  ";
	}else{
		$SqlString="select hospcode as Hospital,
						hospcode.name as HospitalName,
						full_name as Address,
						po_code as CallSign
					from hospcode left join thaiaddress on 
							hospcode.amppart=thaiaddress.amppart and
							hospcode.chwpart=thaiaddress.chwpart and
							hospcode.tmbpart=thaiaddress.tmbpart";
	}
	//echo "<br>".$SqlString;
	$r=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
	$num=mysql_num_rows($r);
		$x=0;
		$stuff_array   = array(); 
		while($row=mysql_fetch_array($r)):
			$x=$x+1;
			//************* Per Record **********
			for($x=0;$x<count($anm)-1;$x++){
				//$return_value[$anm[$x]]=$row[$x];
				$return_value[$anm[$x]]=$row[$x];
			}
			//$stuff_array[]=$return_value;
			//************* End Record **********
		endwhile;	
		return $return_value;
}
function QueryPatient($PersonID) {
$anm=split(",","PersonID,Title,Name,GivenName,FamilyName,Gender,Birth,Race,Nationality,Religion,Living,Hospital,HospitalNumber,BloodType,FatherName,MotherName,SpouseName,FirstDiagnosis,TreatementRight,LastDiagnosis,Emergency,TransferReason,Description,NameSuffix,BirthPlace,Address,AdmissionNumber,Symtom,PhisicalExamination");
$where="";
if(trim($PersonID)!=""){
	$where=" where cid in( ".$PersonID.")  ";
}

//TransferReason, Description,NameSuffix,xxBirthPlace,xxxAddress,AdmissionNumber,Symtom,PhisicalExamination,LastDiagnosis,Emergency,
	$SqlString="select cid as PersonID,
					pname as Title,
					fname as Name,
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
					pre_diagnosis as FirstDiagnosis,
					pttype.name as TreatementRight
				from patient left join clinic_persist_icd on patient.hn=clinic_persist_icd.hn  
							left join icd101  on icd101.code=clinic_persist_icd.icd10 
							left join pttype on patient.pttype=pttype.pttype 
							left join referout on patient.hn=referout.hn ".$where ;
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
				if($x>0 and $x<=4){
					$return_value["patientDetail"]["Name"][$anm[$x]]=$row[$x];
				}else{
					if($anm[$x]=="BirthPlace" or $anm[$x]=="Address"){
					}elseif($anm[$x]=="Gender"){
						if($row[$x]==1){
							$return_value["patientDetail"]["Gender"]=iconv("tis-620","utf-8","ผู้หญิง");
						}else{
							$return_value["patientDetail"]["Gender"]=iconv("tis-620","utf-8","ชาย");
						}

					}elseif($anm[$x]=="Race"){
						$return_value["patientDetail"]["Race"]=iconv("tis-620","utf-8","ไทย");
					}elseif($anm[$x]=="Nationality"){
						$return_value["patientDetail"]["Nationality"]=iconv("tis-620","utf-8","ไทย");
					}elseif($anm[$x]=="Religion"){
						$return_value["patientDetail"]["Religion"]=iconv("tis-620","utf-8","พุทธ");
					}elseif($anm[$x]=="Hospital"){
						//array_push($return_value, getHos("'".$row[$x]."'"));
						$return_value["patientDetail"]["Hospital"]=getHos("'".$row[$x]."'");//$return_value["patientDetail"]["Hospital"][$anm[$x]]=$row[$x];
					}elseif($anm[$x]=="HospitalNumber"){
						//$return_value["patientDetail"]["HospitalNumber"]=getHos("'".$row[$x]."'");
					}else{
						$return_value["patientDetail"][$anm[$x]]=$row[$x];
					}
				}
			}
			$stuff_array[]=$return_value;
			//************* End Record **********
		endwhile;	
		return $stuff_array;
}

$operations = array("QueryRefer" => "QueryReferFunction");
$server = new soap_server("refer.wsdl"); 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
$server->service($HTTP_RAW_POST_DATA);  
//print_r( QueryPatient("'1111111111111'"));

?>
