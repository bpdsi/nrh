<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
	headerEncode();
	$keyword=$_POST["keyword"];
?>
<style>
	.table_header{
		padding: 3px;
	}
</style>

<div id="vaccineEditDIV"
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
							แก้ไขวัดซีน
							<img src="img/delete.png" style="float: right;cursor: pointer;" onclick="$('#vaccineEditDIV').fadeOut();">
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
										<form id="editForm" method="post">
											<input type="hidden" name="vcID" id="vcID">
											<table>
												<tr>
													<td class="form_field">รหัสวัคซีน มาตรฐาน สนย.</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="Vaccine_Name" name="BPS_STD" id="BPS_STD"
															style="width: 50px;"
															onblur="
																$.post('BPS_STDCheck.php',{
																		checkingType: 'edit',
																		vcID: $('#vcID').val(),
																		BPS_STD: $('#BPS_STD').val()
																	},function(data){
																		if(data=='found'){
																			alert('รหัสวัคซีนซ้ำ');
																			$('#BPS_STD').focus();
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
														<input type="text" class="nextFocus" next="Vaccine_Name_EN" name="Vaccine_Name" id="Vaccine_Name" style="text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">ชื่อวัคซีน (อังกฤษ)</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="Prevention" name="Vaccine_Name_EN" id="Vaccine_Name_EN" style="text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">ชื่อโรคที่ป้องกัน</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="Age" name="Prevention" id="Prevention" style="text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">ช่วงที่ฉีด (อายุ / ชั้นเรียน)</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="ICD10" name="Age" id="Age" style="text-align: left;">
													</td>
												</tr>
												<tr>
													<td class="form_field">รหัส ICD_10_TM</td>
													<td class="form_input">
														<input type="text" class="nextFocus" next="Name" name="ICD10" id="ICD10" style="text-align: left;">
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
							<input id="submitButton" class="nprButton" type='submit' value="   บันทึก   "
								onclick="
									var	BPS_STD=$('#BPS_STD').val();
									var	Vaccine_Name=$('#Vaccine_Name').val();
									var	Prevention=$('#Prevention').val();
									var	Age=$('#Age').val();
									var	ICD10=$('#ICD10').val();

									if(BPS_STD==''){
										alert('กรุณากรอก รหัสวัคซีน มาตรฐาน สนย.');
										$('#BPS_STD').click();
									}else if(Vaccine_Name==''){
										alert('กรุณากรอก ชื่อวัคซีน (ไทย)');
										$('#Vaccine_Name').focus();
									}else if(Prevention==''){
										alert('กรุณากรอก ชื่อโรคที่ป้องกัน');
										$('#Prevention').focus();
									}else if(Age==''){
										alert('กรุณากรอก ช่วงอายุที่ฉีก (อายุ / ชั้นเรียน)');
										$('#Age').focus();
									}else if(ICD10==''){
										alert('กรุณากรอก รหัส ICD_10_TM');
										$('#ICD10').focus();
									}else{
										$.post('vaccineEdit.php',
												$('#editForm').serialize()
											,function(data){
												if(data=='complete'){
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
<table class="noSpacing table_01" style="width: 100%;">
	<tr>
		<td class="table_header" colspan="2">รหัสมาตรฐาน สนย.</td>
		<td class="table_header">ชื่อวัคซีน<br>(ไทย)</td>
		<td class="table_header">ชื่อวัคซีน<br>(อังกฤษ)</td>
		<td class="table_header">ชื่อโรคที่ป้องกัน</td>
		<td class="table_header">ช่วงที่ฉีด<br>(อายุ / ชั้นเรียน)</td>
		<td class="table_header" colspan="2">รหัส ICD_10_TM</td>
	</tr>
	<?php
		$query="
			select	*
			from	vc_vaccine
			where	BPS_STD like '%$keyword%' or
					Vaccine_Name like '%$keyword%' or
					Vaccine_Name_EN like '%$keyword%' or
					Prevention like '%$keyword%' or
					Age like '%$keyword%' or
					ICD10 like '%$keyword%'
		";
		$result=mysql_query($query);
		$numrows=mysql_num_rows($result);
		$i=0;
		while($i<$numrows){
			$row=mysql_fetch_array($result);
			
			?>
				<tr id="vcID<?php echo $row[vcID]?>" style="background-color: <?php echo $bgColor;?>">
					<td class="bottom_dashed right_solid" 
						style="
							vertical-align: middle;
							text-align: center;
							padding-top: 5px;
							padding-bottom: 5px;
							cursor: pointer;
						"
						onclick="
							$('#vaccineEditDIV').fadeIn();
							$('#vcID').val('<?php echo $row[vcID]?>');
							$('#vcIDOld').val('<?php echo $row[vcID]?>');
							$('#BPS_STD').val('<?php echo $row[BPS_STD]?>');
							$('#Vaccine_Name').val('<?php echo $row[Vaccine_Name]?>');
							$('#Vaccine_Name_EN').val('<?php echo $row[Vaccine_Name_EN]?>');
							$('#Prevention').val('<?php echo $row[Prevention]?>');
							$('#Age').val('<?php echo $row[Age]?>');
							$('#ICD10').val('<?php echo $row[ICD10]?>');
						"
					><img src="img/edit.png" height="15"></td>
					<td class="table_detail right_solid bottom_dashed"><?php echo $row[BPS_STD]?></td>
					<td class="table_detail right_solid bottom_dashed"><?php echo $row[Vaccine_Name]?></td>
					<td class="table_detail right_solid bottom_dashed"><?php echo $row[Vaccine_Name_EN]?></td>
					<td class="table_detail right_solid bottom_dashed"><?php echo $row[Prevention]?></td>
					<td class="table_detail right_solid bottom_dashed" style="text-align: center"><?php echo $row[Age]?></td>
					<td class="table_detail right_solid bottom_dashed"><?php echo $row[ICD10]?></td>
					<?php
						$vc_deletable=vc_deletable($row[Vaccine_Code]);
					?>
					<td class="bottom_dashed" 
						style="
							text-align: center;
							vertical-align: middle;
							padding-top: 5px;
							padding-bottom: 5px;
							<?php
								if($vc_deletable){
									echo "cursor: pointer";
								} 
							?>
						"
						<?php
							if($vc_deletable){
								?>
									onclick="
										if(confirm('ต้องการลบข้อมูลวัคซีน <?php echo $row[Vaccine_Name]?>')){
											$.post('vaccineDelete.php',{
													vcID: '<?php echo $row[vcID]?>'
												},function(data){
													if(data=='complete'){
														$('#vcID<?php echo $row[vcID]?>').fadeOut();
													}
												}
											);
										}
									"
								<?php
							} 
						?>
					>
						<?php
							if($vc_deletable){
								?><img src="img/delete.png"><?php
							}
						?>						
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