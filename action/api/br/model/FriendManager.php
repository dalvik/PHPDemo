<?php
    require_once("../model/BaseManager.php");
    require_once "../utils/StringsUtil.php";
    require_once("../utils/FriendColumn.php");
    
    class FriendManager extends BaseManager{
    	/*
    	{
    		"id=>"1000, "code=>"2000, "message=>"noerror, "data=>"{result}
    	}
    	 */
        public $VIEW_BR_FRIEND = "br_view_user_friend_circle_friend";
        public $TABLE_BR_FRIEND = "br_user_friend";
        
        function __construct(){
        }
    
        function getFirendList($userId, $type, $pageNumber, $pageOffset){
        	$arr = array();
        	$resultCode = -1;
        	$_id = $this->get('_id');
        	$friend_code = $this->get('masterId');
        	$nick_name = $this->get('nickName');
        	$headicon = $this->get('headIcon');
        	$signature = $this->get('signature');
        	$user_type = $this->get('userType');
        	$user_code = $this->get('userCode');
        	$friend_status = $this->get('friendStatus');
        	
        	$where = $user_code."='".$userId."'";
        	$pro = $_id.",".$friend_code.",".$nick_name.",".$headicon.",".$signature.",".$user_type.",".$user_code.",".$friend_status;
        	$db = $this->initMysql();
        	$result = $db->findMore($this->TABLE_BR_FRIEND, $where, $pro, "", "");
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
         * get friend list code
         */
        function getFirendCodeList($userId, $type, $pageNumber, $pageOffset){
        	$friend_code = $this->get('masterId');
        	$user_code = $this->get('userCode');
        	
        	$where = $friend_code."='".$userId."'";
        	$pro = $user_code;
        	$db = $this->initMysql();
        	$result = $db->findMore($this->TABLE_BR_FRIEND, $where, $pro, "", "", "");
        	return $result;
        }
        
        /**
         * getUserInfo
         */
        function getUserInfo($userCode, $login_type){
        	$arr = array();
            $resultCode = -1;
            $_id = $this->get('_id');
            $real_name = $this->get('realname');
            $email = $this->get('email');
            $nick_name = $this->get('nickname');
            $sex = $this->get('sex');
            $birthday = $this->get('birthday');
            $height = $this->get('height');
            $weight = $this->get('weight');
            $headicon = $this->get('headicon');
            $company = $this->get('company');
            $vocation = $this->get('vocation');
            $school = $this->get('school');
            $signature = $this->get('signature');
            $interest = $this->get('interest');
            $balance = $this->get('balance');
            $technique = $this->get('technique');
            $rongyuntoken = $this->get('rongYunToken');
            $isfristlogin = $this->get('isfristlogin');
            $rich = $this->get('rich');
            $register_time = $this->get('register_time');
            $user_status = $this->get('user_status');
            $type = $this->get('type');
            
            $where = $this->getAcountType($login_type)."='".$userCode."'";
            $pro = $_id.",".$real_name.",".$email.",".$nick_name.",".$sex.",".$birthday.",".$height.",".$weight.",".$headicon.",".$company.",".$vocation.",".$school.",".$signature.",".$interest.",".$balance.",".$technique.",".$rongyuntoken.",".$isfristlogin.",".$rich.",".$register_time.",".$user_status.",".$type;
            $db = $this->initMysql();
            $result = $db->find($this->TABLE_BR_USER, $where, $pro, "", "");
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
    

