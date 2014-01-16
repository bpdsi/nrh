<html>
	<head>
		<title>jQuery.soap demo page</title>
		<style>
			body {
				background: #E0E0E0;
				font-family: Helvetica, Verdana, Arial, sans-serif;
			}
			h1, h2 {
				padding: 15px 25px;
			}
			form {
				width: 50%;
				float: left;
			}
			div#feedbackpanel {
				width: 49%;
				float: right;
			}
			fieldset {
				border: 0;
				padding: 8px 15px 8px 25px;
			}
			label {
				display: inline-block;
				width: 35%;
			}
			input, textarea, select, button {
				width: 60%;
			}
			input.no_width {
				width: auto;
			}
			pre, code {
				padding:20px;
				box-sizing:border-box;
				-moz-box-sizing:border-box;
				webkit-box-sizing:border-box;
				display:block; 
				white-space: pre-wrap;  
				white-space: -moz-pre-wrap; 
				white-space: -pre-wrap; 
				white-space: -o-pre-wrap; 
				word-wrap: break-word; 
				width:100%;
				overflow-x:auto;
			}
			footer {
				clear: both;
			}
		</style>
		<!-- jquery from cdn at (mt) Media Temple -->
		<script type='text/javascript' src='http://code.jquery.com/jquery-1.10.0.min.js'></script>
		<script type='text/javascript' src='./js/jquery.soap.js'></script>
		<script type='text/javascript'>
			$(document).ready(function() {
				$('#test').click(function(e) {
					// stop the form to be submitted...
					e.preventDefault();
					var params = $('#params').val();
					if ($('#paramsType').val() == 'json') {
						params = eval("("+params+")");
					}
					var wss = {};
					if ($('#enableWSS').prop('checked')) {
						wss = {
							username: $('#wssUsername').val(),
							password: $('#wssPassword').val(),
							nonce: 'aepfhvaepifha3p4iruaq349fu34r9q',
							created: new Date().getTime()
						};
					}
					$.soap({
						url: 'http://nrh.dyndns.org/soap_disaster/refer_service.php?wsdl'
						method: 'QueryPatient',
						params: {
							PersonID: '1111111111111'
						},
						success: function (soapResponse) {
							// do stuff with soapResponse
							alert('yes');
							$('#feedbackHeader').html('Success!');
							$('#feedback').text(SOAPResponse.toString());
						},
						error: function (soapResponse) {
							alert('that other server might be down...')
							$('#feedbackHeader').html('Error!');
							$('#feedback').text(SOAPResponse.toString());
						}
					});
				});
			});
		</script>
	</head>
	<body>
		<input id="blnLoadMember2" type="button" value="Get Details2" />
	<div id='feedbackpanel'>
	<div id='requestUrl'></div>
	<pre id='request'></pre>
	<hr />
	<h2 id='feedbackHeader'></h2>
	<pre id='feedback'></pre>
</div>
	</body>
</html>