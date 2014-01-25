<?php
	$functionName="Lab Result (ผลการตรวจจากห้องปฏิบัติการ)";
	include "../template/header.php";
?>
<table class="noSpacing" style="width: 100%;height: 100%;">
	<tr>
		<td class="form_body right_dashed" rowspan="2" style="vertical-align: top;text-align: center;width: 170px;">
			<img id="menu_labResult" src="../img/lab.png" height="150">
			<div style="font-weight: bold;"><?php echo $person[PersonName]?></div>
		</td>
		<td class="form_body" align="right" style="vertical-align: top;">
			<form name="monitorsearch" method="POST">
				<table>
					<tr>
						<td class="form_input">
							จากวันที่
							<input type="text" id="StartDate" name="StartDate" size="10"
								style="
									text-align: center;
									cursor: pointer;
								"
								value="<?php echo $StartDate?>"
							/><img src="<?php echo $mainUrl?>/img/calendar.png"
								style="
									margin-bottom: -3px;
									padding-left: 3px;
									cursor: pointer;
								"
								onclick="$('#StartDate').focus();"
							>
						</td>
						<td class="form_input">
							ถึง
							<input type="text" id="EndDate" name="EndDate" size="10"
								style="
									text-align: center;
									cursor: pointer;
								" 
								value="<?php echo $EndDate?>"
							/><img src="<?php echo $mainUrl?>/img/calendar.png"
								style="
									margin-bottom: -3px;
									padding-left: 3px;
									cursor: pointer
								"
								onclick="$('#EndDate').focus();"
							>													
						</td>
						<td colspan="2" align="right">
							<input type="submit" name="submit" value="   ค้นหา   ">
							<input type="reset" name="reset" value="ยกเลิก" style="display: none">
						</td>
					</tr>
				</table>
			</form>
			
			<?php
				if($StartDate!=""){
					$tempDate=explode("/", $StartDate);	
					$stDate=($tempDate[2]-543)."-".$tempDate[1]."-".$tempDate[0];				
				}
				if($EndDate!=""){
					$tempDate=explode("/", $EndDate);	
					$enDate=($tempDate[2]-543)."-".$tempDate[1]."-".$tempDate[0];
				}
				if($StartDate!=""){
					if($EndDate!=""){
						$query="
							select		*
							from		lab_test
							where		PersonalID='$person[PersonalID]' and
										(
											left(LabDate,10)>='$stDate' and
											left(LabDate,10)<='$enDate'
										)
							order by	LabDate desc
						";
					}else{
						$query="
							select		*
							from		lab_test
							where		PersonalID='$person[PersonalID]' and
										(
											left(LabDate,10)='$stDate'
										)
							order by	LabDate desc
						";
					}
				}else{
					if($endDate!=""){
						$query="
							select		*
							from		lab_test
							where		PersonalID='$person[PersonalID]' and
										(
											left(LabDate,10)='$enDate'
										)
							order by	LabDate desc
						";
					}else{
						$query="
							select		*
							from		lab_test
							where		PersonalID='$person[PersonalID]'
							order by	LabDate desc
						";
					}
				}
				
				$result=mysql_query($query);
				$numrows=mysql_num_rows($result);
				if($numrows>0){
					?>
						<div id="shareDIV"
							style="
								position: absolute;
								display: none;
							"
						>
							<table class="table_01" style="width: 352px;">
								<tr>
									<td class="table_header" style="padding: 4px;">แบ่งปันผลตรวจจากห้องปฏิบัติการ <img src="../img/close.png" onclick="$('#shareDIV').fadeOut();" style="float: right;cursor: pointer;"></td>
								</tr>
								<tr>
									<td>
										<form id="shareForm">
											<input type="hidden" id="LabTestID">
											<input type="hidden" id="PersonalID" value="<?php echo $person[PersonalID]?>">
											<table style="margin-left: auto;margin-right: auto;width: 345px;">
												<tr>
													<td class="form_field" style="font-weight: bold;padding-right:10px;">VN</td>
													<td id="VN"></td>
												</tr>
												<tr>
													<td class="form_field" style="font-weight: bold;padding-right:10px;">วันเวลา</td>
													<td id="LabDate"></td>
												</tr>
												<tr>
													<td class="form_field" style="font-weight: bold;padding-right:10px;">โรงพยาบาล</td>
													<td id="HospitalName"></td>
												</tr>
												<tr>
													<td class="form_field" style="font-weight: bold;padding-right:10px;">สามารถเข้าดูได้</td>
													<td><input type="text" id="accessAvailable" name="accessAvailable" style="width: 20px;text-align: center"> ครั้ง</td>
												</tr>
												<tr>
													<td class="form_field" style="font-weight: bold;padding-right:10px;">วิธีการแบ่งปัน</td>
													<td>
														<select id="shareType"
															onchange="
																if($(this).val()=='shareViaEmail'){
																	$('.showLink').hide();
																	$('.shareViaEmail').show();
																}else{
																	$('.showLink').show();
																	$('.shareViaEmail').hide();
																}
															"
														>
															<option value="shareViaEmail">ส่ง Link ผ่านอิเมล์</option>
															<option value="showLink">แสดง Link</option>
														</select>
													</td>
												</tr>
												<tr>
													<td colspan="2"><hr></td>
												</tr>
												<tr class="shareViaEmail">
													<td class="form_field" style="font-weight: bold;padding-right:10px;">ส่ง Link ไปยังอิเมล์</td>
													<td>
														<input type="text" id="targetEmail" name="targetEmail" style="width: 200px;">
													</td>
												</tr>
												<tr class="shareViaEmail">
													<td colspan="2"><input type="button" value="  ส่ง  " style="float: right;"></td>
												</tr>
												<tr class="showLink" style="display: none;">
													<td colspan="2"><input type="button" value="  แสดง Link  " style="float: right;"></td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
							</table>
						</div>
						<table class="noSpacing border_solid" style="width: 100%;">
							<tr>
								<td class="table_header right_solid bottom_solid" rowspan="2">Analyte (Method)</td>
								<td class="table_header bottom_solid right_solid" colspan="3">Conventional Unit</td>
								<td class="table_header bottom_solid" colspan="3">SI Unit</td>
							</tr>
							<tr>
								<td class="table_header right_solid bottom_solid">Result</td>
								<td class="table_header right_solid bottom_solid">Unit</td>
								<td class="table_header right_solid bottom_solid">Reference Range</td>
								<td class="table_header right_solid bottom_solid">Result</td>
								<td class="table_header right_solid bottom_solid">Unit</td>
								<td class="table_header bottom_solid">Reference Range</td>
							</tr>
							<?php
								$i=0;
								while($i<$numrows){
									$row=mysql_fetch_array($result);
									?>
										<tr>
											<td class="table_detail bottom_solid" style="background-color: #99C27E">
												VN : <b><?php echo $row[VisitingNumber]?></b>
											</td>
											<td class="table_detail bottom_solid" colspan="3" align="center" style="background-color: #99C27E">
												<?php echo dateEncode($row[LabDate])?>
											</td>
											<td class="table_detail bottom_solid" colspan="3" style="text-align: right;background-color: #99C27E">
												<?php echo HospitalName($row[HospCode])." ($row[HospCode])"?>
												<input type="button" value="  Print  " onclick="window.open('printLab.php?VisitingNumber=<?php echo $row[VisitingNumber];?>')">
												<input type="button" value="  แบ่งปันผล Lab  " 
													onclick="
														$('#shareDIV').css('top',$(this).position().top);
														$('#shareDIV').css('left',$(this).position().left-254);
														$('#VN').html('<?php echo $row[VisitingNumber]?>');
														$('#LabDate').html('<?php echo dateEncode($row[LabDate])?>');
														$('#HospitalName').html('<?php echo HospitalName($row[HospCode])?>');
														$('#LabTestID').val('<?php echo $row[LabTestID]?>');
														$('#accessAvailable').val(1);
														$('#shareDIV').fadeIn();
													"
												>												
											</td>
										</tr>
									<?php
									$queryLabResult="
										select		*
										from		lab_test_result
										where		LabTestID='$row[LabTestID]'
										order by	ResultLabID
									";
									$resultLabResult=mysql_query($queryLabResult);
									$numrowsLabResult=mysql_num_rows($resultLabResult);
									$iLabResult=0;
									while($iLabResult<$numrowsLabResult){
										$rowLabResult=mysql_fetch_array($resultLabResult);
										$utest=utest($rowLabResult[UniversalTestID]);
										?>
											<tr>
												<td class="table_detail bottom_dashedGrey right_solid">
													<div><?php echo $utest[UniversalTestName]?></div>
													<div style="float: right;font-size: 85%;">
													<?php if(MethodName($utest[MethodID])!="")echo "(".MethodName($utest[MethodID]).")"?></div>
												</td>
												
												<td class="table_detail bottom_dashedGrey" style="text-align: right"><?php echo $rowLabResult[ResultLab]?></td>
												<td class="table_detail bottom_dashedGrey"><?php echo UnitName($rowLabResult[UnitCode])?></td>
												<td class="table_detail bottom_dashedGrey right_solid" style="text-align: center"><?php echo $rowLabResult[ReferenceResult]?></td>
												
												<td class="table_detail bottom_dashedGrey" style="text-align: right"><?php echo $rowLabResult[ResultUniversal]?></td>
												<td class="table_detail bottom_dashedGrey"><?php echo $rowLabResult[UnitUniversal]?></td>
												<td class="table_detail bottom_dashedGrey" style="text-align: center"><?php echo $rowLabResult[ReferenceUniversalTest]?></td>
											</tr>
										<?php
										$iLabResult++;
									}
									$i++;
								} 
							?>
						</table>
					<?php
				}
			?>
			<input type="button" value=" Home " style="float: right;" onclick="window.open('../home','_self')">
		</td>
	</tr>
</table>
<?php
	include "../template/footer.php"; 
?>