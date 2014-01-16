<?php
	session_start();
	include "../function/functionPHP.php";
	noCache();
	headerEncode();
	$person=$_SESSION["sess_Person"];
?>
<table style="width: 100%;">
	<tr>
		<td>
			<?php
				$table=$_SESSION["sess_vcPrefix"]."_child";
				
				$query="
					select	*
					from	$table
					where	parent='$person[PersonalID]'
				";
				$result=mysql_query($query);
				$numrows=mysql_num_rows($result);
				$i=0;
				while($i<$numrows){
					$row=mysql_fetch_array($result);
					?>
						<div id="vcpID<?php echo $row[vcpID]?>" class="homeIcon" id="menu_vaccinationHistory" style="float: left;width: 233px;padding: 0px;">
							<table style="width: 100%;height: 100%;">
								<tr>
									<td style="width: 35px;padding: 10px;">
										<img src="../images/child.png" height="35">
									</td>
									<td style="text-align: center;vertical-align: middle">
										<?php echo $row[NickName]?><br>
										<div style="font-size: 90%;font-weight: normal;"><?php echo $row[GivenName]." ".$row[MiddleName]." ".$row[FamilyName]?></div>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="button" value="Edit" style="float: left;width: 50px;"
											onclick="
												$('#e_vcpID').val('<?php echo $row[vcpID]?>');
												$('#e_GivenName').val('<?php echo $row[GivenName]?>');
												$('#e_MiddleName').val('<?php echo $row[MiddleName]?>');
												$('#e_FamilyName').val('<?php echo $row[FamilyName]?>');
												$('#e_NickName').val('<?php echo $row[NickName]?>');
												$('#e_Description').val('<?php echo $row[Description]?>');
												$('#editChildDIV').css('top',$(this).position().top);
												$('#editChildDIV').css('left',$(this).position().left+$(this).width());
												$('#editChildDIV').fadeIn();
											"
										>
										<input type="button" value="Delete" style="float: right;width: 50px;"
											onclick="
												if(confirm('ต้องการลบผู้รับวัคซีนชื่อ <?php echo $row[GivenName]." ".$row[MiddleName]." ".$row[FamilyName]?>')){
													$.post('vcDeleteChild.php',{
															vcpID: '<?php echo $row[vcpID]?>'
														},function(data){
														alert(data);
															if(data=='complete'){
																$('#vcpID<?php echo $row[vcpID]?>').fadeOut();
																alert('ลบผู้รับวัคซีนเรียบร้อย');
															}else{
																alert('ไม่สามารถลบ <?php echo $row[GivenName]." ".$row[MiddleName]." ".$row[FamilyName]?>');
															}
														}
													)
												}
											"
										>
									</td>
								</tr>
							</table>
						</div>
					<?php
					$i++;
				} 
			?>
		</td>
	</tr>
	<tr>
		<td>
			<input type="button" value=" Back " style="float: right;" onclick="window.open('../vaccine','_self')">
		</td>
	</tr>
</table>