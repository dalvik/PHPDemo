<?php
	header("Content-Type:text/html;charset=utf-8");
    include "../model/FriendManager.php";
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
    $friendManager = new FriendManager();
    $api = $_SERVER[constant('header_api')];
    $sid = 10001;//$_SERVER[constant('header_sid')];
    //$id = $_SERVER[constant('header_id')];
    $data = null;
    $msg = null;
    if($api == "getFriendList"){
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$userId = $arr['userId'];
    	$userType = $arr['userType'];
    	$pageNumber = $arr['pageNumber'];
    	$offset = $arr['offset'];
    	$data = $friendManager->getFirendList($userId, $userType, $pageNumber, $offset);
    }
    echo json_encode($data);
 