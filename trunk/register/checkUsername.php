<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	$PersonalID=$_POST["PersonalID"];
	$User=$_POST["User"];

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