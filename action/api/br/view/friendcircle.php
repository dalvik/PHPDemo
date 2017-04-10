<?php
	header("Content-Type:text/html;charset=utf-8");
    include "../model/FriendCircleManager.php";
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
    $friendCircleManager = new FriendCircleManager();
    $api = $_SERVER[constant('header_api')];
    $sid = 10001;//$_SERVER[constant('header_sid')];
    //$id = $_SERVER[constant('header_id')];
    $data = null;
    $msg = null;
    if($api == "getFriendList"){//getFriendList
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$userId = $arr['userId'];
    	$userType = $arr['userType'];
    	$pageNumber = $arr['length'];
    	$offset = $arr['offset'];
    	$data = $friendCircleManager->getFirendList($userId, $userType, $pageNumber, $offset);
    } else if($api == "addFriendCircleActive"){//addFriendCircleActive
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$userCode = $arr['userCode'];
    	$activeType = $arr['activeType'];
    	$activeText = $arr['activeText'];
    	$activeImage = $arr['activeImage'];
    	$data = $friendCircleManager->addFriendCircleActive($userCode, $activeType, $activeText, $activeImage);
    } else if($api == "deleteFriendCircleActive") {//deleteFriendCircleActive
        $friendManager = new FriendManager();
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$activeId = $arr['activeId'];
    	$data = $friendCircleManager->deleteFriendCircleActive($activeId);
    } else if($api == "getFriendCircleActiveList") {
        $friendManager = new FriendManager();
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$userCode = "123456789";//$arr['userCode'];
        $userType = $arr['userType'];
        $pageNumber = (int)$arr['length'];
    	$offset = (int)$arr['offset'];
    	$activeId = $arr['_id'];
        $maxNumber = 500;//allowed max friend number
        $pageOffset = 0;
        $friendList = $friendManager->getFirendCodeList($userCode, $userType, $maxNumber, $pageOffset);
		$friendArray = array();
		$index = 0;
		foreach($friendList as $friendCode) {
			$friendArray[$index] = $friendCode["userCode"];
			$index++;
		}
		$friendArray[count($friendArray)] = $userCode;
		$listJson = json_encode($friendArray);
		$listJson = str_replace("[", "(", $listJson);
		$friendListJson = str_replace("]", ")", $listJson);
        //$friendList[count($friendList)] = array('userCoce'=>$userCode);
        //array_push($friendList, array('userCoce'=>$userCode));
    	$data = $friendCircleManager->getFriendCircleActiveList($friendListJson, $activeId, $pageNumber, $offset);
    } else if($api == "addFriendCircleActiveRemark") {//addFriendCircleActiveRemark
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$userCode = $arr['userCode'];
    	$activeId = (int)$arr['activeId'];
        $activePraise = (int)$arr['activePraise'];
    	$data = $friendCircleManager->addFriendCircleActiveRemark($userCode, $activeId, $activePraise);
    } else if($api == "cancelFriendCircleActiveRemark") {//cancelFriendCircleActiveRemark
        $friendManager = new FriendManager();
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$remarkId = $arr['activeId'];
    	$data = $friendCircleManager->cancelFriendCircleActiveRemark($remarkId);
    }  else if($api == "getFriendCircleActiveRemarkList") {//getFriendCircleActiveRemarkList
        $friendManager = new FriendManager();
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	//$userCode = $arr['userCode'];
    	$activeId = $arr['activeId'];
        $pageNumber = $arr['length'];
    	$offset = $arr['offset'];
    	$data = $friendCircleManager->getFriendCircleActiveRemarkList($activeId, $pageNumber, $offset);
    } else if($api == "addFriendCircleActiveComment") {//addFriendCircleActiveComment
        $friendManager = new FriendManager();
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$activeId = $arr['activeId'];
    	$userCode = $arr['userCode'];
        $activeCommenet = $arr['activeComment'];
    	$data = $friendCircleManager->addFriendCircleActiveComment($activeId, $userCode, $activeCommenet);
    } else if($api == "deleteFriendCircleActiveComment") {
        $friendManager = new FriendManager();
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$commentId = $arr['_id'];
    	$data = $friendCircleManager->deleteFriendCircleActiveComment($commentId);
    } else if($api == "getFriendCircleCommentList") {
        $friendManager = new FriendManager();
    	$str = file_get_contents("php://input");
    	$arr = array();
    	parse_str($str, $arr);
    	$activeId = $arr['activeId'];
    	$userCode = $arr['userCode'];
        $pageNumber = $arr['length'];
    	$offset = $arr['offset'];
    	$data = $friendCircleManager->getFriendCircleCommentList($activeId, $pageNumber, $offset);
    }
    $data['api'] = $api;
    echo json_encode($data);
 