<?php
	include "../config/connection.php";
	include "../function/functionPHP.php";
	$mainUrl=get_cfgValue("mainUrl");
	if($Hospital==""){
		$Hospital=11470;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Databank Registration Form</title>
		<link href="../img/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!-- jQuery -->
		<!--<script type='text/javascript' src='http://code.jquery.com/jquery-1.10.0.min.js'></script>-->
		
		<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
		
		<!-- required plugins -->
		<script type="text/javascript" src="../js/date.js"></script>
		<!--[if IE]><script type="text/javascript" src="scripts/jquery.bgiframe.js"></script><![endif]-->
		
		<!-- jquery.datePicker.js -->
			<!-- <script type="text/javascript" src="../js/jquery.datePicker.js"></script>-->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/jquery-ui.css">
	  		<script src="../js/jquery-ui.js"></script>
		<!-- datePicker required styles -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/datePicker.css">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/demo.css">
			
		<!-- CSS -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/npr.css">
		
		<!-- My jScript -->
			<script src="../function/functionJAVA.js" type="text/javascript"></script>
			
		<script type="text/javascript">
			function dateDisplayConvert(date){
				if(date.indexOf("-")){
					date=date.split("-");
				}
				
				if(parseInt(date[0])>parseInt(date[2])){
					date[0]=parseInt(date[0])+543;
					
					return date[2]+"/"+date[1]+"/"+date[0];
				}else if(parseInt(date[0])<parseInt(date[2])){
					date[0]=parseInt(date[0])+543;
					return date[0]+"/"+date[1]+"/"+date[2];
				}
			}
		
			$(function(){

			    var d = new Date();
			    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);

				$(".date-pick").datepicker({ 
					changeMonth: true, 
					changeYear: true,
					dateFormat: 'dd/mm/yy', 
					isBuddhist: true, 
					defaultDate: toDay,
					dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
		            dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		            monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		            monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
		            onSelect: function(){
			            $('this').blur();
			        }
				});
			});
			
		</script>

		<style type="text/css">
			/* Specific Form Rules */
			#form-demo {width: 330px; margin: 50px 0 100px 0; height: 170px; padding: 25px 10px 0 10px; background: url(images/bg_login.png) no-repeat 0 0;}
			#confirm {display: none;}
			.success {order: 1px solid; margin: 0; padding: 10px; text-align: center; color: #4F8A10; background-color: #ebf6d9; border-color: #DFF2BF;}
		</style>
	</head>
	<body onload="$('#CitizenID').focus()">
		<table style="width: 100%;height: 100%;">
			<tr>
				<td style="text-align: center;vertical-align: middle">
					<div class="form" style="width: 640px;margin-left: auto;margin-right: auto;">
						<table class="form" style="width: 100%;">
							<tr>
								<td class="form_header" colspan="2">ลงทะเบียน ระบบสมุดพกวัคซีน</td>
							</tr>
							<tr>
								<td class="form_body" align="center">
									<table>
										<tr>
											<td valign="top" align="center"
												style="
													width: 170px;
													background-image: url('../img/shadowLeft.png');
													background-repeat: no-repeat;
													background-position: right center;
													background-size: 20px 250px;
												"
											>
												<img src="../images/vcPersonRegister.png"><br>
												ข้อมูลบุคคล
											</td>
											<td style="padding: 0px 10px 0px 10px;">
												<form id="registForm" method="post" action="registerSQL.php">
													<table style="width: 400px;">
														<tr>
															<td colspan="2" style="font-weight: bold;">
																ข้อมูลประวัติผู้ใช้ระบบ
															</td>
														</tr>
														<tr>
															<td class="form_field">หมายเลขบัตรประชาชน</td>
															<td class="form_input">
																<script type="text/javascript">
																	function checkCitizenID(){
																		$.post('personCheck.php',{
																				CitizenID: $('#CitizenID').val()
																			},function(data){
																				if(data!='notFound'){
																					alert('กรุณาใช้บัญชี Personal Health Databank ในการเข้าใช้งานระบบ');
																					$('#CitizenID').focus();
																				}
																			}
																		);
																	}
																</script>
																<input type="text" class="nextFocus" next="Prefix" name="CitizenID" id="CitizenID"
																	onblur="checkCitizenID();"
																/>
															</td>
														</tr>
														<tr>
															<td class="form_field">คำนำหน้าชื่อ</td>
															<td class="form_input">
																<input type="text" class="nextFocus" next="Name" name="Prefix" id="Prefix" style="width: 30px;text-align: left;">
															</td>
														</tr>
														<tr>
															<td class="form_field">ชื่อ นามสกุล</td>
															<td class="form_input">
																<input type="text" class="nextFocus" next="Telephone" name="Name" id="Name">
															</td>
														</tr>
														<tr>
															<td class="form_field">หมายเลขโทรศัพท์</td>
															<td class="form_input"><input type="text" class="nextFocus" next="Email" name="Telephone" id="Telephone"></td>
														</tr>
														<tr>
															<td class="form_field">อีเมล์</td>
															<td class="form_input"><input type="text" class="nextFocus" next="BloodGroupABO" name="Email" id="Email"></td>
														</tr>
														<tr>
															<td class="form_field">กรุ๊ปเลือด</td>
															<td class="form_input">
																<input type="text" class="nextFocus" next="BloodTypeRh" name="BloodGroupABO" id="BloodGroupABO" style="width: 50px;">
																&nbsp;
																Rh <input type="text" class="nextFocus" next="BirthDate" name="BloodTypeRh" id="BloodTypeRh" style="width: 50px;">
															</td>
														</tr>
														<tr>
															<td class="form_field">วันเดือนปีเกิด</td>
															<td class="form_input">
																<input type="text" class="nextFocus date-pick" next="User" name="BirthDate" id="BirthDate" size="10"
																><img src="<?php echo $mainUrl?>/img/calendar.png"
																	style="
																		margin-bottom: -3px;
																		padding-left: 3px;
																		cursor: pointer;
																	"
																	onclick="$('#BirthDate').focus();"
																>
															</td>
														</tr>
														<tr>
															<td class="form_field">วันที่สมัคร</td>
															<td class="form_input">
																<input type='hidden' id="AllowDate" name='AllowDate' size="10" readonly
																	value="<?php echo date("d/m/").(date("Y")+543)?>";
																><?php
																	echo date("d");
																	echo " ";
																	echo monNameTH(date("m"));
																	echo " ";
																	echo date("Y")+543;
																?>
															</td>
														</tr>
														<tr>
															<td colspan="2" style="font-weight: bold;padding-top: 10px;">
																บัญชีผู้ใช้ระบบสมุดพกวัคซีน
															</td>
														</tr>
														<tr>
															<td class="form_field">ชื่อผู้ใช้</td>
															<td class="form_input">
																<input type="text" class="nextFocus" next="PasswordN" name="User" id="User">
															</td>
														</tr>
														<tr>
															<td class="form_field">รหัสผ่าน</td>
															<td class="form_input">
																<input type="password" class="nextFocus" next="PasswordC" name="PasswordN" id="PasswordN">
															</td>
														</tr>
														<tr>
															<td class="form_field">ยืนยันรหัสผ่าน</td>
															<td class="form_input">
																<input type="password" class="nextFocus" next="submitButton" name="PasswordC" id="PasswordC">
															</td>
														</tr>
													</table>
												</form>
											</td>
											<td
												style="
													width: 20px;
													background-image: url('../img/shadowRight.png');
													background-repeat: no-repeat;
													background-position: left center;
													background-size: 20px 250px;
												"
											>&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="form_footer">
									<input class="nprButton" type='reset' value="   ยกเลิก   " style="float: left;"
										onclick="
											var HospitalName=$('#HospitalName').val();
											$('#registForm')[0].reset();
											$('#HospitalName').val(HospitalName);
										"
									>
									<input id="submitButton" class="nprButton" type='submit' value="   บันทึก   "
										onclick="
											var	CitizenID=$('#CitizenID').val();
											var	Prefix=$('#Prefix').val();
											var	Name=$('#Name').val();
											var	Telephone=$('#Telephone').val();
											var	Email=$('#Email').val();
											var	Password=$('#Password').val();
			
											var	User=$('#User').val();
											var	PasswordN=$('#PasswordN').val();
											var	PasswordC=$('#PasswordC').val();
											
											if(CitizenID==''){
												alert('กรุณาระบุ CitizenID');
												$('#CitizenID').focus();
											}else if(Name==''){
												alert('กรุณากรอก ชื่อ-นามสกุล');
												$('#Name').focus();
											}else if(Telephone==''){
												alert('กรุณากรอกหมายเลขโทรศัพท์');
												$('#Telephone').focus();
											}else if(Email==''){
												alert('กรุณากรอก อีเมล์');
												$('#Email').focus();
											}else if(User==''){
												alert('กรุณากรอก User');
												$('#User').focus();
											}else if(PasswordN==''){
												alert('กรุณากรอกรหัสผ่าน');
												$('#PasswordN').focus();
											}else if(PasswordN!=PasswordC){
												alert('ยืนยันรหัสผ่านผิดพลาด');
												$('#PasswordC').focus();
											}else{
												$('#registForm').submit();
											}
										"
									>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>