<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	$system=$_POST["system"];
	
	if($_POST["CitizenID"]!=""){
		$CitizenID=$_POST["CitizenID"];
	}else if($_POST["User"]!=""){
		$User=$_POST["User"];
	}
	
	if($system=="healthDatabank"){
		if($CitizenID!=""){
			$query="
				select	*
				from	person
				where	CitizenID='$CitizenID'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				$row=mysql_fetch_array($result);
				$Email=$row[Email];
			}
		}else if($User!=""){
			$query="
				select	*
				from	person
				where	User='$User'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				$row=mysql_fetch_array($result);
				$Email=$row[Email];
			}
		}
		$PersonName=$row[PersonName];
	}else if($system=="vaccination"){
		if($CitizenID!=""){
			$query="
				select	*
				from	vcp_person
				where	CitizenID='$CitizenID'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				$row=mysql_fetch_array($result);
				$Email=$row[Email];
			}
		}else if($User!=""){
			$query="
				select	*
				from	vcp_person
				where	User='$User'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				$row=mysql_fetch_array($result);
				$Email=$row[Email];
			}
		}
		$PersonName=$row[PersonName];
	}
?>
<html>
	<head>
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	</head>
	<body>
		<h2>เรียน คุณ <?php echo $PersonName?></h2>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรุณากด <a href="<?php echo $mainUrl?>/forgetPassword/setPassword.php?system=<?php echo urlencode(aesEncrypt($system))?>&key=<?php
			if($system=="healthDatabank"){
				echo urlencode(aesEncrypt($row[PersonalID]));
			}else{
				echo urlencode(aesEncrypt($row[vcPersonalID]));
			} 
			
		?>">ตั้งรหัสผ่านใหม่</a> เพื่อเข้าสู่ระบบกู้คืนรหัสผ่าน ของระบบ <?php
			if($system=="healthDatabank"){
				echo "ระบบฐานข้อมูลสุขภาพ (Personal Health Databank)";
			}else{
				echo "ระบบสมุดพกวัคซีน (Vaccination Pocket Book)";
			}
		?>
		<br><br>
		หากมีปัญหา กรุณาติดต่อที่ เบอร์โทร
		ขอบคุณครับ
	</body>
</html>