<?php
	header('Content-Type:text/xml');
	session_start();
	$xml="";
	$errcode=0;
	$reason="prepare";
	$sessionId=session_id();
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	$xml.="<sessionid>".$sessionId."</sessionid>\n";
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<body>\n";
	echo "<cloud>\n";
	echo $xml;
	echo "</cloud>\n";
	echo "</body>";
?>