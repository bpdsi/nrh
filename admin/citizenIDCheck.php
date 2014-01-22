<?php
	include "../function/functionPHP.php";
	host("nrh");
	noCache();
	headerEncode();
	
	$CitizenID=$_POST["CitizenID"];
	
	$query="
		select *
		from	admin
		where	CitizenID='$CitizenID'
	";
	$result=mysql_query($query);
	$numrows=mysql_num_rows($result);
	if($numrows>0){
		echo "found";;
	}else{
		echo "notFound";
	}