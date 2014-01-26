<?php
	$functionName="Lab Access History (ประวัติการเข้าดูผลตรวจจากห้องปฏิบัติการ)";
	include "../template/header.php";
?>
<table class="noSpacing" style="width: 100%;height: 100%;">
	<tr>
		<td class="form_body right_dashed" rowspan="2" style="vertical-align: top;text-align: center;width: 170px;">
			<img id="menu_userProfile" src="../img/history_lab.png" height="128">
			<div style="font-weight: bold;"><?php echo $person[PersonName]?></div>
		</td>
		<td class="form_body" style="vertical-align: top;">
			<table style="width: 100%;">
				<tr>
					<td>
						IP Address 
						<input type="text" name="keyword" id="keyword"
							onkeyup="
								$.post('showLabLogTD.php',{
										PersonalID: '<?php echo $person[PersonalID]?>',
										User: '<?php echo $person[User]?>',
										keyword: $('#keyword').val(),
										accessResult: $('#accessResult').val()
									},function(data){
										$('#showLabLogTD').html(data);
									}
								);
							"
						>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						ผลการเข้าสู่ระบบ
						<select id="accessResult" name="accessResult"
							onchange="
								$.post('showLabLogTD.php',{
										PersonalID: '<?php echo $person[PersonalID]?>',
										User: '<?php echo $person[User]?>',
										keyword: $('#keyword').val(),
										accessResult: $('#accessResult').val()
									},function(data){
										$('#showLabLogTD').html(data);
									}
								);
							"
						>
							<option value="all">ทั้งหมด</option>
							<option value="complete">สำเร็จ</option>
							<option value="outOfCredit">ไม่สำเร็จ</option>
						</select>
						<hr>
					</td>
				</tr>
				<tr>
					<td id="showLabLogTD"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript">
	$.post('showLabLogTD.php',{
			PersonalID: '<?php echo $person[PersonalID]?>',
			User: '<?php echo $person[User]?>',
			keyword: $('#keyword').val(),
			accessResult: $('#accessResult').val()
		},function(data){
			$('#showLabLogTD').html(data);
		}
	);
</script>
<?php
	include "../template/footer.php"; 
?>