<?php
	header('Content-Type:text/xml');
	include "../../dbutil/mysqlinfo.php";
	include "../../dbutil/mysql.php";
	
	$TABLE_USER="cloud_user_list";
	$TABLE_USER_CONSUME="cloud_user_consume_list";
	
	date_default_timezone_set("PRC");
	
	$xml="";
	$errcode=0;
	$reason="";
	
	if(!isset($_POST['uuid']) || empty($_POST['uuid']) || !isset($_POST['token']) || empty($_POST['token'])){
		$errcode=-3;
		$reason="parameter is not invalid";
	} else {
		$token = $_POST['token'];
		session_id($token);
		session_start();
		$uuid = $_POST['uuid'];
		$accessToken=md5($uuid."sky");
		if(isset($_SESSION[$accessToken]) && ($_SESSION[$accessToken] == $accessToken)){//logined
			$db = new mysql($hostname, $username, $password, $dbname, $charset);
			
			$consume_where = "uuid='".$uuid."'";
			$consume_field="total_space, used_space, score";
			//update user score
			$result = $db->find($TABLE_USER, $consume_where, $consume_field);
			if(!empty($result)){
				if(isset($_POST['total_space']) && !empty($_POST['total_space'])){//resize storage space
					$newSpace = $_POST['total_space'];
					$totalSpace=$result['total_space']+$newSpace;
					$user_set="total_space='".$totalSpace."'";
					//echo $consume_where."--".$newSpace."--".$totalSpace."--".$user_set;
					if($db->edit($TABLE_USER, $user_set, $consume_where)){
						$errcode = 1;
						$reason="modify toal space success";
						$consume_set="uuid='".$_POST['uuid']."', used_space='".$newSpace."', consume_time='".time()."'";
						//echo $consume_set;
						$db->add($TABLE_USER_CONSUME, $consume_set);//add consume item
					} else {
						$errcode = -22;
						$reason="modify total space fail";
					}
				}
				if(isset($_POST['used_space']) && !empty($_POST['used_space'])){//resize storage space
					$usedSpace = $_POST['used_space'];//consume space minus
					$totalUsedSpace=$result['used_space']-$usedSpace;
					if($totalUsedSpace<$result['total_space']){//has space remain
						$user_set="used_space='".$totalUsedSpace."'";
						//echo $user_set;
						if($db->edit($TABLE_USER, $user_set, $consume_where)){
							$errcode = 1;
							$reason="modify used space success";
							$consume_set="uuid='".$_POST['uuid']."', used_space='".$usedSpace."', consume_time='".time()."'";
							//echo $consume_set;
							$db->add($TABLE_USER_CONSUME, $consume_set);//add consume item
						}else{
							$errcode = -22;
							$reason="modify used space fail";
						}
					}else {
						$errcode = -28;
						$reason="no more space left";
					}
				}
				if(isset($_POST['score']) && !empty($_POST['score'])){//resize storage space
					$getScore = $_POST['score'];//+:get -:consume
					$totalScore=$result['score'] + $getScore;
					if($totalScore>=0){//remain score
						$user_set="uuid='".$_POST['uuid']."', score='".$totalScore."'";
						if($db->edit($TABLE_USER, $user_set, $consume_where)){
							$errcode = 1;
							$reason="modify toal score success";
							$consume_set="uuid='".$_POST['uuid']."', used_score='".$getScore."', consume_time='".time()."'";
							$db->add($TABLE_USER_CONSUME, $consume_set);
						} else {
							$errcode = -24;
							$reason="modify toal score fail";
						}
					} else {
						$errcode = -26;
						$reason="score not enough";
					}
				}
			} else {
				$errcode = -20;
				$reason="user not exist";
			}
		} else{
			$errcode = -4;
			$reason="user not logined";
		}
	}
	
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<result>\n";
	echo $xml;
	echo "</result>";
?>