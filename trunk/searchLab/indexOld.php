<?php
	session_start();
	include "../function/functionPHP.php";
	if(!patientAuthenticated()){
		header("location:../authen/index.php");
		exit();
	}
	host("nrh");
	
	$query="
		select	*
		from	person
		where	User='".$_SESSION["sess_User"]."'
	";
	$result=mysql_query($query);
	$person=mysql_fetch_array($result);
	
	//include "common_soap.php";
	$hn= $_SESSION["hn"];	
	$PersonIDs= $_POST["PersonID"];
	$PatientName= $_POST["PatientName"];
	$StartDate=$_POST["StartDate"];
	$EndDate=$_POST["EndDate"];
	
	function correct_encoding($text) {
	    $current_encoding = mb_detect_encoding($text, 'auto');
	    $text = iconv($current_encoding, 'UTF-8', $text);
	    return $text;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- CSS -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/npr.css">
		
		<!-- jQuery -->
			<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
		
		<!-- datePicker -->
			<script src="../js/jquery-ui.js"></script>
			<link rel="stylesheet" type="text/css" media="screen" href="../css/jquery-ui.css">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/datePicker.css">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/demo.css">
			
		<!-- CUFON -->
			<script type="text/javascript" src="../js/cufon-yui.js"></script>
			<script type="text/javascript" src="../js/nprFont.js"></script>
			<script type="text/javascript">
				//Cufon.replace('h1.header');
			</script>
			
		<script type="text/javascript">
			$(function(){

			    var d = new Date();
			    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);

				$( "#StartDate" ).datepicker({
					changeMonth: true, 
					changeYear: true,
					dateFormat: 'dd/mm/yy', 
					isBuddhist: true, 
					defaultDate: toDay,
					dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
		            dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		            monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		            monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
					onClose: function( selectedDate ) {
						$( "#EndDate" ).datepicker( "option", "minDate", selectedDate );
					},
					onSelect: function(data){
			            $('this').blur();
			        }
				});
				$( "#EndDate" ).datepicker({
					changeMonth: true, 
					changeYear: true,
					dateFormat: 'dd/mm/yy', 
					isBuddhist: true, 
					defaultDate: toDay,
					dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
		            dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		            monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		            monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
					onClose: function( selectedDate ) {
						$( "#from" ).datepicker( "option", "maxDate", selectedDate );
					},
					onSelect: function(data){
			            $('this').blur();
			        }
				});

				/*$(".date-pick").datepicker({ 
					changeMonth: true, 
					changeYear: true,
					dateFormat: 'dd/mm/yy', 
					isBuddhist: true, 
					defaultDate: toDay,
					dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
		            dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		            monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		            monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
		            onSelect: function(data){
			            $('this').blur();
			        }
				});*/
			});
		</script>
		<style type="text/css">
			.form_input{
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div class="form" style="width: 660px;margin-left: auto;margin-right: auto;">
			<table class="form" style="width: 100%;">
				<tr>
					<td class="form_header" colspan="2">Search Lab</td>
				</tr>
				<tr>
					<td class="form_body" align="center">
						<table>
							<tr>
								<td valign="top" align="center" style="width: 170px;">
									<img src="../img/person.png">
									<div style="font-size: 14px;"><?php echo $person[PersonName]?></div>
								</td>
								<td>
									<form name="monitorsearch" method="POST">
										<table>
											<tr>
												<td class="form_field">CitizenID</td>
												<td class="form_input"><?php echo $person[CitizenID]?></td>
											</tr>
											<tr>
												<td class="form_field">GivenName FamilyName</td>
												<td class="form_input"><?php echo $person[PersonName]?></td>
											</tr>
											<tr>
												<td class="form_field">Telephone</td>
												<td class="form_input"><?php echo $person[Telephone]?></td>
											</tr>
											<tr>
												<td class="form_field">Email</td>
												<td class="form_input"><?php echo $person[Email]?></td>
											</tr>
											<tr>
												<td class="form_field">จากวันที่</td>
												<td class="form_input">
													<input type="text" id="StartDate" name="StartDate" size="10"
														style="
															text-align: center;
															cursor: pointer;
														"
														value="<?php echo $StartDate?>"
													/><img src="<?php echo $mainUrl?>/img/calendar.png"
														style="
															margin-bottom: -3px;
															padding-left: 3px;
															cursor: pointer;
														"
														onclick="$('#StartDate').focus();"
													>
												</td>
											</tr>
											<tr>
												<td class="form_field">ถึง</td>
												<td class="form_input">
													<input type="text" id="EndDate" name="EndDate" size="10"
														style="
															text-align: center;
															cursor: pointer;
														" 
														value="<?php echo $EndDate?>"
													/><img src="<?php echo $mainUrl?>/img/calendar.png"
														style="
															margin-bottom: -3px;
															padding-left: 3px;
															cursor: pointer
														"
														onclick="$('#EndDate').focus();"
													>													
												</td>
											</tr>
											<tr>
												<td colspan="2" align="right">
													<input type="submit" name="submit" value="   ค้นหา   ">
													<input type="reset" name="reset" value="ยกเลิก" style="display: none">
												</td>
											</tr>
										</table>
									</form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="padding: 5px;">
						<?php
							require_once('../lib/nusoap.php'); 
							
							try {
								$where="";
								if($PatientName!=""){
									$where.=" and concat(GivenName,FamilyName) like '%".$PatientName."%'";
								}
								if($PersonIDs!=""){
									$where.=" and CitizenID like '%".$PersonIDs."%'";
								}
								if($hn!=""){
									$where.=" and HospitalNumber ='".$hn."'";
								}
								$sql="SELECT CitizenID  from person where PersonalID<>'' ";
								$sql.=$where;
								$result = mysql_query($sql) or die(mysql_error()."<br>".$sql);
								$personid="";
								$numrow=mysql_num_rows($result);
								while($rowcid=mysql_fetch_array($result)):
									if($personid!=""){
										$personid.=",".$rowcid[0];
									}else{
										$personid=$rowcid[0];
									}
								endwhile;

								$myNamespace = 'http://'.$_SERVER['HTTP_HOST']."/soap_health/lab_service.php?wsdl";
								$wsdl = $myNamespace;
								$soap = new nusoap_client($wsdl,"wsdl"); 
								$proxy = $soap->getProxy();
								$result = $proxy->QueryLab(array('CitizenID'=> trim($person[CitizenID]),'StartDate'=> $StartDate,'EndDate'=> $EndDate));
								$anm=split(",","HospitalNumber,CitizenID,Gender,GivenName,FamilyName,address,BirthDate,Nationality,Race,MotherName,MotherCID,FatherName,FatherCID,VisitingNumber,LabID,PersonalID,LabDate,Description,ResultLabID,UniversalTestID,ResultLab,UnitID");
								if($result!=""){
									?>
										<table class="noSpacing border_solid" style="width: 100%;">
											<tr>
												<td class="table_header right_solid bottom_solid" rowspan="2">Analyte (Method)</td>
												<td class="table_header bottom_solid right_solid" colspan="3">Conventional Unit</td>
												<td class="table_header bottom_solid" colspan="3">SI Unit</td>
											</tr>
											<tr>
												<td class="table_header right_solid bottom_solid">Result</td>
												<td class="table_header right_solid bottom_solid">Unit</td>
												<td class="table_header right_solid bottom_solid">Reference Range</td>
												<td class="table_header right_solid bottom_solid">Result</td>
												<td class="table_header right_solid bottom_solid">Unit</td>
												<td class="table_header bottom_solid">Reference Range</td>
											</tr>
											<?php
												if(is_array($result[item][labOrderDetail])){
													$labOrderDetail=$result[item][labOrderDetail];
													$utest=utest($labOrderDetail[UniversalTestID]);
													if($lastVN!=$result[item][labOrder][VisitingNumber]){
														$lastVN=$result[item][labOrder][VisitingNumber];
														$HospCode=$result[item][labOrder][Hospital];
														?>
															<tr>
																<td class="table_detail bottom_solid" style="background-color: #99C27E">
																	VN : <b><?php echo $lastVN?></b>
																</td>
																<td class="table_detail bottom_solid" colspan="3" align="center" style="background-color: #99C27E">
																	<?php echo dateEncode($result[item][labOrder][LabDate])?>
																</td>
																<td class="table_detail bottom_solid" colspan="3" style="text-align: right;background-color: #99C27E">
																	<?php echo HospitalName($HospCode)." ($HospCode)"?>
																	<input type="button" value="  Print  " onclick="window.open('printLab.php?VisitingNumber=<?php echo $lastVN;?>')">
																</td>
															</tr>
														<?php
													}
													?>
														<tr>
															<td class="table_detail bottom_dashedGrey right_solid">
																<div><?php echo $utest[UniversalTestName]?></div>
																<div style="float: right;font-size: 11px;">(<?php echo MethodName($utest[MethodID])?>)</div>
															</td>
															
															<td class="table_detail bottom_dashedGrey" style="text-align: right"><?php echo $labOrderDetail[ResultLab]?></td>
															<td class="table_detail bottom_dashedGrey"><?php echo UnitName($labOrderDetail[UnitID])?></td>
															<td class="table_detail bottom_dashedGrey right_solid" style="text-align: center"><?php echo $labOrderDetail[ReferenceResult]?></td>
															
															<td class="table_detail bottom_dashedGrey" style="text-align: right"><?php echo $labOrderDetail[ResultUniversal]?></td>
															<td class="table_detail bottom_dashedGrey"><?php echo $labOrderDetail[UnitUniversal]?></td>
															<td class="table_detail bottom_dashedGrey" style="text-align: center"><?php echo $labOrderDetail[ReferenceUniversalTest]?></td>
														</tr>
													<?php
												}else{
													for($iLab=0;$result[item][$iLab][labOrder]!=null;$iLab++){													
														$labOrderDetail=$result[item][$iLab][labOrderDetail];
														$utest=utest($labOrderDetail[UniversalTestID]);
														if($lastVN!=$result[item][$iLab][labOrder][VisitingNumber]){
															$lastVN=$result[item][$iLab][labOrder][VisitingNumber];
															$HospCode=$result[item][$iLab][labOrder][Hospital];
															?>
																<tr>
																	<td class="table_detail bottom_solid" style="background-color: #99C27E">
																		VN : <b><?php echo $lastVN?></b>
																	</td>
																	<td class="table_detail bottom_solid" colspan="3" align="center" style="background-color: #99C27E">
																		<?php echo dateEncode($result[item][$iLab][labOrder][LabDate])?>
																	</td>
																	<td class="table_detail bottom_solid" colspan="3" style="text-align: right;background-color: #99C27E">
																		<?php echo HospitalName($HospCode)." ($HospCode)"?>
																		<input type="button" value="  Print  " onclick="window.open('printLab.php?VisitingNumber=<?php echo $lastVN;?>')">
																	</td>
																</tr>
															<?php
														}
														?>
															<tr>
																<td class="table_detail bottom_dashedGrey right_solid">
																	<div><?php echo $utest[UniversalTestName]?></div>
																	<div style="float: right;font-size: 11px;">(<?php echo MethodName($utest[MethodID])?>)</div>
																</td>
																
																<td class="table_detail bottom_dashedGrey" style="text-align: right"><?php echo $labOrderDetail[ResultLab]?></td>
																<td class="table_detail bottom_dashedGrey"><?php echo UnitName($labOrderDetail[UnitID])?></td>
																<td class="table_detail bottom_dashedGrey right_solid" style="text-align: center"><?php echo $labOrderDetail[ReferenceResult]?></td>
																
																<td class="table_detail bottom_dashedGrey" style="text-align: right"><?php echo $labOrderDetail[ResultUniversal]?></td>
																<td class="table_detail bottom_dashedGrey"><?php echo $labOrderDetail[UnitUniversal]?></td>
																<td class="table_detail bottom_dashedGrey" style="text-align: center"><?php echo $labOrderDetail[ReferenceUniversalTest]?></td>
															</tr>
														<?php
													}
												}
											?>
										</table>
									<?php
								}else{
									echo "Result not found!";
								}
							} catch (Exception $e) {
								printf("Message = %s\n",$e->getMessage());
							}
						?>
						<input type="button" value=" Home " style="float: right;" onclick="window.open('../home','_self')">
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>