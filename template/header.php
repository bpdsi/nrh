<?php
	session_start();
	$permission=$_SESSION["admin_permission"];
	include "../function/functionPHP.php";
	noCache();
	$authen=patientAuthenticated();
	$adminAuthen=adminAuthenticated();
	
	if($functionName=="Administrator"){
		if(!$adminAuthen){
			header("location:../admin/authen.php");
			exit();
		}
	}else{
		if(!$authen){
			header("location:../authen/index.php");
			exit();
		}
	}
		
	host("nrh");
	
	if($functionName=="Administrator"){
		$query="
			select	*
			from	admin
			where	User='".$_SESSION["admin_User"]."'
		";
	}else{
		if($authen=="person"){
			$query="
				select	*
				from	person
				where	User='".$_SESSION["sess_User"]."'
			";
			$vcPrefix="vc";		
		}else if($authen=="vc_person"){
			$query="
				select	*
				from	vcp_person
				where	User='".$_SESSION["sess_vc_User"]."'
			";
			$vcPrefix="vcp";
		}		
	}

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
		<title>Personal Health Databank</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="../img/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- CSS -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/npr.css">
		
		<!-- jQuery -->
			<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
		
		<!-- datePicker -->
			<script src="../js/jquery-ui.js"></script>
			<link rel="stylesheet" type="text/css" media="screen" href="../css/jquery-ui.css">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/datePicker.css">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/demo.css">
			
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

				$( "#BirthDate" ).datepicker({
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
			});

			$('document').ready(function(){
				$('.menu_logout').click(function(){
					<?php
						if($functionName=="Administrator"){
							?>window.open('../admin/logout.php','_self');<?php
						}else{
							?>window.open('../authen/logout.php','_self');<?php
						}
					?>
				});
			})
		</script>
		<style type="text/css">
			.form_input{
				font-weight: bold;
			}
			.homeIcon{
				width: 150px;
				border: 1px solid #aaa;
				margin: 10px;
				text-align: center;
				padding: 10px;
				color: #888;
				cursor: pointer;
				font-weight: bold;
			}
			.homeIcon:hover{
				-moz-box-shadow: 2px 2px 10px #aaa;
				-webkit-box-shadow: 2px 2px 10px #aaa;
				box-shadow: 2px 2px 5px #aaa;
				zoom: 1;
				filter:
					progid:DXImageTransform.Microsoft.Shadow(color=#dddddd,direction=0,strength=1),
					progid:DXImageTransform.Microsoft.Shadow(color=#dddddd,direction=45,strength=1),
					progid:DXImageTransform.Microsoft.Shadow(color=#dddddd,direction=90,strength=2),
					progid:DXImageTransform.Microsoft.Shadow(color=#dddddd,direction=135,strength=3),
					progid:DXImageTransform.Microsoft.Shadow(color=#cccccc,direction=180,strength=10),
					progid:DXImageTransform.Microsoft.Shadow(color=#dddddd,direction=225,strength=3),
					progid:DXImageTransform.Microsoft.Shadow(color=#dddddd,direction=270,strength=2),
					progid:DXImageTransform.Microsoft.Shadow(color=#dddddd,direction=315,strength=1);  		
			}
		</style>
	</head>
	<body>
		<div class="home" 
			style="
				width: 1000px;
				height: 100%;
				margin-left: auto;
				margin-right: auto;
				background-color: #fff;
			"
		>
			<table class="home" style="width: 100%;height:100%;">
				<tr>
					<td class="home_header">
						<div style="font-size: 30px;float: left;font-weight: bold;cursor: pointer;"
							onclick="
								<?php
									if(patientAuthenticated()=="vc_person"){
										?>window.open('../vaccine','_self')<?php
									}else{
										?>window.open('../home','_self')<?php
									}
								?>
								
							"
						>Personal Health Databank</div>
						<img src="../img/nectecLogo.png" height="40" style="float: right;margin: 0px 10px 0px 10px">
						<img src="../img/kuLogo.png" height="40" style="float: right;margin: 0px 10px 0px 10px">
						<img src="../img/etdaLogo.png" height="40" style="float: right;margin: 0px 10px 0px 10px">
					</td>
				</tr>
				<tr>
					<td class="home_menu">
						<div class="functionName"><?php echo $functionName;?></div>
						<?php
							if($functionName=="Administrator"){
								if($permission=="admin"){
									$permissionName="ผู้ดูแลระบบโรงพยาบาล";
								}else if($permission=="officer"){
									$permissionName="เจ้าหน้าที่ลงทะเบียนผู้ขอใช้สิทธิ์";
								}else if($permission=="global"){
									$permissionName="ผู้ดูแลระบบ";
								}
								?><div>Welcome <?php echo $_SESSION["admin_Person"]["PersonName"]?> [<?php echo $permissionName?>] <input class="menu_logout" type="button" value="  ออกจากระบบ  "></div><?php
							}else{
								if($authen=="person"){
									?><div>Welcome <?php echo $_SESSION["sess_Person"]["PersonName"]?> <input class="menu_logout" type="button" value="  ออกจากระบบ  "></div><?php
								}else{
									?><div>Welcome <?php echo $_SESSION["sess_vc_Person"]["PersonName"]?> <input class="menu_logout" type="button" value="  ออกจากระบบ  "></div><?php
								}
							}
						?>
					</td>
				</tr>
				<tr>
					<?php
						if($adminAuthen){
							?><td class="home_body" style="vertical-align: top;padding: 0px;"><?php
						}else{
							?><td class="home_body" style="vertical-align: top;"><?php
						}
					?>