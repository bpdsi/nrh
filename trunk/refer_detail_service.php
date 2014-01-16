<?php

require_once('./lib/nusoap.php');
include "common_soap.php";
function QueryRefer($personalid){
//referout.hn as HospitalNumber, 
if($personalid!=""){
	$where=" and patient.cid in (".$personalid.")";
}
$anm=split(",","refer_number,refer_date,refer_time,Hospital,PersonID,refer_type,refer_cause,refer_point,department");
//hospcode as Hospital,
	$SqlString="select 
				refer_number,
				refer_date, 
				refer_time,
				patient.hcode as Hospital, 
				cid as PersonID,
				refer_type.refer_type_name as refer_type, 
				refer_cause.name as refer_cause,
				refer_point, 
				department
			from referout, pttype, patient, refer_cause, refer_type 
			where referout.pttype=pttype.pttype
				and patient.hn=referout.hn
				and referout.refer_cause=refer_cause.id
				and referout.refer_type=refer_type.refer_type".$where;
	//echo $SqlString;
	$r=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
	$num=mysql_num_rows($r);
		$n=0;
		$stuff_array   = array(); 
		while($row=mysql_fetch_array($r)):
			$n=$n+1;
			//************* Per Record **********
			for($x=0;$x<count($anm)-1;$x++){
				//$return_value[$anm[$x]]=$row[$x];
				if($anm[$x]=="Hospital"){
					//$return_value["referDetail"][$anm[$x]]=getHos("'".$row[$x]."'");
					$return_value[$n][$anm[$x]]=getHos("'".$row[$x]."'");
				}else{
					//$return_value["referDetail"][$anm[$x]]=$row[$x];
					$return_value[$n][$anm[$x]]=$row[$x];
				}
			}
			//$stuff_array[]=$return_value;
			//************* End Record **********
		endwhile;	
	return $return_value;
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


$operations = array("QueryRefer" => "QueryReferFunction");
$server = new soap_server("refer_detail.wsdl"); 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
$server->service($HTTP_RAW_POST_DATA);  
//print_r( QueryRefer("3939900078370,3939900078361"));

?>
