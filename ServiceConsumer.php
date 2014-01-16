<?php
 include_once 'GetCustomer.class.php';
 include_once 'xmlParams.class.php';

 $objGetCust = new GetCustomer();
 $objGetCust->user = 'vasu';
 $objGetCust->password = 'vasu16';
 $objGetCust->xmlParams = new xmlParams();
require_once('./lib/nusoap.php');
// $soap_options = array('trace' => 1, 'exceptions'  => 1 );
 $wsdl = "http://nrh.dyndns.org/production/Customer.wsdl";
 
 
 function GetCustomer($params) {
		//var_dump($result);
		return true;
}
 $client = new soap_server($wsdl);
 //$client = new SoapClient($wsdl, $soap_options);

 try {
    $result = $client->GetCustomer($params);
    var_dump($result);
 }catch (SOAPFault $f) {
        echo $f->getMessage();
 }