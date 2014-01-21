<?php
	$functionName="Lab Result (ผลการตรวจจากห้องปฏิบัติการ)";
	include "../template/header.php";
?>
<table class="noSpacing" style="width: 100%;height: 100%;">
	<tr>
		<td class="form_body right_dashed" rowspan="2" style="vertical-align: top;text-align: center;width: 170px;">
			<img id="menu_labResult" src="../img/lab.png" height="150">
			<div style="font-weight: bold;"><?php echo $person[PersonName]?></div>
		</td>
		<td class="form_body" align="right" style="vertical-align: top;">
			<form name="monitorsearch" method="POST">
				<table>
					<tr>
						<td class="form_input">
							จากวันที่
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
						<td class="form_input">
							ถึง
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
						<td colspan="2" align="right">
							<input type="submit" name="submit" value="   ค้นหา   ">
							<input type="reset" name="reset" value="ยกเลิก" style="display: none">
						</td>
					</tr>
				</table>
			</form>

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

					$myNamespace = "http://164.115.24.113:8082/getPatientProxy?wsdl";

					echo "<pre style='text-align: left;'>";
					
					{
						$client = new nusoap_client($myNamespace,true); 
				        $params = array(
		                   'hospCode' => '11470',
						   'hospitalNumber' => '20/51'
				        );
				        $msg='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.nhis.nectec.or.th"><soapenv:Header/><soapenv:Body><ws:getInfo><RequestPatient><hospCode>11470</hospCode><hospitalNumber>20/51</hospitalNumber></RequestPatient></ws:getInfo></soapenv:Body></soapenv:Envelope>';
				        $data = $client->send($msg,"http://164.115.24.113:8082/getPatientProxy");
				        print_r($data);
					}
					echo "</pre>";
					exit();
					
					$wsdl =$myNamespace;
					$soap = new nusoap_client($wsdl,true); 
					$proxy = $soap->getProxy();
					
					$param=array(
							'hospCode'=>'11470', 
							'hospitalNumber'=>'20/51'
					);
					
					$result = $proxy->getInfo($param);
					$anm=split(",","HospitalNumber,CitizenID,Gender,GivenName,FamilyName,address,BirthDate,Nationality,Race,MotherName,MotherCID,FatherName,FatherCID,VisitingNumber,LabID,PersonalID,LabDate,Description,ResultLabID,UniversalTestID,ResultLab,UnitID");
					print_r($result);
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
													<div style="float: right;font-size: 15px;">
													<?php if(MethodName($utest[MethodID])!="")echo "(".MethodName($utest[MethodID]).")"?></div>
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
														<div style="float: right;font-size: 85%;">
														<?php if(MethodName($utest[MethodID])!="")echo "(".MethodName($utest[MethodID]).")"?></div>
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
<?php
	include "../template/footer.php"; 
?>