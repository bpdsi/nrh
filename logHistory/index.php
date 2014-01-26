<?php
	$functionName="Log History (ประวัติการเข้าใช้ระบบ)";
	include "../template/header.php";
?>
<table class="noSpacing" style="width: 100%;height: 100%;">
	<tr>
		<td class="form_body right_dashed" rowspan="2" style="vertical-align: top;text-align: center;width: 170px;">
			<img id="menu_userProfile" src="../img/history.png" height="128">
			<div style="font-weight: bold;"><?php echo $person[PersonName]?></div>
		</td>
		<td class="form_body" style="vertical-align: top;">
			<table style="width: 100%;">
				<tr>
					<td>
						IP Address 
						<input type="text" name="keyword" id="keyword"
							onkeyup="
								$.post('showLogTD.php',{
										PersonalID: '<?php echo $person[PersonalID]?>',
										User: '<?php echo $person[User]?>',
										keyword: $('#keyword').val(),
										authenResult: $('#authenResult').val()
									},function(data){
										$('#showLogTD').html(data);
									}
								);
							"
						>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						ผลการเข้าสู่ระบบ
						<select id="authenResult" name="authenResult"
							onchange="
								$.post('showLogTD.php',{
										PersonalID: '<?php echo $person[PersonalID]?>',
										User: '<?php echo $person[User]?>',
										keyword: $('#keyword').val(),
										authenResult: $('#authenResult').val()
									},function(data){
										$('#showLogTD').html(data);
									}
								);
							"
						>
							<option value="all">ทั้งหมด</option>
							<option value="pass">สำเร็จ</option>
							<option value="fail">ไม่สำเร็จ</option>
						</select>
						<hr>
					</td>
				</tr>
				<tr>
					<td id="showLogTD"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript">
	$.post('showLogTD.php',{
			PersonalID: '<?php echo $person[PersonalID]?>',
			User: '<?php echo $person[User]?>',
			keyword: $('#keyword').val(),
			authenResult: $('#authenResult').val()
		},function(data){
			$('#showLogTD').html(data);
		}
	);
</script>
<?php
	include "../template/footer.php"; 
?>