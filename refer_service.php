<?php
	//header("Cache-Control: no-cache, must-revalidate");
	header('Content-Type: text/html; charset=utf-8');
	require_once('./lib/nusoap.php');
	include "common_soapx.php";
	function getDoctor($doctorID){
		$sql="select * from doctor where";
	}
	function getHos($hospcode) { 
		$anm=split(",","Hospital,HospitalName,Address,CallSign,ContactPerson,Telephone");
		if($hospcode<>""){
		//ContactPerson,Telephone,
			$SqlString="
				select	hospcode as Hospital,
						concat(hospcode.hosptype,' ',hospcode.name) as HospitalName,
						full_name as Address,
						po_code as CallSign
				from	hospcode left join thaiaddress on 
							hospcode.amppart=thaiaddress.amppart and
							hospcode.chwpart=thaiaddress.chwpart and
							hospcode.tmbpart=thaiaddress.tmbpart
				where	hospcode in( ".$hospcode.")  
			";
		}else{
			$SqlString="
				select	hospcode as Hospital,
						hospcode.name as HospitalName,
						full_name as Address,
						po_code as CallSign
				from	hospcode left join thaiaddress on 
							hospcode.amppart=thaiaddress.amppart and
							hospcode.chwpart=thaiaddress.chwpart and
							hospcode.tmbpart=thaiaddress.tmbpart
			";
		}
		//echo "<br>".$SqlString;
		$r=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
		$num=mysql_num_rows($r);
			$x=0;
			$stuff_array = array(); 
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
	function QueryPatient($PersonID,$Hospital,$HospitalNumber) {
		$anm=split(",","CitizenID,Prefix,GivenName,MiddleName ,FamilyName,Gender,BirthDate,Race,Nationality,Religion,LifeStatus ,Telephone,Email,Hospital,HospitalNumber,BloodGroupABO,BloodTypeRh,FatherName,MotherName,SpouseName,FirstDiagnosis,TreatementRight,LastDiagnosis,Emergency,TransferReason,Description,NameSuffix,BirthPlace,Address,AdmissionNumber,Symtom,PhisicalExamination");
		$where="";
		
		if(trim($PersonID)!=""){
			$where="
				where cid in( ".$PersonID.")
			";
		}else if(trim($Hospital)!="" && trim($HospitalNumber)!=""){
			$where="
				where	patient.hcode in( ".$Hospital.") and
						patient.hn in( ".$HospitalNumber.")
			";
		}else if(trim($Hospital)!="" && trim($HospitalNumber)=="" && trim($PersonID)==""){
			return "";
		}
		
		/*if(trim($PersonID)!=""){ //CitizenID
			$where=" where cid in( ".$PersonID.")  ";
		}
		if(trim($Hospital)!=""){ //HospCode
			$where=" where patient.hcode in( ".$Hospital.")  ";
		}
		if(trim($HospitalNumber)!=""){ //HN
			$where=" where patient.hn in( ".$HospitalNumber.")  ";
		}*/
		
		//TransferReason, Description,NameSuffix,xxBirthPlace,xxxAddress,AdmissionNumber,Symtom,PhisicalExamination,LastDiagnosis,Emergency,
			$SqlString="
				select	cid as CitizenID,
						pname as Prefix,
						fname as GivenName,
						midname as MiddleName,
						lname as FamilyName,
						patient.sex as Gender,
						birthday as BirthDate,
						citizenship as Race,
						nationality as Nationality,
						religion as Religion,
						death as LifeStatus,
						patient.informtel as Telephone,
						patient.email as Email,
						hcode as Hospital,
						patient.hn as HospitalNumber,
						bloodgrp as BloodGroupABO,
						concat(fathername,' ',fatherlname) as FatherName,
						concat(mathername,' ',motherlname) MotherName,
						concat(spsname,' ',spslname) as SpouseName,
						pre_diagnosis as FirstDiagnosis,
						pttype.name as TreatementRight,
						bloodgroup_rh as BloodTypeRh
				from	patient left join clinic_persist_icd on patient.hn=clinic_persist_icd.hn  
							left join icd101  on icd101.code=clinic_persist_icd.icd10 
							left join pttype on patient.pttype=pttype.pttype 
							left join referout on patient.hn=referout.hn 
			".$where;
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
				if($x>0 and $x<=10){
					
					if($anm[$x]=="Gender"){
						if(trim($row["Gender"])==2){
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
					$return_value["patientDetail"]["BloodGroupABO"]=$row[BloodGroupABO];
					$return_value["patientDetail"]["BloodTypeRh"]=$row[BloodTypeRh];
				}else{
					if($anm[$x]=="BirthPlace" or $anm[$x]=="Address"){
					}elseif($anm[$x]=="Hospital"){
						//array_push($return_value, getHos("'".$row[$x]."'"));
						$return_value["patientDetail"]["Hospital"]=getHos("'".$row[$x]."'");//$return_value["patientDetail"]["Hospital"][$anm[$x]]=$row[$x];
					}elseif($anm[$x]=="HospitalNumber"){
						//$return_value["patientDetail"]["HospitalNumber"]=getHos("'".$row[$x]."'");
						$return_value["patientDetail"]["HospitalNumber"]=$row[$x];
					}else{
						$return_value["patientDetail"][$anm[$x]]=$row[$x];
					}
				}
				$return_value["patientDetail"]["BloodGroupABO"]=$row[BloodGroupABO];
				$return_value["patientDetail"]["BloodTypeRh"]=$row[BloodTypeRh];
				//$return_value["patientDetail"]["Telephone"]=$row[Telephone];
				
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
	/*echo "<pre>";  
	print_r(QueryPatient("111"));*/
?>
