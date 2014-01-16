<?php
	require_once('./lib/nusoap.php');
try {
	$endpoint = "http://nrh.dyndns.org/demo/lab_manage.php";
	$myNamespace = "http://nrh.dyndns.org/demo/lab_manage.php?wsdl";
	$endpoint = "http://nrh.dyndns.org/production/lab_manage.php";
	$myNamespace = "http://nrh.dyndns.org/production/lab_manage.php?wsdl";
	$wsdl = $myNamespace;
	//$client = new nusoap_client($wsdl,"wsdl")or die("eeee"); 
	$client = new nusoap_client($endpoint, false);

/*$msg = $client->serializeEnvelope('
<ns7030:InsertLab xmlns:ns7030="http://nrh.dyndns.org/">
			<labOrder>
				<HospCode>11470</HospCode>
				<HospitalNumber>0000013</HospitalNumber>
				<VisitingNumber>V000013</VisitingNumber>
				<CitizenID>3809900560555</CitizenID>
				<LabDate>2013/12/26</LabDate>
				<Description>testing lab</Description>
				<LabDetail>
					<labResult>
						<VisitingNumber>V000013</VisitingNumber>
						<UniversalTestID>SUGAR</UniversalTestID>
						<UniversalTestName>SUGAR Name</UniversalTestName>
						<ResultLab>15</ResultLab>
						<UnitID>ml</UnitID>
						<UnitName>miligrame</UnitName>
						<ResultUniversal>11-20</ResultUniversal>
						<UnitUniversal>ml</UnitUniversal>
						<ReferenceResult>150</ReferenceResult>
						<ReferenceUniversalTest>110-200</ReferenceUniversalTest>
					</labResult>
					<labResult>
						<VisitingNumber>V000013</VisitingNumber>
						<UniversalTestID>Blood</UniversalTestID>
						<UniversalTestName>Blood Name</UniversalTestName>
						<ResultLab>13</ResultLab>
						<UnitID>ml</UnitID>
						<UnitName>miligrame</UnitName>
						<ResultUniversal>13-17</ResultUniversal>
						<UnitUniversal>ml</UnitUniversal>
						<ReferenceResult>130</ReferenceResult>
						<ReferenceUniversalTest>100-170</ReferenceUniversalTest>
					</labResult>
				</LabDetail>
			</labOrder>
		</ns7030:InsertLab>');*/

	$msg = $client->serializeEnvelope('
	<ns7030:InsertLab xmlns:ns7030="http://nrh.dyndns.org/">	
	<labReport>
		<patient>
			<citizenID>3000000000001</citizenID>
			<personName>
				<prefix>นาย</prefix>
				<givenName>สมชาย</givenName>
				<middleName></middleName>
				<familyName>นามสกุลดี</familyName>
				</personName>
				<birthdate>1983-02-28</birthdate>
				<birthJurisdictionCountrySubDivision></birthJurisdictionCountrySubDivision>
				<nationality></nationality>
				<gender>M</gender>
				<religion></religion>
				<lifeStatus></lifeStatus>
				<telephone>0810000001</telephone>
				<email>som@gmail.com</email>
				<hospCode>11470</hospCode>
				<age></age>
				<hospitalNumber>1</hospitalNumber>
				<admissionNumber></admissionNumber>
				<bloodTypeABO>A</bloodTypeABO>
				<bloodTypeRh>Positive</bloodTypeRh>
				<preDiagnosis></preDiagnosis>
				<insType></insType>
		</patient>
		<labResult>
			<VN>11470-00001</VN>
			<labID>2</labID>
			<labName>Chemistry</labName>
			<labDate>2013-10-20 10:51:00</labDate>
			<wardID>1</wardID>
			<wardName>อายุรกรรม</wardName>
			<labRequester>
			<citizenID>1</citizenID>
			<personName>
			<prefix/>
			<givenName>วิวัฒน์</givenName>
			<middleName/>
			<familyName>บุญรักษา</familyName>
			</personName>
			<birthdate/>
			<birthJurisdictionCountrySubDivision/>
			<nationality/>
			<gender/>
			<religion/>
			<lifeStatus/>
			<telephone/>
			<email/>
			</labRequester>
			<labResultDetail>
				<LN/>
				<labTestID>1</labTestID>
				<universalTestName>SUGAR</universalTestName>
				<methodID/>
				<methodName/>
				<resultTest>98.0</resultTest>
				<referenceResultTest/>
				<unitID>1</unitID>
				<unitName>mg/dl</unitName>
				<labResultDate>2013-10-20 10:51:00</labResultDate>
				<resultUniversal/>
				<referenceUniversal/>
				<unitUniversal/>
				<labReporter>
					<citizenID>1</citizenID>
					<personName>
					<prefix/>
					<givenName>สมหญิง</givenName>
					<middleName/>
					<familyName>สุดสวย</familyName>
					</personName>
					<birthdate/>
					<birthJurisdictionCountrySubDivision/>
					<nationality/>
					<gender/>
					<religion/>
					<lifeStatus/>
					<telephone/>
					<email/>
				</labReporter>
			</labResultDetail>
		</labResult>
	</labReport>
</ns7030:InsertLab>');
		
$result = $client->send($msg, $endpoint)or die("ttttttttttttttt");

print_r($result);
echo"xxxxxxxxxxxxxx";
} catch (Exception $e) {
		printf("Message = %s\n",$e->getMessage());
}
?>
