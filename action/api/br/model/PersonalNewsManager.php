<?php
    require_once("../model/BaseManager.php");
    require_once "../utils/StringsUtil.php";
    
    class PersonalNewsManager extends BaseManager{
    	/*
    	{
    		"id=>"1000, "code=>"2000, "message=>"noerror, "data=>"{result}
    	}
    	 */
        public $TABLE_BR_VIEW_PERAONAL_NEWS = "br_view_user_personal_news";
		public $TABLE_BR_PERAONAL_NEWS = "br_personal_news";
		public $TABLE_BR_USER = "br_user";
        
        function __construct(){
        }
    
        function getPersonalNewsThumbnail($userCode){
        	$arr = array();
			$personDetail = array();
        	$resultCode = -1;
			//user info
        	$_id = $this->get('_id');
			$head_icon = $this->get('headIcon');
        	$user_code = $this->get('userCode');
			$sex = $this->get('sex');
			$city_code = $this->get('cityCode');
			$nick_name = $this->get('nickName');
			$signature = $this->get('signature');        	
        	
			//news thumbnail
			$news_type = $this->get('newsType');
        	$news_content = $this->get('newsContent');
        	$news_time = $this->get('newsTime');
			
        	$where = $user_code."='".$userCode."'";
        	$db = $this->initMysql();
			
			$userInfoPro = $user_code.",".$head_icon.",".$sex.",".$city_code.",".$nick_name.",".$signature;
			$personDetailInfo = $this->getPersonlInfo($db, $userInfoPro, $where);
			//echo $userInfoPro."--".$where;
			//var_dump($personDetail);
			
			$personDetail['userCode'] = $userCode;
			$personDetail['headIcon'] = $personDetailInfo[$head_icon];
			$personDetail['sex'] = $personDetailInfo[$sex];
			$personDetail['cityCode'] = $personDetailInfo[$city_code];
			$personDetail['nickName'] = $personDetailInfo[$nick_name];
			$personDetail['signature'] = $personDetailInfo[$signature];
			
        	$pro = $_id.",".$news_type.",".$news_content.",".$news_time;
			$limit = " 3 ";
			$order = $news_time;
			//echo $pro."--".$where;
        	$result = $db->findMore($this->TABLE_BR_VIEW_PERAONAL_NEWS, $where, $pro, $order, $limit);
			//var_dump($result);
			$personDetail['data'] = $result;
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$arr['data'] = $personDetail;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = $personDetail;
        	}
        	return $arr;
        }
        
		function getPersonalNewsList($userCode, $length, $offset){
        	$arr = array();
			//$personalNews = array();
        	$resultCode = -1;
			//user info
        	$_id = $this->get('_id');
        	$user_code = $this->get('userCode');
			$news_type = $this->get('newsType');
			$news_content = $this->get('newsContent');
			$news_time = $this->get('newsTime');
        	$where = $user_code."='".$userCode."'";
        	$db = $this->initMysql();
			
			$userNewsPro = $user_code.",".$news_type.",".$news_content.",".$news_time;
			
			$limit = "";//.$length;
			$order = $news_time;
			$group = "";
			//echo $userNewsPro."--".$where;
        	$result = $db->findMore($this->TABLE_BR_VIEW_PERAONAL_NEWS, $where, $userNewsPro, $group, $order, $limit);
			//var_dump($result);
			//$personalNews['data'] = $result;
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$arr['data'] = $result;//$personalNews;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = $result;//$personalNews;
        	}
        	return $arr;
        }
		
		function insetPersonalNews($userCode, $newsType, $newsContent, $imgSrc){
			$arr = array();
        	$resultCode = -1;
        	$col_user_code = $this->get('userCode');
			$col_news_type = $this->get('newsType');
			$col_news_content = $this->get('newsContent');
			$contentLength = strlen($newsContent);
			$summary = "";
			if($contentLength > 50){
				$summary = substr($newsContent, 0, 50);
			} else {
				$summary = $newsContent;
			}
			$col_news_summary = $this->get('newsSummary');
			$col_news_time = $this->get('newsTime');
        	$db = $this->initMysql();
			$now = time();
			$set = $col_user_code."='".$userCode."', ".$col_news_type."=".$newsType.", ".$col_news_content."='".$newsContent."', ".$col_news_summary."='".$summary."' , ".$col_news_time."=".$now;
			//echo "-----------".$set;
        	$result = $db->add($this->TABLE_BR_PERAONAL_NEWS, $set);
			//var_dump($result);
			//$personalNews['data'] = $result;
        	$arr['msg'] = $db->getMySqlError();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$arr['data'] = null;//$personalNews;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;//$personalNews;
        	}
        	return $arr;
		}
		/**
         * getUserInfo
         */
		function getPersonlInfo($db, $pro, $where){
            return $db->find($this->TABLE_BR_USER, $where, $pro, "", "");
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
            return $db->find($this->TABLE_BR_USER, $where, $pro, "", "");
        }
        
        function __destruct(){
        }
    }
    

