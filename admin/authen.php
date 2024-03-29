<?php
	include "../config/connection.php";
	include "../function/functionPHP.php";
	$mainUrl=get_cfgValue("mainUrl");
	if(patientAuthenticated()){
		header("location:../home");
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
		<table class="fullScreen">
			<tr>
				<td style="width: auto;">&nbsp;</td>
				<td style="width: 800px;background-color: #eee;">
					<div class="form" style="width: 450px;margin-left: auto;margin-right: auto;margin-top: auto;margin-bottom: auto;padding: 0px;">
						<table class="form" style="width: 100%;">
							<tr>
								<tr>
									<td class="form_header" colspan="2" style="font-weight: bold;">
										<div id="titleDIV" style="float:left;">
											ผู้ดูแลระบบ<br>
											Administer System
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
							</tr>
							<tr>
								<td class="form_body" align="center">
									<table>
										<tr>
											<td valign="top" align="center" style="width: 170px;">
												<div id="healthDatabank">
													<img src="adminIcon.png" width="100"><br>
													บุคคลากร
												</div>
											</td>
											<td>
												<form id="authenticationForm" method="post" action="authenSQL.php">
													<table>
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
										onclick="alert('กรุณาติดต่อ ผู้ดูแลระบบส่วนกลาง โทร xx-xxxxxxx')"
									>
									<input class="nprButton" id="submitButton" type='submit' value="   เข้าสู่ระบบ   "
										onclick="
											var Username=$('#User').val();
											var Password=$('#Password').val();
											if(Username=='' || Password==''){
												alert('กรุณากรอก Username และ Password');
											}else{
												$('#authenticationForm').attr('action','authenSQL.php');
												$('#authenticationForm').submit();
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