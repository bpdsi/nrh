<?php
	include "../config/connection.php";
	include "../function/functionPHP.php";
	$mainUrl=get_cfgValue("mainUrl");
	if(!staffAuthenticated()){
		exit();
	}
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
			<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
			
		<!-- jQuery -->
			<script type='text/javascript' src='../js/jquery.soap.js'></script>

		<!-- required plugins -->
			<script type="text/javascript" src="../js/date.js"></script>
		
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
				Cufon.replace('h1.header');
			</script>
			
		<!-- CSS -->
			<link rel="stylesheet" type="text/css" media="screen" href="../css/npr.css">
		
		<!-- My jScript -->
			<script src="../function/functionJAVA.js" type="text/javascript"></script>
			
		<script type="text/javascript">
			$(function(){
				$('document').ready(function(){
					$('#menu_config').click(function(){
						$.post('configuration.php',function(data){
							$('#container').html(data);

							$('div.cfgValue').click(function(){
								$(this).hide();
								$(this).next().show();
								$(this).next().focus();
							});
						})
					});
				});
			})
		</script>

		<style type="text/css">
			/* Specific Form Rules */
			#form-demo {width: 330px; margin: 50px 0 100px 0; height: 170px; padding: 25px 10px 0 10px; background: url(images/bg_login.png) no-repeat 0 0;}
			#confirm {display: none;}
			.success {order: 1px solid; margin: 0; padding: 10px; text-align: center; color: #4F8A10; background-color: #ebf6d9; border-color: #DFF2BF;}
			
			.mainMenu_item{
				padding: 3px 10px 3px 10px;
			}
		 	.mainMenu_item:hover{
				background-color: #99C27E;
				cursor: pointer;
			}
			div.cfgValue{
				font-size: 17px;
				padding: 1px;
			}
			input[type=text].cfgValue{
				font-size: 17px;
			}
		</style>
	</head>
	<body>
		<div class="form" style="margin: 10px;">
			<table>
				<tr>
					<td style="border-right: 1px solid #aaa;padding: 0px 5px 0px 5px;" valign="top">
						<table>
							<tr>
								<td id="menu_config" class="mainMenu_item">Configuaration</td>
							</tr>
							<tr>
								<td class="mainMenu_item">Unit</td>
							</tr>
						</table>
					</td>
					<td id="container" valign="top"></td>
				</tr>
			</table>
		</div>
	</body>
</html>