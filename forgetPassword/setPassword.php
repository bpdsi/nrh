<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	
	$system=aesDecrypt($_GET["system"]);
	$key=aesDecrypt($_GET["key"]);
	
	if($system=="healthDatabank"){
		$query="
			select	*
			from	person
			where	PersonalID='$key'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);

		$PersonName=$row[PersonName];
		
	}else if($system=="vaccination"){
		$query="
			select	*
			from	vcp_person
			where	vcPersonalID='$key'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$Email=$row[Email];

		$PersonName=$row[PersonName];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Patient Authentication</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="../img/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon">
		
		<!-- jQuery -->		
			<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
		
		<!-- jquery.datePicker.js -->
			<script src="../js/jquery-ui.js"></script>
			<link rel="stylesheet" type="text/css" media="screen" href="../css/jquery-ui.css">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/datePicker.css">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/demo.css">
			
		<!-- CUFON -->
			<script type="text/javascript" src="../js/cufon-yui.js"></script>
			<script type="text/javascript" src="../js/nprFont.js"></script>
			<script type="text/javascript">
				//Cufon.replace('h1.header');
			</script>
			
		<!-- CSS -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/npr.css">
		
		<script src="../function/functionJAVA.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.focus').focus();
			});
		</script>
		<style type="text/css">
			html{
				margin: 0px;
				width: 100%;
				height: 100%;
			}
			body{
				margin: 0px;
				width: 100%;
				height: 100%;
			}
			#authenticationForm input[type=text], #authenticationForm input[type=password]{
				width: 150px;
			}
		</style>
	</head>
	<body>
		<div id="waitingDIV" 
			style="
				display: none;
				position: fixed;
				width: 100%;
				height: 100%;
				background-image: url('../img/dark60.png');
				z-index: 1000;
			"
		>
			<table style="width: 100%;height: 100%;">
				<tr>
					<td style="vertical-align: middle;text-align: center;font-size:200%;color: #fff;">
						<img src="../img/loading.gif"><br>
						กรุณารอสักครู่
					</td>
				</tr>
			</table>
		</div>
		<table class="fullScreen">
			<tr>
				<td style="width: auto;">&nbsp;</td>
				<td style="width: 800px;background-color: #eee;">
					<div class="form" style="width: 550px;margin-left: auto;margin-right: auto;margin-top: auto;margin-bottom: auto;padding: 0px;">
						<table class="form" style="width: 100%;">
							<tr>
								<td class="form_header" colspan="2" style="font-weight: bold;">
									<?php
										if($system=="healthDatabank"){
											?>
												<div id="titleDIV" style="float:left;">
													ระบบฐานข้อมูลสุขภาพ<br>
													Personal Health Databank
												</div>
											<?php
										}else{
											?>
												<div id="titleDIV" style="float:left;">
													สมุดพกวัคซีน<br>
													Vaccination Pocket Book
												</div>
											<?php
										}
									?>
									
									<img src="../img/nectecLogo.png" height="30" style="float: right">
									<img src="../img/kuLogo.png" height="30" style="float: right;padding-right: 10px;">
									<img src="../img/etdaLogo.png" height="30" style="float: right;padding-right: 10px;">
									
								</td>
							</tr>
							<tr>
								<td class="form_body" align="center">
									<table>
										<tr>
											<td colspan="2"><div style="float: right;font-size: 120%;">ตั้งรหัสผ่านใหม่</div></td>
										</tr>
										<tr>
											<td valign="top" align="center" style="width: 170px;">
												<?php
													if($system=="healthDatabank"){
														?>
															<img src="../img/authentication.png" width="100"><br>
															ระบบฐานข้อมูลสุขภาพ
														<?php
													}else{
														?>
															<img src="../images/vcPersonRegister.png" width="100"><br>
															สมุดพกวัคซีน
														<?php
													}
												?>
											</td>
											<td>
												<form id="setPasswordForm" method="post" action="setPasswordSQL.php">
													<input type="hidden" name="system" value="<?php echo $system?>">
													<input type="hidden" name="key" value="<?php echo $key?>">
													<table>
														<tr>
															<td class="form_field">รหัสผ่านใหม่</td>
															<td class="form_input"><input class="focus nextFocus" next="PasswordC" type="password" id="PasswordN" name="PasswordN"></td>
														</tr>
														<tr>
															<td class="form_field">ยืนยันรหัสผ่าน</td>
															<td class="form_input"><input class="nextFocus" next="submitButton" type="password" id="PasswordC" name="PasswordC"></td>
														</tr>
													</table>
												</form>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="form_footer">
									<input class="nprButton" id="submitButton" type='button' value="   บันทึก   " style="float: right;"
										onclick="
											var PasswordN=$('#PasswordN').val();
											var PasswordC=$('#PasswordC').val();
											if(PasswordN==''){
												alert('กรุณากรอกรหัสผ่านใหม่');
												$('#PasswordN').focus();
											}else if(PasswordC!=PasswordN){
												alert('ยืนยันรหัสผ่านไม่ถูกต้อง');
												$('#PasswordC').focus();
											}else{
												$('#setPasswordForm').submit();
											}
										"
									>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td style="width: auto;">&nbsp;</td>
			</tr>
		</table>
	</body>
</html>