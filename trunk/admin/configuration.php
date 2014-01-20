<?php
	header("Cache-Control: no-cache, must-revalidate");
	header ('Content-type: text/html; charset=utf-8');
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
?>
<form id="configForm">
	<table style="width: 100%;">
		<tr>
			<td class="form_field" style="padding-right: 5px;text-align: left;font-weight: bold;" colspan="2">
				AES Encryption<hr>
			</td>
		</tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;">
				Encryption Key
			</td>
			<td><input type="text" id="aesKey" name="aesKey" value="<?php echo get_cfgValue("aesKey")?>"></td>
		</tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;">
				Encryption Bit
			</td>
			<td>
				<input type="text" id="aesBit" name="aesBit" value="<?php echo get_cfgValue("aesBit")?>" 
					style="
						width: 30px;text-align: right
					"
				> bit
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;text-align: left;font-weight: bold;" colspan="2">
				Mail Setting<hr>
			</td>
		</tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;">
				SMTP Host
			</td>
			<td><input type="text" id="smtpHost" name="smtpHost" value="<?php echo get_cfgValue("smtpHost")?>" style="width: 300px;"></td>
		</tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;">
				Username
			</td>
			<td><input type="text" id="smtpUsername" name="smtpUsername" value="<?php echo get_cfgValue("smtpUsername")?>" style="width: 200px;"></td>
		</tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;">
				Password
			</td>
			<td><input type="password" id="smtpPassword" name="smtpPassword" value="<?php echo get_cfgValue("smtpPassword")?>" style="width: 200px;"></td>
		</tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;">
				Sender Name
			</td>
			<td><input type="text" id="smtpFromName" name="smtpFromName" value="<?php echo get_cfgValue("smtpFromName")?>" style="width: 200px;"></td>
		</tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;">
				Sender E-mail
			</td>
			<td><input type="text" id="smtpFromMail" name="smtpFromMail" value="<?php echo get_cfgValue("smtpFromMail")?>" style="width: 200px;"></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;text-align: left;font-weight: bold;" colspan="2">
				Web Setting<hr>
			</td>
		</tr>
		<tr>
			<td class="form_field" style="padding-right: 5px;">
				Main URL
			</td>
			<td><input type="text" id="mainUrl" name="mainUrl" value="<?php echo get_cfgValue("mainUrl")?>" style="width: 200px;"></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: right">
				<input type="button" value="บันทึก"
					onclick="
						$.post('configurationSQL.php',
								$('#configForm').serialize()
							,function(data){
								alert(data);
							}
						);
					"
				>
			</td>
		</tr>
	</table>
</form>