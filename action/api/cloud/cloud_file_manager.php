<?php
	header('Content-Type:text/xml');
	include "../../dbutil/mysqlinfo.php";
	include "../../dbutil/mysql.php";
		
	$xml="";
	$errcode=0;
	$reason="";
	
	if(!isset($_POST['uuid']) && !isset($_POST['token']) && !isset($_POST['domain']) && !isset($_POST['method'])){
		$sessionID = $_POST['token'];
		session_id($sessionID);
		session_start();
		$uuid = $_POST['uuid'];
		$accessToken=md5($uuid."sky");
		if(isset($_SESSION[$accessToken]) && $_SESSION[$accessToken] == $accessToken){//logined
			$TABLE_FILE_LIST="cloud_user_file_list";
			$domain = $_POST['domain'];
			$method = $_POST['method'];//upload|download|delete|share
			$consume_field="_ID, path";
			$db = new mysql($hostname, $username, $password, $dbname, $charset);
			if($method == 1){//'query'
				$pageNumber = $_POST['number']
				$pageOffset = $_POST['offset'];
				$consume_where = "uuid='".$uuid."'";
				$result=$db->findMore($TABLE_FILE_LIST, $consume_where, $consume_field, "", "", 20);
				if(!empty($result)){
					foreach($result as $tmp){
						$xml.="<record>\n";
						$xml.="<_ID>".$result['_ID']."</_ID>\n";
						$xml.="<path>".$result['path']."</path>\n";
						$xml.="<launch_mod>".$result['launch_mod']."</launch_mod>\n";
						$xml.="<upload_time>".$result['upload_time']."</upload_time>\n";
						$xml.="</record>\n";
					}
					$errcode = 1;
					$reason="find consume record";
				} else {
					$errcode = 1;
					$reason="no consume record";
				}
				} else if($method == 2){//'delete'
					$id = $_POST['id']
					$consume_where = "_ID='".$id."'";
					$result=$db->del($TABLE_FILE_LIST, $consume_where);
				}
		} else {
			$errcode = -4;
			$reason="user not logined";
		}
	} else {
		$errcode=-3;
		$reason="parameter in not invalid";
	}
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<body>\n";
	echo "<consume>\n";
	echo $xml;
	echo "<//consume>\n";
	echo "</body>";
?>