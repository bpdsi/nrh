<?php
	require_once('./lib/nusoap.php');
	include "common_soap.php";
	function checkPateint($PersonalID, $HospCode){
		$checkPatientx="insert";
		$sqlCheck="select PersonalID, HospCode from hospital_patient 
					where PersonalID=$PersonalID and HospCode='$HospCode'";
		$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
		$rowCheck=mysql_fetch_array($rCheck);
		if($rowCheck["PersonalID"]!="") $checkPatientx="update";
		
		return $checkPatientx;
	}
	function checkLab($LabID, $LabName, $HospCode){
		$sqlCheck="select LabCode, LabID, LabName from lab 
					where LabID='$LabID' and LabName='$LabName' and HospCode='$HospCode'";
		$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
		$rowCheck=mysql_fetch_array($rCheck);
		$LabID=$rowCheck["LabCode"];
		if($LabID==""){
			$sqlInsert="insert into lab(LabID, LabName, HospCode) values('$LabID', '$LabName', '$HospCode')";
			$rInsert=mysql_query($sqlInsert)or die(mysql_error()."<br>".$sqlInsert);
			
			$sqlCheck="select LabCode, LabID, LabName from lab 
						where LabID='$LabID' and LabName='$LabName' and HospCode='$HospCode'";
			$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
			$rowCheck=mysql_fetch_array($rCheck);
			$LabID=$rowCheck["LabCode"];
			return $LabID;	
		}else{
			return $LabID;
		}
	}
	function checkWard($WardName, $HospCode){
		$sqlCheck="select WardID, WardName from ward where WardName='$WardName' and HospCode='$HospCode'";
		$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
		$rowCheck=mysql_fetch_array($rCheck);
		$WardID=$rowCheck["WardID"];
		if($WardID==""){
			$sqlInsert="insert into ward(WardName, HospCode) values('$WardName', '$HospCode')";
			$rInsert=mysql_query($sqlInsert)or die(mysql_error()."<br>".$sqlInsert);
			
			$sqlCheck="select WardID, WardName from ward where WardName='$WardName' and HospCode='$HospCode'";
			$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
			$rowCheck=mysql_fetch_array($rCheck);
			$WardID=$rowCheck["WardID"];
			return $WardID;	
		}else{
			return $WardID;
		}
	}
	function checkMethod($MethodName){
		$MethodID="";
		if(trim($MethodName)!=""){
			$sqlCheck="select MethodID, MethodName from method where MethodName='$MethodName'";
			$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
			$rowCheck=mysql_fetch_array($rCheck);
			$MethodID=$rowCheck["MethodID"];
			if($MethodID==""){
				$sqlInsert="insert into method(MethodName, Description) values('$MethodName','Data Bank')";
				$rInsert=mysql_query($sqlInsert)or die(mysql_error()."<br>".$sqlInsert);
				
				$sqlCheck="select MethodID, MethodName from method where MethodName='$MethodName'";
				$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
				$rowCheck=mysql_fetch_array($rCheck);
				$MethodID=$rowCheck["MethodID"];
				return $MethodID;	
			}else{
				return $MethodID;
			}
		}
		return $MethodID;
	}
	function checkUnit($UnitID, $UnitName, $HospCode){
		$UnitID="";
		if(trim($UnitName)!=""){
			$UnitName=mysql_escape_string($UnitName);
			$sqlCheck="select UnitCode, UnitID, UnitName from unit 
						where UnitID='$UnitID' and UnitName='$UnitName' and HospCode='$HospCode'";
			$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
			$rowCheck=mysql_fetch_array($rCheck);
			$UnitID=$rowCheck["UnitCode"];
			if($UnitID==""){
				$sqlInsert="insert into unit(UnitID, UnitName, HospCode) values('$UnitID','$UnitName', '$HospCode')";
				$rInsert=mysql_query($sqlInsert)or die(mysql_error()."<br>".$sqlInsert);
				
				$sqlCheck="select UnitCode, UnitID, UnitName from unit 
						where UnitID='$UnitID' and UnitName='$UnitName' and HospCode='$HospCode'";
				$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
				$rowCheck=mysql_fetch_array($rCheck);
				$UnitID=$rowCheck["UnitCode"];
				return $UnitID;	
			}else{
				return $UnitID;
			}
		}
		return $UnitID;
	}
	//echo checkUnit("mg/dl");
	function checkUTest($UniversalTestName,$MethodID, $HospCode){
		$sqlCheck="select UniversalTestID, UniversalTestName from utest 
					where UniversalTestName='$UniversalTestName' and HospCode='$HospCode'";
		if(trim($MethodID)!="")$sqlCheck.=" and MethodID=$MethodID";
		$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
		$rowCheck=mysql_fetch_array($rCheck);
		$UniversalTestID=$rowCheck["UniversalTestID"];
		if($UniversalTestID==""){
			if(trim($MethodID)!=""){
				$sqlInsert="insert into utest(UniversalTestName, MethodID, HospCode)values('$UniversalTestName',$MethodID, '$HospCode')";
			}else{
					$sqlInsert="insert into utest(UniversalTestName, HospCode)values('$UniversalTestName','$HospCode')";
			}
			$rInsert=mysql_query($sqlInsert)or die(mysql_error()."<br>".$sqlInsert);
			
			$sqlCheck="select UniversalTestID, UniversalTestName from utest 
						where UniversalTestName='$UniversalTestName' and HospCode='$HospCode'";
			if(trim($MethodID)!="")$sqlCheck.=" and MethodID=$MethodID";
			$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
			$rowCheck=mysql_fetch_array($rCheck);
			$UniversalTestID=$rowCheck["UniversalTestID"];
			return $UniversalTestID;	
		}else{
			return $UniversalTestID;
		}
	}
	function checkPerson($CitizenID){
		$sqlCheck="select PersonalID from person where CitizenID='$CitizenID'";
		$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
		$rowCheck=mysql_fetch_array($rCheck);
		$PersonalID=$rowCheck["PersonalID"];
		return $PersonalID;
	}
	function checkLabTestID($LabTestID){
		$LabTestIDx="";
		$sqlCheck="select LabTestID, versionNumber from lab_test where LabTestID='$LabTestID'";
		$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
		$rowCheck=mysql_fetch_array($rCheck);
		if($rowCheck["LabTestID"]!=""){
			$LabTestIDx[0]=$rowCheck["LabTestID"];
			$LabTestIDx[1]=$rowCheck["versionNumber"];
		}
		return $LabTestIDx;
	}
	function checkStaff($CitizenID){
		$sqlCheck="select StaffID from staff where CitizenID='$CitizenID'";
		$rCheck=mysql_query($sqlCheck)or die(mysql_error()."<br>".$sqlCheck);
		$rowCheck=mysql_fetch_array($rCheck);
		$PersonalID=$rowCheck["StaffID"];
		return $PersonalID;
	}
	function InsertLabReport($params) {
		//var_dump($params);
		$string= "insert function<br>";
		//$string.=getString($params["CitizenID"]);
		
		//=============== Parse Patient Element ===================
		$DocumentID=$params["setId"]["!extension"];
		$versionNumber=$params["versionNumber"]["!value"];
		
		$DocumentIDx.="<tr><td>Document</td><td>".$DocumentID."</td></tr>";
		$DocumentIDx.="<tr><td>Document</td><td>".$versionNumber."</td></tr>";
		
		$CitizenID=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["CitizenID"];
		$Prefix=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["personName"]["Prefix"];
		$GivenName=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["personName"]["GivenName"];
		$MiddleName=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["personName"]["MiddleName"];
		$FamilyName=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["personName"]["FamilyName"];
		$Birthdate=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["Birthdate"];
		$BirthJurisdictionCountrySubDivision=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["BirthJurisdictionCountrySubDivision"];
		$Nationality=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["Nationality"];
		$Gender=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["Gender"];
		$Religion=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["Religion"];
		$LifeStatus=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["LifeStatus"];
		$Telephone=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["Telephone"];
		$Email=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["Email"];
		$HospCode=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["HospCode"];
		$Age=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["Age"];
		$HospitalNumber=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["HospitalNumber"];
		$AdmissionNumber=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["AdmissionNumber"];
		$BloodGroupABO=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["BloodGroupABO"];
		$BloodTypeRh=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["BloodTypeRh"];
		$PreDiagnosis=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["PreDiagnosis"];
		$InsType=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["patient"]["InsType"];
		//=============== Finish Parse Patient Element ===================
		
		//=============== Parse labResult Element ===================
		$VisitingNumber=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["VisitingNumber"];
		$LabID=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["LabID"];
		$LabName=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["LabName"];
		$LabDate=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["LabDate"];
		$WardID=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["WardID"];
		$WardName=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["WardName"];
		//=============== Parse sub labResult Requestr Element ===================
		$RequestCitizenID=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["CitizenID"];
		$RequestPrefix=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["personName"]["Prefix"];
		$RequestGivenName=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["personName"]["GivenName"];
		$RequestMiddleName=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["personName"]["MiddleName"];
		$RequestFamilyName=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["personName"]["FamilyName"];
		$RequestBirthdate=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["Birthdate"];
		$RequestBirthJurisdictionCountrySubDivision=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["BirthJurisdictionCountrySubDivision"];
		$RequestNationality=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["Nationality"];
		$RequestGender=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["Gender"];
		$RequestReligion=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["Religion"];
		$RequestLifeStatus=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["LifeStatus"];
		$RequestEmail=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["Email"];
		$RequestTelephone=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labRequester"]["Telephone"];
		//=============== Finish Parse sub labResult Requestr Element ===================
		//=============== Finish Parse labResult Element ===================
		
		//=============== Parse labResult detail Element ===================
		$LabDetail=$params["component"]["structuredBody"]["component"]["section"]["entry"]["labReport"]["labResult"]["labResultDetail"];
		
		$universalTestNamex="";
		
		//=========== Check pateint ==================
			$PersonalID=checkPerson($CitizenID);
			$HospCode=$HospCode;
			$HospitalNumber=$HospitalNumber;
			$CitizenID=$CitizenID;
			$BloodGroupABO=$BloodGroupABO;
			$BloodTypeRh=$BloodTypeRh;
			$PreDiagnosis=$PreDiagnosis;
			$InsuranceType=$InsType;
			$checkHavePatient=checkPateint($PersonalID,$HospCode);
			$universalTestNamex.="<tr><td>Check pateint type</td><td>$checkHavePatient</td></tr>";
			if($checkHavePatient=="insert"){
				$sqlInsertpatient="insert into hospital_patient(PersonalID, HospCode, HospitalNumber, CitizenID, BloodGroupABO, BloodTypeRh, PreDiagnosis, InsuranceType)values($PersonalID, '$HospCode', '$HospitalNumber', '$CitizenID', '$BloodGroupABO', '$BloodTypeRh', '$PreDiagnosis', '$InsuranceType')";
			}elseif($checkHavePatient=="update"){
				$sqlInsertpatient="update hospital_patient set HospitalNumber='$HospitalNumber', CitizenID='$CitizenID', BloodGroupABO='$BloodGroupABO', BloodTypeRh='$BloodTypeRh', PreDiagnosis='$PreDiagnosis', InsuranceType='$InsuranceType' where PersonalID=$PersonalID and  HospCode='$HospCode'";
			}
			$universalTestNamex.="<tr><td>Check pateint</td><td>$sqlInsertpatient</td></tr>";
			mysql_query($sqlInsertpatient)or die(mysql_error());
		//===========Lab Request Insert ==============
			$LabTestID=$DocumentID;
			$PersonalID=checkPerson($CitizenID);
			$VisitingNumber=$VisitingNumber;
			$HospCode=$HospCode;
			$StaffID=checkStaff($RequestCitizenID);
			$WardID=checkWard($WardName,$HospCode);
			$LabCode=checkLab($LabID,$LabName,$HospCode);
			$LabDate=$LabDate;
			$versionNumber=$versionNumber;
			$checkLabTestIDx=checkLabTestID($LabTestID);
			if(count($checkLabTestIDx)>0){
				$LabTestID_Old=$checkLabTestIDx[0];
				$versionNumber_Old=$checkLabTestIDx[1];
				//$universalTestNamex.="<tr><td>Check Array</td><td>Is Array|$LabTestID_Old::$versionNumber_Old::$xx|</td></tr>";
			}else{
				$LabTestID_Old=$checkLabTestIDx;
				$versionNumber_Old="";
				//$universalTestNamex.="<tr><td>Check Array</td><td>Not Array |$LabTestID_Old::$versionNumber_Old|</td></tr>";
			}
			//$universalTestNamex.="<tr><td>rr</td><td>".$checkLabTestIDx[0]."::".$checkLabTestIDx[1]."</td></tr>";
			$resultCheck="";
			if(trim($LabTestID_Old)==""){
				$sqlInsertlab_test="insert into lab_test(LabTestID, versionNumber, PersonalID, VisitingNumber, HospCode, StaffID, WardID, LabCode, LabDate)values('$LabTestID', '$versionNumber', $PersonalID, '$VisitingNumber', '$HospCode', $StaffID, $WardID, $LabCode, '$LabDate')";
				$universalTestNamex.="<tr><td>Insert Lab Request</td><td>".$sqlInsertlab_test."</td></tr>";
				mysql_query($sqlInsertlab_test)or die(mysql_error());
				$resultCheck="insert";
			}else{
				if(trim($LabTestID_Old)==$LabTestID and trim($versionNumber_Old)!=$versionNumber){
					$sqlInsertlab_test="update lab_test set versionNumber='$versionNumber', StaffID=$StaffID, WardID=$WardID, LabCode=$LabCode, LabDate='$LabDate' where LabTestID='$LabTestID'";
					$universalTestNamex.="<tr><td>Update Lab Request</td><td>".$sqlInsertlab_test."</td></tr>";
					mysql_query($sqlInsertlab_test)or die(mysql_error());
				}
				$resultCheck="update";
			}
			//$universalTestNamex.="<tr><td>Lab Request Manage</td><td>".$sqlInsertlab_test."</td></tr>";
		//=========== Finsih Lab Request Insert ==============	
		//$universalTestNamex="";
		for($n=0;$n<count($LabDetail);$n++){
			$LabDetailA=$LabDetail[$n];
			
			//===========Lab Result Detail ==============
			$LabReporterx=$LabDetailA["LabReporter"]["CitizenID"];
			$UniversalTestName=$LabDetailA["UniversalTestName"];
			$MethodName=$LabDetailA["MethodName"];
			$UnitID=$LabDetailA["UnitID"];
			$UnitName=$LabDetailA["UnitName"];
			$LabResultDate=$LabDetailA["LabResultDate"]; 
			$ResultLab=$LabDetailA["ResultTest"]; 
			$ReferenceResultTest=$LabDetailA["ReferenceResultTest"];
			$ResultUniversal=$LabDetailA["ResultUniversal"];
			$ReferenceUniversal=$LabDetailA["ReferenceUniversal"];
			$UnitUniversal=$LabDetailA["UnitUniversal"];
			$LabTestID=$DocumentID;
			$VisitingNumber=$VisitingNumber;
			$HospCode=$HospCode;
			$MethodID=checkMethod($MethodName);
			$UniversalTestID=checkUTest($UniversalTestName,$MethodID,$HospCode);
			$StaffID=checkPerson($ReporterCitizenID);
		
			
			$UnitCode=checkUnit($UnitID, $UnitName,$HospCode);
			$UnitUniversal=checkUnit("",$UnitUniversal,$HospCode);
			$ReferenceUniversalTest="";
			$LabReporter=checkStaff($LabReporterx);
			if(trim($UnitUniversal)=="")$UnitUniversal="Null";
			if($resultCheck=="insert"){
				$sqlInsertlab_test_result="insert into lab_test_result(LabTestID, VisitingNumber, HospCode, UniversalTestID, ResultLab, UnitCode, ReferenceResult, ResultUniversal, UnitUniversal, ReferenceUniversalTest, LabResultDate, LabReporter)values('$LabTestID', '$VisitingNumber', '$HospCode', $UniversalTestID, '$ResultLab', $UnitCode, '$ReferenceResult', '$ResultUniversal', $UnitUniversal, '$ReferenceUniversalTest', '$LabResultDate', $LabReporter)";
			}elseif($resultCheck=="update"){
				$sqlInsertlab_test_result="update lab_test_result set VisitingNumber='$VisitingNumber', ResultLab='$ResultLab', UnitCode=$UnitCode, ReferenceResult='$ReferenceResult', ResultUniversal='$ResultUniversal', UnitUniversal=$UnitUniversal, ReferenceUniversalTest='$ReferenceUniversalTest', LabResultDate='$LabResultDate', LabReporter=$LabReporter where LabTestID='$LabTestID' and UniversalTestID=$UniversalTestID and HospCode='$HospCode'";
			}
			$universalTestNamex.="<tr><td>Lab Result Detail Manage</td><td>".$sqlInsertlab_test_result."</td></tr>";
			mysql_query($sqlInsertlab_test_result)or die(mysql_error());
		}
		
		$i=0;
		$LabResultDetail="";
		
		foreach ($LabDetail as $v1 => $value) {
		$LabResultDetail.="<tr><td colspan='2' bgcolor='blue'>Lab no ".$i."</td></tr>";
		$i++;
			if(is_array($value)){
				foreach ($value as $key => $valx) {
					if(is_array($valx)){
						foreach ($valx as $key2 => $valx2) {
							if(is_array($valx2)){
								$LabResultDetail.="<tr><td>".$key2."</td><td></td></tr>";
								foreach ($valx2 as $key3 => $valx3) {
									$LabResultDetail.="<tr><td>$i.".$key3."</td><td>".$valx3."</td></tr>";
								}
							}else{
								$valstring=iconv("utf-8","tis-620",$valx2);
								$LabResultDetail.="<tr><td>x$i.".$key2."</td><td>x".$valstring."</td></tr>";
							}
						}
					}else{
						$LabResultDetail.="<tr><td>s$i.".$key."</td><td>".$valx."</td></tr>";
					}
				}
			}else{
				$LabResultDetail.="<tr><td>$i.".$v1."</td><td>".$value."</td></tr>";
			}
		}
		
		//=============== Finsh Parse labResult detail Element ===================
		$patient="<tr><td colspan='2' bgcolor='yellow'>Patient</td></tr>";
		$patient.="<tr><td>CitizenID</td><td>$CitizenID</td></tr>";
		$patient.="<tr><td>Person Name</td><td>$Prefix $GivenName $FamilyName $MiddleName</td></tr>";
		$patient.="<tr><td>Birthdate</td><td>$Birthdate</td></tr>";
		$patient.="<tr><td>BirthJurisdictionCountrySubDivision</td><td>$BirthJurisdictionCountrySubDivision</td></tr>";
		$patient.="<tr><td>Nationality</td><td>$Nationality</td></tr>";
		$patient.="<tr><td>Gender</td><td>$Gender</td></tr>";
		$patient.="<tr><td>Religion</td><td>$Religion</td></tr>";
		$patient.="<tr><td>LifeStatus</td><td>$LifeStatus</td></tr>";
		$patient.="<tr><td>Telephone</td><td>$Telephone</td></tr>";
		$patient.="<tr><td>Email</td><td>$Email</td></tr>";
		$patient.="<tr><td>HospCode</td><td>$HospCode</td></tr>";
		$patient.="<tr><td>Age</td><td>$Age</td></tr>";
		$patient.="<tr><td>HospitalNumber</td><td>$HospitalNumber</td></tr>";
		$patient.="<tr><td>AdmissionNumber</td><td>$AdmissionNumber</td></tr>";
		$patient.="<tr><td>BloodGroupABO</td><td>$BloodGroupABO</td></tr>";
		$patient.="<tr><td>BloodTypeRh</td><td>$BloodTypeRh</td></tr>";
		$patient.="<tr><td>PreDiagnosis</td><td>$PreDiagnosis</td></tr>";
		$patient.="<tr><td>InsType</td><td>$InsType</td></tr>";
		
		$labResult="<tr><td colspan='2' bgcolor='yellow'>labResult</td></tr>";
		$labResult.="<tr><td colspan=2>Request Lab</td></tr>";
		$labResult.="<tr><td>VisitingNumber</td><td>$VisitingNumber</td></tr>";
		$labResult.="<tr><td>LabID</td><td>$LabID</td></tr>";
		$labResult.="<tr><td>LabName</td><td>$LabName</td></tr>";
		$labResult.="<tr><td>LabDate</td><td>$LabDate</td></tr>";
		$labResult.="<tr><td>WardID</td><td>$WardID</td></tr>";
		$labResult.="<tr><td>WardName</td><td>$WardName</td></tr>";
		$labResult.="<tr><td colspan='2' bgcolor='yellow'>Requester</td></tr>";
		$labResult.="<tr><td>RequestCitizenID</td><td>$RequestCitizenID</td></tr>";
		$labResult.="<tr><td>RequestPrefix</td><td>$RequestPrefix</td></tr>";
		$labResult.="<tr><td>RequestGivenName</td><td>$RequestGivenName</td></tr>";
		$labResult.="<tr><td>RequestMiddleName</td><td>$RequestMiddleName</td></tr>";
		$labResult.="<tr><td>RequestFamilyName</td><td>$RequestFamilyName</td></tr>";
		$labResult.="<tr><td>RequestBirthdate</td><td>$RequestBirthdate</td></tr>";
		$labResult.="<tr><td>RequestBirthJurisdictionCountrySubDivision</td><td>$RequestBirthJurisdictionCountrySubDivision</td></tr>";
		$labResult.="<tr><td>RequestNationality</td><td>$RequestNationality</td></tr>";
		$labResult.="<tr><td>RequestGender</td><td>$RequestGender</td></tr>";
		$labResult.="<tr><td>RequestReligion</td><td>$RequestReligion</td></tr>";
		$labResult.="<tr><td>RequestLifeStatus</td><td>$RequestLifeStatus</td></tr>";
		$labResult.="<tr><td>RequestTelephone</td><td>$RequestTelephone</td></tr>";
		$labResult.="<tr><td>RequestEmail</td><td>$RequestEmail</td></tr>";
		
		
		$string.="<table border=1 cellspacing=0 cellpadding=0>";//.count($params);
		$string.=$DocumentIDx;
		
		$string.=$patient.$labResult.$universalTestNamex.$LabResultDetail;
		
		
		/*$i=0;
		foreach ($params as $v1 => $value) {
		$i++;
			if(is_array($value)){
				//$string.="$i.Array";
				foreach ($value as $key => $valx) {
					if(is_array($valx)){
						foreach ($valx as $key2 => $valx2) {
							if(is_array($valx2)){
								$string.="<tr><td>".$key2."</td><td></td><td></td></tr>";
								foreach ($valx2 as $key3 => $valx3) {
									$string.="<tr><td>-</td><td>$i.".$key3."</td><td>".$valx3."</td></tr>";
								}
							}else{
								//$valstring=iconv("tis-620","tis-620",$valx2);
								$valstring=iconv("utf-8","tis-620",$valx2);
								$string.="<tr><td>x$i.".$key2."</td><td>x".$valstring."</td></tr>";
							}
						}
					}else{
						$string.="<tr><td>s$i.".$key."</td><td>".$valx."</td></tr>";
					}
				}
			}else{
				$string.="<tr><td>$i.".$v1."</td><td>".$value."</td></tr>";
			}
		}*/
		$string.="</table>";
		//$string.=$params;
		return $string;
	}
	
	
	$operations = array("InsertLabReport" => "InsertLabFunction");
	$server = new soap_server("labReportx.wsdl"); 
	//$server = new soap_server(); 
	//$server->register("InsertLab");
	//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
	$server->service($HTTP_RAW_POST_DATA);  
?>
