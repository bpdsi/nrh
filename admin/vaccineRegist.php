<?php
	include "../function/functionPHP.php";
	host("nrh");
	$query="
		insert into	vc_vaccine
			(
				BPS_STD,
				Vaccine_Code,
				Vaccine_Name,
				Vaccine_Name_EN,
				Prevention,
				Age,
				ICD10
			) values (
				'".$_POST["BPS_STD"]."',
				'".$_POST["BPS_STD"]."',
				'".$_POST["Vaccine_Name"]."',
				'".$_POST["Vaccine_Name_EN"]."',
				'".$_POST["Prevention"]."',
				'".$_POST["Age"]."',
				'".$_POST["ICD10"]."'
			)
	";
	$result=mysql_query($query);
	echo "complete";