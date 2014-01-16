<?php
require_once('./lib/nusoap.php'); 
try {
	$myNamespace = 'http://'.$_SERVER['HTTP_HOST']."/soap_health/lab_service.php?wsdl";
	$wsdl = $myNamespace;//"http://nrh.dyndns.org/soap_disaster/refer_service.php?wsdl"; 
	$soap = new nusoap_client($wsdl,"wsdl"); 
	$proxy = $soap->getProxy(); 
	$result = $proxy->QueryLab(array('CitizenID'=> "'3939900078370'")); 
	
	
	print_r($result);
	printf("ccc: %s </br>",$result["item"]["patientDetail"]["CitizenID"]);
	printf("FatherName : %s <br/>", $result["item"]["patientDetail"]["PersonID"]);
	printf("FatherName : %s <br/>", $result["item"]["patientDetail"]["Name"]["GivenName"]);
	printf("Name : %s <br/>", $result["item"]["patientDetail"]["Name"]["Prefix"]);
	
} catch (Exception $e) {
		printf("Message = %s\n",$e->getMessage());
}
?>
