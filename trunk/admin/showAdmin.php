<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	headerEncode();
?>
<style>
	.table_header{
		padding: 3px;
	}
</style>
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
<div id="adminEditDIV"
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
							แก้ไขข้อมูลเจ้าหน้าที่
							<img src="img/delete.png" style="float: right;cursor: pointer;" onclick="$('#adminEditDIV').fadeOut();">
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
										<form id="editForm" method="post" action="registerSQL.php">
											<table style="width: 400px;">
												<tr>
													<td class="form_field">โรงพยาบาล</td>
													<td class="form_input">
														<input type="hidden" id="edit_hospcode" name="hospcode"
															style="
																float: left;
																width: 50px;
																text-align: center;
																padding: 1px;
																background-color: #eee;
																border: 1px #aaa solid;
															" 
														><div id="edit_HospitalName" style="float: left;margin-top: 3px;"></div><input type="button" id="edit_hospitalBrowseButton" value=" ค้นหา " style="float: left;height: 20px;margin: 0px;padding: 0px;"
															onclick="
																$.get('hospitalList.php',{},function(data){
																		$('#edit_hospitalListDetail').html(data);
																		$('#edit_hospitalListFrame').css('top',$('#edit_hospitalBrowseButton').position().top);
																		$('#edit_hospitalListFrame').css('left',$('#edit_hospitalBrowseButton').position().left+1);
																		$('#edit_hospitalListFrame').fadeIn();
																	}
																);
															"
														>
														<div id="edit_hospitalListFrame" class="frame"
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
																			onclick="$('#edit_hospitalListFrame').fadeOut();"
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
																		คำค้น <input type="text" id="edit_keyword" name="keyword" style="width: 240px;"
																			onkeyup="
																				$.get('hospitalList.php',{
																						keyword: $('#edit_keyword').val()
																					},function(data){
																						$('#edit_hospitalListDetail').html(data);
																						$('#edit_hospitalListFrame').css('top',$('#edit_hospitalBrowseButton').position().top);
																						$('#edit_hospitalListFrame').css('left',$('#edit_hospitalBrowseButton').position().left+1);
																						$('#edit_hospitalListFrame').fadeIn();
																					}
																				);
																			"
																		>
																		<div id="edit_hospitalListDetail" style="width: 100%;height: 200px;overflow: auto"></div>
																	</td>
																</tr>
															</table>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="2" style="font-weight: bold;padding-top: 10px;">
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
														<input type="hidden" class="nextFocus" next="AdminID" name="AdminID" id="AdminID"/>
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
													<td class="form_input" id="ConfirmDate"></td>
												</tr>
												<tr>
													<td class="form_field">ตำแหน่ง</td>
													<td class="form_input">
														<select id="permission" name="permission">
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
									var	CitizenID=$('#CitizenID').val();
									var	Prefix=$('#Prefix').val();
									var	Name=$('#Name').val();
									var	Telephone=$('#Telephone').val();
									var	Email=$('#Email').val();
									var	Password=$('#Password').val();
									
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
									}else{
										$.post('adminEdit.php',
												$('#editForm').serialize()
											,function(data){
												$.post('showAdmin.php',{
														hospcode: '<?php echo $_POST["hospcode"]?>'
													},function(data){
														$('#contentTD').html(data);
													}
												);
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
<table class="noSpacing table_01" style="width: 100%;">
	<tr>
		<td class="table_header" colspan="2">ชื่อผู้ใช้ระบบ</td>
		<td class="table_header">ชื่อ นามสกุล</td>
		<td class="table_header">หมายเลขโทรศัพท์</td>
		<td class="table_header">อิเมล์</td>
		<td class="table_header" colspan="2">วันที่สมัคร</td>
	</tr>
	<?php
		$query="
			select	*
			from	admin
			where	AdminID in (
						select 	AdminID
						from	admin_hospital
						where	hospcode='".$_POST['hospcode']."'	
					) and
					status='enable'
		";
		$result=mysql_query($query);
		$numrows=mysql_num_rows($result);
		$i=0;
		while($i<$numrows){
			$row=mysql_fetch_array($result);
			
			$queryHos="
				select	*
				from	admin_hospital
				where	AdminID='$row[AdminID]'
			";
			$resultHos=mysql_query($queryHos);
			$rowHos=mysql_fetch_array($resultHos);
			$HospitalName=HospitalName($rowHos[hospcode]);
			
			if($row[permission]=='admin'){
				$bgColor='#FFE4E4';
			}
			?>
				<tr id="AdminID<?php echo $row[AdminID]?>" style="background-color: <?php echo $bgColor;?>">
					<td class="bottom_dashed right_solid" 
						style="
							vertical-align: middle;
							text-align: center;
							padding-top: 5px;
							padding-bottom: 5px;
							cursor: pointer;
						"
						onclick="
							$('#adminEditDIV').fadeIn();
							$('#AdminID').val('<?php echo $row[AdminID]?>');
							$('#CitizenID').val('<?php echo $row[CitizenID]?>');
							$('#Prefix').val('<?php echo $row[Prefix]?>');
							<?php
								if($row[MiddleName]==""){
									?>$('#Name').val('<?php echo $row[GivenName]." ".$row[FamilyName]?>');<?php
								}else{
									?>$('#Name').val('<?php echo $row[GivenName]." ".$row[MiddleName]." ".$row[FamilyName]?>');<?php
								}
							?>
							
							$('#Telephone').val('<?php echo $row[Telephone]?>');
							$('#Email').val('<?php echo $row[Email]?>');
							<?php
								$birthTemp=explode("-", $row[BirthDate]); 
							?>
							$('#BirthDate').val('<?php echo $birthTemp[2]."/".$birthTemp[1]."/".($birthTemp[0]+543)?>');
							$('#ConfirmDate').html('<?php echo dateEncode($row[ConfirmDate])?>');
							$('#User').val('<?php echo $row[User]?>');
							$('#permission').val('<?php echo $row[permission]?>');
							
							$('#edit_hospcode').val('<?php echo $rowHos[hospcode]?>');
							$('#edit_HospitalName').html('<?php echo $HospitalName?> &nbsp;&nbsp;&nbsp;&nbsp;');
						"
					><img src="img/edit.png" height="15"></td>
					<td class="table_detail right_solid bottom_dashed"><?php echo $row[User]?></td>
					<td class="table_detail right_solid bottom_dashed"><?php echo $row[PersonName]?></td>
					<td class="table_detail right_solid bottom_dashed" style="text-align: center;"><?php echo $row[Telephone]?></td>
					<td class="table_detail right_solid bottom_dashed"><?php echo $row[Email]?></td>
					<td class="table_detail right_solid bottom_dashed" style="text-align: center;"><?php echo dateEncode($row[ConfirmDate])?></td>
					<td class="bottom_dashed" 
						style="
							text-align: center;
							vertical-align: middle;
							padding-top: 5px;
							padding-bottom: 5px;
							cursor: pointer;
						"
						onclick="
							if(confirm('ต้องการยกเลิกสิทธิ์การเข้าใช้งานของ <?php echo $row[PersonName]?>')){
								$.post('adminDisable.php',{
										AdminID: '<?php echo $row[AdminID]?>'
									},function(data){
										if(data=='complete'){
											$('#AdminID<?php echo $row[AdminID]?>').fadeOut();
										}
									}
								);
							}
						"
					>
						<img src="img/delete.png">
					</td>
				</tr>
			<?php
			$i++;
		} 
	?>
	<tr>
		<td class="table_footer" colspan="7" style="text-align: right"><?php echo $numrows?> รายชื่อ</td>
	</tr>
</table>