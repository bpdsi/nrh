<?php
	include "../function/functionPHP.php";

	$AllowID=aesDecrypt(urldecode($_GET["key"]));

	host("nrh");
	
	$query="
		select	*
		from	person_allow
		where	AllowID='$AllowID' and
				AllowStatus='waiting'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(mysql_num_rows($result)==0){
		echo "Permission Denied!";
		exit();
	}
	
	$query="
		update	person_allow
		set		AllowStatus='rejected'
		where	AllowID='$AllowID'
	";
	$result=mysql_query($query);
?>
<script type="text/javascript">
	alert("Your request has been rejected");
	location.replace("index.php");
</script>