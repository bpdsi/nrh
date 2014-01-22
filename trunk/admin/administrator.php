<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	
	$hospcode=$_POST["hospcode"];
?>
<script type="text/javascript">
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
	
	
		$.post("getHospitalName.php",{
				Hospital: $('#Hospital').val()
			},function(data){
				$('#HospitalName').val(data);
			}
		);
	
		$('#blnLoadMember').click(function(){
			GetMember();					
		});
	})
</script>
<div id="adminRegistDIV"
	style="
		position: absolute;
		z-index: 1000;
		display: none;
		background-color: rgba(0,0,0,0.5);
		width: 100%;
		height: 100%;
		top: 0px;
		left: 0px;
	"
>
	<table style="width: 100%;height: 100%">
		<tr>
			<td style="vertical-align: middle;text-align: center">
				<table class="form table_01" style="width: auto;margin-left: auto;margin-right: auto;box-shadow: 1px 1px 3px #000;">
					<tr>
						<td class="form_header" colspan="2">
							ลงทะเบียนเจ้าหน้าที่
							<img src="img/delete.png" style="float: right;cursor: pointer;" onclick="$('#adminRegistDIV').fadeOut();">
						</td>
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
										<img src="img/user.png"><br>
										ข้อมูลเจ้าหน้าที่
									</td>
									<td style="padding: 0px 10px 0px 10px;">
										<form id="registForm" method="post" action="registerSQL.php">
											<table>
												<tr>
													<td class="form_field">โรงพยาบาล</td>
													<td class="form_input">
														<input type="hidden" id="regist_hospcode" name="hospcode" value="<?php echo $_SESSION["admin_hospcode"]?>"
															style="
																float: left;
																width: 50px;
																text-align: center;
																padding: 1px;
																background-color: #eee;
																border: 1px #aaa solid;
															" 
														><div id="HospitalName" style="float: left;margin-top: 3px;"><?php
															if($_SESSION["admin_permission"]!="global"){
																echo HospitalName($_SESSION["admin_hospcode"]);
															} 
														?></div><?php
															if($_SESSION["admin_permission"]=="global"){
																?><input type="button" id="hospitalBrowseButton" value=" ค้นหา " style="float: left;height: 20px;margin: 0px;padding: 0px;"
																	onclick="
																		$.get('hospitalList.php',{},function(data){
																				$('#hospitalListDetail').html(data);
																				$('#hospitalListFrame').css('top',$('#hospitalBrowseButton').position().top);
																				$('#hospitalListFrame').css('left',$('#hospitalBrowseButton').position().left+1);
																				$('#hospitalListFrame').fadeIn();
																			}
																		);
																	"
																><?php
															} 
														?>
														<div id="hospitalListFrame" class="frame"
															style="
																display: none;
																position: absolute;
																z-index: 1000;
																width: 300px;
															"
														>
															<table style="width: 300px;">
																<tr>
																	<td style="height: 20px;" class="frame_header">
																		<div style="float: left">:: กรุณาเลือกโรงพยาบาล</div>
																		<img src="../img/close.png"
																			onclick="$('#hospitalListFrame').fadeOut();"
																			style="
																				padding: 2px;
																				float: right;
																				cursor: pointer;
																			"
																		>
																	</td>
																</tr>
																<tr>
																	<td>
																		คำค้น <input type="text" id="keyword" name="keyword" style="width: 240px;"
																			onkeyup="
																				$.get('hospitalList.php',{
																						keyword: $('#keyword').val()
																					},function(data){
																						$('#hospitalListDetail').html(data);
																						$('#hospitalListFrame').css('top',$('#hospitalBrowseButton').position().top);
																						$('#hospitalListFrame').css('left',$('#hospitalBrowseButton').position().left+1);
																						$('#hospitalListFrame').fadeIn();
																					}
																				);
																			"
																		>
																		<div id="hospitalListDetail" style="width: 100%;height: 200px;overflow: auto"></div>
																	</td>
																</tr>
															</table>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="2" style="font-weight: bold;text-align: left;padding-top: 10px;">
														ข้อมูลประวัติผู้ใช้ระบบ
													</td>
												</tr>
												<tr>
													<td class="form_field">หมายเลขบัตรประชาชน</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_Prefix" name="CitizenID" id="regist_CitizenID"
															onblur="
																$.post('citizenIDCheck.php',{
																		CitizenID: $('#regist_CitizenID').val()
																	},function(data){
																		if(data=='found'){
																			alert('หมายเลขบัตรประชาชนซ้ำ');
																			$('#regist_CitizenID').focus();
																		}
																	}
																);
															"
														/>
													</td>
												</tr>
												<tr>
													<td class="form_field">คำนำหน้าชื่อ</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_Name" name="Prefix" id="regist_Prefix" style="width: 30px;text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">ชื่อ นามสกุล</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_Telephone" name="Name" id="regist_Name">
													</td>
												</tr>
												<tr>
													<td class="form_field">หมายเลขโทรศัพท์</td>
													<td class="form_input"><input type="text" class="nextFocus" next="regist_Email" name="Telephone" id="regist_Telephone"></td>
												</tr>
												<tr>
													<td class="form_field">อีเมล์</td>
													<td class="form_input"><input type="text" class="nextFocus" next="regist_BloodGroupABO" name="Email" id="regist_Email"></td>
												</tr>
												<tr>
													<td class="form_field">วันเดือนปีเกิด</td>
													<td class="form_input">
														<input type="text" class="nextFocus date-pick" next="regist_User" name="BirthDate" id="regist_BirthDate" size="10"
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
													<td colspan="2" style="font-weight: bold;padding-top: 10px;text-align: left">
														บัญชีผู้ใช้ (เจ้าหน้าที่)
													</td>
												</tr>
												<tr>
													<td class="form_field">ชื่อผู้ใช้</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_PasswordN" name="User" id="regist_User"
															onblur="
																$.post('userCheck.php',{
																		User: $('#regist_User').val()
																	},function(data){
																		if(data=='found'){
																			alert('ชื่อผู้ใช้ซ้ำ');
																			$('#regist_User').focus();
																		}
																	}
																);
															"
														>
													</td>
												</tr>
												<tr>
													<td class="form_field">รหัสผ่าน</td>
													<td class="form_input">
														<input type="password" class="nextFocus" next="regist_PasswordC" name="PasswordN" id="regist_PasswordN">
													</td>
												</tr>
												<tr>
													<td class="form_field">ยืนยันรหัสผ่าน</td>
													<td class="form_input">
														<input type="password" class="nextFocus" next="regist_submitButton" name="PasswordC" id="regist_PasswordC">
													</td>
												</tr>
												<tr>
													<td class="form_field">ตำแหน่ง</td>
													<td class="form_input">
														<select id="regist_permission" name="permission">
															<option value="officer">เจ้าหน้าที่ลงทะเบียนผู้ขอใช้สิทธิ์</option>
															<option value="admin">ผู้ดูแลระบบ (ประจำโรงพยาบาล)</option>
														</select>
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
									var	CitizenID=$('#regist_CitizenID').val();
									var	Prefix=$('#regist_Prefix').val();
									var	Name=$('#regist_Name').val();
									var	Telephone=$('#regist_Telephone').val();
									var	Email=$('#regist_Email').val();
									var	User=$('#regist_User').val();
									var	PasswordN=$('#regist_PasswordN').val();
									var	PasswordC=$('#regist_PasswordC').val();
									var hospcode=$('#regist_hospcode').val();

									if(hospcode==''){
										alert('กรุณาเลือกโรงพยาบาล');
										$('#hospitalBrowseButton').click();
									}else if(CitizenID==''){
										alert('กรุณาระบุ CitizenID');
										$('#regist_CitizenID').focus();
									}else if(Name==''){
										alert('กรุณากรอก ชื่อ-นามสกุล');
										$('#regist_Name').focus();
									}else if(Telephone==''){
										alert('กรุณากรอกหมายเลขโทรศัพท์');
										$('#regist_Telephone').focus();
									}else if(Email==''){
										alert('กรุณากรอก อีเมล์');
										$('#regist_Email').focus();
									}else if(PasswordN==''){
										alert('กรุณากรอก รหัสผ่าน');
										$('#regist_PasswordN').focus();
									}else if(PasswordN!=PasswordC){
										alert('ยืนยันรหัสผ่านไม่ถูกต้อง');
										$('#regist_PasswordC').focus();
									}else{
										$.post('adminRegist.php',
												$('#registForm').serialize()
											,function(data){
												if(data=='complete'){
													$.post('administrator.php',{
															hospcode: $('#regist_hospcode').val()
														},function(data){
															$('#container').html(data);
														}
													);
												}
											}
										);
									}
								"
							>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<table style="width: 100%;">
	<tr>
		<td>
			โรงพยาบาล
			<select id="hospcode"
				onchange="
					$.post('showAdmin.php',{
							hospcode: $(this).val()
						},function(data){
							$('#contentTD').html(data);
						}
					)
				"
			>
				<option value="">กรุณาเลือกโรงพยาบาล</option>
				<?php
					if($_SESSION["admin_permission"]=="admin"){
						$query="
							select	*
							from	hospcode
							where	hospcode='".$_SESSION["admin_hospcode"]."'
						";
					}else{
						$query="
							select	*
							from	hospcode
							where	(
										hosptype='โรงพยาบาล' or
										hosptype='รพ.'
									) and
									hospcode in (
										select	hospcode
										from	admin_hospital
									)
						";
					}
					
					$result=mysql_query($query);
					$numrows=mysql_num_rows($result);
					$i=0;
					while($i<$numrows){
						$row=mysql_fetch_array($result);
						?>
							<option value="<?php echo $row[hospcode]?>"
								<?php
									if($row[hospcode]==$hospcode){
										echo "selected";
									} 
								?>
							><?php echo $row[hosptype].$row[name]?></option>
						<?php
						$i++;
					} 
				?>
			</select>
			<input type="button" value=" ลงทะเบียนเจ้าหน้าที่ " style="float: right;"
				onclick="
					$('#adminRegistDIV').fadeIn();
				"
			>
			<hr>
		</td>
	</tr>
	<tr>
		<td id="contentTD"></td>
	</tr>
</table>
<?php
	if($hospcode!=""){
		?>
			<script type="text/javascript">
				$.post('showAdmin.php',{
						hospcode: '<?php echo $hospcode?>'
					},function(data){
						$('#contentTD').html(data);
					}
				)
			</script>
		<?php
	} 
?>