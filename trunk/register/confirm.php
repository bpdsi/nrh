<?php
	include "../function/functionPHP.php";
	
	$AllowID=aesDecrypt($_GET["key"]);
		
	if($Hospital==""){
		$Hospital=11470;
	}
	/*echo $_GET["key"]."<br>";
	echo aesDecrypt(urldecode($_GET["key"]));*/
	
	host("nrh");
	
	$query="
		select	*
		from	person_allow
		where	AllowID='$AllowID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	
	if(mysql_num_rows($result)==0){
		echo "Permission Denied!";
		exit();
	}else if($row[AllowStatus]=="rejected"){
		echo "Your request has been rejected";
		exit();
	}else if($row[AllowStatus]=="accepted"){
		echo "Your request has been accepted";
		exit();
	}
	
	$PersonalID=$row[PersonalID];
	$PersonalID=4;
	$HospCode=$row[HospCode];
	$AllowType=$row[AllowType];
	$AllowDate=$row[AllowDate];
	
	$person=get_person($PersonalID);
	
	if($person[User]!="" && $person[Password]!=""){
		/*$query="
			update	person_allow
			set		AllowStatus='accepted'
			where	AllowID='$AllowID'
		";
		$result=mysql_query($query);*/
		//header("location:../authen");
		//exit();
	}
	
	$query="
		select	*
		from	hospital_patient
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$HospitalNumber=$row[HospitalNumber];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Databank Confirmation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="../css/demo.css">
			
		<!-- CUFON -->
			<script type="text/javascript" src="../js/cufon-yui.js"></script>
			<script type="text/javascript" src="../js/nprFont.js"></script>
			<script type="text/javascript">
				Cufon.replace('h1.header');
			</script>
			
		<!-- CSS -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/npr.css">
		
		<script type="text/javascript">
			$.extend({
			  password: function (length, special) {
			    var iteration = 0;
			    var password = "";
			    var randomNumber;
			    if(special == undefined){
			        var special = false;
			    }
			    while(iteration < length){
			        randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
			        if(!special){
			            if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
			            if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
			            if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
			            if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
			        }
			        iteration++;
			        password += String.fromCharCode(randomNumber);
			    }
			    return password;
			  }
			});
			$(document).ready(function() {
				$('.focus').focus();
				$('.link-password').click(function(e){
					linkId = $(this).attr('id');
					if (linkId == 'generate'){
						//password = $.password(12,true);
						password = $.password(8);
						$('#random').empty().hide().append(password).fadeIn('slow');
						$('#confirm').fadeIn('slow');
						//$('#confirm').fadeIn('slow');
						//vasu
						//$('#Password').val(password);
					} else {
						$('#Password').val(password);
						$('#random').empty();
						$(this).hide();
					}
					e.preventDefault();
				});
				$('#hospitalBrowseButton').click(function(){
					$.get("hospitalList.php",function(data){
						$('#hospitalListDetail').html(data);
						$('#hospitalListFrame').css("top",$('#hospitalBrowseButton').position().top);
						$('#hospitalListFrame').css("left",$('#hospitalBrowseButton').position().left+1);
						$('#hospitalListFrame').fadeIn();
					});
				});
			});
		</script>
		<script src="../function/functionJAVA.js" type="text/javascript"></script>

		<style type="text/css">
			.form_input{
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div style="position: fixed;bottom: 0px;right:0px;padding: 5px;">©2013 Personal Health Databank</div>
		<table class="fullScreen noSpacing">
			<tr>
				<td style="width: auto;">&nbsp;</td>
				<td style="width: 800px;background-color: #eee;">
					<div class="form" style="width: 660px;margin-left: auto;margin-right: auto;">
						<table class="form" style="width: 100%;">
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
											<td valign="top" align="center" style="width: 170px;">
												<img src="../img/person.png">
												<div style="font-size: 14px;"><?php echo $person[PersonName]?></div>
											</td>
											<td>
												<div style="float: right">ยืนยันการสมัคร</div><br>
												<form id="confirmForm" method="post" action="confirmSQL.php">
													<input type="hidden" name="key" value="<?php echo urlencode(aesEncrypt($AllowID))?>">
													<table>
														<tr>
															<td class="form_field"><?php echo $HospCode;?></td>
															<td class="form_input"><?php echo HospitalName($HospCode);?></td>
														</tr>
														<tr>
															<td colspan="2"><hr /></td>
														</tr>
														<tr>
															<td class="form_field">Hospital Number (HN)</td>
															<td class="form_input"><?php echo $HospitalNumber?></td>
														</tr>
														<tr>
															<td class="form_field">หมายเลขบัตรประชาชน</td>
															<td class="form_input"><?php echo $person[CitizenID]?></td>
														</tr>
														<tr>
															<td class="form_field">ชื่อ นามสกุล</td>
															<td class="form_input"><?php echo $person[PersonName]?></td>
														</tr>
														<tr>
															<td class="form_field">หมายเลขโทรศัพท์</td>
															<td class="form_input"><?php echo $person[Telephone]?></td>
														</tr>
														<tr>
															<td class="form_field">อิเมล์</td>
															<td class="form_input"><?php echo $person[Email]?></td>
														</tr>
														<tr>
															<td class="form_field">กรุ๊ปเลือด</td>
															<td class="form_input">
																O
																&nbsp;
																Rh +
															</td>
														</tr>
														<tr>
															<td class="form_field">ต้องการเก็บประวัติข้อมูลแลป</td>
															<td class="form_input">
																<?php
																	if($AllowType=="Perday"){
																		echo "เฉพาะวันที่ ".substr($AllowDate,0,10);
																	}else if($AllowType=="Unconditioned"){
																		echo "ตั้งแต่วันที่ ".$AllowDate;
																	}
																?>
															</td>
														</tr>
														<tr>
															<td colspan="2"><hr /></td>
														</tr>
														<tr>
															<td class="form_field">ชื่อผู้ใช้</td>
															<td class="form_input">
																<input id="User" type="text" class="text-input focus nextFocus" next="Password" name="User" value=""
																	onblur="
																		$.post('checkUsername.php',{
																				User: $('#User').val()
																			},function(data){
																				if(data=='unavailable'){
																					alert('ไม่สามารถใช้ชื่อผู้ใช้ระบบนี้ได้');
																					$('#User').focus();
																				}
																			}
																		);
																	" 
																/>
															</td>
														</tr>
														<tr>
															<td class="form_field">รหัสผ่าน</td>
															<td class="form_input">
																<input id="Password" type="password" class="text-input password link-password nextClick" next="submitButton" name="Password" value=""
																	size="8"
																/><input id="generate" class="link-password" type="button" value=" Generate Password " /><br>
																<div class="form-row text-right" id="random"></div>
																<a href="#" class="link-password" id="confirm" style="display: none;">Use Password</a>
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
									<input class="nprButton" type='reset' value="   ปฏิเสธ   " style="float: left;"
										onclick="
											if(confirm('ต้องการยกเลิกคำขอนี้')){
												location.replace('reject.php?key=<?php echo $_GET["key"]?>');
											}
										"
									>
									<input id="submitButton" class="nprButton" type='submit' value="   บันทึก   "
										onclick="
											var	User=$('#User').val();
											var	Password=$('#Password').val();
											
											if(User==''){
												alert('กรุณากรอก User');
											}else if(Password==''){
												alert('กรุณากรอก Password');
											}else{
												$('#confirmForm').submit();
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