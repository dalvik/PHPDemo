<?php
	header('Content-Type:text/xml');
	
	date_default_timezone_set("PRC");
	
	$xml="";
	$errcode=0;
	$reason="";
	if(!isset($_POST['uuid']) || empty($_POST['uuid'])){
		$errcode=-3;
		$reason="email is null";
	} else {
		$uuid = $_POST['uuid'];
		$sessionID = $_POST['token'];
		session_id($sessionID);
		session_start();
		$uuid = $_POST['uuid'];
		$accessToken=md5($uuid."sky");
		if(isset($_SESSION[$accessToken]) && $_SESSION[$accessToken] == $accessToken){//logined
			$_SESSION[$accessToken] = null;
		}
		$errcode = 1;
		$reason="user logout";
	}
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<body>\n";
	echo "<cloud>\n";
	echo $xml;
	echo "</cloud>\n";
	echo "</body>";
?>