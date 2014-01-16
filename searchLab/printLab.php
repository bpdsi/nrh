<?php
	include "../function/functionPHP.php";
	host("nrh");
	$VisitingNumber=$_GET["VisitingNumber"];
	$queryLab="
		select	*
		from	lab_test
		where	VisitingNumber='$VisitingNumber'
	";
	$resultLab=mysql_query($queryLab);
	$rowLab=mysql_fetch_array($resultLab);
	
	$queryWard="
		select	*
		from	ward
		where	WardID='$rowLab[WardID]'
	";
	$resultWard=mysql_query($queryWard);
	$rowWard=mysql_fetch_array($resultWard);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
		<style type="text/css">
			body{
				font-family: Arial;
			}
			.form_field{
				text-align: right;
			}
			table{
				border-spacing: 0;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<table 
			style="
				border: 1px solid #000;
				background-image: url('waterMark.png');
				background-position: center center;
				background-repeat: no-repeat;
			"
		>
			<tr>
				<td style="padding: 20px;">
					<table style="width: 100%;">
						<tr>
							<td style="vertical-align: top;">
								<div style="font-weight: bold;font-size: 20px;"><?php
									$queryHosp="
										select	*
										from	hospital
										where	HospCode='$rowLab[HospCode]'
									";
									$resultHosp=mysql_query($queryHosp);
									$rowHosp=mysql_fetch_array($resultHosp);
									echo $rowHosp[HospitalName];
								?></div>
								<div style="font-weight: bold">
									กลุ่มงานพยาธิวิทยา หน่วยงานโลหิตวิทยา<br>
									โทร. 02-517-4270-9
								</div>
								<div>
									ห้องเบอร์ 5 ต่อ 1315/อาคารเฉลิมพระเกียรติ ต่อ 7320
								</div>
							</td>
							<td style="vertical-align: top;">
								<?php echo dateEncode($rowLab[LabDate])?>
							</td>
							<td style="vertical-align: top;">
								<table>
									<tr>
										<td>
											<?php
												$queryPerson="
													select	*
													from	person
													where	PersonalID='$rowLab[PersonalID]'
												";
												$resultPerson=mysql_query($queryPerson);
												$rowPerson=mysql_fetch_array($resultPerson);
											?>
											Name : <?php echo $rowPerson[PersonName]?>
										</td>
									</tr>
									<tr>
										<td>
											<?php
												$queryHN="
													select	*
													from	hospital_patient
													where	PersonalID='$rowLab[PersonalID]' and
															HospCode='$rowLab[HospCode]'
												";
												$resultHN=mysql_query($queryHN);
												$rowHN=mysql_fetch_array($resultHN);
											?>
											<table>
												<tr>
													<td class="form_field">HN : </td>
													<td><?php echo $rowHN[HospitalNumber]?></td>
													<td class="form_field">Age : </td>
													<td style="width: 40px;"></td>
													<td class="form_field">Sex : </td>
													<td style="width: 40px;"><?php echo $rowPerson[Gender]?></td>
												</tr>
												<tr>
													<td class="form_field">VN : </td>
													<td><?php echo $VisitingNumber?></td>
												</tr>
												<tr>
													<td class="form_field">Ward : </td>
													<td><?php echo $rowWard[WardName]?></td>
												</tr>
												<tr>
													<td class="form_field">Request By : </td>
													<td><?php 
														$queryStaff="
																select	*
																from	staff
																where	StaffID='$rowLab[StaffID]'
															";
															$resultRequest=mysql_query($queryStaff);
															$rowRequest=mysql_fetch_array($resultRequest);
														echo $rowRequest[GivenName]." ".$rowRequest[FamilyName];
													?></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="padding: 10px 20px 20px 20px;">
					<table style="border: 1px solid #000;width: 100%;">
						<tr>
							<td rowspan="2" style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;">Analyte</td>
							<td rowspan="2" style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;">Method</td>
							<td colspan="3" style="text-align: center;padding: 0px 20px 0px 20px;">Conventional Unit</td>
							<td colspan="3" style="text-align: center;padding: 0px 20px 0px 20px;">SI Unit</td>
							<td rowspan="2" style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;">Remark</td>
						</tr>
						<tr>
							<td style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;text-align: right">Result</td>
							<td style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;">Unit</td>
							<td style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;">Reference range</td>
							<td style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;">Result</td>
							<td style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;">Unit</td>
							<td style="border-bottom: solid 1px #000;padding: 0px 20px 0px 20px;">Reference range</td>
						</tr>
						<?php
							$queryLabResult="
								select	*
								from	lab_test_result
								where	LabTestID='$rowLab[LabTestID]'
							";
							$resultLabResult=mysql_query($queryLabResult);
							$numrowsLabResult=mysql_num_rows($resultLabResult);
							$iLabResult=0;
							while($iLabResult<$numrowsLabResult){
								$rowLabResult=mysql_fetch_array($resultLabResult);
								$uInfo=utest($rowLabResult[UniversalTestID]);
								?>
									<tr style="height: 35px;">
										<td><?php echo $uInfo[UniversalTestName]?></td>
										<td><?php echo MethodName($uInfo[MethodID])?></td>
										<td style="text-align: right;padding: 0px 20px 0px 20px;"><?php echo $rowLabResult[ResultLab]?></td>
										<td style="text-align: center;padding: 0px 20px 0px 20px;"><?php echo UnitName($rowLabResult[UnitID])?></td>
										<td style="text-align: center;padding: 0px 20px 0px 20px;"><?php echo $rowLabResult[ReferenceResult]?></td>
										<td style="text-align: right;padding: 0px 20px 0px 20px;"><?php echo $rowLabResult[ResultUniversal]?></td>
										<td style="text-align: center;padding: 0px 20px 0px 20px;"><?php echo UnitName($rowLabResult[UnitUniversal])?></td>
										<td style="text-align: center;padding: 0px 20px 0px 20px;"><?php echo $rowLabResult[ReferenceUniversalTest]?></td>
										<td></td>
									</tr>
								<?php
								$iLabResult++;
							}
						?>
					</table>
					<?php
						$queryStaff="
							select	*
							from	staff
							where	StaffID='$rowLabResult[LabReporter]'
						";
						$resultStaff=mysql_query($queryStaff);
						$rowStaff=mysql_fetch_array($resultStaff);
					?>
					<div style="float: left;">Report by : <?php echo $rowStaff[GivenName]." ".$rowStaff[FamilyName]?></div>
					<div style="float: right;">Page 1 of 1</div><br>
					<input type="button" value="Print" style="float: right;" 
						onclick="
							$(this).hide();
							window.print();
							$(this).show();
						"
					>
				</td>
			</tr>
		</table>
	</body>
</html>