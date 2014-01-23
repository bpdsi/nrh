<table style="width: 100%;height: 100%;">
	<tr>
		<td style="vertical-align: middle">
			<div class="form" style="width: 470px;margin-left: auto;margin-right: auto;margin-top: auto;margin-bottom: auto;padding: 0px;">
				<table class="form" style="width: 100%;">
					<tr>
						<td class="form_header" colspan="2" style="font-weight: bold;">
							<div id="titleDIV" style="float:left;">เปลี่ยนรหัสผ่าน</div>
						</td>
					</tr>
					<tr>
						<td class="form_body" align="center">
							<table>
								<tr>
									<td valign="top" align="center" style="width: 170px;">
										<div id="healthDatabank">
											<img src="img/changePassword.png" width="100"><br>
											บุคคลากร
										</div>
									</td>
									<td>
										<form id="changePasswordForm">
											<table>
												<tr>
													<td class="form_field">รหัสผ่านเดิม</td>
													<td class="form_input"><input class="focus nextFocus" next="PasswordN" type="password" id="Password" name="Password"></td>
												</tr>
												<tr>
													<td class="form_field">รหัสผ่านใหม่</td>
													<td class="form_input"><input class="nextClick" next="PasswordC" type="password" id="PasswordN" name="PasswordN"></td>
												</tr>
												<tr>
													<td class="form_field">ยืนยันรหัสผ่าน</td>
													<td class="form_input"><input class="nextClick" next="submitButton" type="password" id="PasswordC" name="PasswordC"></td>
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
							<input class="nprButton" id="submitButton" type='submit' value="   เข้าสู่ระบบ   "
								onclick="
									var Password=$('#Password').val();
									var PasswordN=$('#PasswordN').val();
									var PasswordC=$('#PasswordC').val();
									if(Password==''){
										$('#Password').focus();
										alert('กรุณากรอก รหัสผ่านเดิม');
									}else if(PasswordN==''){
										$('#PasswordN').focus();
										alert('กรุณากรอก รหัสผ่านใหม่');
									}else if(PasswordN!=PasswordC){
										$('#PasswordC').focus();
										alert('ยืนยันรหัสผ่านไม่ถูกต้อง');
									}else{
										$.post('changePasswordSQL.php',
												$('#changePasswordForm').serialize()
											,function(data){
												if(data=='complete'){
													alert('เปลี่ยนรหัสผ่านเรียบร้อย');
												}
											}
										);
									}
								";
							>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>