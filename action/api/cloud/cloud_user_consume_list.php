<?php
	header('Content-Type:text/xml');
	include "../../dbutil/mysqlinfo.php";
	include "../../dbutil/mysql.php";
	
	$TABLE_USER_CONSUME_LIST="cloud_user_consume_list";
	
	$xml="";
	$errcode=0;
	$reason="";
	
	if(!isset($_POST['uuid']) || empty($_POST['uuid']) || !isset($_POST['token']) || empty($_POST['token'])){
		$errcode=-3;
		$reason="uuid is null";
	} else {
		$sessionID = $_POST['token'];
		session_id($sessionID);
		session_start();
		$uuid = $_POST['uuid'];
		$accessToken=md5($uuid."sky");
		if(isset($_SESSION[$accessToken]) && $_SESSION[$accessToken] == $accessToken){//logined
			$db = new mysql($hostname, $username, $password, $dbname, $charset);
			$consume_where = "uuid='".$uuid."'";
			$consume_field="used_space, used_score, consume_time";
			$consume_onder = "consume_time";
			$result=$db->findMore($TABLE_USER_CONSUME_LIST, $consume_where, $consume_field, "", $consume_onder, 20);
			if(!empty($result)){
				foreach($result as $tmp){
					$xml.="<record>\n";
					$xml.="<used_space>".$tmp['used_space']."</used_space>\n";
					$xml.="<used_score>".$tmp['used_score']."</used_score>\n";
					$xml.="<consume_time>".$tmp['consume_time']."</consume_time>\n";
					$xml.="</record>\n";
				}
				$errcode = 1;
				$reason="find consume record";
			} else {
				$errcode = 1;
				$reason="no consume record";
			}
		} else {
			$errcode = -4;
			$reason="user not logined";
		}
		
	}
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<body>\n";
	echo "<consume>\n";
	echo $xml;
	echo "</consume>\n";
	echo "</body>";
?>