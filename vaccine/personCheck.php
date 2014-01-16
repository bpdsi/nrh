<?php
	include "../function/functionPHP.php";
	host("nrh");
	noCache();
	headerEncode();
	
	$CitizenID=$_POST["CitizenID"];
	
	$query="
		select *
		from	person
		where	CitizenID='$CitizenID'
	";
	$result=mysql_query($query);
	$numrows=mysql_num_rows($result);
	if($numrows>0){
		$row=mysql_fetch_array($result);
		$temp=$row[Prefix].":".$row[PersonName].":".$row[Telephone].":".$row[Email].":".$row[BloodGroupABO].":".$row[BloodTypeRh].":".$row[BirthDate].":".$row[User].":".$row[Password];
		echo $temp;
	}else{
		echo "notFound";
	}