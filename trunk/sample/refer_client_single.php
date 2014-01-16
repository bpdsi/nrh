<?php
require_once('./lib/nusoap.php'); 
try {

	$wsdl = "http://localhost/soap_disaster/refer_service.php?wsdl"; 
	$soap = new nusoap_client($wsdl,"wsdl"); 
	$proxy = $soap->getProxy(); 
	$result = $proxy->QueryPatient(array('PersonID'=> "")); 
	
	
	print_r($result);
	/*printf("ccc: %s </br>",$result["patientDetail"]["PersonID"]["xx"]);
	printf("FatherName : %s <br/>", $result["patientDetail"]["PersonID"]);
	printf("FatherName : %s <br/>", $result["patientDetail"]["Name"]["Name"]);
	printf("Name : %s <br/>", $result["patientDetail"]["Name"]["Title"]);*/
	
} catch (Exception $e) {
		printf("Message = %s\n",$e->getMessage());
}
?>
