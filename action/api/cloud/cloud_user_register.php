<?php
	header('Content-Type:text/xml;charset=utf8');
	include "../../dbutil/mysqlinfo.php";
	include "../../dbutil/mysql.php";
	
	$TABLE="cloud_user_list";
	date_default_timezone_set("PRC");
	
	$db = new mysql($hostname, $username, $password, $dbname, $charset);
	$xml="";
	$errcode=0;
	$reason="";
	$uuid="";
	
	if(!isset($_POST['email']) || !isset($_POST['password']) || empty($_POST['email']) || empty($_POST['password'])){
		$errcode=-3;
		$reason="email or password is null";
	} else {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$mac = $_POST['mac'];
		$lo=$_POST['lo'];
		$la=$_POST['la'];
		$result = $db->find($TABLE, "email='".$email."'");
		if(empty($result)){
			$domain="audio_record";
			$db->add($TABLE, "mac='".$mac."', email='".$email."', password='".$password."', domain='".$domain."', lo='".$lo."', la='".$la."', register_time='".time()."'");
			$uuid=$db->getInsertId();
			$errcode = $uuid>0 ? 1 : -1;
		} else {
			$errcode = -1;
			$reason="email is registed";
		}
	}
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	$xml.="<uuid>".$uuid."</uuid>\n";
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<body>\n";
	echo "<result>\n";
	echo $xml;
	echo "</result>\n";
	echo "</body>";
?>