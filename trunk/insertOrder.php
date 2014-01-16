<?
require_once('./lib/nusoap.php');
$server = new soap_server();

	/*$operations = array("InsertOrder" => "QueryListPatientFunction");
	$server = new soap_server("insertOrder.wsdl"); 
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
	$server->service($HTTP_RAW_POST_DATA);  */
$server->configureWSDL('Insert Order', 'urn:InsertOrder');

$server->soap_defencoding = 'utf-8';

$server->register(
    'InsertOrder',
    array('FirstName' => 'xsd:Testing', 'LastName' => 'xsd:NuSoap'),
    array('return' =>'xsd:boolean'),
    'urn:InsertOrderwsdl', 
    'urn:InsertOrderwsdl#InsertOrder', 
    'rpc', 
    'literal'      
);

function InsertOrder($FirstName, $LastName) {

$connect = mysql_pconnect("localhost","root","");
if ($connect) {       
    if(mysql_select_db("database", $connect)) {
  mysql_query("INSERT INTO myuser SET FirstName='$FirstName',     LastName='$LastName'");   
        return true;
    }
}
return false;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>