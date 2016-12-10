<?php

$stor = new SaeStorage();
parse_str($_SERVER['QUERY_STRING']);
$pageNumber = empty($number)?20:$number;
$index = empty($index)?0:$index;
$xml="";
if( $ret = $stor->getList("soundrecorder", "", $pageNumber, $index ) ) {
    foreach($ret as $file) {
        $xml .= "<path>".$file."</path>\n";
    }
}
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<data>\n";
echo $xml;
echo "</data>";

