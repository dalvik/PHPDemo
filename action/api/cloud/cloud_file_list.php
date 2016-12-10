<?php
	header('Content-Type:text/xml');
	
	$xml="";
	$errcode=0;
	$reason="";
	$xml.="<thumb>\n";
	$xml.="<id>1000</id>\n";
	$xml.="<file_name>1</file_name>\n";
	$xml.="<file_cover>http://10.0.2.2/download/a.jpg</file_cover>\n";
	$xml.="<file_count>500</file_count>\n";
	$xml.="<file_descrip>this id file_descrip</file_descrip>\n";
	$xml.="<file_type>0</file_type>\n";
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	$xml.="</thumb>\n";
	$errcode = 1;
	$reason="find consume record";
	
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<body>\n";
	echo "<file_list>\n";
	echo $xml;
	echo "</file_list>\n";
	echo "</body>";
?>