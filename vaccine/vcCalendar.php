<?php
	session_start();
	$functionName="Vaccination History (ประวัติการรับวัคซีน)";
	include "../template/header.php";

	$table=$_SESSION["sess_vcPrefix"]."_vaccination";
	$query="
		select	left(min(Date_Service),4) as minYear 
		from 	$table
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$minYear=$row[minYear];

	$startMon=$_GET[startMon];
	$startYear=$_GET[startYear];
	$startDate=$_GET[startDate];
	$endDate=$_GET[endDate];
	if($startMon==""){
		$startMon=date("m");
	}
	if($startYear==""){
		$startYear=date("Y");
	}
	
	$startMon=numConvert($startMon, 2);
	$startYear=numConvert($startYear, 2);
	dayNameThaSet();
	$dateWidth=105;
	
	$table=$_SESSION["sess_vcPrefix"]."_child";
	$queryVCPerson="
		select	*
		from	$table
		where	parent='$person[PersonalID]'
	";
	$resultVCPerson=mysql_query($queryVCPerson);
	$numrowsVCPerson=mysql_num_rows($resultVCPerson);
	$iVCPerson=0;
	while($iVCPerson<$numrowsVCPerson){
		$rowVCPerson=mysql_fetch_array($resultVCPerson);
		
		$table=$_SESSION["sess_vcPrefix"]."_vaccination";
		$query="
			select	*
			from	$table
			where	vcpID='$rowVCPerson[vcpID]' and
					left(Date_Service,7)='$startYear-$startMon'
		";
		
		$result=mysql_query($query);
		$numrows=mysql_num_rows($result);
		$i=0;
		while($i<$numrows){
			$row=mysql_fetch_array($result);
			/*echo "<pre>";
			print_r($row);
			echo "</pre>";*/
			$Date_Service=$row[Date_Service];
			$DateTemp=substr($Date_Service,0,10);
			$DateTemp=explode("-", $DateTemp);
			$vc["$DateTemp[0]$DateTemp[1]$DateTemp[2]"]["HospitalName"][]=HospitalName($row[HospCode]);
			
			$queryVC="
				select	*
				from	vc_vaccine
				where	Vaccine_Code='$row[Vaccine_Code]'
			";
			$resultVC=mysql_query($queryVC);
			$rowVC=mysql_fetch_array($resultVC);
			
			$vc["$DateTemp[0]$DateTemp[1]$DateTemp[2]"]["VC"][]=$rowVC;
			$vc["$DateTemp[0]$DateTemp[1]$DateTemp[2]"]["VCCINATION"][]=$row;
			$vc["$DateTemp[0]$DateTemp[1]$DateTemp[2]"]["VCP"][]=$rowVCPerson;
			$i++;
		}
		
		$iVCPerson++;
	}
?>
<script type="text/javascript">
	function setDragDrop(){
		$( ".draggable" ).draggable();
		$( ".draggableBack" ).draggable();
		
		$( ".droppable" ).droppable({
			drop: function( event, ui ) {
				var id=$(ui.draggable).attr('id');
				alert(id);
				
			}
		});
	}
	$('document').ready(function(){
		setDragDrop();
	});
</script>
<style>
	.draggable_div{
		border: dashed 1px rgba(0,0,0,0.2);
		padding: 5px;
		background: rgba(255,255,255,0.5);
		margin: 5px;
		font-weight: bold;
		display: inline-block;
		float: left;
	}
	.draggable{
		cursor: pointer;
	}
	.draggable:hover{
		box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
	}
	.droppable{
		border: solid 1px rgba(0,0,0,0.2);
		background: rgba(255,255,255,0.9);
		padding: 10px;
		margin: 10px;
	}
	.table_header{
		background-color: #d0edd1 !important;
		color: #555 !important;
		border-radius: 0px !important;
	}
	.table_footer{
		display: none;
	}
	.table_01{
		border-radius: 0px !important;
	}
	.form_field{
		padding: 3px 0px 3px 0px;
	}
</style>
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
				<div style="float: left">:: ผลการค้นหาสถานพยาบาล</div>
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
				<div id="hospitalListDetail" style="width: 100%;height: 200px;overflow: auto"></div>
			</td>
		</tr>
	</table>
</div>
<div id="addVaccinationDIV" class="form border_solid"
	style="
		display: none;
		position: absolute;
	"
