<?php
	header("Content-Type:text/html;charset=utf-8");
    include "../model/UserManager.php";
    include "../model/ParamParse.php";
    //include "../utils/HeaderKey.php";
    require_once("../utils/HeaderKey.php");
    
    $paramParse = new ParamParse();
    $code = $paramParse->checkUserParameter($_SERVER);
    if($code<0){
        $array = array("id"=>-1, "code"=>$code, "message"=>"error messge", "data"=>NULL);
        echo json_encode($array);
        exit(0);
    }
    date_default_timezone_set("PRC");
    $userManager = new UserManager();
    $api = $_SERVER[constant('header_api')];
    $sid = 10001;//$_SERVER[constant('header_sid')];
    //$id = $_SERVER[constant('header_id')];
    $data = null;
    $msg = null;
    if($api == "userRegistered"){
    	$account = $_GET['mobile'];
        $isRegister = $userManager->isRegister($account);
        // 0：未注册 1：已注册，正常使用 2：已注册未激活  3：锁定 -1：注销
        $data = array("status"=>$isRegister);
        $msg = "success";
    } else if($api == "userRegister"){
        $str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$account = $arr['mobile'];
        $registerType = $arr['type'];
        $registerPwd = $arr['password'];
    	$data = $userManager->register($account, "", $registerType, $registerPwd);
    } else if($api == "userLogin"){
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$account = $arr['mobile'];
    	$pwd = $arr['password'];
        $data = $userManager->login($account, $pwd, "type");
    } else if($api == "userUpdate"){
        $str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
        $data = $userManager->updateUserInfo($arr);
    } else if($api == "userActive"){
        $code = $userManager->userActive($account, "1", "1");
    } else if($api == "searchUser"){
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$account = $arr['mobile'];
    	$data = $userManager->searchUser($account);
    } else if($api == "addFriend"){//add friend, rong send add message
    	$data = array();
    	$data['code'] = 200;
    	$data['data'] = null;
    	$data['message'] = null;
    }
    //$array = array("id"=>$sid, "code"=>$code, "message"=>$msg, "data"=>$data);
    echo json_encode($data);
 