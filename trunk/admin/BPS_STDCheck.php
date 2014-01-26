<?php
	include "../function/functionPHP.php";
	host("nrh");
	noCache();
	headerEncode();
	
	$BPS_STD=$_POST["BPS_STD"];
	$checkingType=$_POST["checkingType"];
	$vcID=$_POST["vcID"];
	
	if($checkingType=="edit"){
		$query="
			select	*
			from	vc_vaccine
			where	BPS_STD='$BPS_STD' and
					vcID<>'$vcID'
		";
	}else{
		$query="
			select	*
			from	vc_vaccine
			where	BPS_STD='$BPS_STD'
		";
	}

	$result=mysql_query($query);
	$numrows=mysql_num_rows($result);
	if($numrows>0){
		echo "found";;
	}else{
		echo "notFound";
	}