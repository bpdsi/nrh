<?php
	include "../function/functionPHP.php";
	foreach ($_POST as $key => $value) {
		$query="
			update	config
			set		cfgValue='$value'
			where	cfgName='$key'
		";
		$result=mysql_query($query);
	}
	echo "complete";