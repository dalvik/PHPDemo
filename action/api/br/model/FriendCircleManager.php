<?php
    require_once("../model/BaseManager.php");
    require_once "../utils/StringsUtil.php";
    require_once("../utils/FriendColumn.php");
    require_once("../utils/FriendCircleActiveColumn.php");
    require_once("../utils/FriendCircleRemarkColumn.php");
    require_once("../utils/FriendCircleCommentColumn.php");
    
    class FriendCircleManager extends BaseManager{
    	/*
    	{
    		"id=>"1000, "code=>"2000, "message=>"noerror, "data=>"{result}
    	}
    	 */
        public $TABLE_BR_FRIEND_CIRCLE_ACTIVE = "br_user_friend_circle_active";
        public $TABLE_BR_FRIEND_CIRCLE_REMARK = "br_user_firend_circle_active_remark";
        public $TABLE_BR_FRIEND_CIRCLE_COMMENT = "br_user_firend_circle_active_comment";
        
        public $VIEW_BR_FRIEND_CIRCLE_ACTIVE = "br_view_user_friend_circle_active";
        public $VIEW_BR_FRIEND_CIRCLE_ACTIVE_REMARK = "br_view_user_friend_circle_active_remark";
        public $VIEW_BR_FRIEND_CIRCLE_ACTIVE_COMMENT = "br_view_user_friend_circle_active_comment";
        
        function __construct(){
        }
    

        /**
         * add friend circle active
         * @param unknown $userId
         * @param unknown $activeType
         * @param unknown $activeText
         * @param unknown $activeImage
         * @return multitype:NULL multitype:NULL
         */
        function addFriendCircleActive($userId, $activeType, $activeText, $activeImage){
        	$arr = array();
        	$resultCode = -1;
        	$user_code = $this->get('userCode');
        	$active_type = $this->get('activeType');
        	$active_text = $this->get('activeText');
                $column_active_text_summary = $this->get('activeTextSummary');
        	$active_image = $this->get('activeImage');
        	$active_time = $this->get('activeTime');
                $activeSummary = "";
                if(strlen($activeText)>60){
                    $activeSummary = substr($activeText, 0, 60);
                } else {
                    $activeSummary = $activeText;
                }
        	$now = time();
                $set = $user_code."='".$userId."',".$active_type."=".$activeType.",".$active_text."='".$activeText."' ,".$column_active_text_summary."='".$activeSummary."', ".$active_image."='".$activeImage."',".$active_time."=".$now;
        	$db = $this->initMysql();
        	$result = $db->add($this->TABLE_BR_FRIEND_CIRCLE_ACTIVE, $set);
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
                $addResult = array();
                $addResult['activeId'] = $db->getInsertId();
        		$arr['data'] = $addResult;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * delte active by id
         * @param $activeId
         * @return multitype:NULL multitype:NULL
         */
        function deleteFriendCircleActive($activeId){
        	$arr = array();
        	$resultCode = -1;
        	$active_id = $this->get('_id');
        	$db = $this->initMysql();
        	$where = $active_id." = '".$activeId."'";
        	$result = $db->del($this->TABLE_BR_FRIEND_CIRCLE_ACTIVE, $where);
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
                $deleteResult = array();
                $deleteResult['activeId'] = $activeId;
                $this->clearFriendCircleActiveRemark($db, $activeId);
        		$arr['data'] = $deleteResult;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * get friend circle active list by friend user code list
         * @param unknown $friendList
         * @param unknown $activeType
         * @param unknown $pageNumber
         * @param unknown $offset
         * @return multitype:NULL unknown
         */
        function getFriendCircleActiveList($friendList, $activeId, $pageNumber, $offset){
        	$arr = array();
        	$resultCode = -1;
        	$column_active_id = $this->get('_id');
        	$column_user_code = $this->get('userCode');
        	$column_nick_name = $this->get('nickName');
			$column_head_icon = $this->get('headIcon');
        	$column_active_type = $this->get('activeType');
        	$column_active_text_summary = $this->get('activeTextSummary');
        	$column_active_image = $this->get('activeImage');
        	$column_active_time = $this->get('activeTime');
        	//$friendArray = array();
        	//$index = 0;
                //print_r($friendList);
        	//foreach($friendList as $friendCode) {
                //    print_r($friendCode[0]); 
                //echo $friendCode["userCode"];
        		//$friendArray[$index] = $friendCode["userCode"];
        		//$index++;
        	//}
        	//$listJson = json_encode($friendArray);
        	//$listJson = str_replace("[", "(", $listJson);
        	//$where = $column_user_code." in ".str_replace("]",")", $listJson)." and ".$column_active_id." > ".$activeId;
            $where = $column_user_code." in ".$friendList." and ".$column_active_id." > ".$activeId;
        	$pro = $column_active_id.", ".$column_user_code.", ".$column_nick_name.", ".$column_head_icon.", ".$column_active_type.", ".$column_active_text_summary.", ".$column_active_image.", ".$column_active_time." ";
        	$order = $column_active_time;
        	$limit = $offset * $pageNumber.", ".$pageNumber;
        	$db = $this->initMysql();
        	$result = $db->findMore($this->VIEW_BR_FRIEND_CIRCLE_ACTIVE, $where, $pro, "", $order, $limit);
        	$arr['msg'] = $db->getMySqlError();
        	if($result != FALSE){
        		$arr['code'] = $this->get('common_result_success');
	                $activeList = array();
	                $index = 0;
	                foreach($result as $var) {
	                    $activeItem = array();
	                    $tempUserCode = $var[$column_user_code];
	                    $tempActiveId = $var[$column_active_id];
	                    $tempNickName = $var[$column_nick_name];
						$tempHeadIcon = $var[$column_head_icon];
	                    $tempActiveType = $var[$column_active_type];
	                    $tempActiveSummary = $var[$column_active_text_summary];
	                    $tempActiveImage = $var[$column_active_image];
	                    $tempActiveTime = $var[$column_active_time];
	                    $activeItem[$column_user_code] = $tempUserCode;
	                    $activeItem[$column_active_id] = $tempActiveId;
	                    $activeItem[$column_nick_name] = $tempNickName;
						$activeItem[$column_head_icon] = $tempHeadIcon;
	                    $activeItem[$column_active_type] = $tempActiveType;
	                    $activeItem[$column_active_text_summary] = $tempActiveSummary;
	                    $activeItem[$column_active_image] = $tempActiveImage;
	                    $activeItem[$column_active_time] = $tempActiveTime;
	                    $tempRemarkList = $this->getFriendCircleActiveRemarkList($db, $tempActiveId, 100, 0);
	                    //var_dump($tempRemarkList);
	                    if($tempRemarkList['code'] == 200){
	                        $activeItem["activeRemarkList"] = $tempRemarkList['data'];
	                    }
	                    $tempCommenkList = $this->getFriendCircleCommentList($db, $tempActiveId, 100, 0);
	                    //print_r($tempCommenkList);
	                    if($tempCommenkList['code'] == 200){
	                        $activeItem["activeCommentList"] = $tempCommenkList['data'];
	                    }
	                    $activeList[$index++] = $activeItem;
	                    //var_dump($activeList);
	                }
	                $arr['data'] = $activeList;
        	} else {
                if($arr['msg'] != ""){
                    $arr['code'] = $this->get('user_query_error');
                } else {
                    $arr['code'] = $this->get('common_result_success');
                }
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * add friend circle remark
         * @param $userCode
         * @param $activeId
         * @param $activePraise
         * @return multitype:NULL unknown
         */
        function addFriendCircleActiveRemark($userCode, $activeId, $activePraise){
        	$arr = array();
        	$resultCode = -1;
        	$column_user_code = $this->get('userCode');
        	$column_active_id = $this->get('activeId');
        	$column_active_praise = $this->get('activePraise');
        	$column_active_praise_time = $this->get('activePraiseTime');
        	$now = time();
        	$set = $column_user_code."='".$userCode."', ".$column_active_id."='".$activeId."', ".$column_active_praise."='".$activePraise."', ".$column_active_praise_time."='".$now."'";
            
        	$db = $this->initMysql();
            
                $where = $column_user_code." = ".$userCode." and ".$column_active_id."=".$activeId;
                $pro = $column_active_id;
                $exists = $db->find($this->VIEW_BR_FRIEND_CIRCLE_ACTIVE_REMARK, $where, $pro, "", "");
            
               if(empty($exists)){
                     $result = $db->add($this->TABLE_BR_FRIEND_CIRCLE_REMARK, $set);
                     $arr['msg'] = $db->getMySqlError();
                    if(!empty($result)){
                        $arr['code'] = $this->get('common_result_success');
                        $info = array();
                        $info[$column_active_id] = $activeId;
                        $arr['data'] = $info;
                    }else {
                        $arr['code'] = $this->get('user_query_error');
                        $arr['data'] = null;
                    }
               } else {
                    $info = array();
                    $arr['msg'] = $db->getMySqlError();
                    $info[$column_active_id] = $exists[$column_active_id];
                    $arr['code'] = $this->get('common_result_success');
                    $arr['data'] = $info;
               }
               return $arr;
        }
        
        /**
         * cancel active remark by active id
         * @param unknown $activeId
         * @return multitype:NULL unknown
         */
        function cancelFriendCircleActiveRemark($remarkId){
        	$arr = array();
        	$resultCode = -1;
        	$column_remark_id = $this->get('_id');
        	$where = $column_remark_id." = '".$remarkId."'";
        	$now = time();
        	$db = $this->initMysql();
        	$result = $db->del($this->TABLE_BR_FRIEND_CIRCLE_REMARK, $where);
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$info = array();
                $info[$column_remark_id] = $remarkId;
                $arr['data'] = $info;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * clear active remark by active id
         * @param unknown $activeId
         * @return multitype:NULL unknown
         */
        function clearFriendCircleActiveRemark($db, $activeId){
        	$arr = array();
        	$resultCode = -1;
        	$column_active_id = $this->get('activeId');
        	$where = $column_active_id." = '".$activeId."'";
        	$now = time();
        	$result = $db->del($this->TABLE_BR_FRIEND_CIRCLE_REMARK, $where);
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$arr['data'] = null;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * get friend circle remark list
         * @param unknown $userCode who remark
         * @param unknown $activeId remark which active
         * @param unknown $pageNumber
         * @param unknown $offset
         * @return multitype:NULL unknown
         */
        function getFriendCircleActiveRemarkList($db, $activeId, $pageNumber, $offset){
        	$arr = array();
        	$resultCode = -1;
                $column_remark_id = $this->get('_id');
        	$column_user_code = $this->get('userCode');
        	$column_nick_name = $this->get('nickName');
        	$column_active_id = $this->get('activeId');
        	$column_active_praise = $this->get('activePraise');
        	$column_active_praise_time = $this->get('activePraiseTime');
        	$where = $column_active_id." = '".$activeId."'";
        	$pro = $column_remark_id.", ".$column_user_code.", ".$column_nick_name.", ".$column_active_id.", ".$column_active_praise.", ".$column_active_praise_time;
        
        	$order = $column_active_praise_time;
        	$limit = $offset * $pageNumber. ", ".$pageNumber;
        	$result = $db->findMore($this->VIEW_BR_FRIEND_CIRCLE_ACTIVE_REMARK, $where, $pro, "", $order, $limit);
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$arr['data'] = $result;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * add new active comment
         * @param unknown $activeId
         * @param unknown $userCode
         * @param unknown $commenetText
         * @return multitype:NULL multitype:NULL
         */
        function addFriendCircleActiveComment($activeId, $userCode, $activeComment, $recvUserCode){
        	$arr = array();
        	$resultCode = -1;
        	$column_active_id = $this->get('activeId');
        	$column_user_code = $this->get('userCode');
        	$column_active_comment = $this->get('activeComment');
                $column_active_recv_user_code = $this->get('recvUserCode');
        	$column_active_comment_time = $this->get('activeCommentTime');
        	$now = time();
        	$set = $column_user_code."='".$userCode."', ".$column_active_id."='".$activeId."', ".$column_active_comment."='".$activeComment."', ".$column_active_recv_user_code.="='".$recvUserCode."', ".$column_active_comment_time."='".$now."'";
        	$db = $this->initMysql();
        	$result = $db->add($this->TABLE_BR_FRIEND_CIRCLE_COMMENT, $set);
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$addResult = array();
                $addResult['activeId'] = $activeId;
                $addResult['activeComment'] = $activeComment;
                $addResult['activeCommentTime'] = $now;
        		$arr['data'] = $addResult;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * delete active comment by id
         * @param unknown $activeId
         * @param unknown $userCode
         * @param unknown $activeComment
         * @return multitype:NULL multitype:NULL
         */
        function deleteFriendCircleActiveComment($commentId){
        	$arr = array();
        	$resultCode = -1;
        	$column_active_id = $this->get('activeId');
        	$column_user_code = $this->get('userCode');
        	$column_active_comment = $this->get('activeComment');
        	$column_active_comment_time = $this->get('activeCommentTime');
        	$now = time();
        	$set = $column_user_code."='".$userCode."', ".$column_active_comment."='".$activeComment."', ".$column_active_comment_time."='".$now."'";
        	$db = $this->initMysql();
        	$result = $db->del($this->TABLE_BR_FRIEND_CIRCLE_COMMENT, $set);
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$addResult = array();
        		$addResult['activeId'] = $db->getInsertId();
        		$arr['data'] = $addResult;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * get friend circle common list
         * @param unknown $friendList
         * @param unknown $activeType
         * @param unknown $pageNumber
         * @param unknown $offset
         * @return multitype:NULL unknown
         */
        function getFriendCircleCommentList($db, $activeId, $pageNumber, $offset){
        	$arr = array();
        	$resultCode = -1;
        	$column_user_code = $this->get('userCode');
        	$column_nick_name = $this->get('nickName');
                $column_head_icon = $this->get('headIcon');
        	$column_active_id = $this->get('activeId');
                $column_recv_user_code = $this->get('recvUserCode');
        	$column_recv_nick_name = $this->get('recvNickName');
        	$column_active_comment_id = $this->get('_id');
        	$column_active_comment = $this->get('activeComment');
        	$column_active_comment_time = $this->get('activeCommentTime');
        	$where = $column_active_id." = '".$activeId."'";
        	$pro = $column_user_code.", ".$column_nick_name.", ".$column_head_icon.", ".$column_active_comment_id.",".$column_recv_user_code.", ".$column_recv_nick_name.", ".$column_active_comment.",".$column_active_comment_time;
        
        	$order = $column_active_comment_time;
        	$limit = $offset * $pageNumber. ", ".$pageNumber;
        	$result = $db->findMore($this->VIEW_BR_FRIEND_CIRCLE_ACTIVE_COMMENT, $where, $pro, "", $order, $limit);
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$arr['data'] = $result;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        function __destruct(){
        }
    }
    

