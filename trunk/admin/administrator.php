<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
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
										<form id="editForm" method="post" action="registerSQL.php">
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
					$result=mysql_query($query);
					$numrows=mysql_num_rows($result);
					$i=0;
					while($i<$numrows){
						$row=mysql_fetch_array($result);
						?>
							<option value="<?php echo $row[hospcode]?>"><?php echo $row[hosptype].$row[name]?></option>
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