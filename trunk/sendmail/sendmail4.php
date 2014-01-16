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
<table>
<tr>
  <td class='intro'>&nbsp;
      เนื่องด้วย โครงการบัณฑิตศึกษา ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเกษตรศาสตร์
    <br>มีนโยบายให้นิสิตปริญญาโท สาขาเทคโนโลยีสารสนเทศ(ภาคพิเศษ) จัดงานสัมมนาเชิงวิชาการเป็นประจำทุกปี <br> ซึ่งได้รับความสนใจอย่างต่อเนื่องจากผู้เข้าร่วมการสัมมนาเป็นจำนวนมากโดยตลอดมา<br>
    สำหรับปีนี้ได้กำหนดจัดงานสัมมนาวิชาการ BizIT 2009 <br> หัวข้อเรื่อง '<strong>Mission Possible: IT Strategies for Opportunity and Survival</strong>' <br>
ระหว่างวันที่ 15 – 16 ตุลาคม 2552 เวลา 8:00 - 16:30 น. <br>
 ณ ห้องประชุมสุธรรม อารีกุล อาคารสารนิเทศ 50 ปี มหาวิทยาลัยเกษตรศาสตร์ <br>
โดยมีวัตถุประสงค์เพื่อเผยแพร่ความรู้ในการนำเทคโนโลยีสารสนเทศมาใช้ให้เป็นรูปธรรม และก่อเกิดประโยชน์ต่อการดำเนินธุรกิจทุกระดับทั้งภาครัฐและเอกชน <br> รวมทั้งเผยแพร่แนวคิดและมุมมองของการใช้เทคโนโลยีสารสนเทศเป็นเครื่องมือในการสร้างธุรกิจแนวใหม่ <br> ซึ่งรายได้หลังหักค่าใช้จ่ายจะถูกนำไปซื้ออุปกรณ์ไอทีให้แก่โรงเรียนที่ขาดแคลน ตามรายละเอียดดังนี้    </td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>

<a href='http://bizit.cpe.ku.ac.th/register/register.php'><img src='http://bizit.cpe.ku.ac.th/images/email_poster.jpg' width='650' height='600' border='0' usemap='#Poster' style='padding-bottom:25px;'></a>


<br>


<h2 style='color:#4D6A10;font-size:1.3em;'>ตารางสัมนา</h2>

