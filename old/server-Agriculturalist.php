<?
require_once('./lib/nusoap.php');
include "common.php";
/*$charset = "SET character_set_results=tis620";
 mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
$charset = "SET character_set_client=tis620"; 
mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
$charset = "SET character_set_connection=tis620"; 
mysql_query($charset) or die('Invalid query: ' . mysql_error()); 

$charset = "SET collation_connection =  utf8_general_ci   ";  
mysql_query($charset) or die('Invalid query: ' . mysql_error()); */


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

$anm=split(",","FarmerID,CitizenID,Address,TelNo");
if($catalogId<>""){
$SqlString="select FarmerID,CitizenID,Address,TelNo from farmer  where CitizenID in( ".$catalogId.")  ";
}else{
	$SqlString="select FarmerID,CitizenID,Address,TelNo from farmer  ";
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


$server = new soap_server("Agriculturalist.wsdl"); 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
$server->service($HTTP_RAW_POST_DATA);  ?>