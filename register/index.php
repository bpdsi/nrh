<?php
	session_start();
	include "../config/connection.php";
	include "../function/functionPHP.php";
	$mainUrl=get_cfgValue("mainUrl");
	if(!adminAuthenticated()){
		?>
			<html>
				<head>
					<title>Personal Databank</title>
					<link href="../img/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon">
					<script type="text/javascript">
						alert("Permission Denied!");
						window.open('../authen','_self');
					</script>
				</head>
			</html>
		<?php
		exit();
	}
	
	$Hospital=$_SESSION["admin_hospcode"];
	if($Hospital==""){
		$Hospital=11470;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Databank Registration Form</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!-- jQuery -->
		<!--<script type='text/javascript' src='http://code.jquery.com/jquery-1.10.0.min.js'></script>-->
		
		<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
		<script type='text/javascript' src='../js/jquery.soap.js'></script>
		
		<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>-->
		
		<!-- required plugins -->
		<script type="text/javascript" src="../js/date.js"></script>
		<!--[if IE]><script type="text/javascript" src="scripts/jquery.bgiframe.js"></script><![endif]-->
		
		<!-- jquery.datePicker.js -->
			<!-- <script type="text/javascript" src="../js/jquery.datePicker.js"></script>-->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/jquery-ui.css">
	  		<script src="../js/jquery-ui.js"></script>
		<!-- datePicker required styles -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/datePicker.css">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/demo.css">
			
		<!-- CUFON -->
			<script type="text/javascript" src="../js/cufon-yui.js"></script>
			<script type="text/javascript" src="../js/nprFont.js"></script>
			<script type="text/javascript">
				//Cufon.replace('h1.header');
			</script>
			
		<!-- CSS -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/npr.css">
		
		<!-- My jScript -->
			<script src="../function/functionJAVA.js" type="text/javascript"></script>
			
		<script type="text/javascript">
			(function($){
				$.unserialize = function(serializedString){
					var str = decodeURI(serializedString);
					var pairs = str.split('&');
					var obj = {}, p, idx, val;
					for (var i=0, n=pairs.length; i < n; i++) {
						p = pairs[i].split('=');
						idx = p[0];
			 
						if (idx.indexOf("[]") == (idx.length - 2)) {
							// Eh um vetor
							var ind = idx.substring(0, idx.length-2)
							if (obj[ind] === undefined) {
								obj[ind] = [];
							}
							obj[ind].push(p[1]);
						}
						else {
							obj[idx] = p[1];
						}
					}
					return obj;
				};
			})(jQuery);
		
			function dateDisplayConvert(date){
				if(date.indexOf("-")){
					date=date.split("-");
				}
				
				if(parseInt(date[0])>parseInt(date[2])){
					date[0]=parseInt(date[0])+543;
					
					return date[2]+"/"+date[1]+"/"+date[0];
				}else if(parseInt(date[0])<parseInt(date[2])){
					date[0]=parseInt(date[0])+543;
					return date[0]+"/"+date[1]+"/"+date[2];
				}
			}
		
			$(function(){
			    var d = new Date();
			    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);
		
				$(".date-pick").datepicker({ 
					changeMonth: true, 
					changeYear: true,
					dateFormat: 'dd/mm/yy', 
					isBuddhist: true, 
					defaultDate: toDay,
					dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
		            dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		            monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		            monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
		            onSelect: function(){
			            $('this').blur();
			        }
				});


				$.post("getHospitalName.php",{
						Hospital: $('#Hospital').val()
					},function(data){
						$('#HospitalName').val(data);
					}
				);

				$('#blnLoadMember').click(function(){
					GetMember();					
				});
			})
			
			function GetMember() {

			    $("#MemberDetails").html('');
			    $("#MemberDetails").addClass("loading");
				var params = '<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns7030:QueryPatient xmlns:ns7030="http://tempuri.org"><PersonID xsi:type="xsd:string">'+ $('#CitizenID').val() +'</PersonID><Hospital xsi:type="xsd:string">'+ $('#Hospital').val() +'</Hospital><HospitalNumber xsi:type="xsd:string">'+ $('#HospitalNumber').val() +'</HospitalNumber></ns7030:QueryPatient></SOAP-ENV:Body></SOAP-ENV:Envelope>';

				var wss = {};

				url=$('#refer_url').val();
				$.soap({
					url: url,
					method: "QueryPatient",
			
					appendMethodToURL: false,
					SOAPAction: "action",
					soap12: false,
					
					params: params,
					wss: wss,
			
					namespaceQualifier: "xsd",
					namespaceURL: url,
					elementName: "",
			
					enableLogging: true,
			
					request: function(SOAPRequest) {
						$('#request').text(SOAPRequest);
					},
					success: function(SOAPResponse) {
						//alert(SOAPResponse.toString());
						$('#feedbackHeader').html('Success!');
						$('#feedback').text(SOAPResponse.toString());
						OnGetMemberSuccess(SOAPResponse);
					},
					error: function(SOAPResponse) {
						$('#feedbackHeader').html('Error!');
						$('#feedback').text(SOAPResponse.toString());
					}
				});
			}
			
			
			
			function OnGetMemberSuccess(data) {
				//alert("Success"+data.toString());
				xmlDoc = $.parseXML(data.toString()),
			    xml = $( xmlDoc ),
			    item = xml.find("item");
			    if(item.text().length==0){
				    alert("Not found!");
			    }else{
			    	CitizenID = xml.find("CitizenID");
			    	BloodGroupABO = xml.find("BloodGroupABO");
			    	BloodTypeRh = xml.find("BloodTypeRh");
				    $("#BloodGroupABO").val(BloodGroupABO.text());
				    $("#BloodTypeRh").val(BloodTypeRh.text());

			    	$.post("getPerson.php",{
				    		CitizenID: CitizenID.text(),
				    		Hospital: $('#Hospital').val()
				    	},function(responseData){
					    	if(responseData!="notFound"){
						    	$('#confirmTypeTR').hide();
						    	$('#currentUserTR').show();
						    	$('#currentUser').val('true');
						    	
					    		personArr=responseData.split(":");
					    		$('#CitizenID').val(personArr[0]);
					    		$('#HospitalNumber').val(personArr[1]).attr('readonly','readonly').css('background-color','#eee');
						    	$('#Name').val(personArr[2]).attr('readonly','readonly').css('background-color','#eee');
						    	$('#Telephone').val(personArr[3]).attr('readonly','readonly').css('background-color','#eee');
						    	$('#Email').val(personArr[4]).attr('readonly','readonly').css('background-color','#eee');
						    	$('#Prefix').val(personArr[5]).attr('readonly','readonly').css('background-color','#eee');

						    	$('#BloodGroupABO').val(personArr[6]).attr('readonly','readonly').css('background-color','#eee');
						    	$('#BloodTypeRh').val(personArr[7]).attr('readonly','readonly').css('background-color','#eee');
						    	$('#BirthDate').val(personArr[8]).attr('readonly','readonly').css('background-color','#eee');

						    	$.post('checkAllow.php',{
							    		Hospital: $('#Hospital').val(),
							    		HospitalNumber: $('#HospitalNumber').val(),
							    		CitizenID: $('#CitizenID').val()
							    	},function(data){
								    	$('#div_AllowStatus').html(data);
							    	}
						    	);
						    }else{
						    	$('#confirmTypeTR').show();
						    	$('#currentUserTR').hide();
						    	$('#currentUser').val('false');
							    
						    	$('#HospitalNumber').removeAttr('readonly').css('background-color','#fff');
						    	$('#Name').removeAttr('readonly').css('background-color','#fff');
						    	$('#Telephone').removeAttr('readonly').css('background-color','#fff');
						    	$('#Email').removeAttr('readonly').css('background-color','#fff');
						    	
						    	Prefix = xml.find("Prefix");
							    GivenName = xml.find("GivenName");
							    MiddleName = xml.find("MiddleName");
							    FamilyName = xml.find("FamilyName");
							    Gender = xml.find("Gender");
							    BirthDate = xml.find("BirthDate");
							    HospitalNumber = xml.find("HospitalNumber");
							    Telephone = xml.find("Telephone");
							    Email = xml.find("Email");
							    BloodGroupABO = xml.find("BloodGroupABO");
							    BloodTypeRh = xml.find("BloodTypeRh");
								var Hospital="";
								var HospitalName="";
								$(xml).find("Hospital").each(function(){
									if($(this).children("Hospital").text()!=""){
										Hospital=$(this).children("Hospital").text();
									}
									if($(this).children("HospitalName").text()!=""){
										HospitalName=$(this).children("HospitalName").text();
										$('#HospitalName').val($(this).children("HospitalName").text());
									}
								});
								
							    //HospitalNumber = $(this).children("Hospital").text();
							    //xx =$(xml).children('patientDetail').children('Hospital').children('HospitalName').text();
								//alert(HospitalNumber+"ff");
							    //HospitalName = xml.find("HospitalName");
							    BloodGroupABO = xml.find("BloodGroupABO");
							    BloodTypeRh = xml.find("BloodTypeRh");
								//alert(FamilyName.text());
								$("#MemberDetails").removeClass("loading");
								if(Hospital!=""){
									$("#Hospital").val(Hospital);
								}
							    $("#Email").val(Email.text());
							    $("#BloodGroupABO").val(BloodGroupABO.text());
							    $("#BloodTypeRh").val(BloodTypeRh.text());
							    $("#Telephone").val(Telephone.text());
							    $("#CitizenID").attr("value", CitizenID.text());
							    $("#HospitalNumber").attr("value", HospitalNumber.text());
							    $("#Prefix").attr("value", Prefix.text());
							    $("#GivenName").val(GivenName.text());
							    $("#MiddleName").val(MiddleName.text());
							    $("#FamilyName").val(FamilyName.text());
							    $("#Name").attr("value", (GivenName.text() + " " + MiddleName.text() + " " + FamilyName.text()));
								//alert("xx");
							    $("#PatientDetails").html("CID :  "+ CitizenID.text()+"<br>" +"วันเกิด :  "+ BirthDate.text()+"<br>" +"เพศ : "+Gender.text()+"<br>"+"กรุ๊ปเลือด : "+BloodGroupABO.text()+"<br>"+"HospitalNumber : "+ HospitalNumber.text()+"<br>Hospital : "+ Hospital +" "+HospitalName+"<br>");
							    $("#MemberDetails2").html(data.toString());
							    $('input[type=button]').attr('disabled', false);
							    $('#BirthDate').val(dateDisplayConvert(BirthDate.text()));

							}
				    	}
			    	);
				}				
			}
			function OnGetMemberSuccessxx(data) {
				//alert("Success"+data.toString());
				xmlDoc = $.parseXML(data.toString()),
			    xml = $( xmlDoc ),
			   
			    
				 $(xml).find("Hospital").each(function(){
					alert($(xml).find("Hospital").text());
					alert("xx"+$(this).children("Hospital").text());
					$("#MemberDetails2").append($(this).children("Hospital") + "<br />");
				});
			  
				
			}
			
			function OnGetMemberError(request, status, error) {
			    //jQuery code will go here...
				alert("Error");
				$("#MemberDetails").removeClass("loading");
			    $("#MemberDetails").html(request.statusText);
			    $('input[type=button]').attr('disabled', false);
			}
			function checkdate(input){
				var validformat=/^\d{2}\/\d{2}\/\d{4}$/; //Basic check for format validity
				var returnval=false;
				if(input.value!=""){
					if (!validformat.test(input.value)){
						alert("กรุณาระบุวันที่ในรูปแบบ dd/mm/yyyy");
					}else{ //Detailed check for valid date ranges
						var dayfield=input.value.split("/")[0];
						var monthfield=input.value.split("/")[1];
						var yearfield=input.value.split("/")[2];
						//alert(dayfield+" " + monthfield +" "+ yearfield);
						var dayobj = new Date(yearfield, monthfield-1, dayfield);
						if(yearfield!="0000"){
							if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield)){
								//alert("Invalid Day, Month, or Year range detected. Please correct and submit again.");
								alert("รูปแบบวันที่ไม่ถูกต้อง กรุณาระบุวันที่ใหม่อีกครั้ง");
							}else{
								returnval=true;
								checkabsent();
							}
						}else{
							if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)){
								//alert("Invalid Day, Month, or Year range detected. Please correct and submit again.");
								alert("รูปแบบวันที่ไม่ถูกต้อง กรุณาระบุวันที่ใหม่อีกครั้ง");
							}else{
								returnval=true;
								checkabsent();
							}
						}
					}
					if (returnval==false){
						input.value="";
						input.select();
					}
					return returnval;
				}
			}
			/*=========Generate password============*/
			$.extend({
			  password: function (length, special) {
			    var iteration = 0;
			    var password = "";
			    var randomNumber;
			    if(special == undefined){
			        var special = false;
			    }
			    while(iteration < length){
			        randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
			        if(!special){
			            if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
			            if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
			            if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
			            if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
			        }
			        iteration++;
			        password += String.fromCharCode(randomNumber);
			    }
			    return password;
			  }
			});
			$(document).ready(function() {
				$('.focus').focus();
				$('.link-password').click(function(e){
					linkId = $(this).attr('id');
					if (linkId == 'generate'){
						//password = $.password(12,true);
						password = $.password(8);
						$('#random').empty().hide().append(password).fadeIn('slow');
						//$('#confirm').fadeIn('slow');
						//vasu
						$('#input-password').val(password);
					} else {
						$('#input-password').val(password);
						$('#random').empty();
						$(this).hide();
					}
					e.preventDefault();
				});
				$('#hospitalBrowseButton').click(function(){
					$.get("hospitalList.php",{
							keyword: $('#HospitalName').val()
						},function(data){
							$('#hospitalListDetail').html(data);
							$('#hospitalListFrame').css("top",$('#hospitalBrowseButton').position().top);
							$('#hospitalListFrame').css("left",$('#hospitalBrowseButton').position().left+1);
							$('#hospitalListFrame').fadeIn('fast',function(){
								$('#keyword').focus();
							});
						}
					);
				});
			});
			/*========= Finished Generate password============*/
		</script>

		<style type="text/css">
			/* Specific Form Rules */
			#form-demo {width: 330px; margin: 50px 0 100px 0; height: 170px; padding: 25px 10px 0 10px; background: url(images/bg_login.png) no-repeat 0 0;}
			#confirm {display: none;}
			.success {order: 1px solid; margin: 0; padding: 10px; text-align: center; color: #4F8A10; background-color: #ebf6d9; border-color: #DFF2BF;}
		</style>
	</head>
	<body>
		<table style="width: 100%;height: 100%">
			<tr>
				<td style="text-align: center;vertical-align: middle">
					<input type="hidden" id="refer_url" value="http://nrh.dyndns.org/production/refer_service.php">
					<div class="form" style="width: 750px;margin-left: auto;margin-right: auto;">
						<table class="form" style="width: 100%;">
							<tr>
								<td class="form_header" colspan="2">ลงทะเบียนขอใช้สิทธิ์</td>
							</tr>
							<tr>
								<td class="form_body" align="center">
									<table>
										<tr>
											<td valign="top" align="center"
												style="
													width: 170px;
													background-image: url('../img/shadowLeft.png');
													background-repeat: no-repeat;
													background-position: right center;
													background-size: 20px 250px;
												"
											>
												<img src="../img/person.png">
												ทะเบียนผู้ขอใช้สิทธิ์
											</td>
											<td style="padding: 0px 10px 0px 10px;">
												<form id="registForm" method="post" action="registerSQL.php">
													<table>
														<tr>
															<td class="form_field">โรงพยาบาล</td>
															<td class="form_input">
																<input type="text" id="Hospital" name="Hospital" value="<?php echo $Hospital?>" readonly
																	style="
																		float: left;
																		width: 50px;
																		text-align: center;
																		padding: 1px;
																		background-color: #eee;
																		border: 1px #aaa solid;
																	" 
																><input type="text" name="HospitalName" id="HospitalName"
																	style="
																		float: left;
																		width: 200px;
																		padding: 1px;
																		background-color: #fff;
																		border: 1px #aaa solid;
																	"
			
																	readonly
																><?php
																	if($_SESSION["admin_permission"]=="global"){
																		?><input type="button" id="hospitalBrowseButton" value="ค้นหา" style="float: left;height: 20px;margin: 0px;padding: 0px;"
																			onclick="
																				$.get('hospitalList.php',{},function(data){
																						$('#hospitalListDetail').html(data);
																						$('#hospitalListFrame').css('top',$('#hospitalBrowseButton').position().top);
																						$('#hospitalListFrame').css('left',$('#hospitalBrowseButton').position().left+1);
																						$('#hospitalListFrame').fadeIn();
																					}
																				);
																			"
																		><?php
																	} 
																?>
															</td>
														</tr>
														<tr>
															<td colspan="2"><hr /></td>
														</tr>
														<tr>
															<td class="form_field">Hospital Number (HN)</td>
															<td class="form_input">
																<input class="focus" type="text" name="HospitalNumber" id="HospitalNumber"
																	onkeypress="
																		if(event.keyCode==13){
																			$('#blnLoadMember').click();
																			$('#Name').focus();
																		}
																	"
																>
															</td>
														</tr>
														<tr>
															<td class="form_field">หมายเลขบัตรประชาชน</td>
															<td class="form_input">
																<input type="text" name="CitizenID" id="CitizenID"
																	onkeypress="
																		if(event.keyCode==13){
																			$('#blnLoadMember').click();
																			$('#Name').focus();
																		}
																	"
																/><input id="555blnLoadMember" type="button" value=" Get Details "
																	onclick="
																		$.post('get_patient2.php',{
																				hospCode: $('#Hospital').val(),
																				hospitalNumber: $('#HospitalNumber').val()
																			},function(data){
																				//alert(data);
																				var aaa=data.split('::');
																				if(aaa[1]!=''){
																					$('#Prefix').val(aaa[0]);
																					$('#Name').val(aaa[1]+' '+aaa[2]+' '+aaa[3]);
																					var bd=aaa[4].split('-');
																					$('#BirthDate').val(bd[2]+'/'+bd[1]+'/'+(parseInt(bd[0])+543));
																					//$('#Gender').val(aaa[5]);
																					$('#Telephone').val(aaa[6]);
																					$('#Email').val(aaa[7]);
																					$('#BloodGroupABO').val(aaa[8]);
																					$('#BloodTypeRh').val(aaa[9]);
																					$('#HospitalNumber').val(aaa[10]);
																					$('#CitizenID').val(aaa[11]);
																				}else{
																					alert('ไม่พบข้อมูลผู้ป่วย');
																				}
																			}
																		)
																	" 
																/>
															</td>
														</tr>
														<tr style="display: none;">
															<td class="form_field">
															</td>
															<td class="form_input">รายละเอียดผู้ป่วย
																<div id="MemberDetails"></div>
																<textarea id="MemberDetails2"></textarea>
															</td>
														</tr>
														<tr style="display: none;">
															<td class="form_field">
															</td>
															<td class="form_input">รายละเอียดผู้ป่วย2
																<div id="PatientDetails"></div>
															</td>
														</tr>
														<tr>
															<td class="form_field">ชื่อ นามสกุล</td>
															<td class="form_input">
																<input type="hidden" name="GivenName" id="GivenName">
																<input type="hidden" name="MiddleName" id="MiddleName">
																<input type="hidden" name="FamilyName" id="FamilyName">
																<input type="text" class="nextFocus" next="Telephone" name="Prefix" id="Prefix" readonly style="width: 30px;text-align: center;"
																><input type="text" class="nextFocus" next="Telephone" name="Name" id="Name">
															</td>
														</tr>
														<tr>
															<td class="form_field">หมายเลขโทรศัพท์</td>
															<td class="form_input"><input type="text" class="nextFocus" next="Email" name="Telephone" id="Telephone"></td>
														</tr>
														<tr>
															<td class="form_field">อิเมล์</td>
															<td class="form_input"><input type="text" class="nextFocus" next="BloodGroup" name="Email" id="Email"></td>
														</tr>
														<tr>
															<td class="form_field">กรุ๊ปเลือด</td>
															<td class="form_input">
																<input type="text" class="nextFocus" next="BloodTypeRh" name="BloodGroupABO" id="BloodGroupABO" style="width: 50px;">
																&nbsp;
																Rh <input type="text" class="nextFocus" next="PerDay" name="BloodTypeRh" id="BloodTypeRh" style="width: 50px;">
															</td>
														</tr>
														<tr>
															<td class="form_field">วันเดือนปีเกิด</td>
															<td class="form_input">
																<input type="text" class="nextFocus date-pick" next="BloodTypeRh" name="BirthDate" id="BirthDate" size="10"
																><img src="<?php echo $mainUrl?>/img/calendar.png"
																	style="
																		margin-bottom: -3px;
																		padding-left: 3px;
																		cursor: pointer;
																	"
																	onclick="$('#BirthDate').focus();"
																>
															</td>
														</tr>
														<tr>
															<td class="form_field">ต้องการเก็บประวัติข้อมูลแลป</td>
															<td class="form_input">
																<input id="PerDay" type="radio" class="nextFocus" next="AllowDate" name="AllowType" value="Perday" checked style="float: left;">
																<div onclick="$('#PerDay').click()"
																	style="
																		padding-right: 15px;
																		float: left;
																		cursor: pointer;
																	"
																>เฉพาะวันนี้</div>
																<input id="BeginDay" type="radio" name="AllowType" value="Unconditioned" style="float: left;">
																<div onclick="$('#BeginDay').click()"
																	style="
																		padding-right: 15px;
																		float: left;
																		cursor: pointer;
																	"
																>ตั้งแต่วันนี้</div>
															</td>
														</tr>
														<tr>
															<td class="form_field">วันที่สมัคร</td>
															<td class="form_input">
																<input type='text' id="AllowDate" name='AllowDate' size="10" 
																	class="date-pick"
																	onchange='return checkdate(this);'
																	value="<?php echo date("d/m/").(date("Y")+543)?>";
																><img src="<?php echo $mainUrl?>/img/calendar.png"
																	style="
																		margin-bottom: -3px;
																		padding-left: 3px;
																		cursor: pointer;
																	"
																	onclick="$('#AllowDate').focus();"
																>
															</td>
														</tr>
														<tr id="confirmTypeTR">
															<td class="form_field">วิธีการยืนยันสิทธิ์</td>
															<td class="form_input">
																<select id="confirmType">
																	<option value="email">ยืนยันผ่าน Email</option>
																	<option value="document">สร้างบัญชีผู้ใช้งาน</option>
																</select>
															</td>
														</tr>
														<tr id="currentUserTR" style="display:none">
															<td class="form_field">สถานะผู้ใช้งาน</td>
															<td class="form_input">ผู้ใช้งานปัจจุบัน<input type="hidden" id="currentUser" name="currentUser" value="false"></td>
														</tr>
														<tr>
															<td colspan="2"><hr /></td>
														</tr>
														<tr>
															<td class="form_input" id="div_AllowStatus" colspan="2"></td>
														</tr>
														<!-- 
															<tr>
																<td colspan="2"><hr /></td>
															</tr>
															<tr>
																<td class="form_field">User</td>
																<td class="form_input">
																	<input id="User" type="text" class="text-input" name="User" value="" />
																</td>
															</tr>
															<tr>
																<td class="form_field">Password</td>
																<td class="form_input">
																	<input id="Password" type="password" class="text-input password" name="Password" value=""
																		size="8"
																	/><input id="generate" class="link-password" type="button" value=" Generate Password " /><br>
																	<div class="form-row text-right" id="random"></div>
																</td>
															</tr>
														-->
													</table>
												</form>
											</td>
											<td
												style="
													width: 20px;
													background-image: url('../img/shadowRight.png');
													background-repeat: no-repeat;
													background-position: left center;
													background-size: 20px 250px;
												"
											>&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="form_footer">
									<input class="nprButton" type='reset' value="   กลับสู่หน้าหลัก   " style="float: left;"
										onclick="
											/*var HospitalName=$('#HospitalName').val();
											$('#registForm')[0].reset();
											$('#HospitalName').val(HospitalName);*/
											window.open('../admin','_self');
										"
									>
									<input id="submitButton" class="nprButton" type='submit' value="   บันทึก   "
										onclick="
											var	Hospital=$('#Hospital').val();
											var	HospitalName=$('#HospitalName').val();
											var	HospitalNumber=$('#HospitalNumber').val();
											var	CitizenID=$('#CitizenID').val();
											var	Name=$('#Name').val();
											var	Telephone=$('#Telephone').val();
											var	Email=$('#Email').val();
											var	TypeKeep=$('#TypeKeep').val();
											var	User=$('#User').val();
											var	Password=$('#Password').val();
											var confirmType=$('#confirmType').val();
											var currentUser=$('#currentUser').val();
											
											if(Hospital==''){
												alert('กรุณาระบุโรงพยาบาล');
											}else if(HospitalNumber==''){
												alert('กรุณาระบุ Hospital Number (HN)');
											}else if(CitizenID==''){
												alert('กรุณาระบุ CitizenID');
											}else if(Name==''){
												alert('กรุณากรอก ชื่อ-นามสกุล');
											}else if(Telephone==''){
												alert('กรุณากรอกหมายเลขโทรศัพท์');
											}else if(Email==''){
												alert('กรุณากรอก อีเมล์');
											}else if(confirmType=='email'){
												$('#registForm').submit();
											}else if(currentUser=='true'){
												$('#registForm').attr('action','registerSQL.php');
												$('#registForm').submit();
											}else if(confirmType=='document'){
												$('#registForm').attr('action','createDocumentSQL.php');
												$('#registForm').submit();
											}
										";
									>
								</td>
							</tr>
						</table>
					</div>
					<div id='feedbackpanel' style="display: none;">
						<div id='requestUrl'></div>
						<pre id='request'></pre>
						<hr />
						<h2 id='feedbackHeader'></h2>
						<pre id='feedback'></pre>
					</div>
					<div id="hospitalListFrame" class="frame"
						style="
							display: none;
							position: absolute;
							z-index: 1000;
							width: 300px;
						"
					>
						<table style="width: 300px;">
							<tr>
								<td style="height: 20px;" class="frame_header">
									<div style="float: left">:: กรุณาเลือกโรงพยาบาล</div>
									<img src="../img/close.png"
										onclick="$('#hospitalListFrame').fadeOut();"
										style="
											padding: 2px;
											float: right;
											cursor: pointer;
										"
									>
								</td>
							</tr>
							<tr>
								<td>
									คำค้น <input type="text" id="keyword" name="keyword" style="width: 240px;"
										onkeyup="
											$.get('hospitalList.php',{
													keyword: $('#keyword').val()
												},function(data){
													$('#hospitalListDetail').html(data);
													$('#hospitalListFrame').css('top',$('#hospitalBrowseButton').position().top);
													$('#hospitalListFrame').css('left',$('#hospitalBrowseButton').position().left+1);
													$('#hospitalListFrame').fadeIn();
												}
											);
										"
									>
									<div id="hospitalListDetail" style="width: 100%;height: 200px;overflow: auto"></div>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>