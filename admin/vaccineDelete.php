<?php
	include "../function/functionPHP.php";
	noCache();
	if(!adminAuthenticated()){
		exit();
	}
	$vcID=$_POST["vcID"];
	$query="
		delete from	vc_vaccine
		where	vcID='$vcID'
	";
	$result=mysql_query($query);
	echo "complete";