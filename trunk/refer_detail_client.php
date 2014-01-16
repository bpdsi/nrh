<?php
echo"<p><img src=\"./images/header.png\" width=\"728\" height=\"90\"></p>";
require_once('./lib/nusoap.php'); 
try {
	$myNamespace = 'http://'.$_SERVER['HTTP_HOST']."/soap_disaster/refer_detail_service.php?wsdl";
	$wsdl = $myNamespace;//"http://nrh.dyndns.org/soap_disaster/refer_service.php?wsdl"; 
	echo $wsdl."<br>";
	$soap = new nusoap_client($wsdl,"wsdl"); 
	$proxy = $soap->getProxy(); 
	$result = $proxy->QueryRefer(array('PersonID'=> 3939900078370)); 
	
	
	print_r($result);
	/*$anm=split(",","refer_number,refer_date,refer_time,Hospital,PersonID,refer_type,refer_cause,refer_point,department");
	echo"<table border='1' cellspacing=0 cellpadding=0>";
		echo"<tr><td>เลขที่ refer</td><td>วันที่</td><td>เวลา</td><td>โรงพยาบาลร้องขอ</td><td>ผู้ป่วย</td><td>ประเภทส่งต่อ</td><td>สาเหตุการส่งต่อ</td><td>จุดส่งต่อ</td></tr>";
		$i=0;
		foreach ($result as $v1) {
			$i++;
			if($i==1)echo"<tr>";
			foreach ($v1 as $v2) {
				if(is_array($v2)){
					echo "<td>";
					foreach ($v2 as $v3) {
							echo $v3."&nbsp;";
					}
					echo"</td>";
				}else{
					echo "<td>".$v2."</td>";
				}
			}
			if($i==8){
				$i=0;
				echo"</tr>";
			}
		}


		
	echo"</table>";*/
	/*printf("ccc: %s </br>",$result["item"]["patientDetail"]["PersonID"]);
	printf("FatherName : %s <br/>", $result["item"]["patientDetail"]["PersonID"]);
	printf("FatherName : %s <br/>", $result["item"]["patientDetail"]["Name"]["Name"]);
	printf("Name : %s <br/>", $result["item"]["patientDetail"]["Name"]["Title"]);*/
	
} catch (Exception $e) {
		printf("Message = %s\n",$e->getMessage());
}
?>
