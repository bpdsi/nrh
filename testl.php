<html>
	<head>
		<title>jQuery.soap demo page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
						url: $('#url').val(),
						method: $('#method').val(),

						appendMethodToURL: $('#appendMethodToURL').prop('checked'),
						SOAPAction: $('#SOAPAction').val(),
						soap12: $('#soap12').prop('checked'),

						params: params,
						wss: wss,

						namespaceQualifier:  $('#namespaceQualifier').val(),
						namespaceURL: $('#namespaceURL').val(),
						elementName: $('#elementName').val(),

						enableLogging: $('#enableLogging').prop('checked'),

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
				});
			});
		</script>
	</head>
	<body>
		<h1>jQuery.soap demo page</h1>
		<hr />
		<form>
			<fieldset>
				<label>url:</label>
				<input type='text' id='url' value='http://nrh.dyndns.org/demo/lab_service.php' size='70' />
			</fieldset>
			<fieldset>
				<label>method:</label>
				<input type='text' id='method' value='QueryLab' />
			</fieldset>
			<fieldset>
				<label>appendMethodToURL:</label>
				<input type='checkbox' id='appendMethodToURL' class='no_width' />
			</fieldset>
			<fieldset>
				<label>SOAPAction:</label>
				<input type='text' id='SOAPAction' value='action' />
			</fieldset>
			<fieldset>
				<label>soap12:</label>
				<input type='checkbox' id='soap12' class='no_width' />
			</fieldset>
			<fieldset>
				<label>params:</label> 
				<select id='paramsType'>
					<option value='xml'>XML String</option>
					<option value='json'>JSON</option>
				</select>
			</fieldset>
			<fieldset>
				<label>XML String:<br />&lt;test&gt;some text here...&lt;/test&gt;<br /><br />JSON example:<br />{ test: 'some text here...' }</label>
				<textarea id='params' rows='10' cols='50'><SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns7030:QueryLab xmlns:ns7030="http://tempuri.org"><CitizenID xsi:type="xsd:string">3939900078370</CitizenID></ns7030:QueryLab></SOAP-ENV:Body></SOAP-ENV:Envelope></textarea>
			</fieldset>
			<fieldset>
				<label>namespace:</label>
				<input type='text' id='namespaceQualifier' value='xsd' class='no_width' size='5' />
				<input type='text' id='namespaceURL' value='http://nrh.dyndns.org/demo/lab_service.php' class='no_width' size='30' />
			</fieldset>
			<fieldset>
				<label>elementName:</label>
				<input type='text' id='elementName' value='' />
			</fieldset>
			<fieldset>
				<label>enableLogging:</label>
				<input type='checkbox' id='enableLogging' class='no_width' checked='checked' />
			</fieldset>
			<h2>WSS</h2>
			<fieldset>
				<label>enableWSS:</label>
				<input type='checkbox' id='enableWSS' class='no_width' />
			</fieldset>
			<fieldset>
				<label>username:</label>
				<input type='text' id='wssUsername' value='' />
			</fieldset>
			<fieldset>
				<label>password:</label>
				<input type='text' id='wssPassword' value='' />
			</fieldset>
			<fieldset>
				<label>&nbsp;</label>
				<button id='test'>Start jQuery.soap Test!!</button>
			</fieldset>
		</form>
		<div id='feedbackpanel'>
			<div id='requestUrl'></div>
			<pre id='request'></pre>

			<hr />
			<h2 id='feedbackHeader'></h2>
			<pre id='feedback'></pre>
		</div>
		<footer>
			<hr />
			More info on this plugin at <a href='https://github.com/doedje/jquery.soap'>github.com/doedje/jquery.soap</a>
		</footer>
	</body>
</html>