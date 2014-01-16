<?php
	require_once('./lib/nusoap.php');
try {
	//$endpoint = "http://nrh.dyndns.org/demo/labReport.php";
	//$myNamespace = "http://nrh.dyndns.org/demo/labReport.php?wsdl";
	$endpoint = "http://nrh.dyndns.org/production/labReport.php";
	$myNamespace = "http://nrh.dyndns.org/production/labReport.php?wsdl";
	$wsdl = $myNamespace;
	//$client = new nusoap_client($wsdl,"wsdl")or die("eeee"); 
	$client = new nusoap_client($endpoint, false);

	$msg = $client->serializeEnvelope('<ns7030:InsertLab xmlns:ns7030="http://nrh.dyndns.org/" encoding="UTF-8">	
	<labReport>
		<patient>
			<CitizenID>3000000000001</CitizenID>
				<personName>
					<Prefix>นาย</Prefix>
					<GivenName>สมชาย</GivenName>
					<MiddleName></MiddleName>
					<FamilyName>นามสกุลดี</FamilyName>
				</personName>
				<Birthdate>1983-02-28</Birthdate>
				<BirthJurisdictionCountrySubDivision></BirthJurisdictionCountrySubDivision>
				<Nationality></Nationality>
				<Gender>M</Gender>
				<Religion></Religion>
				<LifeStatus></LifeStatus>
				<Telephone>0810000001</Telephone>
				<Email>som@gmail.com</Email>
				<HospCode>11470</HospCode>
				<Age></Age>
				<HospitalNumber>1</HospitalNumber>
				<AdmissionNumber></AdmissionNumber>
				<BloodTypeABO>A</BloodTypeABO>
				<BloodTypeRh>Positive</BloodTypeRh>
				<PreDiagnosis></PreDiagnosis>
				<InsType></InsType>
		</patient>
		<labResult>
			<VisitingNumber>11470-00001</VisitingNumber>
			<LabID>2</LabID>
			<LabName>Chemistry</LabName>
			<LabDate>2013-10-20 10:51:00</LabDate>
			<WardID>1</WardID>
			<WardName>อายุรกรรม</WardName>
			<labRequester>
				<CitizenID>1</CitizenID>
				<personName>
					<Prefix></Prefix>
					<GivenName>วิวัฒน์</GivenName>
					<MiddleName></MiddleName>
					<FamilyName>บุญรักษา</FamilyName>
				</personName>
				<Birthdate></Birthdate>
				<BirthJurisdictionCountrySubDivision></BirthJurisdictionCountrySubDivision>
				<Nationality></Nationality>
				<Gender></Gender>
				<Religion></Religion>
				<LifeStatus></LifeStatus>
				<Telephone></Telephone>
				<Email></Email>
			</labRequester>
			<labResultDetail>
				<LabNumber></LabNumber>
				<LabTestID>1</LabTestID>
				<UniversalTestName>SUGAR</UniversalTestName>
				<MethodID></MethodID>
				<MethodName></MethodName>
				<ResultTest>98.0</ResultTest>
				<ReferenceResultTest></ReferenceResultTest>
				<UnitID>1</UnitID>
				<UnitName>mg/dl</UnitName>
				<LabResultDate>2013-10-20 10:51:00</LabResultDate>
				<ResultUniversal></ResultUniversal>
				<ReferenceUniversal></ReferenceUniversal>
				<UnitUniversal></UnitUniversal>
				<labReporter>
					<CitizenID>1</CitizenID>
					<personName>
						<Prefix></Prefix>
						<GivenName>สมหญิง</GivenName>
						<MiddleName></MiddleName>
						<FamilyName>สุดสวย</FamilyName>
					</personName>
					<Birthdate></Birthdate>
					<BirthJurisdictionCountrySubDivision></BirthJurisdictionCountrySubDivision>
					<Nationality></Nationality>
					<Gender></Gender>
					<Religion></Religion>
					<LifeStatus></LifeStatus>
					<Telephone></Telephone>
					<Email></Email>
				</labReporter>
			</labResultDetail>
		</labResult>
	</labReport>
</ns7030:InsertLab>');
		
$result = $client->send($msg, $endpoint)or die("ttttttttttttttt");

print_r($result);
echo"xxxxxxxxxxxxxx";
} catch (Exception $e) {
		printf("MessAge = %s\n",$e->getMessAge());
}
?>
