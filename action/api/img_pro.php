<?php
header("content-type:text/html;charset=utf8");
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
$db = new mysql($hostname, $username, $password, $dbname, $charset);

parse_str($_SERVER['QUERY_STRING']);
if(empty($m)){
	die();
}
$method = $m;
$catalog = empty($t)?"0":$t;
if(empty($bi)){
	die();
}
if(empty($u)){
	die();
}
//http://drovikftp.jw.cscces.net/action/api/img_pro.php?m=add&t=3&bn=abc&bi=123&u=http://img4.ppmsg.net/Upload2010/33/qpsdqmnChupldld/01.jpg
$bucket_name = empty($bn)?"":$bn;;
$bucket_id = $bi;
echo $method."--".$catalog."---bn =".$bucket_name."--bi=".$bucket_id."<br/>";
if($method == "add"){
	// url =http://img4.ppmsg.net/Upload2010/33/qpsdqmnChupldld
	//catalog
	// bucket_name
	//bucket_id
	//des
	////$result = $db->add("media", "_data='http://img4.ppmsg.net/Upload2010/33/qpsdqmnChupldld/02.jpg', _name ='01.jpg', title='01',catalog=0,add_time=now(), bucket_id='36', bucket_name='我们', descrip='暂无描述'");
	$index = strrpos($u, "/");
	$preUrl = substr($u, 0, strrpos($u, "/"));
	$index = strrpos($preUrl, "/");
	if($bucket_name==""){//bucket_name is null get default bn and bi
		$bucket_name = substr($preUrl, strrpos($preUrl, "/")+1, strlen($preUrl));
		$preBucketName = substr($preUrl, 0, strrpos($preUrl, "/"));
		$bi = substr($preBucketName, strrpos($preBucketName, "/")+1, strlen($preBucketName));
	}
	$count = empty($c)?"1":$c;
	echo $preUrl."-".$bucket_name."-".$bi."-".$d."-".$c."<br/>";
	for($i = 1; $i<=$count; $i++){
		if($i<10){
			$url = $preUrl."/0".$i.".jpg";
			$name = "0".$i.".jpg";
		}else{
			$url = $preUrl."/".$i.".jpg";
			$name = $i.".jpg";
		}
		$wh = "_data='".$url."', _name='".$name."', title='', catalog='".$catalog."', add_time=unix_timestamp(), bucket_id='".$bi."', bucket_name='".$bn."', descrip='".$d."'";//.'/'.$name.",", _name ="'".$name."'", title='',catalog=$catalog, add_time=now(), bucket_id="'".$bucket_id."'", bucket_name="'".$bucket_name."'", descrip="'".$d."'";
		//$result = $db->add("media", "_data="'".$url.'/'.$name.",", _name ="'".$name."'", title='',catalog=$catalog, add_time=now(), bucket_id="'".$bucket_id."'", bucket_name="'".$bucket_name."'", descrip="'".$d."'");
		//echo $url."---".$name."<br/>";
		//echo $wh."<br/>";
		$result = $db->add("media", $wh);
		echo mysql_error();
		echo result;
	}
}else if($method == "del"){

	//catalog
    // bucket_name
	//bucket_id
	//_id
	// $db->del("media","bucket_name=qpsdqmnChupldld");
	//$type = empty($t)?"":$t;
}

?>