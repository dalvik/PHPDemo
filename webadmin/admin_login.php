<?php
	include "../dbutil/mysqlinfo.php";
	include "../dbutil/mysql.php";
	session_start();
	if(!empty($_POST)){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(empty($username) || empty($password)){
			header('Location:login.php?errorcode=0');//用户名密码为空
			die();
		}
		$yzm = $_POST['verifycode'];
		if(empty($yzm) || strtolower($yzm) != strtolower($_SESSION['yzm'])){
			header('Location:login.php?errorcode=1');//验证码错误
			die();
		}
		$db = new mysql($db_hostname, $db_username, $db_password, $db_name, $db_charset);
		$result =  $db->find("alumb_users", "alumb_name = '".$username."' and alumb_password = '".MD5($password)."'", "_id, alumb_name", "", "");
		if(!empty($result)){
			$code = MD5($result['_id']).$username.MD5($password)."drovik";
			$_SESSION['shell'] = $code;
			$_SESSION['alumb_name'] = $username;
			date_default_timezone_set('PRC');
			$date = date('Y-m-d H:i:s');
			$db->edit("alumb_users", "alumb_login_time='".$date."'", "_id ='".$result['_id']."'");
			header('Location:index.php');//跳转主页
		}else{
			header('Location:login.php?errorcode=2');//用户名密码错误
		}
	}
?>

