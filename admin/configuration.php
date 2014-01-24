<?php
	header("Cache-Control: no-cache, must-revalidate");
	header ('Content-type: text/html; charset=utf-8');
	include "../function/functionPHP.php";
	host("nrh");
?>
<table>
	<?php
		$query="
			select	*
			from	config
		";
		$result=mysql_query($query);
		$numrows=mysql_num_rows($result);
		$i=0;
		while($i<$numrows){
			$row=mysql_fetch_array($result);
			?>
				<tr>
					<td class="form_field" style="padding-right: 5px;">
						<input type="hidden" name="cfgName[]" value="<?php echo $row[cfgName]?>">
						<?php echo $row[cfgName]?>
					</td>
					<td>
						<div class="cfgValue"><?php echo $row[cfgValue]?></div>
						<div style="display: none"><input class="cfgValue" type="text" value="<?php echo $row[cfgValue]?>"></div>
					</td>
				</tr>
			<?php
			$i++;
		}
	?>
</table>