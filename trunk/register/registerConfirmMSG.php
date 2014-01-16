<?php
	include "../function/functionPHP.php";
	if(!staffAuthenticated()){
		exit();
	}
	$mainUrl=get_cfgValue("mainUrl");
	host("nrh");
	$PersonalID=$_POST["PersonalID"];
	$AllowID=$_POST["AllowID"];
	$query="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
?>
<html>
	<head>
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	</head>
	<body>
		<h2>เรียน คุณ <?php echo $row[PersonName]?></h2>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรุณายืนยันเข้าใช้ระบบ <a href="<?php echo $mainUrl?>/register/confirm.php?key=<?php echo urlencode(aesEncrypt($AllowID))?>">ที่นี่</a> ขอบคุณ
		<br><br>
		หากมีปัญหา กรุณาติดต่อที่ เบอร์โทร
		ขอบคุณครับ
	</body>
</html>