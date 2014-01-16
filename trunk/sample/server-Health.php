<?
require_once('./lib/nusoap.php');
include "common.php";


function showpage($page,$pagelen,$dataresult,$nextpage,$Sql,$ans){
	$num_rows = mysql_num_rows($dataresult);
	$rt = $num_rows%$pagelen;
	if($rt!=0) {
		$totalpage = floor($num_rows/$pagelen)+1;
	}else {
		$totalpage = floor($num_rows/$pagelen);
	}

	$pagestr = " &nbsp; &nbsp;หน้า : ";
     $ans=urlencode($ans);
	For ($i=1 ; $i<=$totalpage ; $i++) {
		if ($i == $page ) {
			$pagestr .= " [ <b><font size =+1 color=#990000>$i</font></b> ] ";
		} else  {
			$pagestr .= " <a href=$nextpage?currentpage=$i&act=search&query=$Sql&ans=$ans>$i</a> ";
		}
	}
	$npage=$page+1;
	return $pagestr." &nbsp;&nbsp;<a href=$nextpage?currentpage=$npage&act=search&query=$Sql&ans=$ans>Next >></a>";
}

function getCatalogEntry($catalogId) { 

$anm=split(",","PersonID,Name,Title,GivenName,FamilyName,NameSuffix,Gender,Birth,BirthPlace,Race,Nationality,Religion,Living,Address,Hospital,HospitalNumber,AdmissionNumber,Symtom,BloodType,BloodType,PhisicalExamination,FatherName,MotherName,SpouseName,FirstDiagnosis,LastDiagnosis,Emergency,TreatementRight,TransferReason,Description");
if($catalogId<>""){
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
							left join pttype on patient.pttype=pttype.pttype
				where cid in( ".$catalogId.")  ";
}else{
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
							left join pttype on patient.pttype=pttype.pttype";
}
$r=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
$num=mysql_num_rows($r);

$result_query="";

$ans=urldecode($catalogId);

	$page = $_GET["currentpage"];
	if($page==""){ $page=1; }
	$pagelen = 15; $startrec = ($page-1)*$pagelen;

if($num<>0){ 
	$query =str_replace("'","+",$SqlString);
	$query =str_replace("\n"," ",$query);
	$query=urlencode ($query);
	//$result_query.= $query;
		$listofeq = showpage($page,$pagelen,$r,"opac-searchresult.php",$query,$ans); 
		
		$listofeq = "		<!--hr color=##736AFF-->
				<tr>
					<td colspan=4 > $listofeq </td>
				</tr>";
}
//$result_query.= $listofeq;
$SqlString .= " LIMIT $startrec,$pagelen";

//-------------------จบ แสดงข้อมูลแต่ละหน้า ---------------------
//return $SqlString;

//*****************************vasu 13-11-2007************************
$rx=mysql_query($SqlString) or die (mysql_error()."<br>".$SqlString);
$num=mysql_num_rows($r);
	
//จบแสดงทีละหน้า
//header ("Content-Type:text/xml");
 $result_query.=' 
 <?xml version="1.0" encoding="UTF-8" ?> 
	<result>';



	if($r && mysql_num_rows($r)>0):
		$x=0;
		while($row=mysql_fetch_array($rx)):
			$x=$x+1;
			
			//$result_query.="<tr valign=top>";
			//************* Per Record **********
			$result_query.="<doc>";
			for($x=0;$x<count($anm)-1;$x++){
				$result_query.="<".$anm[$x].">".$row[$x]."</".$anm[$x].">
";
			}
			$result_query.="</doc>
";
			//************* End Record **********
		endwhile;	
	else:

		return $result_query;
	endif;

	  $result_query.= "</result>";

	return $result_query;
 
} 


$server = new soap_server("Health.wsdl"); 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
$server->service($HTTP_RAW_POST_DATA);  ?>