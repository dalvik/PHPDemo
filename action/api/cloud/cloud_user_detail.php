<?php
	header('Content-Type:text/xml');
	include "../../dbutil/mysqlinfo.php";
	include "../../dbutil/mysql.php";
	
	$TABLE_USER_DETAIL="cloud_user_detail_list";
	
	date_default_timezone_set("PRC");
	
	$xml="";
	$errcode=0;
	$reason="";
	
	$phone="";
	$imqq="";
	$sex=0;
	$age=0;
	$wed_state=0;
	$education=0;
	$school="";
	$descripe="";
	//var_dump(getallheaders());
	if(!isset($_POST['uuid']) || empty($_POST['uuid']) || !isset($_POST['token']) || empty($_POST['token'])){
		$errcode=-3;
		$reason="parameter is invalid";
	} else {
		$sessionID = $_POST['token'];
		session_id($sessionID);
		session_start();
		$uuid = $_POST['uuid'];
		$accessToken=md5($uuid."sky");
		if(isset($_SESSION[$accessToken]) && $_SESSION[$accessToken] == $accessToken){//logined

			$db = new mysql($hostname, $username, $password, $dbname, $charset);
			
			$detail_where = "uuid='".$uuid."'";
			$detail_field="phone, imqq, sex, age, wed_state, education, school, descripe";
			//verify user info, user login with email or uuid
			$detalInfo = $db->find($TABLE_USER_DETAIL, $detail_where, $detail_field);
			if(!empty($detalInfo)){
				$errcode = 1;
				$phone=$detalInfo['phone'];
				$imqq=$detalInfo['imqq'];
				$sex=$detalInfo['sex'];
				$age=$detalInfo['age'];
				$wed_state=$detalInfo['wed_state'];
				$education=$detalInfo['education'];
				$school=$detalInfo['school'];
				$descripe=$detalInfo['descripe'];
			} else {
				$errcode = -5;
				$reason="user info is not exist";
			}
		} else {//not logined
			$errcode = -4;
			$reason="user not logined";
		}
	}
	$xml.="<errorcode>".$errcode."</errorcode>\n";
	$xml.="<reason>".$reason."</reason>\n";
	
	$xml.="<phone>".$phone."</phone>\n";
	$xml.="<imqq>".$imqq."</imqq>\n";
	$xml.="<sex>".$sex."</sex>\n";
	$xml.="<age>".$age."</age>\n";
	$xml.="<wed_state>".$wed_state."</wed_state>\n";
	$xml.="<education>".$education."</education>\n";
	$xml.="<school><![CDATA[".$school."]]></school>\n";
	$xml.="<descripe><![CDATA[".$descripe."]]></descripe>\n";
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<body>\n";
	echo "<userinfo>\n";
	echo $xml;
	echo "</userinfo>\n";
	echo "</body>";
?>