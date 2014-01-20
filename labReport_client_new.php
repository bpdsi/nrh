<?php
	require_once('./lib/nusoap.php');
try {
	$endpoint = "http://nrh.dyndns.org/production/labReport.php";
	$myNamespace = "http://nrh.dyndns.org/production/labReport.php?wsdl";
	//$endpoint = "http://127.0.0.1/soap_health/labReport.php";
	//$myNamespace = "http://127.0.0.1/soap_health/labReport.php?wsdl";
	$wsdl = $myNamespace;
	//$client = new nusoap_client($wsdl,"wsdl")or die("eeee"); 
	$client = new nusoap_client($endpoint, false);

	$msg = $client->serializeEnvelope('<ns7030:InsertLabReport xmlns:ns7030="http://127.0.0.1/" encoding="UTF-8">	<ClinicalDocument xmlns="urn:hl7-org:v3" xmlns:voc="urn:hl7-org:v3/voc" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:hl7-org:v3 CDA.xsd"><TypeId extension="POCD_HD000040" root="2.16.840.1.113883.1.3"/><Id displayable="false"/><Code displayName="Lab Report"/><EffectiveTime value="2013-03-01T160000"/><ConfidentialityCode code="N" codeSystem="2.16.840.1.113883.5.25"/><SetId extension="11470.5189086.BI064" root="DocumentID"/><VersionNumber value="1"/><RecordTarget><PatientRole><Id assigningAuthorityName="นพรัตน์" extension="11470" root="HospCode"/><Patient><Id extension="22/51" root="HospitalNumber"/><Name><Given>abc</Given><Family>defg</Family><Prefix>???</Prefix></Name></Patient></PatientRole></RecordTarget><Author><Time value="2013-03-01T160000"/><AssignedAuthor><Id assigningAuthorityName="PMK HIS"/><AssignedAuthoringDevice><SoftwareName>PMK HIS</SoftwareName></AssignedAuthoringDevice></AssignedAuthor></Author><Custodian><AssignedCustodian><RepresentedCustodianOrganization><Id assigningAuthorityName="ทดสอบ"/><Name>ทดสอบ</Name></RepresentedCustodianOrganization></AssignedCustodian></Custodian><Component><StructuredBody><Component><Section><Title>Lab Report</Title><Text>...</Text><Entry><th-eGIF:LabReport xmlns:th-eGIF="urn:th.gov.th-eGIF:v1"><Patient><CitizenID>3000000000001</CitizenID><PersonName><Prefix>???</Prefix><GivenName>abc</GivenName><MiddleName>hij</MiddleName><FamilyName>defg</FamilyName></PersonName><BirthDate>1984-06-29</BirthDate><BirthJurisdictionCountrySubDivision/><Nationality/><Gender>M</Gender><Religion/><LifeStatus/><Telephone>0808080808</Telephone><Email/><HospCode>11470</HospCode><Age/><HospitalNumber>22/51</HospitalNumber><AdmissionNumber/><BloodGroup/><BloodType/><PreDiagnosis/><InsType/><ParentName/></Patient><LabResult><VisitingNumber>5189086</VisitingNumber><LabID>BI064</LabID><LabName/><LabDate/><WardID>7508</WardID><WardName/><LabRequester><CitizenID/><PersonName><Prefix/><GivenName/><MiddleName/><FamilyName/></PersonName><Birthdate/><BirthJurisdictionCountrySubDivision/><Nationality/><Gender/><Religion/><LifeStatus/><Telephone/><Email/></LabRequester><LabResultDetail><LN/><LabTestID>BI064-1</LabTestID><UniversalTestName>Metamphetamine</UniversalTestName><MethodID/><MethodName/><ResultTest>Negative</ResultTest><ReferenceResult/><UnitID/><UnitName>-</UnitName><LabResultDate>2010-07-28T00:00:00</LabResultDate><ResultUniversal/><ReferenceUniversalTest/><UnitUniversal/><LabReporter><CitizenID/><PersonName><Prefix/><GivenName/><MiddleName/><FamilyName/></PersonName><Birthdate/><BirthJurisdictionCountrySubDivision/><Nationality/><Gender/><Religion/><LifeStatus/><Telephone/><Email/></LabReporter></LabResultDetail></LabResult></th-eGIF:LabReport></Entry></Section></Component></StructuredBody></Component><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
<ds:SignedInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
<ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"/>
<ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#dsa-sha1" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"/>
<ds:Reference URI="" xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
<ds:Transforms xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
<ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"/>
</ds:Transforms>
<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"/>
<ds:DigestValue xmlns:ds="http://www.w3.org/2000/09/xmldsig#">SG87+EsOpT0vbBwORw6JSUK/ID8=</ds:DigestValue>
</ds:Reference>
</ds:SignedInfo>
<ds:SignatureValue xmlns:ds="http://www.w3.org/2000/09/xmldsig#">QH7QyFAQrQgwoXR3I8HLpLbTO9VfmtNREhw2BGfieECc3+3W4HfGSA==</ds:SignatureValue>
</ds:Signature></ClinicalDocument></ns7030:InsertLabReport>');
		
$result = $client->send($msg, $endpoint);//or die("ttttttttttttttt");
if ($client->fault) {
		trigger_error("SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faulstring})", E_ERROR);
	} else {
		// Check for errors
		$err = $client->getError();
		if ($err) {
			// Display the error
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
		} else {
			// Display the result
			echo '<h2>Result</h2><pre>';
			echo $result;
			print_r($result);
			echo '</pre>';
		}
	}
	
	
//echo $result;
//print_r($result);
//echo"xxxxxxxxxxxxxx";
} catch (Exception $e) {
		printf("MessAge = %s\n",$e->getMessAge());
}
?>
