<?php
    require_once("../model/BaseManager.php");
    require_once "../utils/StringsUtil.php";
    
    class UserManager extends BaseManager{
    	/*
    	{
    		"id=>"1000, "code=>"2000, "message=>"noerror, "data=>"{result}
    	}
    	 */
		//$private_uuid = {
		//	111111111,222222222, 333333333, 444444444, 555555555, 666666666, 777777777, 888888888, 999999999,
		
		//};
        public $TABLE_BR_USER = "br_user";
        
        function __construct(){
        }
    
        /**
         * 检查账户是否已经注册
         */
        function isRegister($account){
        	$arr = array();
            $db = $this->initMysql();
            $_id = $this->get('_id');
            $invite_time = $this->get('invite_time');
            $invite_code = $this->get('invite_code');
            $user_status = $this->get('user_status');
            $email = $this->get('email');
            $pro = $_id.", ".$invite_time.", ".$invite_code.",".$user_status;
            $result = $db->find($this->TABLE_BR_USER, $email." = '".$account."'", $pro, "", "");
            $data = array();
            if($result){
            	$arr['code'] = $this->get('common_result_success');//success
                $arr['msg'] = '';
            	$data['status'] = $result[$user_status];//0：未注册 1：已注册，正常使用 2：已注册未激活  3：禁用 -1：注销
            } else {
	            $arr['code'] = $this->get('user_isregister_error');//not exist
	            $arr['msg'] = $db->getMySqlError();
            }
            $arr['data'] = $data;
            return $arr;
        }
        
        /**
         * 注册账户
         */
        function register($account, $vCode, $regist_type, $md5Pwd){//register type:0 phone 1: email
            $arr = array();
        	$db = $this->initMysql();
            $_id = $this->get('_id');
            $invite_time = $this->get('inviteTime');
            $invite_code = $this->get('inviteCode');
            $user_status = $this->get('userStatus');
            $email = $this->get('email');
            $where = $this->getAcountType($regist_type)."='".$account."'";
            $pro = $_id.", ".$invite_time.", ".$invite_code.",".$user_status;
        	$result = $db->find($this->TABLE_BR_USER, $where, $pro, "", "");
            $arr['msg'] = $db->getMySqlError();
        	$now = time();
            $anHourMicSecond = 24*3600*1000;
            $status_not_active = $this->get('user_status_not_actived');
            $stringUtil = new StringsUtil();
            $data = array();
            $code = 0;
        	if(!empty($result)){//用户信息以及存在
        		$user_status_tmp = $result[$user_status];
        		$invite_time_tmp = $result[$invite_time];//邀请时间
                if($user_status_tmp == $status_not_active){//未激活
                    if(($invite_time_tmp + $anHourMicSecond) < $now){//邀请码过期
                        $invite_code_temp = $stringUtil->showunique_rand(100000, 999999,1);
                        $set = $invite_time."='".$now."', ".$user_status."='".$status_not_active."', ".$invite_code."='".$invite_code_temp."'";
                        $resultCode = 1;//send_mail("", "", "", "active", "http://www.baidu.com/invite_code=".$invite_code_temp."&invite_time=1234567890989&invite_type=1&invite_email=abc@123.com");
                        if($resultCode == 1){
                            $result = $db->edit($this->TABLE_BR_USER, $set, $where);
                            $arr['msg'] = $db->getMySqlError();
                            if($result){
                                $code =  $status_not_active;
                            }
                        } else {
                            $code = $this->get('user_register_error');//error
                        }
                    } else {//在有效期内
                        $code = $this->get('user_status_not_actived');
                    }
                } else {
                    $code =  $user_status_tmp;//其他状态
                }
        	} else {//新用户
                $is_first_login = 0;
                $pwd = $this->get('password');
                $invite_code_temp = $stringUtil->showunique_rand(100000, 999999,1);
                $set = $pwd."='".$md5Pwd."', ".$invite_time."='".$now."', ".$user_status."='".$status_not_active."', ".$invite_code."='".$invite_code_temp."', ";
                $set = $set.$where;
                $resultCode = 1;//send_mail("", "", "", "active", "http://www.baidu.com/invite_code=".$invite_code_temp."&invite_time=1234567890989&invite_type=1&invite_email=abc@123.com");
                if($resultCode == 1){//send mail sucess
                    $result = $db->add($this->TABLE_BR_USER, $set);
                    $arr['msg'] = $db->getMySqlError();
                    if($result){//SUCCESS
                        $code = $this->get('user_status_not_actived');//wait for active
                    } else {
                        $code = $this->get('user_invite_error');//error
                    }
                } else {
                    $code = $this->get('user_invite_error');//error
                }
            }
            $arr['code'] = $code;
            $arr['data'] = null;
            return $arr;
        }
        
        /**
         * param:invite_email,invite_code,invite_time,invite_type
         */
        function activeUser($account, $vCode, $invite_type){
            $arr = array();
            $data = array();
            $where = $this->getAcountType($invite_type)."='".$account."'";
            $resultCode = -1;
            $_id = $this->get('_id');
            $invite_time = $this->get('inviteTime');
            $invite_code = $this->get('inviteCode');
            $user_status = $this->get('userStatus');
            $email = $this->get('email');
            $rongYunToken = $this->get('rongyuntoken');
            $pro = $_id.", ".$invite_time.", ".$invite_code.",".$user_status;
            $db = $this->initMysql();
            //查询注册状态
            $result = $db->find($this->TABLE_BR_USER, $where, $pro, "", "");
            $arr['msg'] = $db->getMySqlError();
            $status_not_active = $this->get('user_status_not_actived');
            $status_active = $this->get('user_status_active');
            if(!empty($result)){
                //$time = explode(" ", microtime());
                //$time = $time[1].($time[0]*1000);
                //$time2 = explode(".", $time);
                //$time = $time2[0];
                $now = time();
                $invite_time = $result[$invite_time];
                $user_status_temp = $result[$user_status];
                if($user_status_temp == $status_active){//actived,return
                    $arr['code'] = $this->get('user_status_actived');
                } else {
                    if($user_status_temp == $status_not_active){//not actived
                        $anHourMicSecond = 24*3600*1000;
                        if($now<($invite_time + $anHourMicSecond)){//24小时过期
                            $user_invite_code_temp = $result[$invite_code];
                            $genIdArr = $db->find($this->TABLE_BR_USER, "", "max(_id)", "", "");//general user code
                            $arr['msg'] = $db->getMySqlError();
                            $user_code = $this->get('userCode');
                            $register_time = $this->get('registerTime');
                            $registerType = $this->get('type');
                            $set = $user_code."='".$user_invite_code_temp."', ".$register_time."='".$now."',".$user_status."='".$status_active."', ".$registerType."='".$invite_type."',".$rongYunToken."='".$user_code."'";
                            if($vCode != $user_invite_code_temp){//"invite code error."
                                $arr['code'] = $this->get('user_invite_not_exist');
                            } else {
                                //激活账户，设置用户id，设置状态，设置注册时间
                                $resultUpdate = $db->edit($this->TABLE_BR_USER, $set, $where);
                                $arr['msg'] = $db->getMySqlError();
                                if(!empty($resultUpdate)){//"active success.";
                                    $arr['code'] = $this->get('user_status_active');
                                } else {//"active fail."
                                    $arr['code'] = $this->get('user_status_actived');
                                }
                            }
                        } else {
                            $arr['code'] = $this->get('user_invite_outoff_time');
                        }
                    } else {
                        $arr['code'] = $this->get('user_invite_outoff_time');
                    }
                }
            } else {//user not exist
                $arr['code'] = $this->get('user_status_not_exist');
            }
            $arr['data'] = $data;
            return $arr;
        }
        
        /**
         * user login
         * 1、校验用户名和密码
         * 2、校验是否登陆
         * 3、校验当前用户状态
         * 4、登陆成功，获取用户信息
         */
        function login($account, $pwdMd5, $login_type){
        	$arr = array();
        	$where = "(".$this->get('userCode')."='".$account."' or ".$this->get('telephone')."='".$account."' or ".$this->get('email')."='".$account."')";
            $resultCode = -1;
            $_id = $this->get('_id');
            $invite_time = $this->get('inviteTime');
            $invite_code = $this->get('inviteCode');
            $password = $this->get('password');
            $user_status = $this->get('userStatus');
            $email = $this->get('email');
            
            $where = $where." AND ".$password."='".$pwdMd5."'";
            $pro = $_id.",".$user_status.",".$password.",".$email;
        	$db = $this->initMysql();
            $result = $db->find($this->TABLE_BR_USER, $where, $pro, "", "");
            if(!empty($result)){
                $status_temp = $result[$user_status];
                $pwd = $result[$password];
                if($pwdMd5 == $pwd){//密码校验通过
                	if($status_temp == $this->get('user_status_active')){//用户已激活，状态正常
                		return $this->getUserInfoByDb($result[$_id], $db);
                	}else {//未激活或者被禁用
                		$resultCode = $status_temp;
                        $data = array();
                        $data['email'] = $result[$email];
                        $arr['data'] = $data;
                	}
                }else{
                	$resultCode = $this->get('user_login_error');//用户名或者密码错误
                }
            } else {
            	$arr['msg'] = $db->getMySqlError();
				$arr['data'] = null;
                $resultCode = $this->get('user_login_error');
            }
            $arr['code'] = $resultCode;
            return $arr;
        }
        
        /**
         * getUserInfo
         */
        function getUserInfoByDb($id, $db){
        	$arr = array();
        	$resultCode = -1;
        	$_id = $this->get('_id');
        	$real_code = $this->get('userCode');
        	$real_name = $this->get('realName');
        	$email = $this->get('email');
        	$nick_name = $this->get('nickName');
        	$sex = $this->get('sex');
        	$birthday = $this->get('birthday');
        	$height = $this->get('height');
        	$weight = $this->get('weight');
                $cityCode = $this->get('cityCode');
        	$headicon = $this->get('headIcon');
        	$company = $this->get('company');
        	$vocation = $this->get('vocation');
        	$school = $this->get('school');
        	$signature = $this->get('signature');
        	$interest = $this->get('interest');
        	$balance = $this->get('balance');
        	$technique = $this->get('technique');
        	$rongyuntoken = $this->get('rongYunToken');
        	$isfristlogin = $this->get('isFristLogin');
        	$rich = $this->get('rich');
        	$register_time = $this->get('registerTime');
        	$user_status = $this->get('userStatus');
        	$type = $this->get('type');
        
        	$where = $_id."='".$id."'";
        	$pro = $_id.",".$real_code.",".$real_name.",".$email.",".$nick_name.",".$sex.",".$birthday.",".$height.",".$weight.",".$headicon.",".$cityCode.",".$company.",".$vocation.",".$school.",".$signature.",".$interest.",".$balance.",".$technique.",".$rongyuntoken.",".$isfristlogin.",".$rich.",".$register_time.",".$user_status.",".$type;
        	$result = $db->find($this->TABLE_BR_USER, $where, $pro, "", "");
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$arr['data'] = $result;
        	}else {
        		$arr['msg'] = $db->getMySqlError();
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        /**
         * getUserInfo
         */
        function getUserInfo($id){
        	$arr = array();
            $resultCode = -1;
            $_id = $this->get('_id');
            $real_name = $this->get('realName');
            $email = $this->get('email');
            $nick_name = $this->get('nickName');
            $sex = $this->get('sex');
            $birthday = $this->get('birthday');
            $height = $this->get('height');
            $weight = $this->get('weight');
            $cityCode = $this->get('cityCode');
            $headicon = $this->get('headIcon');
            $company = $this->get('company');
            $vocation = $this->get('vocation');
            $school = $this->get('school');
            $signature = $this->get('signature');
            $interest = $this->get('interest');
            $balance = $this->get('balance');
            $technique = $this->get('technique');
            $rongyuntoken = $this->get('rongYunToken');
            $isfristlogin = $this->get('isFristLogin');
            $rich = $this->get('rich');
            $register_time = $this->get('registerTime');
            $user_status = $this->get('userStatus');
            $type = $this->get('type');
            
            $where = $_id."='".$id."'";
            $pro = $_id.",".$real_name.",".$email.",".$nick_name.",".$sex.",".$birthday.",".$height.",".$weight.",".$cityCode.",".$headicon.",".$company.",".$vocation.",".$school.",".$signature.",".$interest.",".$balance.",".$technique.",".$rongyuntoken.",".$isfristlogin.",".$rich.",".$register_time.",".$user_status.",".$type;
            $db = $this->initMysql();
            $result = $db->find($this->TABLE_BR_USER, $where, $pro, "", "");
            if(!empty($result)){
                $arr['code'] = $this->get('common_result_success');
                $arr['data'] = $result;
            }else {
	            $arr['msg'] = $db->getMySqlError();
                $arr['code'] = $this->get('user_query_error');
                $arr['data'] = null;
            }
            return $arr;
        }
        
        
        /**
         * update user info
         */
        function updateUserInfo($userInfo){
        	$arr = array();
            $db = $this->initMysql();
            $resultCode = -1;
            $_id = $this->get('_id');
            $user_code = $this->get('userCode');
            $real_name = $this->get('realName');
            $email = $this->get('email');
            $password = $this->get('password');
            $nick_name = $this->get('nickName');
            $sex = $this->get('sex');
            $birthday = $this->get('birthday');
            $height = $this->get('height');
            $weight = $this->get('weight');
            $headicon = $this->get('headIcon');
            $cityCode = $this->get('cityCode');
            $company = $this->get('company');
            $vocation = $this->get('vocation');
            $school = $this->get('school');
            $signature = $this->get('signature');
            $interest = $this->get('interest');
            $balance = $this->get('balance');
            $technique = $this->get('technique');
            $rongyuntoken = $this->get('rongYunToken');
            $rich = $this->get('rich');
            $set = $user_code."='".$userInfo[$user_code]."'";
            if(isset($userInfo[$real_name])){
	            $real_name_tmp = $userInfo[$real_name];
            	$set = $set.",".$real_name."='".$real_name_tmp."'";
            }
            if(isset($userInfo[$email])){
	            $email_tmp = $userInfo[$email];
            	$set = $set.",".$email."='".$email_tmp."'";
            }
            if(isset($userInfo[$password])){
            	$password_tmp = $userInfo[$password];
            	$set = $set.",".$password."='".$password_tmp."'";
            }
            if(isset($userInfo[$nick_name])){
	            $nick_name_tmp = $userInfo[$nick_name];
            	$set = $set.",".$nick_name."='".$nick_name_tmp."'";
            }
            if(isset($userInfo[$sex])){
			    $sex_tmp = $userInfo[$sex];
            	$set = $set.",".$sex."='".$sex_tmp."'";
            }
            if(isset($userInfo[$birthday])){
            	$birthday_tmp = $userInfo[$birthday];
            	$set = $set.",".$birthday."='".$birthday_tmp."'";
            }
            
            if(isset($userInfo[$height])){
	            $height_tmp = $userInfo[$height];
            	$set = $set.",".$height."='".$height_tmp."'";
            }
            if(isset($userInfo[$weight])){
	            $weight_tmp = $userInfo[$weight];
            	$set = $set.",".$weight."='".$weight_tmp."'";
            }
            if(isset($userInfo[$headicon])){
	            $headicon_tmp = $userInfo[$headicon];
            	$set = $set.",".$headicon."='".$headicon_tmp."'";
            }
            if(isset($userInfo[$cityCode])){
	            $cityCode_tmp = $userInfo[$cityCode];
            	$set = $set.",".$cityCode."='".$cityCode_tmp."'";
            }
            if(isset($userInfo[$company])){
	            $company_tmp = $userInfo[$company];
            	$set = $set.",".$company."='".$company_tmp."'";
            }
            if(isset($userInfo[$vocation])){
	            $vocation_tmp = $userInfo[$vocation];
            	$set = $set.",".$vocation."='".$vocation_tmp."'";
            }
            if(isset($userInfo[$school])){
	            $school_tmp = $userInfo[$school];
            	$set = $set.",".$school."='".$school_tmp."'";
            }
            if(isset($userInfo[$signature])){
	            $signature_tmp = $userInfo[$signature];
            	$set = $set.",".$signature."='".$signature_tmp."'";
            }
            if(isset($userInfo[$interest])){
	            $interest_tmp = $userInfo[$interest];
            	$set = $set.",".$interest."='".$interest_tmp."'";
            }
            if(isset($userInfo[$balance])){
	            $balance_tmp = $userInfo[$balance];
            	$set = $set.",".$balance."='".$balance_tmp."'";
            }
            if(isset($userInfo[$technique])){
	            $technique_tmp = $userInfo[$technique];
            	$set = $set.",".$technique."='".$technique_tmp."'";
            }
            if(isset($userInfo[$rongyuntoken])){
	            $rongyuntoken_tmp = $userInfo[$rongyuntoken];
            	$set = $set.",".$rongyuntoken."='".$rongyuntoken_tmp."'";
            }
            if(isset($userInfo[$rich])){
	            $rich_tmp = $userInfo[$rich];
            	$set = $set.",".$rich."='".$rich_tmp."'";
            }
            $where = $user_code."='".$userInfo[$user_code]."'";
            $result = $db->edit($this->TABLE_BR_USER, $set, $where);
            if($result){
            	$arr['code'] = $this->get('common_result_success');
            } else {
            	$arr['code'] = $this->get('user_update_error');
            	
            }
            $arr['msg'] = $db->getMySqlError();
            return $arr;
        }
        
        function searchUser($keyWords){
        	$arr = array();
        	$db = $this->initMysql();
        	$resultCode = -1;
        	$usercode = $this->get('userCode');
        	$email = $this->get('email');
        	$telephone = $this->get('telephone');
        	
        	$_id = $this->get('_id');
        	$real_name = $this->get('realName');
        	$email = $this->get('email');
        	$nick_name = $this->get('nickName');
        	$sex = $this->get('sex');
        	$birthday = $this->get('birthday');
                $cityCode = $this->get('cityCode');
        	$headicon = $this->get('headIcon');
        	$signature = $this->get('signature');
        	$balance = $this->get('balance');
        	$rongyuntoken = $this->get('rongYunToken');
        	$user_status = $this->get('userStatus');
        	$type = $this->get('type');
        	
        	$where = $usercode."='".$keyWords."' or ".$email."='".$keyWords."' or ".$telephone."='".$keyWords."'";
        	$pro = $_id.",".$usercode.",".$real_name.",".$email.",".$nick_name.",".$sex.",".$headicon.",".$cityCode.",".$signature.",".$balance.",".$rongyuntoken.",".$user_status.",".$type;
        	$result = $db->findMore($this->TABLE_BR_USER, $where, $pro, "", "");
        	$arr['msg'] = $db->getMySqlError();
        	$userList = array();
        	if(!empty($result)){
        		$arr['code'] = $this->get('common_result_success');
        		$arr['data'] = $result;
        	}else {
        		$arr['code'] = $this->get('user_query_error');
        		$arr['data'] = null;
        	}
        	return $arr;
        }
        
        function send_mail($to, $from, $password, $subject, $body){
            //标题不能带换行
            $subject=str_replace("\r\n",' ',$subject);
            //行首的“.”是SMTP预留的格式，需要用“..”转意
            $body=preg_replace('/(=?^|\r\n)\./','..',$body);
            //从发信邮箱中找到用户名和服务器域名
            $u=explode('@',$from);
            //连接邮箱SMTP服务器的25端口
            $s=fsockopen('smtp.'.$u[1],25);
            fgets($s);
            //构造邮件内容数据
            $data=array(
                'MIME-Version: 1.0',
                'Content-Type: text/html',
                "From: $from","To: $to",
                "Subject: $subject",
                "\r\n$body",'.'
            );
            //根据SMTP协议与邮件服务器做一些应答
            foreach(array(
                'HELO sb',
                'AUTH LOGIN',
                base64_encode($u[0]),
                base64_encode($password),
                "MAIL FROM: <$from>",
                "RCPT TO: <$to>",
                'DATA',implode("\r\n",$data)
            ) as $i){
                //发送消息
                fwrite($s,"$i\r\n");
                //等待返回并获取返回信息
                $m=fgets($s);
                //如果返回的是错误信息则结束函数
                if($m[0]>3)return $m;
            };
            //关闭sock
            fclose($s);
        }
        
        /**
         * 获取用户注册状态
         * 用户类型，用户账户，
         * type: 1 email 2 telephone 3 usercode
         */
        function getAcountType($type){
        	$name = null;
        	if($type == 1){//email
                $name = $this->get('email');
        	} else if($type == 2){//phone
                $name = $this->get('telephone');
        	} else {//usercode
                $name = $this->get('userCode');
            }
            return $name;
        }
        
        function __destruct(){
        }
    }
    

