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
		<div style="position: fixed;bottom: 0px;right:0px;padding: 5px;">©2013 Personal Health Databank</div>
		<table class="fullScreen noSpacing">
			<tr>
				<td style="width: auto;">&nbsp;</td>
				<td style="width: 800px;background-color: #eee;">
					<div style="width: 450px;margin-left: auto;margin-right: auto;margin-top: auto;margin-bottom: auto;padding: 0px;">
						<table class="form" 
							style="
								width: 100%;
								-webkit-box-shadow: 2px 2px 10px #aaa;
								box-shadow: 2px 2px 5px #aaa;
							"
						>
							<tr>
								<td class="form_header" colspan="2" style="font-weight: bold;">
									<div id="titleDIV" style="float:left;">
										ระบบฐานข้อมูลสุขภาพ<br>
										Personal Health Databank
									</div>
									<img src="../img/nectecLogo.png" height="30" 
										style="
											float: right;
											cursor: pointer;
										"
										onclick="window.open('http://www.nectec.or.th/','_blank');"
									>
									<img src="../img/kuLogo.png" height="30" 
										style="
											float: right;
											padding-right: 10px;
											cursor: pointer;
										"
										onclick="window.open('http://www.ku.ac.th/','_blank');"
									>
									<img src="../img/etdaLogo.png" height="30" 
										style="
											float: right;
											padding-right: 10px;
											cursor: pointer;
										"
										onclick="window.open('http://www.etda.or.th/','_blank');"
									>									
								</td>
							</tr>
							<tr>
								<td class="form_body" align="center">
									<table>
										<tr>
											<td colspan="2"><div style="float: right;font-size: 120%;">เข้าสู่ระบบ</div></td>
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
															<td class="form_field">ชื่อผู้ใช้</td>
															<td class="form_input"><input class="focus nextFocus" next="Password" type="text" id="User" name="User"></td>
														</tr>
														<tr>
															<td class="form_field">รหัสผ่าน</td>
															<td class="form_input"><input class="nextClick" next="submitButton" type="password" id="Password" name="Password"></td>
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
									<input class="nprButton" type='reset' value="   ลืมรหัสผ่าน   " style="float: left;"
										onclick="window.open('../forgetPassword','_self')"
									>
									<input class="nprButton" id="submitButton" type='submit' value="   เข้าสู่ระบบ   "
										onclick="
											var Username=$('#User').val();
											var Password=$('#Password').val();
											if(Username=='' || Password==''){
												alert('กรุณากรอก Username และ Password');
											}else{
												if($('#system').val()=='healthDatabank'){
													$('#authenticationForm').attr('action','authenSQL.php');
													$('#authenticationForm').submit();
												}else if($('#system').val()=='vaccination'){
													$('#authenticationForm').attr('action','vc_authenSQL.php');
													$('#authenticationForm').submit();
												}
											}
										";
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