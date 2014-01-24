<?php
	$host= "http://".$_SERVER['SERVER_ADDR'];
	require_once('../sendmail/phpMailer/class.phpmailer.php'); 
	$smail=",vasutap@hotmail.com,immwwi@gmail.com";
	$amail=split(",",$smail);
	
	
	$mail = new PHPMailer();
	$mail->SetLanguage("en","../sendmail/phpMailer/language/"); 
	$mail->IsHTML(true); 
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	//$mail->SMTPSecure = 'tls';
	$mail->Host = 'ssl://smtp.gmail.com:465'; 
	//$mail->Host = 'smtp.alcotek.it:25'; 
	//$mail->Host = "smtp.gmail.com";
	//$mail->Port = 465; 
	$mail->Username = "vasutap@gmail.com"; // GMAIL username
	$mail->Password = "vasu16"; // GMAIL password
	$mail->FromName = "NPR Data Bank";
	$mail->From ="vasutap@gmail.com";
	$Name="วสุเทพ ขุนทอง";
	$subjectNm="ยืนยันการสมัคร เข้าใช้ NPR Data Bank";
	$message="<h3>เรียนคุณ".$Name."</h3><br><br>";
	$message.="&nbsp;&nbsp;&nbsp;กรุณายืนยันการเข้าใช้ระบบ  <a href='http://localhost/soap_health/register/'>ที่นี่</a>";
	$emailaddress="vasutap@yahoo.com";
	$footer="ขอบคุณ<br><br>หากมีปัญหา กรุณาติดต่อที่ เบอร์โทร <br>ขอบคุณครับ";
	//sendwarning($mail,$subjectNm,$message,$emailaddress,$footer);
	mail('vasutap@yahoo.com', 'My Subject', $message);
	
	function sendwarning($mail,$subjectNm,$message,$emailaddress,$footer){
		if(trim($emailaddress)!=""){
			$mailx=$mail;
			$mailx->Subject =$subjectNm;
			$mailx->Body = $message.$footer;
			$mailx->AddAddress($emailaddress);
			if(!$mail->Send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} 
			$mail->ClearAddresses();
			$msg="";
			$message="";
			echo "<hr>Send Email ".$emailaddress." Complete<hr>";
		}else{
			echo "<hr>Can't send ".$message." because user don't have email<hr>";
		}
	}
?>