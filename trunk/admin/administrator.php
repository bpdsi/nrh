<?php
	include "../function/functionPHP.php";
	noCache();
	host("nrh");
?>
<table style="width: 100%;">
	<tr>
		<td>
			โรงพยาบาล
			<select id="hospcode"
				onchange="
					$.post('showAdmin.php',{
							hospcode: $(this).val()
						},function(data){
						}
					)
				"
			>
				<option value="">กรุณาเลือกโรงพยาบาล</option>
				<?php
					$query="
						select	*
						from	hospcode
						where	(
									hosptype='โรงพยาบาล' or
									hosptype='รพ.'
								) and
								hospcode in (
									select	hospcode
									from	admin_hospital
								)
					";
					$result=mysql_query($query);
					$numrows=mysql_num_rows($result);
					$i=0;
					while($i<$numrows){
						$row=mysql_fetch_array($result);
						?>
							<option value="<?php echo $row[hospcode]?>"><?php echo $row[hosptype].$row[name]?></option>
						<?php
						$i++;
					} 
				?>
			</select><hr>
		</td>
	</tr>
	<tr>
		<td id="contentTD"></td>
	</tr>
</table>