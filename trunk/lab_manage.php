<?php
	require_once('./lib/nusoap.php');
	include "common_soap.php";
	function InsertLab($params) {
		$string= "insert function<br>";
		$string.="<table>";//.count($params);
		$i=0;
		foreach ($params as $v1 => $value) {
		$i++;
			if(is_array($value)){
				//$string.="$i.Array";
				foreach ($value as $key => $valx) {
					if(is_array($valx)){
						foreach ($valx as $key2 => $valx2) {
							if(is_array($valx2)){
								$string.="<tr><td>".$key2."</td><td></td><td></td></tr>";
								foreach ($valx2 as $key3 => $valx3) {
									$string.="<tr><td>-</td><td>$i.".$key3."</td><td>".$valx3."</td></tr>";
								}
							}else{
								$string.="<tr><td>$i.".$key2."</td><td>".$valx2."</td></tr>";
							}
						}
					}else{
						$string.="<tr><td>$i.".$key."</td><td>".$valx."</td></tr>";
					}
				}
			}else{
				$string.="<tr><td>$i.".$v1."</td><td>".$value."</td></tr>";
			}
		}
		$string.="</table>";
		return $string;
	}
	
	$operations = array("InsertLab" => "InsertLabFunction");
	$server = new soap_server("import.wsdl"); 
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
	$server->service($HTTP_RAW_POST_DATA);  
?>
