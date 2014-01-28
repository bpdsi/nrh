<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	$HospCode=$_POST["HospCode"];
	$HospitalNumber=$_POST["HospitalNumber"];

	$query="
		select	*
		from	hospital_patient
		where	HospCode='$HospCode' and
				HospitalNumber='$HospitalNumber'
	";
	$result=mysql_query($query);
	if(mysql_num_rows($result)>0){
		echo "current";
	}else{
		echo "new";
	}