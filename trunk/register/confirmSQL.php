<?php
	include "../function/functionPHP.php";
	host("nrh");
	if(!staffAuthenticated()){
		exit();
	}
	
	$AllowID=aesDecrypt(urldecode($_POST["key"]));
	$User=$_POST["User"];
	$Password=$_POST["Password"];
	
	$query="
		select	*
		from	person_allow
		where	AllowID='$AllowID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$PersonalID=$row[PersonalID];
	
	$query="
		update	person
		set		User='$User',
				Password='".aesEncrypt($Password)."'
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	
	$query="
		update	person_allow
		set		AllowStatus='accepted'
		where	AllowID='$AllowID'
	";
	$result=mysql_query($query);
?>
<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript">
	$(function(){
		alert("Registration Complete");
		window.open('../authen','_self');
	});
</script>