<br>
<table id='Table_01' width='1024' border='0' cellpadding='0' cellspacing='0'>

	<tr>
		<td width='1024' valign='top'><!-- InstanceBeginEditable name='body' -->

		<span class='style10'>
		<!-- CONTENT HERE -->
		</span>
		<div class='style10' id='content' style='width:auto'>
		
		<table width='100%' border='0' cellspacing='0' cellpadding='0' id='agenda'>
          <tr>
            <td style='border-bottom: solid 1px #3689C2; border-left:solid 1px #3689C2; border-right: solid 1px  #3689C2; border-top:solid 1px  #3689C2; '><table width='100%' border='0' cellpadding='7' cellspacing='1' style='font-size:1em;'>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'></div></td>
                <td height='26' colspan='3' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='style7'> วันที่ 1 (15 ตุลาคม2552) </span></div></td>
                </tr>

              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>เวลา</span></div></td>
                <td colspan='3' align='center' valign='middle'class='content_bg_blue01'><div align='center' class='style8'>โปรแกรม</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>08.00 - 09.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>ลงทะเบียน</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>09.00 - 10.30</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>พิธีเปิดและบรรยายพิเศษ Welcome Address and Special Keynote<br><br><b>ดร.โกเมน พิบูลย์โรจน์ - NECTEC</b></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>10:30 - 10.45</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>Break-อาหารว่าง</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>10.45 - 12.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>'IT Strategies for Opportunity and Survival' บรรยายโดย อาจารย์ผู้ทรงคุณวุฒิของมหาวิทยาลัยเกษตรศาสตร์<br><br><b>รองศาสตราจารย์ยืน ภู่วรวรรณ</b></div></td>
              </tr>

              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>12.00 - 13.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>พักรับประทานอาหารกลางวัน</div></td>
              </tr>

              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>เวลา</span></div></td>
                <td align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>Business Solution for Crisis</span><br />
                </div></td>
                <td align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>Trend and Innovation</span></div></td>
                <td align='center' valign='middle' class='content_bg_blue01'><div align='center'><span class='text1'>Cyber Security Threats</span></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>13.00 - 14.30
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>แนวทางการบริหารจัดการการใช้ซอฟต์แวร์เพื่อลดต้นทุน<br>
                    <br>  
                    <strong>คุณ อนันตโชติ เชาวนโยธิน <br>ATSI</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>เคล็ดลับกับการเริ่มต้นกับ Cloud Computing<br>
                    <br>
               
                    <strong>คุณ ตรัยรัตน์ สุวรรณประทีป <br>IBM Thailand</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>ผลกระทบต่อการเพิกเฉยต่อ พรบ. คอมพิวเตอร์<br>
                    <br>
                    <strong>คุณระวิวรรณ พงษ์พานิช,คุณศรัณย์ ทองคำ <br>ICT</strong></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>14.30 - 14.45</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>Break-อาหารว่าง</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>14.45 - 16.00
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>เพิ่มศักยภาพให้กับธุรกิจอย่างชาญฉลาดด้วยโอเพนซอร์ส<br />
                    <br />
                  <strong>มล.ลือศักดิ์ จักรพันธุ์ <br>S&P Syndicate PCL.</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>เสริมประสิทธิภาพการรักษาความปลอดภัยบนสภาพแวดล้อมเสมือน<br>
                    <br />
                    <strong>คุณ จุติพัฒน์ บุญสูง <br>BlueZebra</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>ผลกระทบต่อการเพิกเฉยต่อกฎความปลอดภัย<br />
                    <br />
                    <strong>อาจารย์ปริญญา หอมเอนก <br>ACIS</strong></div></td>
              </tr>

            </table>			</td>
          </tr>
        </table>
		<br>
		<p style='color:red;font-size:1em;'>* ตารางการสัมมนานี้  อาจมีการเปลี่ยนแปลงหัวข้อและวิทยากรได้</p>	
		
		<br>
		<br>
		
		
	<table width='100%' border='0' cellspacing='0' cellpadding='0' id='agenda'>
          <tr>
            <td style='border-bottom: solid 1px #3689C2; border-left:solid 1px #3689C2; border-right: solid 1px  #3689C2; border-top:solid 1px  #3689C2; '><table border='0' cellpadding='7' cellspacing='1' style='font-size:1em;' width='100%'>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'></div></td>
                <td colspan='3' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='style7'>วันที่ 2 (16 ตุลาคม 2552) </span></div></td>
                </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'></div></td>
                <td colspan='3' align='center' valign='middle'class='content_bg_blue01'><div align='center' class='style8'>โปรแกรม</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>เวลา</span></div></td>
                <td align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>Business Solution for Crisis</span><br>
 
                </div></td>
                <td align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>Trend and Innovation</span></div></td>
                <td align='center' valign='middle' class='content_bg_blue01'><div align='center'><span class='text1'>Cyber Security Threats</span></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>09.00 - 10.30

                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'>
                  <div align='center'>วิธีการลดต้นทุนด้านไอทีด้วยวิธีสภาพแวดล้อมเสมือน<br><br>

                  <strong>DELL (Thailand)</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Technology update : Where will Investment Go?<br><br>
                  <strong>อาจารย์ วิสุทธิ์ สุวรรณสุขโรจน์</strong></div></td>
		 <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Sharing in Virtualization Technology - Part 1<br><br>
		   <strong>MSIT11</strong></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>10.30 - 10.45</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>Break-อาหารว่าง</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>10.45 - 12.00
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>เพิ่มกำไรจากการพัฒนา BI สู่ BPM<br><br>
                  <strong>คุณ นัชนัยน์ ไชยสรณะ IBM Thailand</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Mobile Technology to change your lifestyle<br><br>
                  <strong>คุณ สุปรีชา ลิมปิกาญจนโกวิท - Advanced MPay</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Sharing in Virtualization Technology - Part 2<br><br>

                  <strong>MSIT11</strong></div></td>
              </tr>
			  
		<tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>12.00 - 13.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>อาหารกลางวัน</div></td>
              </tr> 	  
		
		 <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>13.00 - 14.30
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Search Engine & Social Media Marketing <br>Strategies in Economic Crisis<br><br>
                  <strong>คุณ พิมพ์พร นรินทร์โท - TK Park</strong>
                  <br>
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>WOA : Web Platform and Web-Oriented Architecture<br><br><br>
                  <strong>ดร.ชุมพล บุญมี</strong><br>
               
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Sharing in Business Intelligence Tool
<br><br><br>
                  <strong>MSIT11</strong>
                </div></td>
              </tr>	  
			  
		<tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>14:30 - 14.45</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>Break-อาหารว่าง</div></td>
              </tr>
			  
		<tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>14.45 - 16.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>เสวนา 'การวางกลยุทธ์ด้านไอทีอย่างเซียน'<br><b>คุณ ณัฐวุฒิ อุ่นใจ - Managing Director บริษัท ออฟฟิคเมท จำกัด (มหาชน)</b><br><b>คุณ สรศักดิ์ ลิขิตรุจานนท์ - Country Manager of TATA Consultancy Services</b><br><b>ดร.สุรัตน์ ตันเทอดทิตย์ - การไฟฟ้าฝ่ายผลิตแห่งประเทศไทย</b><br><b>ดำเนินรายการโดย : ผู้ช่วยศาสตราจารย์ ดร. ภุชงค์ อุทโยภาศ</b></div></td>
              </tr>	  
			  
		<tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>16.00 - 16.30</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>ชิงรางวัล และ กล่าวปิดงาน</div></td>
              </tr>	  

            </table></td>
          </tr>
        </table>	
<br>
	<p style='color:red;font-size:1em;margin-bottom:25px;'>* ตารางการสัมมนานี้  อาจมีการเปลี่ยนแปลงหัวข้อและวิทยากรได้</p>		
		</div>
         
	  <!-- InstanceEndEditable --></td>
	</tr>
	<tr>
	<td height='80' colspan='3' style='background:#f5f5f5;'>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
         <tr>
			
			<td width='100%' class='footer_1'>Copyright 2009 นิสิตโครงการบัณฑิตศึกษา สาขาวิชาเทคโนโลยีสารสนเทศ (MSIT 11) </td>
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

</body>

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



//$email=split(",","pochaco_o@hotmail.com,immwwi@hotmail.com");

$sql ="SELECT DISTINCT `email`  FROM `regis_bizit` WHERE email <> ''";
$r_email = mysql_query($sql) or die ("Error : <br>$sql_user <br /> $cou");
$email = "";
$count = 0;
while( $row=mysql_fetch_array($r_email)){
		//echo $row['email']."<br>";
		//$email=split(",",$row['email']);
		$email = $row['email'];
		echo $email."<br>";
		
		$mail->AddAddress($email);
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message sent!<br>";
			$count++;
		}
		$mail->ClearAddresses();
		
}

echo "Send Total : ".$count."<br>";
echo "Finish";

?>