>
	<table class="form">
		<tr>
			<td class="table_header" style="text-align: left;">
				<div class="content">เพิ่มข้อมูลการรับวัคซีน</div>
				<img class="closeButton" src="../img/close.png" style="float: right;margin: 3px;" 
					onclick="
						$('#addVaccinationDIV').fadeOut();
						$('#hospitalListFrame').fadeOut();
					"
				>
			</td>
		</tr>
		<tr>
			<td class="table_body" style="padding: 10px;">
				<table>
					<tr>
						<td>
							<img src="../images/vcAdd.png" height="100">
						</td>
						<td>
							<form method="post" action="vcAdd.php">
								<input type="hidden" name="startYear" value="<?php echo $startYear?>">
								<input type="hidden" name="startMon" value="<?php echo $startMon?>">
								<table>
									<tr>
										<td class="form_field">ผู้รับวัคซีน</td>
										<td class="form_input">
											<select id="vcpID" name="vcpID">
												<?php
													$table=$_SESSION["sess_vcPrefix"]."_child";
													
													$query="
														select	*
														from	$table
														where	parent='$person[PersonalID]'
													";
													$result=mysql_query($query);
													$numrows=mysql_num_rows($result);
													$i=0;
													while($i<$numrows){
														$row=mysql_fetch_array($result);
														?>
															<option value="<?php echo $row[vcpID]?>"><?php echo $row[NickName]." (".$row[GivenName]." ".$row[MiddleName]." ".$row[FamilyName].")"?></option>
														<?php
														$i++;
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class="form_field">วัคซีน</td>
										<td class="form_input">
											<select id="Vaccine_Code" name="Vaccine_Code">
												<?php
													$query="
														select	*
														from	vc_vaccine
													";
													$result=mysql_query($query);
													$numrows=mysql_num_rows($result);
													$i=0;
													while($i<$numrows){
														$row=mysql_fetch_array($result);
														?>
															<option value="<?php echo $row[Vaccine_Code]?>"><?php echo $row[Vaccine_Name]?></option>
														<?php
														$i++;
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class="form_field" style="vertical-align: top;">วันที่รับวัคซีน</td>
										<td class="form_input">
											<div id="Date_Str"></div>
											<input type="hidden" id="Date_Service" name="Date_Service" readonly size="10">
										</td>
									</tr>
									<tr>
										<td class="form_field" style="vertical-align: top;">เวลา</td>
										<td class="form_input">
											<select id="hr" name="hr">
												<?php
													for($i=0;$i<=23;$i++){
														?>
															<option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT);?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT);?></option>
														<?php
													} 
												?>
											</select>
											:
											<select id="mi" name="mi">
												<?php
													for($i=0;$i<=59;$i++){
														?>
															<option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT);?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT);?></option>
														<?php
													} 
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class="form_field" style="vertical-align: top;">Lot No.</td>
										<td class="form_input">
											<input type="text" id="Vaccine_Lot_Number" name="Vaccine_Lot_Number" size="10">
										</td>
									</tr>
									<tr>
										<td class="form_field">โรงพยาบาล</td>
										<td class="form_input">
											<input type="text" id="Hospital" name="HospCode" value="<?php echo $Hospital?>" readonly
												style="
													float: left;
													width: 50px;
													text-align: center;
													padding: 1px;
													background-color: #eee;
													border: 1px #aaa solid;
												" 
											><input type="text" name="HospitalName" id="HospitalName"
												style="
													float: left;
													width: 200px;
													padding: 1px;
													background-color: #fff;
													border: 1px #aaa solid;
												"
												onkeyup="
													$.get('hospitalList.php',{
															keyword: this.value
														},function(data){
															$('#hospitalListDetail').html(data);
															$('#hospitalListFrame').css('top',$('#Hospital').offset().top+25);
															$('#hospitalListFrame').css('left',$('#Hospital').offset().left);
															$('#hospitalListFrame').fadeIn();
														}
													);
												"
											>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<input type="button" value="  บันทึก  " style="float: right;"
												onclick="
													var vcpID=$('#vcpID').val();
													var HospCode=$('#Hospital').val();
													var Date_Service=$('#Date_Service').val();
													var Vaccine_Code=$('#Vaccine_Code').val();
													var Vaccine_Lot_Number=$('#Vaccine_Lot_Number').val();
													if(HospCode==''){
														alert('กรุณาระบุสถานพยาบาล');
														$('#HospitalName').focus();
													}else{
														form.submit();
													}
												"
											>
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
			<td class="table_footer">
				<input class="submitButton" type="button" value="  บันทึก  " style="float: right;"
					onclick="
						var	GivenName=$('#GivenName').val();
						var	MiddleName=$('#MiddleName').val();
						var	FamilyName=$('#FamilyName').val();
						var	NickName=$('#NickName').val();
						var	Description=$('#Description').val();
						if(GivenName==''){
							alert('กรุณากรอกชื่อ');
							$('#GivenName').focus();
						}else if(FamilyName==''){
							alert('กรุณากรอกนามสกุล');
							$('#FamilyName').focus();
						}else if(NickName==''){
							alert('กรุณากรอกชื่อเล่น');
							$('#NickName').focus();
						}else{
							$.post('vcAddChild.php',{
									GivenName: GivenName,
									MiddleName: MiddleName,
									FamilyName: FamilyName,
									NickName: NickName,
									Description: Description
								},function(data){
									if(data=='complete'){
										$.post('vcChildTD.php',{
											},function(data){
												$('#vcChildTD').html(data);
												$('#addChildDIV').fadeOut();
												$('#GivenName').val('');
												$('#MiddleName').val('');
												$('#FamilyName').val('');
												$('#NickName').val('');
												$('#Description').val('');
												alert('เพิ่มผู้รับวัคซีนเรียบร้อย');
											}
										);
									}else{
										alert('ไม่สามารถเพิ่มผู้รับวัคซีนได้');
									}
								}
							);
						}
					"
				>
			</td>
		</tr>
	</table>
