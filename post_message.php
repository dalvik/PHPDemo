<?php
	include "dbutil/mysqlinfo.php";
	include "dbutil/mysql.php";
	session_start();
	if(!empty($_POST)){
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$content = $_POST['content'];
		if(empty($email)){
			header('Location:drovikmessage.php?errorcode=0');//����Ϊ��
			die();
		}
		if(empty($phone)){
			header('Location:drovikmessage.php?errorcode=1');//�绰����Ϊ��
			die();
		}
		if(empty($content)){
			header('Location:drovikmessage.php?errorcode=2');//��������Ϊ��
			die();
		}
		if(strlen($content)>=140){
			header('Location:drovikmessage.php?errorcode=3');//��������̫��
			die();
		}
		$yzm = $_POST['verifycode'];
		if(empty($yzm) || strtolower($yzm) != strtolower($_SESSION['yzm'])){
			header('Location:drovikmessage.php?errorcode=4');//��֤�����
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
			header('Location:drovikmessage.php?errorcode=5');//�ύ�ɹ�����ȴ��ظ���лл
			die();
		}else{
			header('Location:drovikmessage.php?errorcode=6');//�ύʧ��
			die();
		}
	}
?>

