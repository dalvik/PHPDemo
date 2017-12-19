<?php 
	include "../model/UserManager.php";
	require_once("../utils/EmailFunctions.php");
	
	$flag = sendMail("sky.xctc@163.com", "邮件激活", "欢迎点击链接激活账户");
	//$userManager = new UserManager();
	//$result = $userManager->send_mail("sky.xctc@163.com", "skyxcu@126.com", "skySKY123", "邮件激活", "欢迎点击链接激活账户");
	//$result = $userManager->send_mail("sky.xctc@163.com", "邮件激活", "欢迎点击链接激活账户");
	echo $flag;
?>