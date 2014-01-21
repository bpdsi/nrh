<?php
	include "../function/functionPHP.php";
	noCache();
	if(!adminAuthenticated()){
		exit();
	}
	$AdminID=$_POST["AdminID"];
	$query="
		update	admin
		set		status='disable'
		where	AdminID='$AdminID'
	";
	$result=mysql_query($query);
	echo "complete";