</div>
<div id="editVaccinationDIV" class="form border_solid"
	style="
		display: none;
		position: absolute;
	"
>
	<table class="form">
		<tr>
			<td class="table_header" style="text-align: left;">
				<div class="content">แก้ไขข้อมูลการรับวัคซีน</div>
				<img class="closeButton" src="../img/close.png" style="float: right;margin: 3px;" 
					onclick="
						$('#editVaccinationDIV').fadeOut();
						$('#hospitalListFrame').fadeOut();
					"
				>
			</td>
		</tr>
		<tr>
			<td class="table_body" style="padding: 10px;">
				<table>
					<tr>
						<td>
							<img src="../images/vcAdd.png" height="100">
						</td>
						<td>
							<form method="post" action="vcEdit.php">
								<input type="hidden" name="startYear" value="<?php echo $startYear?>">
								<input type="hidden" name="startMon" value="<?php echo $startMon?>">
								<table>
									<tr>
										<td class="form_field">ผู้รับวัคซีน</td>
										<td class="form_input">
											<input type="hidden" id="eo_vcpID" name="eo_vcpID" readonly size="10">
											<select id="e_vcpID" name="vcpID">
												<?php
													$table=$_SESSION["sess_vcPrefix"]."_child";
													$query="
														select	*
														from	$table
														where	parent='$person[PersonalID]'
													";
													$result=mysql_query($query);
													$numrows=mysql_num_rows($result);
													$i=0;
													while($i<$numrows){
														$row=mysql_fetch_array($result);
														?>
															<option value="<?php echo $row[vcpID]?>"><?php echo $row[NickName]." (".$row[GivenName]." ".$row[MiddleName]." ".$row[FamilyName].")"?></option>
														<?php
														$i++;
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class="form_field">วัคซีน</td>
										<td class="form_input">
											<select id="e_Vaccine_Code" name="Vaccine_Code">
												<?php
													$query="
														select	*
														from	vc_vaccine
													";
													$result=mysql_query($query);
													$numrows=mysql_num_rows($result);
													$i=0;
													while($i<$numrows){
														$row=mysql_fetch_array($result);
														?>
															<option value="<?php echo $row[Vaccine_Code]?>"><?php echo $row[Vaccine_Name]?></option>
														<?php
														$i++;
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class="form_field" style="vertical-align: top;">วันที่รับวัคซีน</td>
										<td class="form_input">
											<div id="e_Date_Str"></div>
											<input type="hidden" id="e_Date_Service" name="Date_Service" readonly size="10">
											<input type="hidden" id="eo_Date_Service" name="eo_Date_Service" readonly size="10">
										</td>
									</tr>
									<tr>
										<td class="form_field" style="vertical-align: top;">เวลา</td>
										<td class="form_input">
											<select id="e_hr" name="hr">
												<?php
													for($i=0;$i<=23;$i++){
														?>
															<option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT);?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT);?></option>
														<?php
													} 
												?>
											</select>
											:
											<select id="e_mi" name="mi">
												<?php
													for($i=0;$i<=59;$i++){
														?>
															<option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT);?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT);?></option>
														<?php
													} 
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class="form_field" style="vertical-align: top;">Lot No.</td>
										<td class="form_input">
											<input type="text" id="e_Vaccine_Lot_Number" name="Vaccine_Lot_Number" size="10">
										</td>
									</tr>
									<tr>
										<td class="form_field">โรงพยาบาล</td>
										<td class="form_input">
											<input type="text" class=".Hospital" id="e_Hospital" name="HospCode" value="<?php echo $Hospital?>"
												style="
													float: left;
													width: 50px;
													text-align: center;
													padding: 1px;
													background-color: #eee;
													border: 1px #aaa solid;
												" 
											><input type="text" name="HospitalName" id="e_HospitalName"
												style="
													float: left;
													width: 200px;
													padding: 1px;
													background-color: #fff;
													border: 1px #aaa solid;
												"
												onkeyup="
													$.get('hospitalList.php',{
															keyword: this.value
														},function(data){
															$('#hospitalListDetail').html(data);
															$('#hospitalListFrame').css('top',$('#e_Hospital').offset().top+25);
															$('#hospitalListFrame').css('left',$('#e_Hospital').offset().left);
															$('#hospitalListFrame').fadeIn();
														}
													);
												"
											>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<input type="button" value="  บันทึก  " style="float: right;"
												onclick="
													var vcpID=$('#e_vcpID').val();
													var HospCode=$('#e_Hospital').val();
													var Date_Service=$('#e_Date_Service').val();
													var Vaccine_Code=$('#e_Vaccine_Code').val();
													var Vaccine_Lot_Number=$('#e_Vaccine_Lot_Number').val();
													if(HospCode==''){
														alert('กรุณาระบุสถานพยาบาล');
														$('#HospitalName').focus();
													}else{
														form.submit();
													}
												"
											>
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
			<td class="table_footer">
				<input class="submitButton" type="button" value="  บันทึก  " style="float: right;"
					onclick="
						var	GivenName=$('#GivenName').val();
						var	MiddleName=$('#MiddleName').val();
						var	FamilyName=$('#FamilyName').val();
						var	NickName=$('#NickName').val();
						var	Description=$('#Description').val();
						if(GivenName==''){
							alert('กรุณากรอกชื่อ');
							$('#GivenName').focus();
						}else if(FamilyName==''){
							alert('กรุณากรอกนามสกุล');
							$('#FamilyName').focus();
						}else if(NickName==''){
							alert('กรุณากรอกชื่อเล่น');
							$('#NickName').focus();
						}else{
							$.post('vcAddChild.php',{
									GivenName: GivenName,
									MiddleName: MiddleName,
									FamilyName: FamilyName,
									NickName: NickName,
									Description: Description
								},function(data){
									if(data=='complete'){
										$.post('vcChildTD.php',{
											},function(data){
												$('#vcChildTD').html(data);
												$('#addChildDIV').fadeOut();
												$('#GivenName').val('');
												$('#MiddleName').val('');
												$('#FamilyName').val('');
												$('#NickName').val('');
												$('#Description').val('');
												alert('เพิ่มผู้รับวัคซีนเรียบร้อย');
											}
										);
									}else{
										alert('ไม่สามารถเพิ่มผู้รับวัคซีนได้');
									}
								}
							);
						}
					"
				>
			</td>
		</tr>
	</table>
