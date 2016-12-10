<?php
	header('Content-Type:text/xml');
	include "../../dbutil/mysqlinfo.php";
	include "../../dbutil/mysql.php";
	
	$TABLE_USER="cloud_user_list";
	$TABLE_USER_DETAIL="cloud_user_detail_list";
	$TABLE_LOGIN_LIST="cloud_user_login_list";
	
	date_default_timezone_set("PRC");
	
	$xml="";
	$errcode=0;
	$reason="";
	$domain="";
	$uuid="";
	$email="";
	$state="";
	$total_space=0;
	$used_space=0;
	$score=0;
	$sessionId=0;
	//$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if(!isset($_POST['email']) || !isset($_POST['password']) || empty($_POST['email']) || empty($_POST['password']) ){
		$errcode=-3;
		$reason="email or password is null";
	} else {
		$db = new mysql($hostname, $username, $password, $dbname, $charset);
		$email = $_POST['email'];
		$password = $_POST['password'];
		$mac=$_POST['mac'];
		$lo=$_POST['lo'];
		$la=$_POST['la'];
		$where = "email='".$email."' or uuid='".$email."'";
		$field = "uuid, email, password, domain, state, total_space, used_space, score";
		//verify user info, user login with email or uuid
		$result = $db->find($TABLE_USER, $where, $field);
		if(!empty($result)){
			//$errcode = $result['password'];
			if($password == $result['password']){
				$errcode = 1;
				$uuid = $result['uuid'];
				$email = $result['email'];
				$domain = $result['domain'];
				$accessToken=md5($uuid."sky");
				session_start();
				$sessionId=session_id();
				$_SESSION[$accessToken] = $accessToken;//save login token
				$state = $result['state'];
				$total_space = $result['total_space'];
				$used_space = $result['used_space'];
				$score = $result['score'];
				$set = "uuid='".$uuid."', mac='".$mac."', lo='".$lo."', la='".$la."', login_time='".time()."'";
				// add login record
				$db->add($TABLE_LOGIN_LIST, $set);
			} else {
				$errcode = -6;
				$reason="username or password is not correct";
			}
		} else {
			$errcode = -5;
			$reason="user is not exist";
		}
	}
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	$xml.="<sessionid>".$sessionId."</sessionid>\n";
	$xml.="<domain>".$domain."</domain>\n";
	$xml.="<uuid>".$uuid."</uuid>\n";
	$xml.="<email>".$email."</email>\n";
	$xml.="<state>".$state."</state>\n";
	$xml.="<total_space>".$total_space."</total_space>\n";
	$xml.="<used_space>".$used_space."</used_space>\n";
	$xml.="<score>".$score."</score>\n";
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<body>\n";
	echo "<user>\n";
	echo $xml;
	echo "</user>\n";
	echo "</body>";
?>