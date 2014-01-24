<?php
	require '../sendmail/phpMailer/class.phpmailer.php';

	function host($dbName){
		global $host_db;
		global $user_db;
		global $password_db;
		global $database_name;
		global $conDB;
		global $objDB;
		$host_db="localhost";
		$user_db="npr";
		$password_db="1234";
		$conDB=mysql_connect($host_db,$user_db,$password_db) or die ("Something is going wrong");
		
		mysql_query("SET character_set_connection = UTF8")or die(mysql_error());
		mysql_query("SET character_set_client = UTF8")or die(mysql_error());
		mysql_query("SET character_set_results = UTF8")or die(mysql_error());
		mysql_query("SET NAMES UTF8")or die(mysql_error());
		$objDB=mysql_select_db($dbName);
	}

	function get_cfgValue($cfgName){
		host("nrh");
		$query="
			select	cfgValue
			from	config
			where	cfgName='$cfgName'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		return $row[cfgValue];
	}

	$mailTo="thanaphutBenz@gmail.com";
	$subject="Test Mail";
	$message="Tes test Test";

	$mainUrl=get_cfgValue("mainUrl");

	$mail = new PHPMailer();
	$mail->SetLanguage("en","../sendmail/phpMailer/language/"); 
	$mail->IsHTML(true); 
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->Host = "ssl://smtp.gmail.com:587";
	$mail->Username = "thanaphutBenz@gmail.com"; // GMAIL username
	$mail->Password = "Benz8157"; // GMAIL password
	$mail->FromName = "Personal Health Databank";
	$mail->From = "vasutap@gmail.com";


	if(trim($mailTo)!=""){
		$mailx=$mail;
		$mailx->Subject =$subject;
		$mailx->Body = $message;
		$mailx->AddAddress($mailTo);
		if(!$mail->Send()) {
			echo "Fail";
			$mail->ClearAddresses();
		}else{
			$mail->ClearAddresses();
			$msg="";
			$message="";
			echo "Success";
		}
	}else{
		echo "Fail";
	}