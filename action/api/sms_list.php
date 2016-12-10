<?php
header("Content-type: text/xml");
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
$db = new mysql($hostname, $username, $password, $dbname, $charset);
$table = "sms";
//sms_list.php?no=aaa&num=10&page=20
parse_str($_SERVER['QUERY_STRING']);
$verify_no = empty($no)?"":$no;
$pageNum = empty($num)?20:$num;
$page = empty($page)?0:$page;
$nowPage = $page*$pageNum;

$limit = $nowPage.",".$pageNum;
$result = $db->findMore($table, "verify_no='".$verify_no."'", "_from, _to, name, body, time, dire, lo, la",  "", "", $limit);

$xml="";
foreach($result as $v){
  $xml .= "<sms>\n";
  $xml .= "<_from>".$v['_from']."</_from>\n";
  $xml .= "<_to>".$v['_to']."</_to>\n";
  $xml .= "<name>".$v['name']."</name>\n";
  $xml .= "<body>".$v['body']."</body>\n";
  $xml .= "<time>".$v['time']."</time>\n";
  $xml .= "<dire>".$v['dire']."</dire>\n";
  $xml .= "<lo>".$v['lo']."</lo>\n";
  $xml .= "<la>".$v['la']."</la>\n";
  $xml .= "</sms>\n";
}
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<gsms>\n";
echo $xml;
echo "</gsms>";

?>