<?
require_once('./phpMailer/class.phpmailer.php'); 

$message = "<html>
<head>
	
	<title>BizIT 2009 Web Site : Email Template</title>
	<meta http-equiv='Content-Type' content='text/html; charset=tis-620' />
	<style type='text/css'>
		#content {text-align:center;margin:auto;}
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

<map name='Poster'>
<area alt='Register here!!' coords='283,473,635,518' href='http://bizit.cpe.ku.ac.th/register/register.php'>
<area alt='BizIT2009' coords='38,61,407,241' href='http://bizit.cpe.ku.ac.th/'>
</map>
<img src='http://bizit.cpe.ku.ac.th/images/email_poster.jpg' width='650' height='600' border='0' usemap='#Poster' style='padding-bottom:25px;'>

<br>


<h2 style='color:#4D6A10;font-size:1.3em;'>���ҧ�����</h2>

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
                <td height='26' colspan='3' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='style7'> �ѹ��� 1 (15 ���Ҥ�2552) </span></div></td>
                </tr>

              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>����</span></div></td>
                <td colspan='3' align='center' valign='middle'class='content_bg_blue01'><div align='center' class='style8'>�����</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>08.00 - 09.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>ŧ����¹</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>09.00 - 10.30</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>�Ը��Դ��к����¾���� Welcome Address and Special Keynote<br><br><b>��.���� �Ժ�����è�� - NECTEC</b></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>10:30 - 10.45</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>Break-�������ҧ</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>10.45 - 12.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>'IT Strategies for Opportunity and Survival' �������� �Ҩ������ç�س�زԢͧ����Է������ɵ���ʵ��<br><br><b>�ͧ��ʵ�Ҩ�����׹ �������ó</b></div></td>
              </tr>

              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>12.00 - 13.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>�ѡ�Ѻ��зҹ����á�ҧ�ѹ</div></td>
              </tr>

              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>����</span></div></td>
                <td align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>Business Solution for Crisis</span><br />
                </div></td>
                <td align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>Trend and Innovation</span></div></td>
                <td align='center' valign='middle' class='content_bg_blue01'><div align='center'><span class='text1'>Cyber Security Threats</span></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>13.00 - 14.30
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>�Ƿҧ��ú����èѴ��á����Ϳ����������Ŵ�鹷ع<br>
                    <br>  
                    <strong>�س ͹ѹ�⪵� ��ǹ�¸Թ <br>ATSI</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>����Ѻ�Ѻ���������鹡Ѻ Cloud Computing<br>
                    <br>
               
                    <strong>�س �����ѵ�� ����ó��зջ <br>IBM Thailand</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>�š�з���͡���ԡ�µ�� �ú. ����������<br>
                    <br>
                    <strong>�س������ó ����ҹԪ,�س��ѳ�� �ͧ�� <br>ICT</strong></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>14.30 - 14.45</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>Break-�������ҧ</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>14.45 - 16.00
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>�����ѡ��Ҿ���Ѻ��áԨ���ҧ�ҭ��Ҵ������ྐྵ�����<br />
                    <br />
                  <strong>��.����ѡ��� �ѡþѹ��� <br>S&P Syndicate PCL.</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>���������Է���Ҿ����ѡ�Ҥ�����ʹ��º���Ҿ�Ǵ��������͹<br>
                    <br />
                    <strong>�س �صԾѲ�� �ح�٧ <br>BlueZebra</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>�š�з���͡���ԡ�µ�͡�������ʹ���<br />
                    <br />
                    <strong>�Ҩ�����ԭ�� ����͹� <br>ACIS</strong></div></td>
              </tr>

            </table>			</td>
          </tr>
        </table>
		<br>
		<p style='color:red;font-size:1em;'>* ���ҧ��������ҹ��  �Ҩ�ա������¹�ŧ��Ǣ������Է�ҡ���</p>	
		
		<br>
		<br>
		
		
	<table width='100%' border='0' cellspacing='0' cellpadding='0' id='agenda'>
          <tr>
            <td style='border-bottom: solid 1px #3689C2; border-left:solid 1px #3689C2; border-right: solid 1px  #3689C2; border-top:solid 1px  #3689C2; '><table border='0' cellpadding='7' cellspacing='1' style='font-size:1em;' width='100%'>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'></div></td>
                <td colspan='3' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='style7'>�ѹ��� 2 (16 ���Ҥ� 2552) </span></div></td>
                </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'></div></td>
                <td colspan='3' align='center' valign='middle'class='content_bg_blue01'><div align='center' class='style8'>�����</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>����</span></div></td>
                <td align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>Business Solution for Crisis</span><br>
 
                </div></td>
                <td align='center' valign='middle'class='content_bg_blue01'><div align='center'><span class='text1'>Trend and Innovation</span></div></td>
                <td align='center' valign='middle' class='content_bg_blue01'><div align='center'><span class='text1'>Cyber Security Threats</span></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>09.00 - 10.30

                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'>
                  <div align='center'>�Ըա��Ŵ�鹷ع��ҹ�ͷմ����Ը���Ҿ�Ǵ��������͹<br><br>

                  <strong>DELL (Thailand)</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Technology update : Where will Investment Go?<br><br>
                  <strong>�Ҩ���� ���ط��� ����ó�آ�è��</strong></div></td>
		 <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Sharing in Virtualization Technology - Part 1<br><br>
		   <strong>MSIT11</strong></div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>10.30 - 10.45</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>Break-�������ҧ</div></td>
              </tr>
              <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>10.45 - 12.00
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>�������èҡ��þѲ�� BI ��� BPM<br><br>
                  <strong>�س �Ѫ��¹� ���ó� IBM Thailand</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Mobile Technology to change your lifestyle<br><br>
                  <strong>�س �ػ�ժ� ����ԡҭ����Է - Advanced MPay</strong></div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Sharing in Virtualization Technology - Part 2<br><br>

                  <strong>MSIT11</strong></div></td>
              </tr>
			  
		<tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>12.00 - 13.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>����á�ҧ�ѹ</div></td>
              </tr> 	  
		
		 <tr>
                <td width='90' align='center' valign='middle' class='content_bg_blue02'><div align='center'>13.00 - 14.30
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Search Engine & Social Media Marketing <br>Strategies in Economic Crisis<br><br>
                  <strong>�س ������ ��Թ���� - TK Park</strong>
                  <br>
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>WOA : Web Platform and Web-Oriented Architecture<br><br><br>
                  <strong>��.����� �ح��</strong><br>
               
                </div></td>
                <td align='center' valign='middle' class='content_bg_blue03'><div align='center'>Sharing in Business Intelligence Tool
