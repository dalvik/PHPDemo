<?php
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
include "../utils/StringsUtil.php";
include "../model/UserManager.php";

//$invite_code = $_GET['invite_code'];
//$invite_time = $_GET['invite_time'];
//$invite_type = $_GET['invite_type'];
//$invite_email = $_GET['invite_email'];
$TABLE_BR_USER = "br_user";
date_default_timezone_set("PRC");

if(!isset($_GET['invite_code']) || !isset($_GET['invite_email'])){
	$str = <<<html
	<head>
		<title>注册激活</title>
	</head>
    <body>
		<div>
			<font color='red' size='5'>
				 参数错误。
			</font
		</div>
	</body>
html;
    echo $str;
} else {
	$userManager = new UserManager();
	$inviteCode = intval($_GET['invite_code']);
	$inviteType = intval($_GET['invite_type']);
	$data = $userManager->activeUser($_GET['invite_email'], $inviteCode, $inviteType);
    $result = $data['code'];
	$tip = "";
	if($result == 1000){
		$tip = "恭喜！激活成功。欢迎使用。";
	} else if($result == 1005){
		$tip = "已激活，请在安卓客户端登陆。";
	} else if($result == -1007){
		$tip = "邀请码过期，请重新获取。";
	} else if($result == -1008){
		$tip = "邀请码错误。";
	} else if($result == -1006){
		$tip = "激活失败。";
	} else if($result == -1009){
		$tip = "未知错误。";
	} else if($result == -1002){
		$tip = "邀请码不存在。";
	}  else if($result == -1002){
		$tip = "邀请码不存在。";
	} else {
        $tip = "未知错误。";
    }
	$content = <<<html
	<head>
		<title>注册激活</title>
	</head>
	<body>
		<div>
			<font color='red' size='5'>
				$tip
			</font>
		</div>
	</body>
html;
	echo $content;
}

?>