<?php
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
$apk_download = "apk_download";
$apk_list = "dav_soft_list";
$db = new mysql($hostname, $username, $password, $dbname, $charset);
$apk_id = $_REQUEST['apk_id'];
$result =  $db->find($apk_list, "_id = '".$apk_id."'", "path", "", "");
if($result['path'] != null && $result['path'] != ""){
	$ip = $_SERVER["REMOTE_ADDR"];
	$par_url = $_SERVER['HTTP_REFERER'];
	$time = date('Y-m-d G:i:s',date('U') + 8*3600);
	$re = $db->add($apk_download, "ip ='".$ip."', apk_id='".$apk_id."', par_url='".$par_url."', time='".$time."'");
	//echo mysql_error();
	echo $apk_id;
}else{
	echo "0";
}
//echo var_dump($result);
//echo $apk_id;