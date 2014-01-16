<?php
	$functionName="Child (ผู้รับวัคซีน)";
	include "../template/header.php";
?>
<style>
	.form_field{
		padding: 3px 0px 3px 0px;
	}
</style>
<div id="addChildDIV" class="form border_solid"
	style="
		display: none;
		position: absolute;
	"
>
	<table class="form">
		<tr>
			<td class="table_header" style="text-align: left;">
				<div class="content">เพิ่มผู้รับวัคซีน</div>
				<img class="closeButton" src="../img/close.png" style="float: right;margin: 3px;" onclick="$('#addChildDIV').fadeOut();">
			</td>
		</tr>
		<tr>
			<td class="table_body" style="padding: 10px;">
				<table>
					<tr>
						<td>
							<img src="../images/vcAddChild.png" height="100">
						</td>
						<td>
							<table>
								<tr>
									<td class="form_field">ชื่อ</td>
									<td class="form_input"><input type="text" id="GivenName" name="GivenName" style="width: 150px;"></td>
								</tr>
								<tr>
									<td class="form_field" style="vertical-align: top;">ชื่อกลาง</td>
									<td class="form_input"><input type="text" id="MiddleName" name="MiddleName" style="width: 150px;"></td>
								</tr>
								<tr>
									<td class="form_field" style="vertical-align: top;">นามสกุล</td>
									<td class="form_input"><input type="text" id="FamilyName" name="FamilyName" style="width: 150px;"></td>
								</tr>
								<tr>
									<td class="form_field" style="vertical-align: top;">ชื่อเล่น</td>
									<td class="form_input"><input type="text" id="NickName" name="NickName" style="width: 150px;"></td>
								</tr>
								<tr>
									<td class="form_field" style="vertical-align: top;">บันทึก</td>
									<td class="form_input"><textarea id="Description" name="Description" style="width: 200px;height: 30px;"></textarea></td>
								</tr>
							</table>
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
<div id="editChildDIV" class="form border_solid"
	style="
		display: none;
		position: absolute;
	"
>
	<table class="form">
		<tr>
			<td class="table_header" style="text-align: left;">
				<div class="content">แก้ไขผู้รับวัคซีน</div>
				<img class="closeButton" src="../img/close.png" style="float: right;margin: 3px;" onclick="$('#editChildDIV').fadeOut();">
			</td>
		</tr>
		<tr>
			<td class="table_body" style="padding: 10px;">
				<table>
					<tr>
						<td>
							<img src="../images/vcAddChild.png" height="100">
						</td>
						<td>
							<input type="hidden" id="e_vcpID" name="vcpID" style="width: 150px;">
							<table>
								<tr>
									<td class="form_field">ชื่อ</td>
									<td class="form_input"><input type="text" id="e_GivenName" name="GivenName" style="width: 150px;"></td>
								</tr>
								<tr>
									<td class="form_field" style="vertical-align: top;">ชื่อกลาง</td>
									<td class="form_input"><input type="text" id="e_MiddleName" name="MiddleName" style="width: 150px;"></td>
								</tr>
								<tr>
									<td class="form_field" style="vertical-align: top;">นามสกุล</td>
									<td class="form_input"><input type="text" id="e_FamilyName" name="FamilyName" style="width: 150px;"></td>
								</tr>
								<tr>
									<td class="form_field" style="vertical-align: top;">ชื่อเล่น</td>
									<td class="form_input"><input type="text" id="e_NickName" name="NickName" style="width: 150px;"></td>
								</tr>
								<tr>
									<td class="form_field" style="vertical-align: top;">บันทึก</td>
									<td class="form_input"><textarea id="e_Description" name="Description" style="width: 200px;height: 30px;"></textarea></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="table_footer">
				<input class="submitButton" type="button" value="  บันทึก  " style="float: right;"
					onclick="
						var	vcpID=$('#e_vcpID').val();
						var	GivenName=$('#e_GivenName').val();
						var	MiddleName=$('#e_MiddleName').val();
						var	FamilyName=$('#e_FamilyName').val();
						var	NickName=$('#e_NickName').val();
						var	Description=$('#e_Description').val();
						if(GivenName==''){
							alert('กรุณากรอกชื่อ');
							$('#e_GivenName').focus();
						}else if(FamilyName==''){
							alert('กรุณากรอกนามสกุล');
							$('#e_FamilyName').focus();
						}else if(NickName==''){
							alert('กรุณากรอกชื่อเล่น');
							$('#e_NickName').focus();
						}else{
							$.post('vcEditChild.php',{
									vcpID: vcpID,
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
												$('#editChildDIV').fadeOut();
												$('#e_GivenName').val('');
												$('#e_MiddleName').val('');
												$('#e_FamilyName').val('');
												$('#e_NickName').val('');
												$('#e_Description').val('');
												alert('แก้ไขผู้รับวัคซีนเรียบร้อย');
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
<table class="noSpacing" style="width: 100%;height: 100%;">
	<tr>
		<td class="form_body right_dashed" rowspan="2" style="vertical-align: top;text-align: center;width: 170px;">
			<img id="menu_userProfile" src="../images/child.png" height="150">
			<div style="font-weight: bold;">ผู้รับวัคซีน</div>
			<br>
			<input type="button" value="เพิ่มผู้รับวัคซีน" style="width: 150px;"
				onclick="
					$('#addChildDIV').css('top',$(this).position().top);
					$('#addChildDIV').css('left',$(this).position().left+$(this).width());
					$('#addChildDIV').fadeIn();
				"
			>
		</td>
		<td id="vcChildTD" class="form_body" style="vertical-align: top;">
			
		</td>
	</tr>
</table>
<script type="text/javascript">
	$.post('vcChildTD.php',{
		},function(data){
			$('#vcChildTD').html(data);
		}
	);
</script>
<?php
	include "../template/footer.php"; 
?>