</div>
<div id="vc_detailPreview"
	style="
		display: none;
		position: absolute;
		z-index: 1000;
		width: 400px;
	"
>
	<table class="table_01" style="background-color: #fff;">
		<tr>
			<td class="table_header table_topRadius" id="vc_detailPreview_vcpName" style="padding: 5px;"></td>
		</tr>
		<tr>
			<td id="vc_detailPreview_cbDetail" style="padding: 10px;">
				<table>
					<tr>
						<td style="font-weight: bold;text-align: right">ชื่อวัคซีน</td>
						<td id="Preview_Vaccine_Name" style="padding-left: 5px;"></td>
					</tr>
					<tr>
						<td style="font-weight: bold;text-align: right">วันที่ได้รับ</td>
						<td id="Preview_Date_Service" style="padding-left: 5px;"></td>
					</tr>
					<tr>
						<td style="font-weight: bold;text-align: right">สถานที่</td>
						<td id="Preview_HospitalName" style="padding-left: 5px;"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="table_footer"></td>
		</tr>
	</table>
</div>
<table style="width: 100%;height:100%;">
	<tr>
		<td class="form_body right_dashed" rowspan="2" style="vertical-align: top;text-align: center;width: 200px;padding: 0px;">
			<img id="menu_labResult" src="../images/vc.png" height="150">
			<div style="font-weight: bold;">รายชื่อผู้รับวัคซีน</div>
			<br>
			<table style="width: 100%;">
				<?php
					$table=$_SESSION["sess_vcPrefix"]."_child";
					$query="
						select	*
						from	$table
						where	parent='$person[PersonalID]'
					";
					$result=mysql_query($query);
					$numrows=mysql_num_rows($result);
					$i=0;
					while($i<$numrows){
						$row=mysql_fetch_array($result);
						?>
							<tr>
								<td style="width: 20px;vertical-align: middle;padding-top: 5px;">
									<input type="checkbox" id="vcpID<?php echo $row[vcpID]?>" checked="checked"
										onclick="
											if(this.checked==false){
												$('.vcpID<?php echo $row[vcpID]?>').hide();
											}else{
												$('.vcpID<?php echo $row[vcpID]?>').show();
											}
										"
									>
								</td>
								<td style="font-size: 150%;">
									<?php 
										echo $i+1;
										$vcpNumber[$row[vcpID]]=$i+1;
									?>
								</td>
								<td style="padding-left: 5px;text-align: left;padding-top: 5px;padding-bottom: 5px;cursor: pointer;"
									onclick="$('#vcpID<?php echo $row[vcpID]?>').click();"
								>
									<div><?php echo $row[NickName]?></div>
									<div style="font-size: 70%;text-align: left;"><?php echo $row[GivenName]." ".$row[MiddleName]." ".$row[FamilyName];?></div>
								</td>
							</tr>
						<?php
						$i++;
					} 
				?>
				<tr>
					<td colspan="3">
						<input type="button" value=" รายชื่อผู้รับวัคซีน " onclick="window.open('vcChild.php','_self')"
							style="width: 175px;" 
						>
						<input type="button" value=" ลบรายการรับวัคซีน "
							style="width: 175px;" 
							onclick="
								if($('.vcpEdit').is(':hidden')==false){
									if($('.vcpDisplay').is(':hidden')){
										$('.vcpDisplay').show();
										$('.vcpEdit').hide();
									}
								}
								
								if($('.vcpDisplay').is(':hidden')){
									$('.vcpDisplay').show();
								}else{
									$('.vcpDisplay').hide();
								}
								if($('.vcpDelete').is(':hidden')){
									$('.vcpDelete').show();
								}else{
									$('.vcpDelete').hide();
								}
							"
						>
						<input type="button" value=" แก้ไขรายการรับวัคซีน "
							style="width: 175px;" 
							onclick="
								if($('.vcpDelete').is(':hidden')==false){
									if($('.vcpDisplay').is(':hidden')){
										$('.vcpDisplay').show();
										$('.vcpDelete').hide();
									}
								}
							
								if($('.vcpDisplay').is(':hidden')){
									$('.vcpDisplay').show();
								}else{
									$('.vcpDisplay').hide();
								}
								if($('.vcpEdit').is(':hidden')){
									$('.vcpEdit').show();
								}else{
									$('.vcpEdit').hide();
								}
							"
						>
					</td>
				</tr>
			</table>
		</td>
		<td style="vertical-align: top;">
			<table style="width: 100%;margin-bottom: 10px;">
				<tr>
					<td style="vertical-align: top;">
						<table cellspacing="0" cellpadding="0" border="0" style="margin-left: auto;margin-right: auto;">
							<tr>
								<td>
									<form method="get" action="vcCalendar.php">
										<table cellspacing="0" cellpadding="0" style="width: 100%;" border="0">
											<tr>
												<td style="height: 25px;">
													<table cellspacing="0" cellpadding="0" style="width: 100%;">
														<tr>
															<td align="right" style="font-weight: bold;">
																ตั้งแต่เดือน
																<select id="startMon" name="startMon" onchange="form.submit()">
																	<?php
																		for($i=1;$i<=12;$i++){
																			?>
																				<option value="<?php echo $i;?>"
																					<?php
																						if($i==$startMon){
																							echo "selected";
																						} 
																					?>
																				><?php echo monName($i)?></option>
																			<?php
																		} 
																	?>
																</select><select id="startYear" name="startYear" onchange="form.submit()">
																	<?php
																		for($i=$minYear-5;$i<=date("Y")+5;$i++){
																			?>
																				<option value="<?php echo $i?>"
																					<?php
																						if($i==$startYear){
																							echo "selected";
																						} 
																					?>
																				><?php echo $i+543?></option>
																			<?php
																		} 
																	?>
																</select>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</form>
								</td>
							</tr>
							<tr>
								<td valign="top" style="height: 100%;">
									<table align="center" cellspacing="0" cellpadding="0" style="height:100%;background: rgba(255,255,255,1);" border="0">
										<tr>
											<?php
												for($i=0;$dayNameThas[$i]!=null;$i++){
													?>
														<td class="table_header" align="center"
															style="
																background-color: #d6d6d6;
																color: #414141;
																font-size: 15px;
																height: 20px;
																width: <?php echo $dateWidth?>px;
																border-left: 1px solid #aaa;
																border-top: 1px solid #aaa;
																border-bottom: 1px solid #aaa;
																<?php
																	 if($dayNameThas[$i+1]==null){
																	 	echo "border-right: 1px solid #aaa;";
																	 }
																?>
															"
														>
															<?php echo $dayNameThas[$i];?>
														</td>
													<?php 
												} 
											?>
										</tr>
										<tr>
											<?php
												if(dayNum($startYear,$startMon,1)>0){
													?>
														<td colspan="<?php echo dayNum($startYear,$startMon,1);?>"
															style="
																border-left:solid;
																border-bottom:solid;
																border-width:1px;
																border-color:#d6d6d6;
															"
														>&nbsp;</td>	
													<?php 
												} 
												for($i=1;$i<=maxDate($startYear, $startMon);$i++){
													$dayNum=numConvert($i, 2);
													?>
														<td align="right" valign="top"
															onmouseover="
																this.bgColor='<?php echo $color[mouseOver]?>';
																this.style.boxShadow='inset 1px 1px 10px #888888';
															"
															onmouseout="
																this.bgColor='';
																this.style.boxShadow='';
															"
															style="
																width:20px;
																border-left:solid;
																border-bottom:solid;
																<?php
																	if(dayNum($startYear, $startMon, $i+1)==0){
																		echo "border-right:solid;";
																	} 
																?>
																border-width:1px;
																border-color:#d6d6d6;
																font-weight: bold;
																color: #979797;
																<?php
																	if(
																		$startYear.$startMon.numConvert($dayNum, 2)==$startDate ||
																		(
																			$startYear.$startMon.numConvert($dayNum, 2)>=$startDate &&
																			$startYear.$startMon.numConvert($dayNum, 2)<=$endDate
																		)
																	){
																		echo "background-color: rgb(197, 220, 255)";
																	}else{
																		$dayColor="#cddfcd";
																	}
																?>
															"
															onclick="
																
															"
														>
															<table cellspacing="0" cellpadding="3" 
																style="
																	width: 100%;
																	height: 100%;
																	<?php
																		if($startYear.$startMon.$dayNum==date("Ymd")){
																			?>
																				background-image: url('images/calendarPin.png');
																				background-position: top left;
																				background-repeat: no-repeat;
																			<?php
																		} 
																	?>
																"
															>
																<tr>
																	<?php
																		if(dayNum($startYear,$startMon,1)==0 && maxDate($startYear, $startMon)<29){
																			$cellHeight="54px";
																		}else{
																			if(dayNum($startYear,$startMon,1)>=5){
																				if(maxDate($startYear, $startMon)<=30){
																					$cellHeight="38px";
																				}else{
																					$cellHeight="25px";
																				}
																			}else{
																				$cellHeight="38px";
																			}
																		}
																	?>
																	<td align="right" 
																		style="
																			font-weight: bold;
																			height: <?php echo $cellHeight;?>;
																			font-size: 150%;
																			padding: 5px;
																			color: #1F8A2B;
																		"
																		valign="top"
																	>
																		&nbsp;<?php echo $i;?>
																		<img src="../images/add.png" 
																			style="
																				float: left;
																				top: 0px;
																				left: 0px;
																				height: 15px;
																				cursor: pointer;
																			"
																			onclick="
																				$('#Date_Str').html('<?php echo $i." ".monNameTH($startMon)." ".($startYear+543)?>');;
																				$('#Date_Service').val('<?php echo $startYear?>-<?php echo $startMon?>-<?php echo str_pad($i,2,"0", STR_PAD_LEFT)?>');;
																				<?php
																					if(dayNum($startYear, $startMon, $i+1)>=5 || dayNum($startYear, $startMon, $i+1)==0){
																						?>$('#addVaccinationDIV').css('left',$(this).offset().left-$('#addVaccinationDIV').width());<?php
																					}else{
																						?>$('#addVaccinationDIV').css('left',$(this).offset().left);<?php
																					}
																				?>
																				$('#addVaccinationDIV').css('top',$(this).position().top);
																				$('#addVaccinationDIV').fadeIn();
																			"
																		>
																	</td>
																</tr>
																<tr>
																	<td align="right" valign="bottom"
																		style="
																			font-size: 13px;
																			height: 40px;
																		"
																	>
																		<?php
																			$dayNumTemp=numConvert($i, 2);;
																			for($iTemp=0;$vc["$startYear$startMon$dayNumTemp"]["HospitalName"][$iTemp]!=null;$iTemp++){
																				?>
																					<div class="vcpID<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["vcpID"]?>">
																						<div class="vcpDisplay"
																							style="
																								height: 30px;
																								width: 30px;
																								background-image: url('../images/vcIcon.png');
																								background-size: 25px 25px;
																								background-position: center center;
																								background-repeat: no-repeat;
																								float: right;
																							"
																							onmouseover="
																								$('#vc_detailPreview').show();
																								$('#vc_detailPreview_vcpName').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["NickName"]." (".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["GivenName"]." ".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["MiddleName"]." ".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["FamilyName"].")"?>');
																								$('#Preview_Vaccine_Name').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VC"][$iTemp]["Vaccine_Name"]?>');
																								$('#Preview_Date_Service').html('<?php echo dateEncode($vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["Date_Service"])?>');
																								$('#Preview_HospitalName').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["HospitalName"][$iTemp]?>');
																								$('#vc_detailPreview').css('left',$(this).position().left+35);
																								$('#vc_detailPreview').css('top',$(this).position().top);
																							"
																							onmouseout="$('#vc_detailPreview').hide();"
																						>
																							<table class="noSpacing" style="width: 100%;height: 100%;">
																								<tr>
																									<td style="text-align: right;vertical-align: bottom;"><?php echo $vcpNumber[$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["vcpID"]]?></td>
																								</tr>
																							</table>
																						</div>
																						<div class="vcpDelete"
																							style="
																								display: none;
																								height: 30px;
																								width: 30px;
																								background-image: url('../images/vcDelete.png');
																								background-size: 25px 25px;
																								background-position: center center;
																								background-repeat: no-repeat;
																								float: right;
																								cursor: pointer;
																							"
																							onmouseover="
																								$('#vc_detailPreview').show();
																								$('#vc_detailPreview_vcpName').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["NickName"]." (".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["GivenName"]." ".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["MiddleName"]." ".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["FamilyName"].")"?>');
																								$('#Preview_Vaccine_Name').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VC"][$iTemp]["Vaccine_Name"]?>');
																								$('#Preview_Date_Service').html('<?php echo dateEncode($vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["Date_Service"])?>');
																								$('#Preview_HospitalName').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["HospitalName"][$iTemp]?>');
																								$('#vc_detailPreview').css('left',$(this).position().left+35);
																								$('#vc_detailPreview').css('top',$(this).position().top);
																							"
																							onmouseout="$('#vc_detailPreview').hide();"
																							onclick="
																								if(confirm('ต้องการลบรายการนี้')){
																									window.open('vcDelete.php?vcpID=<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["vcpID"]?>&Date_Service=<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["Date_Service"]?>&startYear=<?php echo $startYear?>&startMon=<?php echo $startMon?>','_self');
																								}
																							"
																						>
																							<table class="noSpacing" style="width: 100%;height: 100%;">
																								<tr>
																									<td style="text-align: right;vertical-align: bottom;"><?php echo $vcpNumber[$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["vcpID"]]?></td>
																								</tr>
																							</table>
																						</div>
																						<div class="vcpEdit"
																							style="
																								display: none;
																								height: 30px;
																								width: 30px;
																								background-image: url('../images/vcEdit.png');
																								background-size: 25px 25px;
																								background-position: center center;
																								background-repeat: no-repeat;
																								float: right;
																								cursor: pointer;
																							"
																							onmouseover="
																								$('#vc_detailPreview').show();
																								$('#vc_detailPreview_vcpName').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["NickName"]." (".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["GivenName"]." ".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["MiddleName"]." ".$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["FamilyName"].")"?>');
																								$('#Preview_Vaccine_Name').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VC"][$iTemp]["Vaccine_Name"]?>');
																								$('#Preview_Date_Service').html('<?php echo dateEncode($vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["Date_Service"])?>');
																								$('#Preview_HospitalName').html('<?php echo $vc["$startYear$startMon$dayNumTemp"]["HospitalName"][$iTemp]?>');
																								$('#vc_detailPreview').css('left',$(this).position().left+35);
																								$('#vc_detailPreview').css('top',$(this).position().top);
																							"
																							onmouseout="$('#vc_detailPreview').hide();"
																							onclick="
																								$('#eo_vcpID').val('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["vcpID"]?>');
																								$('#eo_Date_Service').val('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["Date_Service"];?>');
																								$('#e_Date_Str').html('<?php echo $i." ".monNameTH($startMon)." ".($startYear+543)?>');
																								$('#e_Date_Service').val('<?php echo $startYear?>-<?php echo $startMon?>-<?php echo str_pad($i,2,"0", STR_PAD_LEFT)?>');
																								$('#e_vcpID').val('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["vcpID"]?>');
																								$('#e_Vaccine_Code').val('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VC"][$iTemp]["Vaccine_Code"]?>');
																								$('#e_hr').val('<?php echo substr($vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["Date_Service"],11,2)?>');
																								$('#e_mi').val('<?php echo substr($vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["Date_Service"],14,2)?>');
																								$('#e_Vaccine_Lot_Number').val('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["Vaccine_Lot_Number"];?>');
																								$('#e_Hospital').val('<?php echo $vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["HospCode"];?>');
																								$('#e_HospitalName').val('<?php echo HospitalName($vc["$startYear$startMon$dayNumTemp"]["VCCINATION"][$iTemp]["HospCode"]);?>');
																								<?php
																									if(dayNum($startYear, $startMon, $i+1)>=5 || dayNum($startYear, $startMon, $i+1)==0){
																										?>$('#editVaccinationDIV').css('left',$(this).offset().left-$('#editVaccinationDIV').width());<?php
																									}else{
																										?>$('#editVaccinationDIV').css('left',$(this).offset().left);<?php
																									}
																								?>
																								$('#editVaccinationDIV').css('top',$(this).position().top);
																								$('#editVaccinationDIV').fadeIn();
																							"
																						>
																							<table class="noSpacing" style="width: 100%;height: 100%;">
																								<tr>
																									<td style="text-align: right;vertical-align: bottom;"><?php echo $vcpNumber[$vc["$startYear$startMon$dayNumTemp"]["VCP"][$iTemp]["vcpID"]]?></td>
																								</tr>
																							</table>
																						</div>
																					</div>
																				<?php
																			}
																		?>
																	</td>
																</tr>
															</table>
														</td>
													<?php 
													if(dayNum($startYear, $startMon, $i+1)==0){
														if($i==maxDate($startYear, $startMon)){
															echo "</tr>";
														}else{
															echo "</tr><tr height=\"50\">";
														}
													}
												}
												$endColSpan=6-dayNum($startYear, $startMon, $i-1);
												if($endColSpan>0){
													echo "
														<td colspan=\"$endColSpan\"
															style=\"
																border-left: solid;
																border-right: solid;
																border-bottom: solid;
																border-color: #d6d6d6;
																border-width: 1px;
															\"
														>&nbsp;</td>
													";
												} 
											?>
			
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<input type="button" value=" Back " style="float: right;" onclick="window.open('../vaccine','_self')">
		</td>
	</tr>
</table>
<?php
	include "../template/footer.php"; 
?>