<?php
	require_once('./lib/nusoap.php');
	include "common_soap.php";
	function getHos($hospcode) { 
		$anm=split(",","Hospital,HospitalName,Address,CallSign,ContactPerson,Telephone");
		if($hospcode<>""){
		//ContactPerson,Telephone,
			$SqlString="
				select	hospcode as Hospital,
						concat(hospcode.hosptype,' ',hospcode.name) as HospitalName,
						full_name as Address,
						po_code as CallSign
				from 	hospcode left join thaiaddress on 
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
	//function QueryLab($CitizenID,$LabDate,$HospitalNumber) {
	function QueryLab($CitizenID,$StartDate,$EndDate) {
		$anm=split(",","PersonalID,HospitalNumber,CitizenID,Gender,GivenName,FamilyName,address,BirthDate,Nationality,Race,MotherName,MotherCID,FatherName,FatherCID,VisitingNumber,LabID,PersonalID,LabDate,Description,ResultLabID,UniversalTestID,ResultLab,UnitID,LabReporter");

		if($StartDate!=""){
			$StartDate=explode("/", $StartDate);
			$StartDate=($StartDate[2]-543)."-".$StartDate[1]."-".$StartDate[0];
		}
		
		if($EndDate!=""){
			$EndDate=explode("/", $EndDate);
			$EndDate=($EndDate[2]-543)."-".$EndDate[1]."-".$EndDate[0];
		}
		
		$where="";
		if(trim($CitizenID)!=""){
			if($StartDate=="" && $EndDate==""){
				$where=" where person.CitizenID='$CitizenID'  ";
			}else if($StartDate!="" && $EndDate==""){
				$where="
					where	person.CitizenID='$CitizenID' and
							Left(lab_test.LabDate,10)='$StartDate'
				";
			}else if($StartDate=="" && $EndDate!=""){
				$where="
					where	person.CitizenID='$CitizenID' and
							Left(lab_test.LabDate,10)='$EndDate'
				";
			}else{
				$where="
					where	person.CitizenID='$CitizenID' and
							(
								Left(lab_test.LabDate,10)>='$StartDate' and
								Left(lab_test.LabDate,10)<='$EndDate'
							)
				";
			}
		}
		
		//TransferReason, Description,NameSuffix,xxBirthPlace,xxxAddress,AdmissionNumber,Symtom,PhisicalExamination,LastDiagnosis,Emergency,
		/*$SqlString="
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
		".$where ;*/
		
		$SqlString="
			select		person.PersonalID,
						person.CitizenID,
						person.Gender,
						person.GivenName,
						person.FamilyName,
						person.BirthDate,
						person.Nationality,
						lab_test.HospCode,
						lab_test.VisitingNumber,
						lab_test.LabCode,
						lab_test.PersonalID,
						lab_test.LabDate,
						lab_test.Description,
						lab_test_result.ResultLabID,
						lab_test_result.UniversalTestID,
						lab_test_result.ResultLab,
						lab_test_result.UnitCode,
						lab_test_result.ResultUniversal,
						lab_test_result.UnitUniversal,
						lab_test_result.ReferenceResult,
						lab_test_result.ReferenceUniversalTest,
						lab_test_result.LabReporter
			from		person left join lab_test on person.PersonalID=lab_test.PersonalID  
						left join  lab_test_result on lab_test.VisitingNumber=lab_test_result.VisitingNumber
		".$where."
			order by	lab_test.LabDate desc
		";
		
		//echo $SqlString;						
		//*****************************vasu 13-11-2007************************
		$tempFile=fopen("temp.txt",'w');
		fwrite($tempFile,$SqlString);
		fwrite($tempFile,"------------------------------------------------------------");
		$r=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
		$num=mysql_num_rows($r);
		fwrite($tempFile,"Numrows : $num");
		$x=0;
		$stuff_array=array(); 
		while($row=mysql_fetch_array($r)):
			
			$queryHN="
				select	HospitalNumber
				from	hospital_patient
				where	HospCode='$row[HospCode]' and
						PersonalID='$row[PersonalID]'
			";
			$resultHN=mysql_query($queryHN);
			$rowHN=mysql_fetch_array($resultHN);
			$HospitalNumber=$rowHN[HospitalNumber];
			
			if(trim($row["Gender"])=="2"){
				$Gender="ผู้หญิง";
			}else{
				$Gender="ชาย";
			}
			$stuff_array[$x]=array(
				"labOrderDetail"=>array(
						"PersonalID"=>$row[PersonalID],
						"ResultLabID"=>$row[ResultLabID],
						"UniversalTestID"=>$row[UniversalTestID],
						"ResultLab"=>$row[ResultLab],
						"UnitID"=>$row[UnitCode],
						"ResultUniversal"=>$row[ResultUniversal],
						"UnitUniversal"=>$row[UnitUniversal],
						"ReferenceResult"=>$row[ReferenceResult],
						"ReferenceUniversalTest"=>$row[ReferenceUniversalTest],
						"LabReporter"=>$row[LabReporter]
				),
				"patientDetail"=>array(
						"Name"=>array(
								"HospitalNumber"=>$HospitalNumber,
								"CitizenID"=>$row[CitizenID],
								"Gender"=>$Gender,
								"GivenName"=>$row[GivenName],
								"MiddleName"=>$row[MiddleName],
								"FamilyName"=>$row[FamilyName],
								"BirthDate"=>$row[BirthDate],
								"Nationality"=>$row[Nationality],
								"Race"=>$row[Race],
								"Religion"=>$row[Religion],
								"Living"=>$row[Living]
						)
				),
				"labOrder"=>array(
					"Hospital"=>$row[HospCode],
					"VisitingNumber"=>$row[VisitingNumber],
					"LabID"=>$row[LabCode],
					"PersonalID"=>$row[PersonalID],
					"LabDate"=>$row[LabDate],
					"Description"=>$row[Description]
				)
			);
			/*$x=$x+1;
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
			$stuff_array[]=$return_value;*/
			//************* End Record **********
			$x++;
		endwhile;	
		//echo $SqlString;
		return $stuff_array;
	}
	
	$operations = array("QueryLab" => "QueryLabFunction");
	//$server = new soap_server("lab.wsdl");
	$server=new soap_server("lab.wsdl", array('encoding'=>'UTF-8')); 
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
	$server->service($HTTP_RAW_POST_DATA);
	/*echo "<pre>";
	print_r( QueryLab("'3809900560555'","01/08/2556","31/08/2556"));
	echo "</pre>";*/
?>