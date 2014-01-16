<?php
	include "../function/functionPHP.php";
	host("nrh");
	$PersonalID=aesDecrypt($_GET["code"]);
	$HospCode=aesDecrypt($_GET["code1"]);
	$AllowID=aesDecrypt($_GET["code2"]);

	$queryPerson="
		select	*
		from	person
		where	PersonalID='$PersonalID'
	";
	$resultPerson=mysql_query($queryPerson);
	$personInfo=mysql_fetch_array($resultPerson);
	
	$dateTime=date("Y-m-d H:i:s");
	
	$queryHospital="
		select	*
		from	hospital
		where	HospCode='$HospCode'
	";
	$resultHospital=mysql_query($queryHospital);
	$hospitalInfo=mysql_fetch_array($resultHospital);
	
	$queryAllow="
		select	*
		from	person_allow
		where	AllowID='$AllowID'
	";
	$resultAllow=mysql_query($queryAllow);
	$rowAllow=mysql_fetch_array($resultAllow);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="../js/jquery-1.10.2.js" type="text/javascript"></script>
		<style>
			body{
				font-family: Arial;
			}
			.nrhHeader{
				font-size: 20px;
				text-align: left;
			}
			.docName{
				font-size: 15px;
				text-align: right
			}
			table{ 
			    border-spacing:0;
			    border-collapse:collapse;
			}
			.topSolid{
				border-top: 1px solid #000;
			}
			.rightSolid{
				border-right: 1px solid #000;
			}
			.bottomSolid{
				border-bottom: 1px solid #000;
			}
			.leftSolid{
				border-left: 1px solid #000;
			}
			.solid{
				border: 1px solid #000;
			}
			.form_field{
				text-align: right;
				font-size: 13px;
			}
			.form_data{
				text-align: left;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<input type="button" value="Print" style="float: right;"
			onclick="
				$(this).hide();
				window.print();
				$(this).show();
			"
		>
		<table style="width: 500px;margin-left: auto;margin-right: auto;">
			<tr>
				<td class="solid">
					<table style="width: 100%;">
						<tr>
							<td class="nrhHeader">NRH Databank</td>
							<td class="docName">เอกสารขอใช้สิทธิ์....</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;background-color: #eee" class="leftSolid rightSolid form_field">ข้อมูลส่วนบุคคล</td>
			</tr>
			<tr>
				<td class="leftSolid rightSolid bottomSolid" style="padding: 10px;">
					<table style="margin-left: auto;margin-right: auto;">
						<tr>
							<td class="form_field">หมายเลขบัตรประชาชน : </td>
							<td class="form_data"><?php echo $personInfo[CitizenID]?></td>
						</tr>
						<tr>
							<td class="form_field">ชื่อผู้ขอใช้สิทธิ์ : </td>
							<td class="form_data"><?php echo $personInfo[PersonName]?></td>
						</tr>
						<tr>
							<td class="form_field">โรงพยาบาล : </td>
							<td class="form_data"><?php echo $hospitalInfo[HospitalName]?></td>
						</tr>
						<tr>
							<td class="form_field">ประเภทการขอใช้สิทธิ์ : </td>
							<td class="form_data"><?php
								if($rowAllow[AllowType]=="Perday"){
									echo "เฉพาะวันที่ ".dateEncode($rowAllow[AllowDate]);
								}else if($AllowType=="Unconditioned"){
									echo "ตั้งแต่วันที่ ".dateEncode($rowAllow[AllowDate]);
								}
							?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;background-color: #eee" class="leftSolid rightSolid form_field">ข้อมูลผู้ใช้ระบบ</td>
			</tr>
			<tr>
				<td class="leftSolid rightSolid bottomSolid" style="padding: 10px;">
					<table style="margin-left: auto;margin-right: auto;">
						<tr>
							<td class="form_field">ชื่อผู้ใช้ระบบ : </td>
							<td class="form_data">
								<div style="margin: 3px;width: 150px;padding: 3px;" class="solid"><?php echo $personInfo[User]?></div>
							</td>
						</tr>
						<tr>
							<td class="form_field">รหัสผ่าน : </td>
							<td class="form_data">
								<div style="margin: 3px;width: 150px;padding: 3px;" class="solid"><?php echo aesDecrypt($personInfo[Password])?></div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;" class="rightSolid bottomSolid leftSolid"><?php echo dateEncode($dateTime)?></td>
			</tr>
		</table>
	</body>
</html>