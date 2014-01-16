<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	headerEncode();
	
	$CitizenID=$_POST["CitizenID"];
	$Password=$_POST["Password"];
	
	$query="
		select	*
		from	person
		where	CitizenID='$CitizenID'
	";
	$result=mysql_query($query);
	if(mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if(aesDecrypt($row[Password])=="$Password"){
			$temp=$row[PersonalID].":".$row[Prefix].":".$row[PersonName].":".$row[Telephone].":".$row[Email].":".$row[BloodGroupABO].":".$row[BloodTypeRh].":".$row[BirthDate].":".$row[User].":".$row[Password];
			echo $temp;
		}else{
			echo "fail";
		}
	}else{
		echo "fail";
	}