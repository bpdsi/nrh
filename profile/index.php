<?php
	$functionName="Profile (ข้อมูลผู้ใช้ระบบ)";
	include "../template/header.php";
?>
<style>
    .displayNone{
        display:none;            
    }    
</style>
<div id="accountEditDIV" class="form border_solid"
	style="
		display: none;
		position: absolute;
	"
>
	<table class="form">
		<tr>
			<td class="table_header" style="text-align: left;">
				<div class="content">แก้ไขข้อมูลการเข้าใช้ระบบ</div>
				<img class="closeButton" src="../img/close.png" style="float: right;margin: 3px;">
			</td>
		</tr>
		<tr>
			<td class="table_body" style="padding: 10px;">
				<table>
					<tr>
						<td class="form_field">ชื่อเข้าใช้ระบบ</td>
						<td><input type="text" id="User" name="User" style="width: 250px;"></td>
					</tr>
					<tr>
						<td class="form_field" style="vertical-align: top;">รหัสผ่าน</td>
						<td>
							<input type="password" id="changeUserPassword" name="User" style="width: 100px;"><br>
							กรุณากรอกรหัสผ่าน เพื่อยืนยันการเปลี่ยนชื่อเข้าใช้ระบบ
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="table_footer">
				<input class="submitButton" type="button" value="  บันทึก  " style="float: right;padding: 3px;">
			</td>
		</tr>
	</table>
</div>
<div id="changePasswordDIV" class="form border_solid"
	style="
		display: none;
		position: absolute;
	"
>
	<table class="form">
		<tr>
			<td class="table_header" style="text-align: left;">
				<div class="content">เปลี่ยนรหัสผ่าน</div>
				<img class="closeButton" src="../img/close.png" style="float: right;margin: 3px;">
			</td>
		</tr>
		<tr>
			<td class="table_body" style="padding: 10px;">
				<table>
					<tr>
						<td class="form_field">รหัสผ่านเดิม</td>
						<td><input type="password" id="PasswordO" name="PasswordO" style="width: 100px;"></td>
					</tr>
					<tr>
						<td class="form_field">รหัสผ่านใหม่</td>
						<td><input type="password" id="PasswordN" name="PasswordN" style="width: 100px;"></td>
					</tr>
					<tr>
						<td class="form_field">ยืนยันรหัสผ่านใหม่</td>
						<td><input type="password" id="PasswordC" name="PasswordC" style="width: 100px;"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="table_footer">
				<input class="submitButton" type="button" value="  บันทึก  " style="float: right;padding: 3px;">
			</td>
		</tr>
	</table>
</div>
<table class="noSpacing" style="width: 100%;height: 100%;">
	<tr>
		<td class="form_body right_dashed" rowspan="2" style="vertical-align: top;text-align: center;width: 170px;">
			<img id="menu_userProfile" src="../img/profile.png" height="150">
			<div style="font-weight: bold;"><?php echo $person[PersonName]?></div>
		</td>
		<td class="form_body" style="vertical-align: top;">
			<table style="width: 100%;border-spacing: 5px;border-collapse: separate;">
				<tr>
					<td class="border_solid" colspan="2">
						<table class="noSpacing" style="margin-left: auto;margin-right: auto;width: 100%;">
							<tr>
								<td class="table_header" colspan="2" style="text-align: left;">
									<div class="content">ข้อมูลการเข้าใช้ระบบ</div>
									<input id="accountEditButton" type="button" value="  แก้ไข  " style="float: right;height: 20px;">
								</td>
							</tr>
							<tr>
								<td class="form_field">ชื่อเข้าใช้ระบบ</td>
								<td class="form_input"><?php echo $person[User]?></td>
							</tr>
							<tr>
								<td class="form_field">รหัสผ่าน</td>
								<td class="form_input"><input id="changePasswordButton" type="button" value="เปลี่ยนรหัสผ่าน" style="width: 150px;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="border_solid" style="vertical-align: top;">
						<table class="noSpacing" style="margin-left: auto;margin-right: auto;width: 100%;">
							<tr>
								<td class="table_header" colspan="2" style="text-align: left;">
									<div class="content">ข้อมูลส่วนตัว</div>
								</td>
							</tr>
							<tr>
								<td class="form_field">หมายเลขบัตรประจำตัวประชาชน</td>
								<td class="form_input"><?php echo $person[CitizenID]?></td>
							</tr>
							<tr>
								<td class="form_field">คำนำหน้า</td>
								<td class="form_input"><?php echo $person[Prefix]?></td>
							</tr>
							<tr>
								<td class="form_field">ชื่อ นามสกุล</td>
								<td class="form_input"><?php echo $person[PersonName]?></td>
							</tr>
							<tr>
								<td class="form_field">เพศ</td>
								<td class="form_input"><?php echo $person[Gender]?></td>
							</tr>
							<tr>
								<td class="form_field">วัน เดือน ปีเกิด</td>
                                                                <td class="form_input"><?php echo dateEncodeBE($person[BirthDate]);?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">สถานที่เกิด</td>
								<td class="form_input"><?php echo $person[BirthJurisdictionCountrySubDivision]?></td>
							</tr>
							<tr>
								<td class="form_field">กรุ๊ปเลือด</td>
								<td class="form_input"><?php echo $person[BloodGroupABO]?> <?php echo $person[BloodTypeRh]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">สัญชาติ</td>
								<td class="form_input"><?php echo $person[Nationality]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">ศาสนา</td>
								<td class="form_input"><?php echo $person[Religion]?></td>
							</tr>
						</table>
					</td>
					<td class="border_solid" style="vertical-align: top;">
						<table class="noSpacing" style="margin-left: auto;margin-right: auto;width: 100%;">
							<tr>
								<td class="table_header" colspan="2" style="text-align: left;">
									<div class="content">สถานที่ติดต่อ</div>
								</td>
							</tr>
							<tr>
								<td class="form_field">หมายเลขโทรศัพท์</td>
								<td class="form_input"><?php echo $person[Telephone]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">บ้านเลขที่</td>
								<td class="form_input"><?php echo $person[BuildingNumber]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">ตรอก</td>
								<td class="form_input"><?php echo $person[SubLane]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">ซอย</td>
								<td class="form_input"><?php echo $person[Lane]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">ถนน</td>
								<td class="form_input"><?php echo $person[StreetName]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">ตำบล</td>
								<td class="form_input"><?php echo $person[SubDistrict]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">อำเภอ</td>
								<td class="form_input"><?php echo $person[District]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">จังหวัด</td>
								<td class="form_input"><?php echo $person[Province]?></td>
							</tr>
							<tr class="displayNone">
								<td class="form_field">รหัสไปรษณีย์</td>
								<td class="form_input"><?php echo $person[Postcode]?></td>
							</tr>
							<tr>
								<td class="form_field">อีเมล์</td>
								<td class="form_input"><?php echo $person[Email]?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<input type="button" value=" Home " style="float: right;" onclick="window.open('../home','_self')">
		</td>
	</tr>
