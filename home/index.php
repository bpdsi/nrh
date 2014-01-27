<?php
	$functionName="Home";
	include "../template/header.php"; 
?>
<style>
<!--
	.homeIcon{
		height: 150px;
	}
-->
</style>
<table style="margin-left: auto;margin-right: auto;">
	<tr>
		<td>
			<div class="homeIcon" id="menu_userProfile" style="float: left;">
				<table style="width: 100%;height: 100%;">
					<tr>
						<td style="text-align: center;vertical-align: middle">
							<img src="../img/profile.png" height="100"><br>
							User Profile<br>(ข้อมูลผู้ใช้ระบบ)
						</td>
					</tr>
				</table>
			</div>
			<div class="homeIcon" id="menu_labResult" style="float: left;">
				<table style="width: 100%;height: 100%;">
					<tr>
						<td style="text-align: center;vertical-align: middle">
							<img src="../img/lab.png" height="100"><br>
							Lab Result<br>(ผลการตรวจจากห้องปฏิบัติการ)
						</td>
					</tr>
				</table>
			</div>
			<div class="homeIcon" id="menu_vaccinationHistory" style="float: left;">
				<table style="width: 100%;height: 100%;">
					<tr>
						<td style="text-align: center;vertical-align: middle">
							<img src="../img/vaccination.png" height="100"><br>
							Vaccination<br>(การรับวัคซีน)
						</td>
					</tr>
				</table>
			</div><br>
			<div class="homeIcon" id="menu_logHistory" style="float: left;">
				<table style="width: 100%;height: 100%;">
					<tr>
						<td style="text-align: center;vertical-align: middle">
							<img src="../img/history.png" height="100"><br>
							Log History<br>(ประวัติการเข้าใช้ระบบ)
						</td>
					</tr>
				</table>
			</div>
			<div class="homeIcon" id="menu_logHistory_lab" style="float: left;">
				<table style="width: 100%;height: 100%;">
					<tr>
						<td style="text-align: center;vertical-align: middle">
							<img src="../img/history_lab.png" height="100"><br>
							Lab Access History<br><div style="font-size: 80%;">(ประวัติการเข้าดูผลตรวจจากห้องปฏิบัติการ จากบุคคลภายนอก)</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="homeIcon" class="menu_logout" style="float: left;"
				onclick="window.open('../authen/logout.php','_self');"
			>
				<table style="width: 100%;height: 100%;">
					<tr>
						<td style="text-align: center;vertical-align: middle">
							<img src="../img/logout.png" height="100"><br>
							Logout
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<script type="text/javascript">
	$('#menu_userProfile').click(function(){
		window.open('../profile','_self');
	});
	$('#menu_labResult').click(function(){
		window.open('../searchLab','_self');
	});
	$('#menu_vaccinationHistory').click(function(){
		window.open('../vaccine','_self');
	});
	$('#menu_logHistory').click(function(){
		window.open('../logHistory','_self');
	});
	$('#menu_logHistory_lab').click(function(){
		window.open('../logHistory/indexLab.php','_self');
	});
</script>
<?php
	include "../template/footer.php"; 
?>