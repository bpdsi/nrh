<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	$PersonalID=$_POST["PersonalID"];
	$User=$_POST["User"];
	$Password=$_POST["Password"];
	
	$query="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(aesDecrypt($row[Password])==$Password){
		$query="
			select	*
			from	person
			where	User='$User' and
					PersonalID<>'$PersonalID'
		";
		$result=mysql_query($query);
		if(mysql_num_rows($result)>0){
			echo "unavailable";
		}else{
			echo "available";
		}
	}else{
		echo "notAuthenticated";
	}