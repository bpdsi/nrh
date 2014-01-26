<?php
	include "../function/functionPHP.php";
	host("nrh");
	$query="
		update	vc_vaccine
		set		BPS_STD='".$_POST["BPS_STD"]."',
				Vaccine_Code='".$_POST["BPS_STD"]."',
				Vaccine_Name='".$_POST["Vaccine_Name"]."',
				Vaccine_Name_EN='".$_POST["Vaccine_Name_EN"]."',
				Prevention='".$_POST["Prevention"]."',
				Age='".$_POST["Age"]."',
				ICD10='".$_POST["ICD10"]."'
		where	vcID='".$_POST["vcID"]."'
	";
	$result=mysql_query($query);
	echo "complete";