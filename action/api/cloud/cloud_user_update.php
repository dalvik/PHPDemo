<?php
	header('Content-Type:text/xml');
	include "../../dbutil/mysqlinfo.php";
	include "../../dbutil/mysql.php";
	
	session_start();
	
	$USER_TABLE="cloud_user_list";
	$USER_DETAIL_TABLE="cloud_user_detail_list";
	date_default_timezone_set("PRC");
	
	$db = new mysql($hostname, $username, $password, $dbname, $charset);
	$xml="";
	$errcode=0;
	$reason="";
	//var_dump(getallheaders());
	//used to logined or allow user to modify password
	if(!isset($_POST['token']) || !isset($_POST['uuid']) || !isset($_POST['token']) || empty($_POST['token'])){
		$errcode=-3;
		$reason="parameter is invalid";
	} else {
		$token = $_POST['token'];
		session_id($token);
		$uuid = $_POST['uuid'];
		$accessToken=md5($uuid."sky");
		if(isset($_SESSION[$accessToken]) && $_SESSION[$accessToken] == $accessToken){//logined
			
			$where="uuid='".$uuid."'";
			if(!isset($_POST['password'])) {// update user info except pasword
				$email = $_POST['email'];
				$used_space = $_POST['used_space'];
				$score = $_POST['score'];
					
				$phone = $_POST['phone'];
				$imqq = $_POST['imqq'];
				$age = $_POST['age'];
				$wed_state = $_POST['wed_state'];
				$education = $_POST['education'];
				$school = $_POST['school'];
				$descripe = $_POST['descripe'];
					
				$user_set = "email='".$email."', used_space='".$used_space."', score='".$score."'";
				$user_detail_set = "phone='".$phone."', imqq='".$imqq."', age='".$age."', wed_state='".$wed_state."', education='".$education."', school='".$school."', descripe='".$descripe."'";
				if($db->edit($USER_TABLE, $user_set, $where) && $db->edit($USER_DETAIL_TABLE, $user_detail_set, $where)){
					$errcode = 1;
					$reason = "modify success";
				} else {
					$errcode = -7;
					$reason = mysql_errno().": ".mysql_error();
				}
			} else {//logined but set password, only used to modify password
				$password = $_POST['password'];
				$set = "password='".$password."'";
				$result = $db->edit($USER_TABLE, $set, $where);
				if($result){
					$errcode = 1;
					$reason = "modify success";
				} else {
					$errcode = -7;
					$reason = "modify fail";
				}
			}
		} else {//not logind, but set new password
			if(isset($_POST['password'])) {// update user info except pasword
				$password = $_POST['password'];
				$set = "password='".$password."'";
				$result = $db->edit($USER_TABLE, $set, $where);
				if($result){
					$errcode = 1;
					$reason = "not logined, update pwd modify success";
				} else {
					$errcode = -7;
					$reason = "not logined, update pwdmodify fail";
				}
			} else {
				$errcode = -7;
				$reason = "not logined, update pwd modify unexcept";
			}
		}
	}
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<result>\n";
	echo $xml;
	echo "</result>";
?>