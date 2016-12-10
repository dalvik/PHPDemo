<?php
//header("content-type:text/html;charset=utf8");
header("Content-type: text/xml");
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
$db = new mysql($hostname, $username, $password, $dbname, $charset);
$table = "sms_client";
$data = "";
/*
$xml = "<client>\n";
$xml .= "<userinfo>\n";
$xml .= "<_id>123455</_id>\n";
$xml .= "<nick_name>DF-EB-EE-EA</nick_name>\n";
$xml .= "<password>123.123.45.63</password>\n";
$xml .= "<mac>1833453049</mac>\n";
$xml .= "<ip>13598761234</ip>\n";
$xml .= "<verify_no>namenamn</verify_no>\n";
$xml .= "<sex>1</sex>\n";
$xml .= "<age>12</age>\n";
$xml .= "<personly>1</personly>\n";
$xml .= "<emotion_state>123.1344567</emotion_state>\n";
$xml .= "<stars>21.349238</stars>\n";
$xml .= "<company>1</company>\n";
$xml .= "<school>123.1344567</school>\n";
$xml .= "<grade>21.349238</grade>\n";
$xml .= "<jobs>1</jobs>\n";
$xml .= "<descrip>123.1344567</descrip>\n";
$xml .= "<times>21.349238</times>\n";
$xml .= "<regist_time>1</regist_time>\n";
$xml .= "<login_time>1</login_time>\n";
$xml .= "<lo>123.1344567</lo>\n";
$xml .= "<la>21.349238</la>\n";
$xml .= "</userinfo>\n";
$xml .= "</client>\n";*/
	if(!empty($_POST['content'])){
		$content = $_POST['content'];
		$dom = DOMDocument::loadXML($content);
		$userinfo = $dom->getElementsByTagName("userinfo");
		foreach($userinfo as $sms){
			$types = $sms->getElementsByTagName("type");
			$type = $types->item(0)->nodeValue;
			$emails = $sms->getElementsByTagName("email");
			$email = $emails->item(0)->nodeValue;

			if($type == 1){// check email is registed
				$result =  $db->find($table, "email = '".$email."'", "_id", "", "");
				if($result > 0){
					$data .="<_id>".$result['_id']."</_id>\n";
					$data .="<result>1</result>\n";
					$data .="<reson>0</reson>\n";
				}else{
					$data .="<_id>-1</_id>\n";
					$data .="<result>-1</result>\n";
					$data .="<reson>".mysql_error()."</reson>\n";
				}
			} else if($type == 2){// check userid and password for login
			    $_ids = $sms->getElementsByTagName("_id");
				$_id = $_ids->item(0)->nodeValue;
				$passwords = $sms->getElementsByTagName("password");
				$password = $passwords->item(0)->nodeValue;
				$result =  $db->find($table, "_id = '".$_id."'", "password", "", "");
				$data .="<_id>".$_id."</_id>\n";
				if($result['password'] != null && $result['password'] == $password){
					$macs = $sms->getElementsByTagName("mac");
					$mac = $macs->item(0)->nodeValue;
					$ips = $sms->getElementsByTagName("ip");
					$ip = $ips->item(0)->nodeValue;
					$timess = $sms->getElementsByTagName("times");
					$times = $timess->item(0)->nodeValue;
					$regist_times = $sms->getElementsByTagName("regist_time");
					$regist_time = $regist_times->item(0)->nodeValue;
					$login_times = $sms->getElementsByTagName("login_time");
					$login_time = $login_times->item(0)->nodeValue;
					$los = $sms->getElementsByTagName("lo");
					$lo = $los->item(0)->nodeValue;
					$las = $sms->getElementsByTagName("la");
					$la = $las->item(0)->nodeValue;
					$sql = "mac='".$mac."',ip='".$ip."', times=times+1, login_time='".$login_time."',lo='".$lo."',la='".$la."'";
					$result = $db->edit($table,$sql,"_id='".$_id."'");
					if($result > 0){
						$data .="<result>1</result>\n";// login success
						$data .="<reson>0</reson>\n";
					}else{
						$data .="<result>-1</result>\n";// login fail
						$data .="<reson>".mysql_error()."</reson>\n";
					}
				}else{
					$data .="<result>-1</result>\n";//failed
					$data .="<reson>-1</reson>\n";// password not correct
				}
			} else if($type == 3){//check email and passsowrd for login 
				$passwords = $sms->getElementsByTagName("password");
				$password = $passwords->item(0)->nodeValue;
				$result =  $db->find($table, "email = '".$email."'", "_id, password", "", "");
				$id = -1;
				if($result['password'] != null && $result['password'] == $password){
					$id = $result['_id'];
					$macs = $sms->getElementsByTagName("mac");
					$mac = $macs->item(0)->nodeValue;
					$ips = $sms->getElementsByTagName("ip");
					$ip = $ips->item(0)->nodeValue;
					$timess = $sms->getElementsByTagName("times");
					$times = $timess->item(0)->nodeValue;
					$regist_times = $sms->getElementsByTagName("regist_time");
					$regist_time = $regist_times->item(0)->nodeValue;
					$login_times = $sms->getElementsByTagName("login_time");
					$login_time = $login_times->item(0)->nodeValue;
					$los = $sms->getElementsByTagName("lo");
					$lo = $los->item(0)->nodeValue;
					$las = $sms->getElementsByTagName("la");
					$la = $las->item(0)->nodeValue;
					$sql = "mac='".$mac."',ip='".$ip."', times=times+1, login_time='".$login_time."',lo='".$lo."',la='".$la."'";
					$result = $db->edit($table,$sql,"email='".$email."'");
					if($result > 0){
						$data .="<_id>".$id."</_id>\n";
						$data .="<result>1</result>\n";// login success
						$data .="<reson>0</reson>\n";
					}else{
						$data .="<_id>-2</_id>\n";// update  failed
						$data .="<result>-1</result>\n";// login fail
						$data .="<reson>".mysql_error()."</reson>\n";
					}
				}else{
					$data .="<_id>-1</_id>\n";
					$data .="<result>-1</result>\n";//unregisted or password not correct
					$data .="<reson>-1</reson>\n";// password not correct
				}
			} else if($type == 4){// regist new userinfo
				$passwords = $sms->getElementsByTagName("password");
				$password = $passwords->item(0)->nodeValue;
				$macs = $sms->getElementsByTagName("mac");
				$mac = $macs->item(0)->nodeValue;
				$ips = $sms->getElementsByTagName("ip");
				$ip = $ips->item(0)->nodeValue;
				$nick_names = $sms->getElementsByTagName("nick_name");
				$nick_name = $nick_names->item(0)->nodeValue;
				$verify_nos = $sms->getElementsByTagName("verify_no");
				$verify_no = $verify_nos->item(0)->nodeValue;
				$sexs = $sms->getElementsByTagName("sex");
				$sex = $sexs->item(0)->nodeValue;
				$ages = $sms->getElementsByTagName("age");
				$age = $ages->item(0)->nodeValue;
				$personlys = $sms->getElementsByTagName("personly");
				$personly = $personlys->item(0)->nodeValue;
				$emotion_states = $sms->getElementsByTagName("emotion_state");
				$emotion_state = $emotion_states->item(0)->nodeValue;
				if($emotion_state == ''){
					$emotion_state = 0;
				}
				$starss = $sms->getElementsByTagName("stars");
				$stars = $starss->item(0)->nodeValue;
				if($stars ==''){
					$stars = 0;
				}
				$companys = $sms->getElementsByTagName("company");
				$company = $companys->item(0)->nodeValue;
				$schools = $sms->getElementsByTagName("school");
				$school = $schools->item(0)->nodeValue;
				$grades = $sms->getElementsByTagName("grade");
				$grade = $grades->item(0)->nodeValue;
				$jobss = $sms->getElementsByTagName("jobs");
				$jobs = $jobss->item(0)->nodeValue;
				$descrips = $sms->getElementsByTagName("descrip");
				$descrip = $descrips->item(0)->nodeValue;
				$regist_times = $sms->getElementsByTagName("regist_time");
				$regist_time = $regist_times->item(0)->nodeValue;
				$login_times = $sms->getElementsByTagName("login_time");
				$login_time = $login_times->item(0)->nodeValue;
				$los = $sms->getElementsByTagName("lo");
				$lo = $los->item(0)->nodeValue;
				$las = $sms->getElementsByTagName("la");
				$la = $las->item(0)->nodeValue;
				$sql = "email='".$email."', nick_name='".$nick_name."', password ='".$password."', mac='".$mac."',ip='".$ip."',verify_no='".MD5($mac)."', sex='".$sex."', age='".$age."', personly='".$personly."',emotion_state='".$emotion_state."',stars='".$stars."',company='".$company."',school='".$school."', grade='".$grade."', jobs='".$jobs."', descrip='".$descrip."',  regist_time='".$regist_time."',login_time='".$regist_time."',lo='".$lo."',la='".$la."'";
				$result = $db->add($table,$sql);
				if($result > 0){
					$data .="<_id>".mysql_insert_id()."</_id>\n";
					$data .="<result>1</result>\n";
					$data .="<reson>0</reson>\n";
				}else{
					$data .="<_id>-1</_id>\n";
					$data .="<result>'".$sql."'</result>\n";
					$data .="<reson>".mysql_error()."</reson>\n";
				}
			}
		}
	}
	/*if(!empty($_POST['sms_client_update'])){
		$content = $_POST['sms_client_update'];
		$dom = DOMDocument::loadXML($content);
		$userinfo = $dom->getElementsByTagName("userinfo");
		foreach($userinfo as $sms){
			$_ids = $sms->getElementsByTagName("_id");
			$_id = $_ids->item(0)->nodeValue;
			$nick_names = $sms->getElementsByTagName("nick_name");
			$nick_name = $nick_names->item(0)->nodeValue;
			$passwords = $sms->getElementsByTagName("password");
			$password = $passwords->item(0)->nodeValue;
			$macs = $sms->getElementsByTagName("mac");
			$mac = $macs->item(0)->nodeValue;
			$ips = $sms->getElementsByTagName("ip");
			$ip = $ips->item(0)->nodeValue;
			$verify_nos = $sms->getElementsByTagName("verify_no");
			$verify_no = $verify_nos->item(0)->nodeValue;
			$emotion_states = $sms->getElementsByTagName("emotion_state");
			$emotion_state = $emotion_states->item(0)->nodeValue;
			$starss = $sms->getElementsByTagName("stars");
			$stars = $starss->item(0)->nodeValue;
			$companys = $sms->getElementsByTagName("company");
			$company = $companys->item(0)->nodeValue;
			$schools = $sms->getElementsByTagName("school");
			$school = $schools->item(0)->nodeValue;
			$grades = $sms->getElementsByTagName("grade");
			$grade = $grades->item(0)->nodeValue;
			$jobss = $sms->getElementsByTagName("jobs");
			$jobs = $jobss->item(0)->nodeValue;
			$descrips = $sms->getElementsByTagName("descrip");
			$descrip = $descrips->item(0)->nodeValue;
			$timess = $sms->getElementsByTagName("times");
			$times = $timess->item(0)->nodeValue;
			$regist_times = $sms->getElementsByTagName("regist_time");
			$regist_time = $regist_times->item(0)->nodeValue;
			$login_times = $sms->getElementsByTagName("login_time");
			$login_time = $login_times->item(0)->nodeValue;
			$los = $sms->getElementsByTagName("lo");
			$lo = $los->item(0)->nodeValue;
			$las = $sms->getElementsByTagName("la");
			$la = $las->item(0)->nodeValue;
			$sql = "nick_name='".$nick_name."', password ='".$password."', mac='".$mac."',ip='".$ip."',verify_no='".$verify_no."',emotion_state='".$emotion_state."',stars='".$stars."',company='".$company."',school='".$school."', grade='".$grade."', jobs='".$jobs."', descrip='".$descrip."', times='".$times."', regist_time='".$regist_time."',login_time='".$login_time."',lo='".$lo."',la='".$la."'";
			$result = $db->edit($table,$sql,"_id = ".$_id);
			$data .="<_id>".$result."</_id>\n";
			if($result > 0){
				$data .="<result>1</result>\n";
				$data .="<reson>0</reson>\n";
			}else{
				$data .=mysql_error();
				$data .="<result>-1</result>\n";
				$data .="<reson>'".mysql_error()."'</reson>\n";
			}
		}
	}*/
	/*if(!empty($_POST['sms_client_login'])){
		$content = $_POST['sms_client_login'];
		$dom = DOMDocument::loadXML($content);
		$userinfo = $dom->getElementsByTagName("userinfo");
		foreach($userinfo as $sms){
			$nick_names = $sms->getElementsByTagName("nick_name");
			$nick_name = $nick_names->item(0)->nodeValue;
			$passwords = $sms->getElementsByTagName("password");
			$password = $passwords->item(0)->nodeValue;
			$result = $db->find($table,"nick_name='".$nick_name."' and password='".$password."'");
			foreach($result as $v){
				$data .= "<userinfo>\n";
				$data .= "<_id>".$v['_id']."</_id>\n";*/
				/*$data .= "<nick_name>".$v['nick_name']."</nick_name>\n";
				$data .= "<password>".$v['password']."</password>\n";
				$data .= "<mac>".$v['mac']."</mac>\n";
				$data .= "<ip>".$v['ip']."</ip>\n";
				$data .= "<verify_no>".$v['verify_no']."</verify_no>\n";
				$data .= "<sex>".$v['sex']."</sex>\n";
				$data .= "<age>".$v['age']."</age>\n";
				$data .= "<personly>".$v['personly']."</personly>\n";
				$data .= "<emotion_state>".$v['emotion_state']."</emotion_state>\n";
				$data .= "<stars>".$v['stars']."</stars>\n";
				$data .= "<company>".$v['company']."</company>\n";
				$data .= "<school>".$v['school']."</school>\n";
				$data .= "<grade>".$v['grade']."</grade>\n";
				$data .= "<jobs>".$v['jobs']."</jobs>\n";
				$data .= "<descrip>".$v['descrip']."</descrip>\n";
				$data .= "<times>".$v['times']."</times>\n";
				$data .= "<regist_time>".$v['regist_time']."</regist_time>\n";
				$data .= "<login_time>".$v['login_time']."</login_time>\n";
				$data .= "<lo>".$v['lo']."</lo>\n";
				$data .= "<la>".$v['la']."</la>\n";*/
				/*$data .= "</userinfo>\n";
			}
		}
	}*/
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<data>\n";
echo $data;
echo "</data>";
?>