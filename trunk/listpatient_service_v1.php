<?php
	//header("Cache-Control: no-cache, must-revalidate");
	require_once('./lib/nusoap.php');
	include "common_soap.php";
	
	function QueryListPatient($CitizenID,$Hospital,$HospitalNumber,$AllowDate,$VisitingNumber) {
		$anm=split(",","CitizenID,Hospital,HospitalNumber,VisitingNumber ,AllowDate");
		$where="";
		$whereDate="";
		
		if(trim($CitizenID)!=""){
			$where.="
				and person.CitizenID in( ".$CitizenID.")
			";
		}
		if(trim($HospitalNumber)!=""){
			if(trim($Hospital)!=""){
			$where.="
				and	hospital_patient.HospCode in( ".$Hospital.") and
						hospital_patient.HospitalNumber in( ".$HospitalNumber.")";
			}else{
				$where.="and hospital_patient.HospitalNumber in( ".$HospitalNumber.")";
			}
		}
		if(trim($Hospital)!=""){
			$where.=" and	hospital_patient.HospCode in( ".$Hospital.")";
		}
		if(trim($AllowDate)!=""){
			$whereDate.="
				and	((date(person_allow.AllowDate) <='".$AllowDate."' and person_allow.AllowType='Unconditioned') or date(person_allow.AllowDate) ='".$AllowDate."') ";
			/*$whereDate.=" and ((date(person_allow.AllowDate) <='".$AllowDate."' and person_allow.AllowType='Unconditioned') 
				and PersonalID not in (select PersonalID from person_allow where date(person_allow.AllowDate) <='".$AllowDate."' and AllowType='PerDay' ))";*/
		}
		if(trim($Hospital)=="" && trim($HospitalNumber)=="" && trim($CitizenID)==""){
			return "";
		}
		
		
		//TransferReason, Description,NameSuffix,xxBirthPlace,xxxAddress,AdmissionNumber,Symtom,PhisicalExamination,LastDiagnosis,Emergency,
			$SqlString="
				select distinct person.CitizenID,hospital_patient.HospCode as Hospital,
						HospitalNumber,HospitalNumber as VisitingNumber 
					from person, hospital_patient, person_allow
					where person.PersonalID=person_allow.PersonalID  and AllowStatus='accepted'
							and person.PersonalID=hospital_patient.PersonalID
							and person.CitizenID=hospital_patient.CitizenID
			".$where.$whereDate;
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
				$return_value[$anm[$x]]=$row[$anm[$x]];
			}
			$stuff_array[]=$return_value;
			//************* End Record **********
		endwhile;	
		return $stuff_array;
	}
	
	$operations = array("QueryListPatient" => "QueryListPatientFunction");
	$server = new soap_server("listpatient.wsdl"); 
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
	$server->service($HTTP_RAW_POST_DATA);  
	//print_r( QueryListPatient("'3809900560555'"));
	//echo"dddddddddddddddddddd";
	//print_r( QueryListPatient("","10680","","2013-09-03",""));
?>
