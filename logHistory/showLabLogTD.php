<?php
	session_start();
	include "../function/functionPHP.php";
	
	$page=$_POST["page"];
	$keyword=$_POST["keyword"];
	$accessResult=$_POST["accessResult"];
	$PersonalID=$_POST["PersonalID"];
	$User=$_POST["User"];
	
	noCache();
	headerEncode();
	$perPage=12;
	if($page==""){
		$page=1;
	}
	if($page==1){
		$startRecord=0;
	}else{
		$startRecord=($page-1)*$perPage;
	}
	
	if($accessResult=="all"){
		$query="
			select		*
			from		log_lab_share
			where		ipAddress like '%$keyword%' and
						LabTestID in (
							select	LabTestID
							from	lab_test
							where	PersonalID='$PersonalID'
						)
			order by	datetime desc
		";
	}else{
		$query="
			select		*
			from		log_lab_share
			where		ipAddress like '%$keyword%' and
						LabTestID in (
							select	LabTestID
							from	lab_test
							where	PersonalID='$PersonalID'
						) and
						accessResult='$accessResult'
			order by	datetime desc
		";
	}
	$result=mysql_query($query);
	$numrows=mysql_num_rows($result);
	$pageCount=$numrows/$perPage;
	if((int)$pageCount<$pageCount){
		$pageCount=((int)$pageCount)+1;
	}
?>
<table style="margin-left: auto;">
	<tr>
		<td align="right">
			<?php
				if($page>1){
					?>
						<div style="float: left;" class="pageButton"
							onclick="
								$.post('showLabLogTD.php',{
										page: '<?php echo $page-1;?>',
										keyword: '<?php echo $keyword?>',
										PersonalID: '<?php echo $PersonalID?>',
										User: '<?php echo $User?>',
										accessResult: '<?php echo $accessResult?>'
									},function(data){
										$('#showLabLogTD').html(data);
									}
								);
							"
						>&lt;</div>
					<?php
				}
				for($i=1;$i<=$pageCount;$i++){
					?>
						<div class="pageButton"
							style="
								float: left;
								<?php
									if($i==$page){
										?>color: #b90000; font-weight: bold;<?php
									}
								?>
							"
							onclick="
								$.post('showLabLogTD.php',{
										page: '<?php echo $i;?>',
										keyword: '<?php echo $keyword?>',
										PersonalID: '<?php echo $PersonalID?>',
										User: '<?php echo $User?>',
										accessResult: '<?php echo $accessResult?>'
									},function(data){
										$('#showLabLogTD').html(data);
									}
								);
							"
						><?php echo $i;?></div><?php
				}
				if($page<$pageCount){
					?>
					<div style="float: left;" class="pageButton"
						onclick="
							$.post('showLabLogTD.php',{
									page: '<?php echo $page+1;?>',
									keyword: '<?php echo $keyword?>',
									PersonalID: '<?php echo $PersonalID?>',
									User: '<?php echo $User?>',
									accessResult: '<?php echo $accessResult?>'
								},function(data){
									$('#showLabLogTD').html(data);
								}
							);
						"
					>&gt;</div><?php
				}
			?>
		</td>
	</tr>
</table>
<table class="table_01 noSpacing" style="width: 100%;">
	<tr>
		<td class="table_header" style="padding: 5px;">
			วันเวลา
		</td>
		<td class="table_header" style="padding: 5px;">
			IP Address
		</td>
		<td class="table_header" style="padding: 5px;">ผลการเข้าสู่ระบบ</td>
	</tr>
	<?php
		$result=mysql_query($query." limit	$startRecord,$perPage");
		$numrows=mysql_num_rows($result);
		$i=0;
		while($i<$numrows){
			$row=mysql_fetch_array($result);
			if($row[accessResult]=="pass"){
				$bgColor="#FFF";
			}else if($row[accessResult]=="fail"){
				$bgColor="#FFE4E4";
			}
			?>
				<tr style="background-color: <?php echo $bgColor;?>">
					<td class="bottom_dashed right_solid" style="text-align: center;padding: 5px;"><?php echo dateEncode($row[datetime]);?></td>
					<td class="bottom_dashed right_solid" style="text-align: center;padding: 5px;"><?php echo $row[ipAddress]?></td>
					<td class="bottom_dashed" style="text-align: center;padding: 5px;">
						<?php 
							if($row[accessResult]=="complete"){
								echo "สำเร็จ";
							}else{
								echo "ไม่สำเร็จ";
							}
						?>
					</td>
				</tr>
			<?php
			$i++;
		}
	?>
	<tr>
		<td class="table_header" colspan="8" style="text-align: right;padding: 5px;"><?php echo $numrows?> รายการ</td>
	</tr>
</table><br>
<input type="button" value=" Home " style="float: right;" onclick="window.open('../home','_self')">