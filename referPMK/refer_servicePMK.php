<?php
	//header("Cache-Control: no-cache, must-revalidate");
	header('Content-Type: text/html; charset=utf-8');
	require_once('../lib/nusoap.php');
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
		$anm=split(",","CitizenID,Prefix,GivenName,MiddleName ,FamilyName,Gender,BirthDate,Race,Nationality,Religion,LifeStatus ,Telephone,Email,Hospital,HospitalNumber,BloodType,FatherName,MotherName,SpouseName,FirstDiagnosis,TreatementRight,LastDiagnosis,Emergency,TransferReason,Description,NameSuffix,BirthPlace,Address,AdmissionNumber,Symtom,PhisicalExamination");
		$where="";
		
		if(trim($PersonID)!=""){
			$where="
				where ID_CARD in( ".$PersonID.")
			";
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
				select	ID_CARD as CitizenID,
						PRENAME as Prefix,
						NAME as GivenName,
						'' as MiddleName,
						SURNAME as FamilyName,
						SEX as Gender,
						BIRTHDAY as BirthDate,
						TEL as Telephone,
						HOME_E_MAIL as Email,
						HN as 'HospitalNumber'
				from	patients 
			".$where;
			//echo $SqlString;						
		//*****************************vasu 13-11-2007************************
		$r=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
		$num=mysql_num_rows($r);
		$x=0;
		$stuff_array   = array();
		while($row=mysql_fetch_array($r)):
			$x=$x+1;
			
			$return_value["patientDetail"]["CitizenID"]=$row[CitizenID];
			
			$return_value["patientDetail"]["Name"]["Prefix"]=$row[Prefix];
			$return_value["patientDetail"]["Name"]["GivenName"]=$row[GivenName];
			$return_value["patientDetail"]["Name"]["MiddleName"]=$row[MiddleName];
			$return_value["patientDetail"]["Name"]["FamilyName"]=$row[FamilyName];
			
			if(trim($row["Gender"])=="F"){
				$return_value["patientDetail"]["Name"]["Gender"]="ผู้หญิง";
			}else{
				$return_value["patientDetail"]["Name"]["Gender"]="ชาย";
			}

			$return_value["patientDetail"]["Name"]["BirthDate"]=$row[BirthDate];
			$return_value["patientDetail"]["Name"]["BirthDate"]=$row[BirthDate];
			$return_value["patientDetail"]["Name"]["Race"]="ไทย";
			$return_value["patientDetail"]["Name"]["Nationality"]="ไทย";
			$return_value["patientDetail"]["Name"]["Religion"]="พุทธ";
			$return_value["patientDetail"]["Name"]["LifeStatus"]="N";
			
			$return_value["patientDetail"]["Telephone"]=$row[Telephone];
			$return_value["patientDetail"]["Email"]=$row[Email];
			$return_value["patientDetail"]["Hospital"]["Hospital"]="";
			$return_value["patientDetail"]["Hospital"]["HospitalName"]="";
			$return_value["patientDetail"]["Hospital"]["Address"]="";
			$return_value["patientDetail"]["Hospital"]["CallSign"]="";
			$return_value["patientDetail"]["Hospital"]["ContactPerson"]="";
			
			$return_value["patientDetail"]["HospitalNumber"]=$row[HospitalNumber];
			$return_value["patientDetail"]["BloodType"]="";
			$return_value["patientDetail"]["FatherName"]="";
			$return_value["patientDetail"]["MotherName"]="";
			$return_value["patientDetail"]["SpouseName"]="";
			$return_value["patientDetail"]["FirstDiagnosis"]="";
			$return_value["patientDetail"]["TreatementRight"]="";
			$return_value["patientDetail"]["LastDiagnosis"]="";
			$return_value["patientDetail"]["Emergency"]="";
			$return_value["patientDetail"]["TransferReason"]="";
			$return_value["patientDetail"]["Description"]="";
			$return_value["patientDetail"]["NameSuffix"]="";
			$return_value["patientDetail"]["AdmissionNumber"]="";
			$return_value["patientDetail"]["Symtom"]="";

                            /*[] => VASUTHEP
                            [ ] => 
                            [] => KHUNTHONG
                            [Race] => ไทย
                            [Nationality] => ไทย
                            [Religion] => พุทธ
                            [ ] => N*/

			
			
			
			//************* Per Record **********
			/*for($x=0;$x<count($anm)-1;$x++){
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
			}*/
			$stuff_array[]=$return_value;
			//************* End Record **********
		endwhile;	
		return $stuff_array;
	}
	
	$operations = array("QueryRefer" => "QueryReferFunction");
	$server = new soap_server("../refer.wsdl"); 
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
	$server->service($HTTP_RAW_POST_DATA);
	echo "<pre>";  
	print_r( QueryPatient("3809900560555","",""));
?>
