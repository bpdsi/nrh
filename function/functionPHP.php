<?php
	date_default_timezone_set('Asia/Bangkok');
	$mainUrl=get_cfgValue("mainUrl");
	require 'aes.class.php';
  	require 'aesctr.class.php';
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
	
	function aesEncrypt($message){
  		return AesCtr::encrypt($message, get_cfgValue("aesKey"), get_cfgValue("aesBit"));
	}
	
	function aesDecrypt($message){
  		return AesCtr::decrypt($message, get_cfgValue("aesKey"), get_cfgValue("aesBit"));
	}
	
	function sendMail($mailTo,$toName,$subject,$message){
		/*$host= "http://".$_SERVER['SERVER_ADDR'];
		$smail=",vasutap@hotmail.com,immwwi@gmail.com";
		$amail=split(",",$smail);*/
		
		/*$smtpHost=get_cfgValue("smtpHost");
		$smtpUsername=get_cfgValue("smtpUsername");
		$smtpPassword=get_cfgValue("smtpPassword");
		$smtpFromName=get_cfgValue("smtpFromName");
		$smtpFromMail=get_cfgValue("smtpFromMail");*/
		
		$mail = new PHPMailer();
		$mail->SetLanguage("en","../sendmail/phpMailer/language/"); 
		$mail->IsHTML(true); 
		$mail->IsSMTP();
		$mail->SMTPAuth = true; // enable SMTP authentication
		$mail->Host = get_cfgValue("smtpHost");
		$mail->Username = get_cfgValue("smtpUsername"); // GMAIL username
		$mail->Password = get_cfgValue("smtpPassword"); // GMAIL password
		$mail->FromName = get_cfgValue("smtpFromName");
		$mail->From = get_cfgValue("smtpFromMail");

		if(trim($mailTo)!=""){
			$mailx=$mail;
			$mailx->Subject =$subject;
			$mailx->Body = $message;
			$mailx->AddAddress($mailTo);
			if(!$mail->Send()) {
				return fail;
				$mail->ClearAddresses();
			}else{
				$mail->ClearAddresses();
				$msg="";
				$message="";
				return true;
			}
		}else{
			return fail;
		}
	}
	
	function get_hospital($keyword){ //Return array of Hospital
		host("nrh");
		$query="
			select		hospcode as hospital, 
						concat(hosptype,name) as hospitalname,
						refer_url
			from 		hospcode 
			where 		(
							hosptype like '%โรงพยาบาล%' or
							hosptype like 'รพ.%' or
							hosptype like 'รพช.%'
						) and
						concat(hosptype,name) like '%$keyword%'
			order by	hospcode
		";
		$result=mysql_query($query) or die("<br>hospital<br>".mysql_error()."<br>".$sql);
		$numrows=mysql_num_rows($result);
		$i=0;
		while($i<$numrows){
			$row=mysql_fetch_array($result);
			$returnValue[$row[hospital]][hospitalname]=$row[hospitalname];
			$returnValue[$row[hospital]][refer_url]=$row[refer_url];
			$i++;
		}
		return $returnValue;
	}
	
	function get_hospitalName($hospcode){ //Return array of Hospital
		host("hos");
		$query="
			select		concat(hosptype,name) as hospitalname 
			from 		hos.hospcode 
			where 		hospcode='$hospcode'
		";
		$result=mysql_query($query) or die("<br>hospital<br>".mysql_error()."<br>".$sql);
		$row=mysql_fetch_array($result);
		return $row[hospitalname];
	}
	
	function staffAuthenticated(){
		return adminAuthenticated();
	}
	
	function adminAuthenticated(){
		session_start();
		host("nrh");
		$query="
			select	*
			from	admin
			where	User='".$_SESSION["admin_User"]."' and
					Password='".$_SESSION["admin_Password"]."'
		";
		$result=mysql_query($query);
		if(mysql_num_rows($result)>0){
			return "admin";
		}else{
			return false;
		}
	}
	
	function patientAuthenticated(){
		session_start();
		host("nrh");
		$query="
			select	*
			from	person
			where	User='".$_SESSION["sess_User"]."' and
					Password='".$_SESSION["sess_Password"]."'
		";
		$result=mysql_query($query);
		if(mysql_num_rows($result)>0){
			return "person";
		}else{
			$query="
				select	*
				from	vcp_person
				where	User='".$_SESSION["sess_vc_User"]."' and
						Password='".$_SESSION["sess_vc_Password"]."'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				return "vc_person";
			}else{
				return false;
			}
		}
	}
	
	function newPersonlID(){
		host("nrh");
		$query="
			select		*
			from		person
			order by	PersonalID desc
		";
		$result=mysql_query($query) or die("<br>person<br>".mysql_error()."<br>".$sql);
		$row=mysql_fetch_array($result);
		$PersonalID=$row[PersonalID]+1;
		return $PersonalID;
	}
	
	function newAllowID(){
		host("nrh");
		$query="
			select		*
			from		person_allow
			order by	AllowID desc
		";
		$result=mysql_query($query) or die("<br>person_allow<br>".mysql_error()."<br>".$sql);
		$row=mysql_fetch_array($result);
		$AllowID=$row[AllowID]+1;
		return $AllowID;
	}
	
	function get_person($PersonalID){
		host("nrh");
		$query="
			select	*
			from	person
			where	PersonalID='$PersonalID'
		";
		$result=mysql_query($query);
		return mysql_fetch_array($result);
	}
	
	function HospitalName($HospCode){
		host("nrh");
		$query="
			select	*
			from	hospcode
			where	hospcode='$HospCode'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		return $row[hosptype].$row[name];
	}
	
	function UniversalTestName($UniversalTestID){
		host("nrh");
		$query="
			select	UniversalTestName
			from	utest
			where	UniversalTestID='$UniversalTestID'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		return $row[UniversalTestName];
	}
	
	function utest($UniversalTestID){
		host("nrh");
		$query="
			select	*
			from	utest
			where	UniversalTestID='$UniversalTestID'
		";
		$result=mysql_query($query);
		return mysql_fetch_array($result);
	}
	
	function MethodName($MethodID){
		host("nrh");
		$query="
			select	MethodName
			from	method
			where	MethodID='$MethodID'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		return $row[MethodName];
	}
	
	function UnitName($UnitID){
		host("nrh");
		$query="
			select	UnitName
			from	unit
			where	UnitID='$UnitID'
		";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		return $row[UnitName];
	}
	
	function monNameENG($monNum){
		switch ($monNum){
			case "01": return "Jan";
			case "02": return "Feb";
			case "03": return "Much";
			case "04": return "Apr";
			case "05": return "May";
			case "06": return "Jun";
			case "07": return "Jul";
			case "08": return "Aug";
			case "09": return "Sep";
			case "10": return "Oct";
			case "11": return "Nov";
			case "12": return "Dec";
		}
	}
	
	function monNameTH($monNum){
		switch ($monNum){
			case "01": return "มกราคม";
			case "02": return "กุมภาพันธ์";
			case "03": return "มีนาคม";
			case "04": return "เมษายน";
			case "05": return "พฤษภาคม";
			case "06": return "มิถุนายน";
			case "07": return "กรกฎาคม";
			case "08": return "สิงหาคม";
			case "09": return "กันยายน";
			case "10": return "ตุลาคม";
			case "11": return "พฤษจิายน";
			case "12": return "ธันวาคม";
		}
	}
	
	function dateEncode($date){
		$temp=explode(" ", $date);
		$date=$temp[0];
		$time=$temp[1];
		
		$temp=explode("-", $date);
		$yearNum=$temp[0];
		$monNum=$temp[1];
		$dayNum=$temp[2];
		
		return $dayNum." ".monNameTH($monNum)." ".$yearNum." ".$time;
	}
	
	function noCache(){
		header("Cache-Control: no-cache, must-revalidate");
	}
	
	function headerEncode(){  //Set character code to TIS620 (by php header)
		header("Content-Type: text/plain; charset=UTF-8");
	}
	
	function numConvert($numInput,$sizeNowCodeTempNum){
		$numInput++;
		$numInput--;
		for($iNumConvert=strlen($numInput);$iNumConvert<=$sizeNowCodeTempNum-1;$iNumConvert++){
			$numInput="0$numInput";
		}
		$numOutput=$numInput;
		return $numInput;
	}
	
	function dayNameThai($dayNameEng){
		if($dayNameEng=="Sunday" || $dayNameEng==0){
			return "อาทิตย์";
		}		
		if($dayNameEng=="Monday" || $dayNameEng==1){
			return "จันทร์";
		}
		if($dayNameEng=="Tuesday" || $dayNameEng==2){
			return "อังคาร";
		}
		if($dayNameEng=="Wednesday" || $dayNameEng==3){
			return "พุธ";
		}
		if($dayNameEng=="Thursday" || $dayNameEng==4){
			return "พฤหัสบดี";
		}
		if($dayNameEng=="Friday" || $dayNameEng==5){
			return "ศุกร์";
		}
		if($dayNameEng=="Saturday" || $dayNameEng==6){
			return "เสาร์";
		}
	}
	function dayNameThaSet(){
		global $dayNameThas;
		for($i=0;$i<=6;$i++){
			$dayNameThas[$i]=dayNameThai($i);
		}
	}
	
	function monName($monNum){  //Return month name in Thai
		$monName=array("1"=>"มกราคม","2"=>"กุมภาพันธ์","3"=>"มีนาคม","4"=>"เมษายน","5"=>"พฤษภาคม","6"=>"มิถุนายน","7"=>"กรกฎาคม","8"=>"สิงหาคม","9"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
		$monNum++;
		$monNum--;
		return $monName[$monNum];
	}
	
	function dayNum($yearNum,$monNum,$dayNum){
		$today=getdate(mktime(00,00,00,$monNum,$dayNum,$yearNum)); //mktime(hr,mm,ss,mon,day,year);
		return $today[wday];
	}
	
	function maxDate($yearNum,$monNum){
		if($monNum=='02'){
			$firstString=substr($yearNum,2,1);
			$secondString=substr($yearNum,3,1);
			if(($firstString=='0') or ($firstString=='2') or ($firstString=='4') or ($firstString=='6') or ($firstString=='8')){
				if(($secondString=='0') or ($secondString=='4') or ($secondString=='8')){
					$maxDate=29;
				}else{
					$maxDate=28;
				}
			}else{
				if(($secondString=='2') or ($secondString=='6')){
					$maxDate=29;
				}else{
					$maxDate=28;
				}
			}
		}else{
			if(($monNum=='04') or ($monNum=='06') or ($monNum=='09') or ($monNum=='11')){
				$maxDate=30;
			}else{
				$maxDate=31;
			}
		}
		return $maxDate;
	}
	
	function genPassword($length){
		function getNumber(){
			return chr(rand(48, 57));
		}
		
		function getUpperCase(){
			return chr(rand(65, 90));
		}
		
		function getLowerCase(){
			return chr(rand(97, 122));
		}
		
		for($i=0;$i<$length;$i++){
			$characterType=rand(0,2);
			if($characterType==0){
				$returnPassword.=getNumber();
			}else if($characterType==1){
				$returnPassword.=getUpperCase();
			}else if($characterType==2){
				$returnPassword.=getLowerCase();
			}
		}
		
		return $returnPassword;
		
	}
	
	function dateConvert($date){
		$temp=explode("/", $date);
		$yearNum=$temp[2]-543;
		$monNum=$temp[1];
		$dayNum=$temp[0];
		
		return $yearNum."-".$monNum."-".$dayNum;
	}
	function dateRevert($date){
		$temp=explode("-", $date);
		$yearNum=$temp[0]+543;
		$monNum=$temp[1];
		$dayNum=$temp[2];
		
		return $dayNum."/".$monNum."/".$yearNum;
	}
	
	function vc_deletable($Vaccine_Code){
		host("nrh");
		$query="
			select	*
			from	vc_vaccination
			where	Vaccine_Code='$Vaccine_Code'
		";
		$result=mysql_query($query);
		if(mysql_num_rows($result)>0){
			return false;
		}else{
			$query="
				select	*
				from	vcp_vaccination
				where	Vaccine_Code='$Vaccine_Code'
			";
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0){
				return false;
			}else{
				return true;
			}
		}
	}