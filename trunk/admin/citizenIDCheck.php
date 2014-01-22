<?php
	include "../function/functionPHP.php";
	host("nrh");
	noCache();
	headerEncode();
	
	$CitizenID=$_POST["CitizenID"];
	$checkingType=$_POST["checkingType"];
	$AdminID=$_POST["AdminID"];
	
	if($checkingType=="edit"){
		$query="
			select	*
			from	admin
			where	CitizenID='$CitizenID' and
					AdminID<>'$AdminID'
		";
	}else{
		$query="
			select	*
			from	admin
			where	CitizenID='$CitizenID'
		";
	}

	$result=mysql_query($query);
	$numrows=mysql_num_rows($result);
	if($numrows>0){
		echo "found";;
	}else{
		echo "notFound";
	}