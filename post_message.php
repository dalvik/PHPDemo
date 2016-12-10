<?php
	include "dbutil/mysqlinfo.php";
	include "dbutil/mysql.php";
	session_start();
	if(!empty($_POST)){
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$content = $_POST['content'];
		if(empty($email)){
			header('Location:drovikmessage.php?errorcode=0');//邮箱为空
			die();
		}
		if(empty($phone)){
			header('Location:drovikmessage.php?errorcode=1');//电话号码为空
			die();
		}
		if(empty($content)){
			header('Location:drovikmessage.php?errorcode=2');//留言内容为空
			die();
		}
		if(strlen($content)>=140){
			header('Location:drovikmessage.php?errorcode=3');//留言内容太长
			die();
		}
		$yzm = $_POST['verifycode'];
		if(empty($yzm) || strtolower($yzm) != strtolower($_SESSION['yzm'])){
			header('Location:drovikmessage.php?errorcode=4');//验证码错误
			die();
		}
		$db = new mysql($hostname, $username, $password, $dbname, $charset);
		$table = "dav_message";
		$time = date('Y-m-d G:i:s',date('U') + 8*3600);
		$content = mb_convert_encoding($content, "UTF-8", "GBK"); 
		$wh = "type=0, email='".$email."', phone='".$phone."', content='".$content."', time='".$time."'";
		$result = $db->add($table, $wh);
		//$eror = mysql_error();
		//exit("<script>alert('".mysql_error()."')</script>");
		if(!empty($result)){
			header('Location:drovikmessage.php?errorcode=5');//提交成功，请等待回复，谢谢
			die();
		}else{
			header('Location:drovikmessage.php?errorcode=6');//提交失败
			die();
		}
	}
?>

