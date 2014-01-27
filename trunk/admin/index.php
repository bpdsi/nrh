<?php
	$functionName="Administrator";
	include "../template/header.php"; 

	$mainUrl=get_cfgValue("mainUrl");
	if(!adminAuthenticated()){
		exit();
	}
	if($Hospital==""){
		$Hospital=11470;
	}
?>
<script type="text/javascript">
	$(function(){
		$('document').ready(function(){
			$('#menu_config').click(function(){
				$.post('preference.php',function(data){
					$('#container').html(data);
				})
			});

			$('#menu_administrator').click(function(){
				$.post('administrator.php',function(data){
					$('#container').html(data);
				});
			});

			$('#menu_vaccine').click(function(){
				$.post('vaccine.php',function(data){
					$('#container').html(data);
				});
			});

			$('#menu_patientRegist').click(function(){
				window.open('../register','_self');
			});

			$('#menu_unit').click(function(){
				alert('Under Construction');
			});

			$('#menu_changePassword').click(function(){
				$.post('changePassword.php',function(data){
					$('#container').html(data);
				});
			});

			$('#menu_logHistory').click(function(){
				$.post('logHistory.php',function(data){
					$('#container').html(data);
				});
			});
			
		});
	})
</script>

<style type="text/css">
	.mainMenu_item{
		padding: 3px 10px 3px 10px;
	}
 	.mainMenu_item:hover{
		background-color: #99C27E;
		cursor: pointer;
	}
	div.cfgValue{
		font-size: 17px;
		padding: 1px;
	}
	input[type=text].cfgValue{
		font-size: 17px;
	}
</style>
<table style="width: 100%;height: 100%;">
	<tr>
		<td style="border-right: 1px solid #aaa;text-align: center;" valign="top">
			<img src="adminIcon.png" style="margin-left: auto;margin-right: auto;">
			<table style="width: 100%;text-align: left;">
				<tr>
					<td id="menu_patientRegist" class="mainMenu_item">ลงทะเบียนขอใช้สิทธิ์</td>
				</tr>
				<?php
					if($_SESSION["admin_permission"]=="admin" || $_SESSION["admin_permission"]=="global"){
						?>
							<tr>
								<td id="menu_administrator" class="mainMenu_item">เจ้าหน้าที่</td>
							</tr>
							<?php
								if($_SESSION["admin_permission"]=="global"){
									?>
										<tr>
											<td id="menu_config" class="mainMenu_item">การตั้งค่า</td>
										</tr>
										<tr>
											<td id="menu_vaccine" class="mainMenu_item">รายการวัคซีน</td>
										</tr>
									<?php
								} 
							?>
							<tr style="display: none">
								<td id="menu_unit" class="mainMenu_item">Unit</td>
							</tr>
						<?php
					} 
				?>
				<tr>
					<td id="menu_changePassword" class="mainMenu_item">เปลี่ยนรหัสผ่าน</td>
				</tr>
				<tr>
					<td id="menu_logHistory" class="mainMenu_item">ประวัติการเข้าใช้ระบบ</td>
				</tr>
				<tr>
					<td><hr></td>
				</tr>
				<tr>
					<td class="mainMenu_item menu_logout">ออกจากระบบ</td>
				</tr>
			</table>
		</td>
		<td id="container" valign="top"></td>
	</tr>
</table>
<?php
	include "../template/footer.php"; 
?>