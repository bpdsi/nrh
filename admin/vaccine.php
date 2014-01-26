<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
?>
<div id="vaccineRegistDIV"
	style="
		position: fixed;
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
							ลงทะเบียนวัดซีน
							<img src="img/delete.png" style="float: right;cursor: pointer;" onclick="$('#vaccineRegistDIV').fadeOut();">
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
										<img src="../images/vc.png" style="height: 128px;"><br>
										ข้อมูลวัคซีน
									</td>
									<td style="padding: 0px 10px 0px 10px;">
										<form id="registForm" method="post" action="registerSQL.php">
											<table>
												<tr>
													<td class="form_field">รหัสวัคซีน</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_Vaccine_Name" name="BPS_STD" id="regist_BPS_STD"
															style="width: 50px;"
															onblur="
																$.post('BPS_STDCheck.php',{
																		BPS_STD: $('#regist_BPS_STD').val()
																	},function(data){
																		if(data=='found'){
																			alert('รหัสวัคซีนซ้ำ');
																			$('#regist_BPS_STD').focus();
																		}
																	}
																);
															"
														/>
													</td>
												</tr>
												<tr>
													<td class="form_field">ชื่อวัคซีน (ไทย)</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_Vaccine_Name_EN" name="Vaccine_Name" id="regist_Vaccine_Name" style="text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">ชื่อวัคซีน (อังกฤษ)</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_Prevention" name="Vaccine_Name_EN" id="regist_Vaccine_Name_EN" style="text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">ชื่อโรคที่ป้องกัน</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_Age" name="Prevention" id="regist_Prevention" style="text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">ช่วงที่ฉีด (อายุ / ชั้นเรียน)</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_ICD10" name="Age" id="regist_Age" style="text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">รหัส ICD_10_TM</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="regist_Name" name="ICD10" id="regist_ICD10" style="text-align: left;">
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
									var	BPS_STD=$('#regist_BPS_STD').val();
									var	Vaccine_Name=$('#regist_Vaccine_Name').val();
									var	Prevention=$('#regist_Prevention').val();
									var	Age=$('#regist_Age').val();
									var	ICD10=$('#regist_ICD10').val();

									if(BPS_STD==''){
										alert('กรุณากรอก รหัสวัคซีน มาตรฐาน สนย.');
										$('#regist_BPS_STD').click();
									}else if(Vaccine_Name==''){
										alert('กรุณากรอก ชื่อวัคซีน (ไทย)');
										$('#regist_Vaccine_Name').focus();
									}else if(Prevention==''){
										alert('กรุณากรอก ชื่อโรคที่ป้องกัน');
										$('#regist_Prevention').focus();
									}else if(Age==''){
										alert('กรุณากรอก ช่วงอายุที่ฉีก (อายุ / ชั้นเรียน)');
										$('#regist_Age').focus();
									}else if(ICD10==''){
										alert('กรุณากรอก รหัส ICD_10_TM');
										$('#regist_ICD10').focus();
									}else{
										$.post('vaccineRegist.php',
												$('#registForm').serialize()
											,function(data){
												if(data=='complete'){
													$('#registForm')[0].reset();
													
													$('#vaccineRegistDIV').fadeOut();
													$.post('showVaccine.php',function(data){
															$('#contentTD').html(data);
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
			คำค้น
			<input type="text" name="keyword" id="keyword"
				onkeyup="
					$.post('showVaccine.php',{
							keyword: $('#keyword').val()
						},function(data){
							$('#contentTD').html(data);
						}
					)
				"
			>
			<input type="button" value=" ลงทะเบียนวัคซีน" style="float: right;"
				onclick="
					$('#vaccineRegistDIV').fadeIn();
				"
			>
			<hr>
		</td>
	</tr>
	<tr>
		<td id="contentTD"></td>
	</tr>
</table>
<script type="text/javascript">
	$.post('showVaccine.php',function(data){
			$('#contentTD').html(data);
		}
	);
</script>