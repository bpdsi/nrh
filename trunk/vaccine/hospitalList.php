<?php
	header('Content-Type: text/html; charset=utf-8');
	include "../config/connection.php";
	include "../function/functionPHP.php";
	$keyword=$_GET["keyword"];
	$hospitalArray=get_hospital($keyword);
	//print_r($hospitalArray);
?>
<table class="browse" style="width: 100%;">
	<?php
		if(count($hospitalArray)){
			foreach ($hospitalArray as $key => $value){
				?>
					<tr>
						<td class="browse_list" 
							style="
								padding: 3px 0px 3px 10px;
								font-size: 14px;
							"
							onclick="
								$('#Hospital').val('<?php echo $key?>');
								$('#e_Hospital').val('<?php echo $key?>');
								$('#HospitalName').val('<?php echo $value[hospitalname]?>');
								$('#e_HospitalName').val('<?php echo $value[hospitalname]?>');
								$('#hospitalListFrame').fadeOut('fast');
								$('#refer_url').val('<?php echo $value[refer_url]?>');
							"
						><?php echo $value[hospitalname];?></td>
					</tr>
				<?php
			}
		}
	?>
</table>