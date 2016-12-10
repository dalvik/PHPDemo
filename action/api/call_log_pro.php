<?php
header("Content-type: text/xml");
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
$table = "call_log";
$db = new mysql($hostname, $username, $password, $dbname, $charset);
/*
$xml = "<gcall>\n";
$xml .= "<call>\n";
$xml .= "<_id>123455</_id>\n";
$xml .= "<mac>DF-EB-EE-EA</mac>\n";
$xml .= "<ip>123.123.45.63</ip>\n";
$xml .= "<number>1833453049</number>\n";
$xml .= "<name>namenamnamenamee</name>\n";
$xml .= "<duration>namenamnamenamee</duration>\n";
$xml .= "<type>1</type>\n";
$xml .= "<time>1</time>\n";
$xml .= "<lo>123.1344567</lo>\n";
$xml .= "<la>21.349238</la>\n";
$xml .= "</call>\n";
$xml .= "</gcall>\n";*/
	if(!empty($_POST['content'])){
		$content = $_POST['content'];
		$content = preg_replace('/[\x00-\x08\x0b\x0c\x0e-\x1f\x7f]/','', $content);
		$dom = DOMDocument::loadXML($content);
		$gcall = $dom->getElementsByTagName("call");
		$data = "";
		foreach($gcall as $sms){
			$_ids = $sms->getElementsByTagName("_id");
			$_id = $_ids->item(0)->nodeValue;
			$macs = $sms->getElementsByTagName("mac");
			$mac = $macs->item(0)->nodeValue;
			$ips = $sms->getElementsByTagName("ip");
			$ip = $ips->item(0)->nodeValue;
			$numbers = $sms->getElementsByTagName("number");
			$number = $numbers->item(0)->nodeValue;
			$names = $sms->getElementsByTagName("name");
			$name = $names->item(0)->nodeValue;
			$durations = $sms->getElementsByTagName("duration");
			$duration = $durations->item(0)->nodeValue;
			$types = $sms->getElementsByTagName("type");
			$type = $types->item(0)->nodeValue;
			$cdates = $sms->getElementsByTagName("time");
			$cdate = $cdates->item(0)->nodeValue;
			$los = $sms->getElementsByTagName("lo");
			$lo = $los->item(0)->nodeValue;
			$las = $sms->getElementsByTagName("la");
			$la = $las->item(0)->nodeValue;
			$sql = "id='".$_id."', mac='".$mac."', ip='".$ip."',number='".$number."',name='".$name."', duration='".$duration."', type='".$type."',cdate='".date("Y-m-d G:i:s",$cdate + 8*3600)."',lo='".$lo."',la='".$la."'";
			$result = $db->add($table, $sql);
			$data .="<_id>".$_id."</_id>\n";
			if($result > 0){
				$data .="<result>1</result>\n";
				$data .="<reson>0</reson>\n";
			}else{
				$data .=mysql_error();
				$data .="<result>-1</result>\n";
				$data .="<reson>'".mysql_error()."'</reson>\n";
			}
		}
	}
/*echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";*/
echo "<data>\n";
echo $data;
echo "</data>";
?>