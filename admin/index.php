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
				})
			});

			$('#menu_patientRegist').click(function(){
				window.open('../register','_self');
			});
		});
	})
</script>

<style type="text/css">
	/* Specific Form Rules */
	#form-demo {width: 330px; margin: 50px 0 100px 0; height: 170px; padding: 25px 10px 0 10px; background: url(images/bg_login.png) no-repeat 0 0;}
	#confirm {display: none;}
	.success {order: 1px solid; margin: 0; padding: 10px; text-align: center; color: #4F8A10; background-color: #ebf6d9; border-color: #DFF2BF;}
	
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
				<tr>
					<td id="menu_administrator" class="mainMenu_item">เจ้าหน้าที่</td>
				</tr>
				<tr>
					<td id="menu_config" class="mainMenu_item">การตั้งค่า</td>
				</tr>
				<tr>
					<td class="mainMenu_item">Unit</td>
				</tr>
			</table>
		</td>
		<td id="container" valign="top"></td>
	</tr>
</table>
<?php
	include "../template/footer.php"; 
?>