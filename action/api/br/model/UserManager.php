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
         * ����˻��Ƿ��Ѿ�ע��
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
            	$data['status'] = $result[$user_status];//0��δע�� 1����ע�ᣬ����ʹ�� 2����ע��δ����  3������ -1��ע��
            } else {
	            $arr['code'] = $this->get('user_isregister_error');//not exist
	            $arr['msg'] = $db->getMySqlError();
            }
            $arr['data'] = $data;
            return $arr;
        }
        
        /**
         * ע���˻�
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
        	if(!empty($result)){//�û���Ϣ�Լ�����
        		$user_status_tmp = $result[$user_status];
        		$invite_time_tmp = $result[$invite_time];//����ʱ��
                if($user_status_tmp == $status_not_active){//δ����
                    if(($invite_time_tmp + $anHourMicSecond) < $now){//���������
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
                    } else {//����Ч����
                        $code = $this->get('user_status_not_actived');
                    }
                } else {
                    $code =  $user_status_tmp;//����״̬
                }
        	} else {//���û�
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
            //��ѯע��״̬
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
                        if($now<($invite_time + $anHourMicSecond)){//24Сʱ����
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
                                //�����˻��������û�id������״̬������ע��ʱ��
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
         * 1��У���û���������
         * 2��У���Ƿ��½
         * 3��У�鵱ǰ�û�״̬
         * 4����½�ɹ�����ȡ�û���Ϣ
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
                if($pwdMd5 == $pwd){//����У��ͨ��
                	if($status_temp == $this->get('user_status_active')){//�û��Ѽ��״̬����
                		return $this->getUserInfoByDb($result[$_id], $db);
                	}else {//δ������߱�����
                		$resultCode = $status_temp;
                        $data = array();
                        $data['email'] = $result[$email];
                        $arr['data'] = $data;
                	}
                }else{
                	$resultCode = $this->get('user_login_error');//�û��������������
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
            //���ⲻ�ܴ�����
            $subject=str_replace("\r\n",' ',$subject);
            //���׵ġ�.����SMTPԤ���ĸ�ʽ����Ҫ�á�..��ת��
            $body=preg_replace('/(=?^|\r\n)\./','..',$body);
            //�ӷ����������ҵ��û����ͷ���������
            $u=explode('@',$from);
            //��������SMTP��������25�˿�
            $s=fsockopen('smtp.'.$u[1],25);
            fgets($s);
            //�����ʼ���������
            $data=array(
                'MIME-Version: 1.0',
                'Content-Type: text/html',
                "From: $from","To: $to",
                "Subject: $subject",
                "\r\n$body",'.'
            );
            //����SMTPЭ�����ʼ���������һЩӦ��
            foreach(array(
                'HELO sb',
                'AUTH LOGIN',
                base64_encode($u[0]),
                base64_encode($password),
                "MAIL FROM: <$from>",
                "RCPT TO: <$to>",
                'DATA',implode("\r\n",$data)
            ) as $i){
                //������Ϣ
                fwrite($s,"$i\r\n");
                //�ȴ����ز���ȡ������Ϣ
                $m=fgets($s);
                //������ص��Ǵ�����Ϣ���������
                if($m[0]>3)return $m;
            };
            //�ر�sock
            fclose($s);
        }
        
        /**
         * ��ȡ�û�ע��״̬
         * �û����ͣ��û��˻���
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
    

