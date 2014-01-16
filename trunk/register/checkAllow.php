<?php
	include "../function/functionPHP.php";
	headerEncode();
	
	$CitizenID=$_POST["CitizenID"];
	$HospitalNumber=$_POST["HospitalNumber"];
	$Hospital=$_POST["Hospital"];
	
	host("nrh");
	$query="
		select 		*
		from		person_allow
		where		PersonalID in (
						select	PersonalID
						from	person
						where	CitizenID='$CitizenID' or
								PersonalID in (
									select	PersonalID
									from	hospital_patient
									where	HospitalNumber='$HospitalNumber' and
											HospCode='$Hospital'
								)
					)
		order by	AllowDate desc
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(mysql_num_rows($result)==0){
		echo "empty";
	}else{
		?>
			<table style="margin-left: auto;margin-right: auto;font-size: 17px;">
				<tr>
					<td style="font-weight: bold">ผู้ใช้ระบบนี้ มีการลงทะเบียนแล้ว ณ วันที่</td>
				</tr>
				<tr>
					<td style="padding-left: 20px;"><?php echo dateEncode($row[AllowDate])?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;padding-top: 10px;">รูปแบบการขอใช้สิทธิ์</td>
				</tr>
				<tr>
					<td style="padding-left: 20px;">
						<?php
							if($row[AllowType]=='Perday'){
								echo "เฉพาะวันที่ ".(dateEncode($row[AllowDate]));
							}else{
								echo "ตั้งแต่วันที่ ".(dateEncode($row[AllowDate]));
							}
						?>
					</td>
				</tr>
			</table>
		<?php 
	}