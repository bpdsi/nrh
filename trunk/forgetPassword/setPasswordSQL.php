<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	$system=$_POST["system"];
	$key=$_POST["key"];
	$PasswordN=$_POST["PasswordN"];
	$PasswordC=$_POST["PasswordC"];
	
	if($system=="healthDatabank"){
		$query="
			update	person
			set		Password='".aesEncrypt($PasswordN)."'
			where	PersonalID='$key'
		";
		$result=mysql_query($query);
	}else if($system=="vaccination"){
		$query="
			update	vcp_person
			set		Password='".aesEncrypt($PasswordN)."'
			where	vcPersonalID='$key'
		";
		$result=mysql_query($query);
	}
?>
<script>
	alert("เปลี่ยนรหัสผ่าน เรียบร้อย");
	location.replace('../authen');
</script>