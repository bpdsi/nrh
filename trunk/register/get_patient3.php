<?php
	include "../function/functionPHP.php";
	//headerEncode();
	noCache();
	$hospCode=$_POST["hospCode"];
	$hospitalNumber=$_POST["hospitalNumber"];
	
	function getPatient($hospCode, $hospitalNumber){
		require_once('../lib/nusoap.php');
		$endpoint = "http://164.115.24.113:8082/getPatientProxy/";
		$wsdl = $myNamespace;
		$client = new nusoap_client($endpoint, false);
		$client->soap_defencoding = 'UTF-8';
		$client->decode_utf8 = false;

		$err = $client->getError();
		if ($err) {
		 echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		 return false;
		}
	
		$msg='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.nhis.nectec.or.th"><soapenv:Header/><soapenv:Body><ws:getInfo><RequestPatient><hospCode>'.$hospCode.'</hospCode><hospitalNumber>'.$hospitalNumber.'</hospitalNumber></RequestPatient></ws:getInfo></soapenv:Body></soapenv:Envelope>';
		$result=$client->send($msg, $endpoint);
		
		//echo mb_detect_encoding($result)."\n";
		// Check for a fault
		if ($client->fault) {
			 return false;
		} else {
			 $err = $client->getError();
			 if ($err) {
			  return false;
			 } else {
			  return $result;
			  /*echo $result["Patient"]["PersonName"]["Prefix"];
			  echo $result["Patient"]["PersonName"]["GivenName"];
			  echo $result["Patient"]["PersonName"]["MiddleName"];
			  echo $result["Patient"]["PersonName"]["FamilyName"];
			  echo $result["Patient"]["BirthDate"];*/
			  
			 }
		}
	}
	$returnValue=getPatient($hospCode,$hospitalNumber);
	echo $returnValue["Patient"]["PersonName"]["Prefix"]."::".$returnValue["Patient"]["PersonName"]["GivenName"]."::".$returnValue["Patient"]["PersonName"]["MiddleName"]."::".$returnValue["Patient"]["PersonName"]["FamilyName"]."::".$returnValue["Patient"]["BirthDate"]."::".$returnValue["Patient"]["Gender"]."::".$returnValue["Patient"]["Telephone"]."::".$returnValue["Patient"]["Email"]."::".$returnValue["Patient"]["BloodGroupABO"]."::".$returnValue["Patient"]["BloodTypeRh"]."::".$returnValue["Patient"]["HospitalNumber"];
?>