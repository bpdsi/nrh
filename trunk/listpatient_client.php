<?php
require_once('./lib/nusoap.php'); 
try {
	$myNamespace = "http://nrh.dyndns.org/production/listpatient_service.php?wsdl";
	$wsdl = $myNamespace;
	$soap = new nusoap_client($wsdl,"wsdl"); 
	$proxy = $soap->getProxy(); 
	//$result = $proxy->QueryPatient(array('PersonID'=> "'1111111111111'",'Hospital'=>"",'HospitalNumber'=>"")); 
	//$CitizenID,$Hospital,$HospitalNumber,$AllowDate,$VisitingNumber
	$result = $proxy->QueryListPatient(array('CitizenID'=>"",'Hospital'=>"10680",'HospitalNumber'=>"",'AllowDate'=>"2013-09-03",'VisitingNumber'=>""));
	
	//echo '<h2>Request</h2>';
	//echo '<pre>' . htmlspecialchars($proxy->request, ENT_QUOTES) . '</pre>';
	//print_r($proxy->QueryPatient(array('PersonID'=> "'1111111111111'")));
	echo"<hr>";
	print_r($result);

	
} catch (Exception $e) {
		printf("Message = %s\n",$e->getMessage());
}
?>