<br><br><br>
                  <strong>MSIT11</strong>
                </div></td>
              </tr>	  
			  
		<tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>14:30 - 14.45</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue02'><div align='center'>Break-�������ҧ</div></td>
              </tr>
			  
		<tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>14.45 - 16.00</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>��ǹ� '����ҧ���ط���ҹ�ͷ����ҧ��¹'<br><b>�س �Ѱ�ز� ���� - Managing Director ����ѷ �Ϳ�Ԥ��� �ӡѴ (��Ҫ�)</b><br><b>�س ���ѡ��� �ԢԵ�بҹ��� - Country Manager of TATA Consultancy Services</b><br><b>��.���ѵ�� �ѹ�ʹ�Ե�� - ���俿�ҽ��¼�Ե��觻������</b><br><b>���Թ��¡���� : ��������ʵ�Ҩ���� ��. �ت��� �ط�����</b></div></td>
              </tr>	  
			  
		<tr>
                <td width='90' align='center' valign='middle'class='content_bg_blue02'><div align='center'>16.00 - 16.30</div></td>
                <td colspan='3' align='center' valign='middle' class='content_bg_blue03'><div align='center'>�ԧ�ҧ��� ��� ����ǻԴ�ҹ</div></td>
              </tr>	  

            </table></td>
          </tr>
        </table>	
<br>
	<p style='color:red;font-size:1em;margin-bottom:25px;'>* ���ҧ��������ҹ��  �Ҩ�ա������¹�ŧ��Ǣ������Է�ҡ���</p>		
		</div>
         
	  <!-- InstanceEndEditable --></td>
	</tr>
	<tr>
	<td height='80' colspan='3' style='background:#f5f5f5;'>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
         <tr>
			
			<td width='100%' class='footer_1'>Copyright 2009 ���Ե�ç��úѳ�Ե�֡�� �Ң��Ԫ�෤��������ʹ�� (MSIT 11) </td>
         </tr>
       
          <tr>
            
            <td class='footer_2'>�Ҥ�Ԫ����ǡ������������� ������ǡ�����ʵ�� ����Է������ɵ���ʵ�� <BR>
              ���Ѿ�� : 0-29428555 ��� 1441 , 1402 , 1439 , 1440 <BR>
              ����� : 0-2579-2200 &nbsp;E-mail :   <a href='mailto:bizit.msit@gmail.com'>bizit.msit@gmail.com</a></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
  </tr>
</table>







</div>

</body>

</html>";

$mail = new PHPMailer();
$mail->IsHTML(true); // ��˹���� ���� html
$mail->IsSMTP();
$mail->SMTPAuth = true; // enable SMTP authentication
// $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
// $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
// $mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Host = 'ssl://smtp.gmail.com:465'; // ����� ���������Ẻ������
$mail->Username = "bizit.msit@gmail.com"; // GMAIL username
$mail->Password = "bizit@cpeg"; // GMAIL password
$mail->From = "bizit.msit@gmail.com"; // "name@yourdomain.com";
$mail->FromName = "BIZ IT"; 
$mail->Subject = "This is the Test.";
$mail->Body = $message; 
$mail->AddAddress("immwwi@hotmail.com"); // ��� email ����Ѻ���ҧ���ǡ���
$mail->Send(); // ������͡ 

echo "Finish";

?>