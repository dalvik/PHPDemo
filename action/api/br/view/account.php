<?php 
	include "../model/UserManager.php";
	
	$userManager = new UserManager();
	$result = $userManager->send_mail("sky.xctc@163.com", "skyxcu@126.com", "sky123", "邮件激活", "欢迎点击链接激活账户");
	echo $result;
?>