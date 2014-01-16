<?php
	$functionName="Vaccination (การรับวัคซีน)";
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
			<div class="homeIcon" id="menu_vaccinationHistory" style="float: left;">
				<table style="width: 100%;height: 100%;">
					<tr>
						<td style="text-align: center;vertical-align: middle">
							<img src="../images/vcCalendar.png" height="100"><br>
							Vaccination History<br>(ประวัติการรับวัคซีน)
						</td>
					</tr>
				</table>
			</div>
			<div class="homeIcon" id="menu_child" style="float: left;">
				<table style="width: 100%;height: 100%;">
					<tr>
						<td style="text-align: center;vertical-align: middle">
							<img src="../images/child.png" height="100"><br>
							Child<br>(ผู้รับวัคซีน)
						</td>
					</tr>
				</table>
			</div>
			<?php
				if($authen!="vc_person"){
					?>
						<div class="homeIcon" id="menu_home" style="float: left;">
							<table style="width: 100%;height: 100%;">
								<tr>
									<td style="text-align: center;vertical-align: middle">
										<img src="../images/home.png" height="100"><br>
										Home<br>(กลับสู่เมนูหลัก)
									</td>
								</tr>
							</table>
						</div>
					<?php
				} 
			?>
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
	$('#menu_child').click(function(){
		window.open('../vaccine/vcChild.php','_self');
	});
	$('#menu_addVaccination').click(function(){
		window.open('../vaccine/vcAdd.php','_self');
	});
	$('#menu_vaccinationHistory').click(function(){
		window.open('../vaccine/vcCalendar.php','_self');
	});
	$('#menu_home').click(function(){
		window.open('../home','_self');
	});
</script>
<?php
	include "../template/footer.php"; 
?>