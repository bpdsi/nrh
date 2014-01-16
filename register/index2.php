<?
include"../config/connection.php";
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- jQuery -->
<!--<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>-->
<script type='text/javascript' src='http://code.jquery.com/jquery-1.10.0.min.js'></script>
<script type='text/javascript' src='../js/jquery.soap.js'></script>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>-->

<!-- required plugins -->
<script type="text/javascript" src="../js/date.js"></script>
<!--[if IE]><script type="text/javascript" src="scripts/jquery.bgiframe.js"></script><![endif]-->

<!-- jquery.datePicker.js -->
<script type="text/javascript" src="../js/jquery.datePicker.js"></script>
<!-- datePicker required styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../css/datePicker.css">
<link rel="stylesheet" type="text/css" media="screen" href="../css/demo.css">
<script language="JavaScript" type="text/javascript">
$(function(){
	$('.date-picker').dpSetStartDate('01/01/2000');
	$('.date-picker').dpSetEndDate('01/01/2800');
	$('.date-pick').datePicker({autoFocusNextInput: true,changeMonth: true, changeYear: true })
})
function GetMember() {
    $('input[type=button]').attr('disabled', true);
    $("#MemberDetails").html('');
    $("#MemberDetails").addClass("loading");
	var wsUrl = "http://nrh.dyndns.org/soap_disaster/refer_service.php?wsdl/QueryPatient";
    var soapRequest ='<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">   <soap:Body> <getQuote xmlns:impl="http://nrh.dyndns.org/production/refer_service.php?wsdl">  <xsd:element name="PersonID" type="xsd:string">'+ $("#Citizenid").val() + '</xsd:element>   </getQuote> </soap:Body></soap:Envelope>';
	
    //alert(soapRequest)
	//data: "{'PersonID': '" + $("#Citizenid").val() + "'}",
	//contentType: "text/xml; charset=utf-8",
    $.ajax({
        type: "POST",
        url: wsUrl,
        data: "{'PersonID': '" + $("#Citizenid").val() + "'}",
		contentType: "text/xml",
        dataType: "xml",
		
        success: OnGetMemberSuccess,
        error: OnGetMemberError
    });
	/*alert($("#Citizenid").val());
	$.ajax({
		type: "POST",
		url: "../refer_service.php?wsdl/QueryPatient",
		data: "{'PersonID': '" + $("#Citizenid").val() + "'}",
		contentType: "text/xml; charset=utf-8",
		dataType: "xml",
		processData: false,
		error: function (XMLHttpRequest, textStatus, errorThrown) { OnGetMemberError(XMLHttpRequest, textStatus, errorThrown); },
		success: function (xmlHttpRequest,status) { OnGetMemberSuccess(xmlHttpRequest,status); }
	});
	*/
}

function GetMemberxx() {
    $('input[type=button]').attr('disabled', true);
    $("#MemberDetails").html('');
    $("#MemberDetails").addClass("loading");
    $.ajax({
        type: "POST",
        url: "../refer_service.php?wsdl/QueryPatient",
        data: "{'PersonID': '" + $("#Citizenid").val() + "'}",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: OnGetMemberSuccess,
        error: OnGetMemberError
    });
}