</table>
<script type="text/javascript">
	$('#accountEditButton').click(function(){
		$('#accountEditDIV').fadeIn();
		$('#accountEditDIV').css('top',$(this).position().top+($(this).height()-7));
		$('#accountEditDIV').css('left',$(this).position().left-$('#accountEditDIV').width());
	});
	$('#accountEditDIV .closeButton').click(function(){
		$('#accountEditDIV').fadeOut();
	});
	$('#accountEditDIV .submitButton').click(function(){
		if($('#User').val()==''){
			alert('กรุณากรอก ชื่อเข้าใช้ระบบ');
		}else if($('#User').val()=='<?php echo $person[User]?>'){
			$('#accountEditDIV').fadeOut();
		}else{
			$.post('checkUsername.php',{
					User: $('#User').val(),
					PersonalID: '<?php echo $person[PersonalID]?>',
					Password: $('#changeUserPassword').val()
				},function(data){
					if(data=='notAuthenticated'){
						alert('รหัสผ่านผิด');
					}else if(data=='available'){
						$.post('changeUser.php',{
								User: $('#User').val(),
								PersonalID: '<?php echo $person[PersonalID]?>',
								Password: $('#changeUserPassword').val()
							},function(data){
								if(data=='complete'){
									alert('เปลี่ยนชื่อผู้ใช้ระบบเรียบร้อยแล้ว');
									window.open('../profile','_self');
								}else{
									alert('ไม่สามารถติดต่อฐานข้อมูลได้!');
								}
							}
						);
					}else if(data=='unavailable'){
						alert('ชื่อผู้ใช้ระบบซ้ำ!');
					}else{
						alert('ไม่สามารถติดต่อฐานข้อมูลได้!');
					}
				}
			);
		}
	});

	$('#changePasswordButton').click(function(){
		$('#changePasswordDIV').fadeIn();
		$('#changePasswordDIV').css('top',$(this).position().top+($(this).height()-7));
		$('#changePasswordDIV').css('left',$(this).position().left-$('#changePasswordDIV').width());
	});
	$('#changePasswordDIV .closeButton').click(function(){
		$('#changePasswordDIV').fadeOut();
	});
	$('#changePasswordDIV .submitButton').click(function(){
		if($('#PasswordO').val()==''){
			alert('กรุณากรอก รหัสผ่านเดิม');
			$('#PasswordO').focus();
		}else if($('#PasswordN').val()==''){
			alert('กรุณากรอก รหัสผ่านใหม่');
			$('#PasswordN').focus();
		}else if($('#PasswordN').val()!=$('#PasswordC').val()){
			alert('ยืนยันรหัสผ่านไม่ถูกต้อง');
			$('#PasswordC').focus();
		}else{
			$.post('changePassword.php',{
					PersonalID: '<?php echo $person[PersonalID]?>',
					PasswordO: $('#PasswordO').val(),
					PasswordN: $('#PasswordN').val()
				},function(data){
					if(data=='complete'){
						alert('เปลี่ยนรหัสผ่านเรียบร้อย');
						$('#changePasswordDIV').fadeOut();
					}else if(data=='notAuthenticated'){
						alert('รหัสผ่านเดิมผิด');
					}else{
						alert('ไม่สามารถเปลี่ยนรหัสผ่านได้');
					}
				}
			);
		}
	});
</script>
<?php
	include "../template/footer.php"; 
?>