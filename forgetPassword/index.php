<?php
	include "../config/connection.php";
	include "../function/functionPHP.php";
	$mainUrl=get_cfgValue("mainUrl");
	if(patientAuthenticated()){
		header("location:../home");
	}else if(adminAuthenticated()){
		header("location:../admin");
	}
	if($Hospital==""){
		$Hospital=11470;
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
									<div id="titleDIV" style="float:left;">
										ระบบฐานข้อมูลสุขภาพ<br>
										Personal Health Databank
									</div>
									<img src="../img/nectecLogo.png" height="30" style="float: right">
									<img src="../img/kuLogo.png" height="30" style="float: right;padding-right: 10px;">
									<img src="../img/etdaLogo.png" height="30" style="float: right;padding-right: 10px;">
									
								</td>
							</tr>
							<tr>
								<td class="form_body" align="center">
									<table>
										<tr>
											<td colspan="2"><div style="float: right;font-size: 120%;">ระบบกู้คืนรหัสผ่าน</div></td>
										</tr>
										<tr>
											<td valign="top" align="center" style="width: 170px;">
												<div id="healthDatabank">
													<img src="../img/authentication.png" width="100"><br>
													ระบบฐานข้อมูลสุขภาพ
												</div>
												<div id="vaccination" style="display: none;">
													<img src="../images/vcPersonRegister.png" width="100"><br>
													สมุดพกวัคซีน
												</div>
											</td>
											<td>
												<form id="authenticationForm" method="post" action="authenSQL.php">
													<table>
														<tr>
															<td class="form_field">ระบบ</td>
															<td class="form_input">
																<select id="system" name="system"
																	onchange="
																		if(this.value=='healthDatabank'){
																			$('#titleDIV').html('ระบบฐานข้อมูลสุขภาพ<br>Personal Health Databank');
																			$('#healthDatabank').show();
																			$('#vaccination').hide();
																		}else{
																			$('#titleDIV').html('สมุดพกวัคซีน<br>Vaccination Pocket Book');
																			$('#healthDatabank').hide();
																			$('#vaccination').show();
																		}
																	"
																>
																	<option value="healthDatabank">ระบบฐานข้อมูลสุขภาพ</option>
																	<option value="vaccination">สมุดพกวัคซีน</option>
																</select>
															</td>
														</tr>
														<tr><td colspan="2"><hr></td></tr>
														<tr>
															<td class="form_field">หมายเลขบัตรประชาชน</td>
															<td class="form_input"><input class="focus nextFocus" next="Password" type="text" id="CitizenID" name="CitizenID"></td>
														</tr>
														<tr>
															<td colspan="2" style="text-align: right">
																<input type="button" value=" ตั้งรหัสผ่านใหม่ "
																	onclick="
																		$('#waitingDIV').fadeIn();
																		$.post('forgetPasswordMSG.php',{
																				CitizenID: $('#CitizenID').val(),
																				system: $('#system').val()
																			},function(message){
																				$.post('sendForgetPasswordMail.php',{
																						CitizenID: $('#CitizenID').val(),
																						system: $('#system').val(),
																						message: message
																					},function(data){
																						if(data=='complete'){
																							$('#waitingDIV').fadeOut();
																							$('#CitizenID').val('');
																							alert('กรุณาตรวจสอบ Link สำหรับตั้งรหัสผ่านใหม่ในอิเมล์ของท่าน');
																						}else{
																							$('#waitingDIV').fadeOut();
																							alert('ไม่สามารถกู้คืนรหัสผ่านได้');
																						}
																					}
																				);
																			}
																		);
																	"
																>
																<hr>
															</td>
														</tr>
														<tr>
															<td class="form_field">ชื่อผู้ใช้ระบบ</td>
															<td class="form_input"><input class="nextClick" next="submitButton" type="text" id="User" name="User"></td>
														</tr>
														<tr>
															<td colspan="2" style="text-align: right">
																<input type="button" value=" ตั้งรหัสผ่านใหม่ "
																	onclick="
																		$('#waitingDIV').fadeIn();
																		$.post('forgetPasswordMSG.php',{
																				User: $('#User').val(),
																				system: $('#system').val()
																			},function(message){
																				$.post('sendForgetPasswordMail.php',{
																						User: $('#User').val(),
																						system: $('#system').val(),
																						message: message
																					},function(data){
																						if(data=='complete'){
																							$('#waitingDIV').fadeOut();
																							$('#User').val('')
																							alert('กรุณาตรวจสอบ Link สำหรับตั้งรหัสผ่านใหม่ในอิเมล์ของท่าน');
																						}else{
																							$('#waitingDIV').fadeOut();
																							alert('ไม่สามารถกู้คืนรหัสผ่านได้');
																						}
																					}
																				);
																			}
																		);
																	"
																>
																<hr>
															</td>
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
									<input class="nprButton" type='reset' value="   ยกเลิก   " style="float: right;"
										onclick="window.open('../authen','_self')"
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