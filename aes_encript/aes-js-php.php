<?php 
  require 'aes.class.php';     // AES PHP implementation
  require 'aesctr.class.php';  // AES Counter Mode implementation 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>AES JavaScript+PHP test harness (server-side decrypt)</title>
	</head>
	<body>
		<!-- output the post array received and dectypt the message -->
		<pre>$_POST: <?= print_r($_POST, true) ?></pre>
		<pre>Plaintext: <?= AesCtr::decrypt($_POST['message'], 'k.vasuthep16', 256) ?></pre>
		<pre>Plaintext: <?= AesCtr::encrypt("benz", 'k.vasuthep16', 256) ?></pre>
		<pre>Plaintext: <?= AesCtr::decrypt("ef9sxsaODVJRWyer", 'k.vasuthep16', 256) ?></pre>
	</body>
</html>