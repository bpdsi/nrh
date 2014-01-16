
<?php
	require_once('./lib/nusoap.php');  

  $client = new nusoap_client("Agriculturalist.wsdl",true); 
  $catalogId='catalog1';
 
  $resdponse = $client->call('getCatalogEntry', array('catalogId' => '')); 

 
$contents=htmlspecialchars_decode($client->response);
//echo $contents;
//exit;
$pages='<result>';
$pageln=strlen($pages);
 $endpages="</result>";
 $endpageln=strlen($endpages);
 
$px=substr(trim($contents),strpos(trim($contents),$pages),strpos(trim($contents),$endpages)-strpos(trim($contents),$pages)+$endpageln);

   $docx = new DOMDocument(); 
   $docx->loadXML($px);

$items = $docx->getElementsByTagName('doc'); 
    $headlines = array(); 
    
    foreach($items as $item) { 
        $headline = array(); 
        
        if($item->childNodes->length) { 
            foreach($item->childNodes as $i) { 
                $headline[$i->nodeName] = $i->nodeValue; 
            } 
        } 
        
        $headlines[] = $headline; 
    } 
if(!empty($headlines)) { 
        $hc = 0; 
        
        echo '<table>'; 
		$tdhd=split(",","FarmerID,CitizenID,Address,TelNo");
		echo'<tr>';
		for($n=0;$n<count($tdhd);$n++){
			echo'<td>'.$tdhd[$n].'</td>';
		}
		echo'</tr>';
        //เพิ่ม header
        foreach($headlines as $headline) { 				
				echo"<tr>";
				for($m=0;$m<count($tdhd);$m++){
					echo'<td>'.$headline[$tdhd[$m]].'</td>';
				}
				echo"</tr>";
        } 
        
        echo '</table>'; 
    } 
?>
