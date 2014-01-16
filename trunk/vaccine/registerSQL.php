<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	
	$CitizenID=$_POST["CitizenID"];
	$Password=$_POST["Password"];
	$Prefix=$_POST["Prefix"];
	$Name=$_POST["Name"];
	$Telephone=$_POST["Telephone"];
	$Email=$_POST["Email"];
	$BloodGroupABO=$_POST["BloodGroupABO"];
	$BloodTypeRh=$_POST["BloodTypeRh"];
	$BirthDate=dateConvert($_POST["BirthDate"]);
	$AllowDate=dateConvert($_POST["AllowDate"]);
	$ReferenceID=$_POST["ReferenceID"];
	
	$User=$_POST["User"];
	$PasswordN=$_POST["PasswordN"];
	
	$query="
		insert into	vcp_person
			(
				CitizenID,
				Prefix,
				PersonName,
				Telephone,
				Email,
				BloodGroupABO,
				BloodTypeRh,
				BirthDate,
				User,
				Password,
				ReferenceID,
				ConfirmDate
			) values (
				'$CitizenID',
				'$Prefix',
				'$Name',
				'$Telephone',
				'$Email',
				'$BloodGroupABO',
				'$BloodTypeRh',
				'$BirthDate',
				'$User',
				'".aesEncrypt($PasswordN)."',
				'$ReferenceID',
				CURRENT_TIMESTAMP
			)
	";
	$result=mysql_query($query) or die("Error<hr>Query: $query<br>Error Message: ".mysql_error()."<hr>");
	?>
<script type="text/javascript">
	alert('บันทึกข้อมูลเรียบร้อย')
	location.replace('../authen');
</script>