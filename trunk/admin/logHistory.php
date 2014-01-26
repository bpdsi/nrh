<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	
	$AdminID=$_SESSION[admin_Person][AdminID];
	$User=$_SESSION[admin_Person][User];
?>
<table style="width: 100%;">
	<tr>
		<td>
			IP Address 
			<input type="text" name="keyword" id="keyword"
				onkeyup="
					$.post('showLogHistory.php',{
							AdminID: '<?php echo $AdminID?>',
							User: '<?php echo $User?>',
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
					$.post('showLogHistory.php',{
							AdminID: '<?php echo $AdminID?>',
							User: '<?php echo $User?>',
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
<script type="text/javascript">
	$.post('showLogHistory.php',{
			AdminID: '<?php echo $AdminID?>',
			User: '<?php echo $User?>',
			keyword: $('#keyword').val(),
			authenResult: $('#authenResult').val()
		},function(data){
			$('#showLogTD').html(data);
		}
	);
</script>