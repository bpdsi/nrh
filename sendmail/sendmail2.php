<?
include "common.php";
require_once('./phpMailer/class.phpmailer.php'); 

$message = "<html>
<head>
	
	<title>BizIT 2009 Web Site : Email Template</title>
	<meta http-equiv='Content-Type' content='text/html; charset=tis-620' />
	<style type='text/css'>
		#content {text-align:center;margin:auto;}
		.intro{ font-size: 16px;text-align: center;color: #79A631;
}
		body{font-family:MS Sans Serif;font-size:80%;}
		.footer_1 {color:#79A631;text-align:center;font-size:1em;}
		.footer_2 {color: #676767;text-align:center;font-size:1em;}
		.content_bg_blue01 {background:#4D6A10;}
		.style7,.text1 {color:#FFF;font-weight:bold;}
		.content_bg_blue02 {background:#82B022;color:#FFF;}
		.content_bg_blue03 {background:#F2F6E9;}
		.style8 {color: #FFFFFF;font-weight: bold;}
		#welcome {width:725px;padding:20px 20px 10px 20px;background:#4D6A10;color:#FFF;margin:40px 0 0 0;border: 1px solid rgb(54, 137, 194);text-align:left;}
    </style>
	
</head>

<body>

<div id='content'>
<table align='center'>
<tr align='center'>
  <td class='intro'><div align='center'><a href='http://bizit.cpe.ku.ac.th'><img src='http://vivaldi.cpe.ku.ac.th/~imm/sendmail/Label.png' width='784' height='360' border='0' usemap='#Poster' style='padding-bottom:25px;'></a></div></td>
</tr>
</table>

<a href='http://bizit.cpe.ku.ac.th/register/register.php'><img src='http://bizit.cpe.ku.ac.th/images/email_poster.jpg' width='650' height='600' border='0' usemap='#Poster' style='padding-bottom:25px;'></a>


<br>


<h2 style='color:#4D6A10;font-size:1.3em;'>ตารางสัมมนา</h2>

<br>
<table id='Table_01' width='705' border='0' cellpadding='0' cellspacing='0' align='center'>

	<tr align='center'>
		<td align='center'><div align='center'><a href='http://bizit.cpe.ku.ac.th/register/register.php'><img src='http://vivaldi.cpe.ku.ac.th/~imm/sendmail/schedules.png'  border='0'></a></div></td>
	</tr>
	<tr>
	<td height='80' colspan='3' style='background:#f5f5f5;'>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
         <tr align='center'>
			<td width='100%' class='footer_1' align='center'>Copyright 2009 นิสิตโครงการบัณฑิตศึกษา สาขาวิชาเทคโนโลยีสารสนเทศ (MSIT 11) </td>
         </tr>
       
          <tr>
            
            <td class='footer_2'>ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเกษตรศาสตร์ <BR>
              โทรศัพท์ : 0-29428555 ต่อ 1441 , 1402 , 1439 , 1440 <BR>
              โทรสาร : 0-2579-2200 &nbsp;E-mail :   <a href='mailto:bizit.msit@gmail.com'>bizit.msit@gmail.com</a></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
  </tr>
</table>







</div>


<map name='Map'>
  <area shape='rect' coords='926,1270,1084,1392' href='http://bizit.cpe.ku.ac.th/register/register.php' alt=''>
</map></body>

</html>";

$mail = new PHPMailer();
$mail->IsHTML(true); // กำหนดให้ ส่งเป็น html
$mail->IsSMTP();
$mail->SMTPAuth = true; // enable SMTP authentication
// $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
// $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
// $mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Host = 'ssl://smtp.gmail.com:465'; // รวมเป็น ตัวแปลเดียวแบบนี้ก็ได้
$mail->Username = "bizit.msit@gmail.com"; // GMAIL username
$mail->Password = "bizit@cpeg"; // GMAIL password
$mail->From = "bizit.msit@gmail.com"; // "name@yourdomain.com";
$mail->FromName = "BIZ IT 2009"; 
$mail->Subject = "เรียนเชิญเข้าร่วมงานสัมมนาวิชาการด้านเทคโนโลยีสารสนเทศ BizIT 2009 ณ มหาวิทยาลัยเกษตรศาสตร์‏";
$mail->Body = $message; 


/*
$email=split(",","pochaco_o@hotmail.com,immwwi@hotmail.com");

$sql ="SELECT DISTINCT `email`  FROM `regis_bizit` WHERE email <> ''";
$r_email = mysql_query($sql) or die ("Error : <br>$sql_user <br /> $cou");
$email = "";
while( $row=mysql_fetch_array($r_email)){
		echo $row['email']."<br>";
		$email = $email.",".$row['email'];
}

echo "Email: ".$email;
*/
$friend = "worldtech_j@hotmail.com,
vorkorrup@hotmail.com,
m_thanapon@hotmail.com,
worldtech_j@hotmail.com,
teerapob_s@hotmail.com,
immwwi@hotmail.com,
eakchai46@hotmail.com,
ku_na_korn@hotmail.com,
nuuinc12@hotmail.com,
advpailin@gmail.com,
faa_swu@hotmail.com,
selamoonjr@hotmail.com,
yajok_narak@hotmail.com,
kampees@hotmail.com,
giddaa@hotmail.com,
jai_mom_mam@hotmail.com,
bumper009@hotmail.com,
ms_supamit@hotmail.com,
ostric_t@hotmail.com,
chanpen_udom@hotmail.com,
sansanee23@hotmail.com,
wtycpd@gmail.com,
jesus_66@hotmail.com,
pokeo_cs@hotmail.com,
i_am_renuka@hotmail.com,
vmjp2003@hotmail.com,
watchara009@hotmail.com,
bad2friday@hotmail.com,
romulus1@hotmail.com,
pinkish22@hotmail.com,
mo2ploy@hotmail.com,
daimond_pet@hotmail.com,
lordmortir@hotmail.com,
littleglasses@hotmail.com,
alonednew@hotmail.com,
jojoe2046@hotmail.com,
boobee2525@hotmail.com,
khwansuthon@hotmail.com,
pochaco_o@hotmail.com,
muner17@hotmail.com,
tanasman@hotmail.com,
tik124@hotmail.com,
viking191@hotmail.com,
moddy_q@hotmail.co
tul_chitnuson@hotmail.com,
lovelovelittlebear@hotmail.com,
ju_hukkroo@hotmail.com,
rain_mo@hotmail.com,
matta_eve@hotmail.com,
thisisnoom@hotmail.com,
nattapol_nu@hotmail.com,
pook_cpe7@hotmail.com,
ravut@hotmail.com,
oneantantant@hotmail.com,
tanwong@hotmail.com,
toonneyspear@hotmail.com,
narumon_bua@hotmail.com,
piranya_s@hotmail.com,
aehmsit11@gmail.com,
wahopage@hotmail.com,
dudsadee@hotmail.com,
p_preda@hotmail.com,
kg_hoop@hotmail.com";
$countnum = 0;
$email=split(",",$friend);
for($i=0;$i<count($email);$i++){

	echo "------------".$email[$i]."---------<br>";	
	$x = $email[$i];
	echo $x."<br>";
	$mail->AddAddress($x); // ใส่ email ผู้รับอย่างเดียวก็ได้
	/*
	if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!<br>";
		$countnum++;
		echo "Countnum : ".$countnum."<br>";
	}
	$mail->ClearAddresses();
	*/
	$countnum++;
	echo "Countnum : ".$countnum."<br>";
}
/*
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!<br>";
}
echo "Finish";
*/
echo "Total Num : ".$countnum."<br>";
echo "Finish";

?>