function OnGetMemberSuccess(data, textStatus , req) {
//function OnGetMemberSuccess(xmlHttpRequest,status) {
    //jQuery code will go here...
	
	//alert(textStatus);
	if (textStatus == "success"){
        $("#MemberDetails").text($(req.responseXML).find("referDetails").text());
		$("#MemberDetails").text("vasuthep");
	}
	alert(req.responseXML);
    alert("Success");
	$("#MemberDetails").removeClass("loading");
    $("#MemberDetails").html(data.d);
    $('input[type=button]').attr('disabled', false);
	/*alert($(xmlHttpRequest.responseXML).text());
	/*$(xmlHttpRequest.responseXML)
    .find('item')
    .each(function () {
        alert( $(this).find('patientDetail').text());
    });*/
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
function getPatientxx(){
alert("xx");
	var params = $('#Citizenid').val();
	/*if ($('#paramsType').val() == 'json') {
		params = eval("("+params+")");
	}*/
	var wss = {};
	/*if ($('#enableWSS').prop('checked')) {
		wss = {
			username: $('#wssUsername').val(),
			password: $('#wssPassword').val(),
			nonce: 'aepfhvaepifha3p4iruaq349fu34r9q',
			created: new Date().getTime()
		};
	}*/
	$.soap({
		url: "http://nrh.dyndns.org/soap_disaster/refer_service.php?wsdl",//$('#url').val(),
		method: "QueryRefer",//$('#method').val(),

		/*appendMethodToURL: $('#appendMethodToURL').prop('checked'),
		SOAPAction: $('#SOAPAction').val(),
		soap12: $('#soap12').prop('checked'),*/

		params: params,
		wss: wss,

		/*namespaceQualifier:  $('#namespaceQualifier').val(),*/
		namespaceQualifier:  "xsd",
		/*namespaceURL: $('#namespaceURL').val(),*/
		namespaceURL:"http://nrh.dyndns.org/soap_disaster/refer_service.php",
		/*elementName: $('#elementName').val(),*/
		elementName: "",

		/*enableLogging: $('#enableLogging').prop('checked'),*/

		request: function(SOAPRequest) {
			$('#request').text(SOAPRequest);
		},
		success: function(SOAPResponse) {
			$('#feedbackHeader').html('Success!');
			$('#feedback').text(SOAPResponse.toString());
		},
		error: function(SOAPResponse) {
			$('#feedbackHeader').html('Error!');
			$('#feedback').text(SOAPResponse.toString());
		}
	});
}

$(document).ready(function() {
	$('#blnLoadMember2').click(function(e) {
	// stop the form to be submitted...
	e.preventDefault();
	alert("xx");
	var params = $('#Citizenid').val();
	var wss = {};
	$.soap({
		url: "http://nrh.dyndns.org/soap_disaster/refer_service.php",
		method: "QueryPatient",
		
		appendMethodToURL: true,
		SOAPAction: 'action',
		soap12: false,
		params: params,
		wss: wss,

		namespaceQualifier:  "xsd",
		namespaceURL:"http://nrh.dyndns.org/soap_disaster/refer_service.php",
		elementName: "",

		enableLogging: true ,
		request: function(SOAPRequest) {
			$('#request').text(SOAPRequest);
		},
		success: function(SOAPResponse) {
			alert("Success");
			$('#feedbackHeader').html('Success!');
			$('#feedback').text(SOAPResponse.toString());
		},
		error: function(SOAPResponse) {
			alert("Error");
			$('#feedbackHeader').html('Error!');
			$('#feedback').text(SOAPResponse.toString());
		}
	});
	});
});
			
function processResponse(respObj) {
//respObj is a JSON equivalent of SOAP Response XML (all namespaces are dropped)
//... do something with response
	alert(respObj.result);
}
</script>
</head>
<h3>ลงทะเบียน</h3>
<table>
	<tr><td></td></tr>
	<tr>
		<td>โรงพยาบาล</td>
		<td>
			<select name="hospital">
				<option value="">เลือกโรงพยาบาลที่สังกัด</option>
				<?
					$sql="select hospcode as hospital, concat(hosptype,name) as hospitalname 
							from hos.hospcode 
							where hospital_type_id=1
							order by  hospcode";
					$r=mysql_query($sql)or die("<br>hospital<br>".mysql_error()."<br>".$sql);
					while($row=mysql_fetch_array($r)):
							echo"<option value=\"".$row["hospital"]."\">".$row["hospitalname"]."</option>";
					endwhile;
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Hospital Number</td>
		<td><input type="text" name="HospitalNumber"></td>
	</tr>
	<tr>
		<td>Citizenid</td>
		<td><input type="text" name="Citizenid" id="Citizenid"></td>
	</tr>
	<tr>
		<td colspan="2">
			<input id="blnLoadMember" type="button" value="Get Details" onclick="GetMember(); return false;"/>
			<input id="blnLoadMember2" type="button" value="Get Details2" />
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="MemberDetails">xxxx</div>
		</td>
	</tr>
	<tr>
		<td>GivenName FamilyName</td>
		<td><input type="text" name="Name"></td>
	</tr>
	<tr>
		<td>Telephone</td>
		<td><input type="text" name="Mobile"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><input type="text" name="Email"></td>
	</tr>
	<tr>
		<td>ต้องการเก็บประวัติข้อมูลแลป</td>
		<td>
			<input type="radio" name="TypeKeep" value="PerDay">เฉพาะวันนี้
			<input type="radio" name="TypeKeep" value="BeginDay">ตั้งแต่วันนี้
		</td>
	</tr>
	<tr>
		<td>วันที่สมัคร</td>
		<td>
			<input type='text' name='BeginDate' onChange='return checkdate(this);' class="date-pick">
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right">
			<input type='submit' value="บันทึก"><input type='reset' value="ยกเลิก">
		</td>
	</tr>
</table>
<div id='feedbackpanel'>
	<div id='requestUrl'></div>
	<pre id='request'></pre>
	<hr />
	<h2 id='feedbackHeader'></h2>
	<pre id='feedback'></pre>
</div>