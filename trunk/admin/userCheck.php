<?php
	include "../function/functionPHP.php";
	host("nrh");
	noCache();
	headerEncode();
	
	$User=$_POST["User"];
	
	$query="
		select *
		from	admin
		where	User='$User'
	";
	$result=mysql_query($query);
	$numrows=mysql_num_rows($result);
	if($numrows>0){
		echo "found";;
	}else{
		echo "notFound";
	}