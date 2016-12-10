<?php
header('Content-Type: text/xml');
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
$db = new mysql($hostname, $username, $password, $dbname, $charset);

parse_str($_SERVER['QUERY_STRING']);
$bucket_id = empty($cid)?0:$cid;
$bucket_name = empty($name)?"":$name;
$pageNum = empty($num)?20:$num;
$page = empty($page)?0:$page;
$nowPage = $page*$pageNum;

$limit = $nowPage.",".$pageNum;
$result = $db->findMore("media", "bucket_id=".$bucket_id." and bucket_name='".$bucket_name."'", "_data, _name", "", "add_time", $limit);

$xml="";
foreach($result as $v){
  $xml .= "<image>\n";
  $xml .= "<url>".$v['_data']."</url>\n";
  $xml .= "<name>".$v['_name']."</name>\n";
  $xml .= "</image>\n";
}
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<data>\n";
echo $xml;
echo "</data>";

?>