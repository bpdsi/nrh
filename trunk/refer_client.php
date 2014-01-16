<?php
require_once('./lib/nusoap.php'); 
try {
	$myNamespace = "http://nrh.dyndns.org/soap_disaster/refer_service.php?wsdl";
	//$myNamespace = "http://nrh.dyndns.org/demo/refer_service_p.php?wsdl";
	$wsdl = $myNamespace;
	$soap = new nusoap_client($wsdl,"wsdl"); 
	$proxy = $soap->getProxy(); 
	$result = $proxy->QueryPatient(array('PersonID'=> "'1111111111111'",'Hospital'=>"",'HospitalNumber'=>"")); 
	
	echo '<h2>Request</h2>';
	echo '<pre>' . htmlspecialchars($soap->request, ENT_QUOTES) . '</pre>';
	//print_r($proxy->QueryPatient(array('PersonID'=> "'1111111111111'")));
	echo"<hr>";
	print_r($result);
	
} catch (Exception $e) {
		printf("Message = %s\n",$e->getMessage());
}
?>