<?php
header("Content-type: text/xml");
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
$db = new mysql($hostname, $username, $password, $dbname, $charset);

parse_str($_SERVER['QUERY_STRING']);
$catalog = empty($type)?0:$type;
$pageNum = empty($num)?20:$num;
$page = empty($page)?0:$page;
$nowPage = $page*$pageNum;

$limit = $nowPage.",".$pageNum;
$result = $db->findMore("media", " catalog=".$catalog,"_data, bucket_id, bucket_name, descrip, count(*)",  "bucket_id, bucket_name", "add_time", $limit);


$xml="";
foreach($result as $v){
  $xml .= "<image>\n";
  //$xml .= "<ab>".$pageNum.",".$nowPage."</ab>\n";//$page.
  $xml .= "<id>".$v['bucket_id']."</id>\n";
  $xml .= "<name>".$v['bucket_name']."</name>\n";
  $xml .= "<cover>".$v['_data']."</cover>\n";
  $xml .= "<count>".$v['count(*)']."</count>\n";
  $xml .= "<descrip>".$v['descrip']."</descrip>\n";
  $xml .= "</image>\n";
}
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<data>\n";
echo $xml;
echo "</data>";
?>