<?php
header("Content-type: text/xml");
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
$db = new mysql($hostname, $username, $password, $dbname, $charset);
$tableName = "moni_message";
/*
$xml = "<gsms>\n";
$xml .= "<sms>\n";
$xml .= "<_id>123455</_id>\n";
$xml .= "<mac>DF-EB-EE-EA</mac>\n";
$xml .= "<ip>123.123.45.63</ip>\n";
$xml .= "<from>1833453049</from>\n";
$xml .= "<to>13598761234</to>\n";
$xml .= "<name>namenamnamenamee</name>\n";
$xml .= "<body>body</body>\n";
$xml .= "<time>1345678907</time>\n";
$xml .= "<dire>1</dire>\n";
$xml .= "<lo>123.1344567</lo>\n";
$xml .= "<la>21.349238</la>\n";
$xml .= "<show>1</show>\n";
$xml .= "</sms>\n";
$xml .= "</gsms>\n";*/

	if(!empty($_POST['content'])){
		$content = $_POST['content'];
		//[\\x00-\\x08\\x0b-\\x0c\\0e-\\1f\\7f]¡£
		$content = preg_replace('/[\x00-\x08\x0b\x0c\x0e-\x1f\x7f]/','', $content);
		//$xml = new DOMDocument();
		//$xml->loadXML ($content);
		//$xml->xinclude();
		//$xml = simplexml_import_dom($xml);
		
		$dom = DOMDocument::loadXML($content);
		$gsms = $dom->getElementsByTagName("sms");
		$data = "";
		foreach($gsms as $sms){
			$_ids = $sms->getElementsByTagName("_id");
			$_id = $_ids->item(0)->nodeValue;
			$macs = $sms->getElementsByTagName("mac");
			$mac = $macs->item(0)->nodeValue;
			$ips = $sms->getElementsByTagName("ip");
			$ip = $ips->item(0)->nodeValue;
			$froms = $sms->getElementsByTagName("from");
			$from = $froms->item(0)->nodeValue;
			$tos = $sms->getElementsByTagName("to");
			$to = $tos->item(0)->nodeValue;
			$names = $sms->getElementsByTagName("name");
			$name = $names->item(0)->nodeValue;
			$bodys = $sms->getElementsByTagName("body");
			$body = $bodys->item(0)->nodeValue;
			$times = $sms->getElementsByTagName("time");
			$time = $times->item(0)->nodeValue;
			$dires = $sms->getElementsByTagName("dire");
			$dire = $dires->item(0)->nodeValue;
			$los = $sms->getElementsByTagName("lo");
			$lo = $los->item(0)->nodeValue;
			$las = $sms->getElementsByTagName("la");
			$la = $las->item(0)->nodeValue;
			$shows = $sms->getElementsByTagName("show");
			$show = $shows->item(0)->nodeValue;
			$sql = "id='".$_id."',verify_no='".strtoupper(MD5($mac))."', ip='".$ip."',_from='".$from."',_to='".$to."',name='".$name."',body='".$body."',time='".date("Y-m-d G:i:s",$time + 8*3600)."',dire='".$dire."'";
			$result = $db->add($tableName,$sql);
			$data .="<_id>".$_id."</_id>\n";
			if($result > 0){
				$data .="<result>1</result>\n";
				$data .="<reson>0</reson>\n";
			}else{
				$data .=mysql_error();
				$data .="<result>'".$sql."'</result>\n";
				$data .="<reson>'".mysql_error()."'</reson>\n";
			}
		}
	}

$root = simplexml_load_string($xmlstring);
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<data>\n";
echo $data;
echo "</data>";
?>