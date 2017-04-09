<?php 
	require_once("../../dbutil/mysql.php");
    require_once("../../dbutil/mysqlinfo.php");
	//echo phpinfo();
//echo "aaaaaaaaaa";
//$db = new mysql(SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS, SAE_MYSQL_DB,"utf8");
//echo "".$hostname."--".$username."---".$password."---".$dbname."--".$charset;
//session_start();
$db = new mysql($hostname, $username, $password, $dbname, $charset);
//echo MD5("sky123");
//$db = new mysql(SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS ,"gbk");
//$link = mysql_connect (SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS ,'utf822');
var_dump($db);
//var_dump($link);