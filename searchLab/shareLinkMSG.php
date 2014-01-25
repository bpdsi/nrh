<?php
	include "../function/functionPHP.php";
	if(!patientAuthenticated()){
		exit();
	}
	$mainUrl=get_cfgValue("mainUrl");
	host("nrh");
	
	$labShareID=$_POST["labShareID"];
	
	$query="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$person=mysql_fetch_array($result);
	
	$shareLink=$mainUrl."/searchLab/sharedLab.php?key=".urlencode(aesEncrypt($labShareID));
?>
<html>
	<head>
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	</head>
	<body>
		<h2>Personal Health Databank</h2>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ท่านสามารถเข้าดูผลตรวจจากห้องปฏิบัติการได้จาก <a href=<?php echo $shareLink?>>ผลการตรวจจากห้องปฏิบัติการ</a>
		<br><br>
	</body>
</html>