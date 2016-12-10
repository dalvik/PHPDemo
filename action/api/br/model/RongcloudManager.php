<?php
    /**
     * ���� Server API PHP �ͻ���
     * create datetime : 2016-10-20 
     * 
     * v2.0.1
     */
    require_once('../../rongcloud/rongcloud.php');
    $appKey = 'appKey';
    $appSecret = 'appSecret';
    $jsonPath = "../../rongcloud/jsonsource/";
    $paramParse = new ParamParse();
    $code = $paramParse->checkUserParameter($_SERVER);
    if($code<0){
        $array = array("id"=>-1, "code"=>$code, "message"=>"error messge", "data"=>NULL);
        echo json_encode($array);
        exit(0);
    }
    date_default_timezone_set("PRC");
    $RongCloud = new RongCloud($appKey,$appSecret);
    $api = $_SERVER[constant('header_api')];
    $sid = 10001;//$_SERVER[constant('header_sid')];
    //$id = $_SERVER[constant('header_id')];
    $data = null;
    $msg = null;
    if($api == "getToken"){// ��ȡ Token ����
    	$userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $data = $RongCloud->user()->getToken($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "refresh"){// ˢ���û���Ϣ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $data = $RongCloud->user()->refresh($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "checkOnline"){// ����û�����״̬ ����
        $userCode = $_GET['userCode'];
        $data = $RongCloud->user()->checkOnline($userCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "block"){// ����û�������ÿ������ 100 �Σ�
        $userCode = $_GET['userCode'];
        $blockTime = $_GET['blockTime'];
        $data = $RongCloud->user()->block($userCode, $blockTime);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "unBlock"){// ����û����������ÿ������ 100 �Σ�
        $userCode = $_GET['userCode'];
        $data = $RongCloud->user()->unBlock($userCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryBlock"){// ��ȡ������û�������ÿ������ 100 �Σ�
        $data = $RongCloud->user()->queryBlock();
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addBlacklist"){// ����û���������������ÿ������ 100 �Σ�
        $userCode = $_GET['userCode'];
        $blackUserCode = $_GET['blackUserCode'];
        $data = $RongCloud->user()->addBlacklist($userCode, $userCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryBlacklist"){// ��ȡĳ�û��ĺ������б�����ÿ������ 100 �Σ�
        $userCode = $_GET['userCode'];
        $data = $RongCloud->user()->queryBlacklist($userCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "removeBlacklist"){// �Ӻ��������Ƴ��û�������ÿ������ 100 �Σ�
        $userCode = $_GET['userCode'];
        $blackUserCode = $_GET['blackUserName'];
        $data = $RongCloud->user()->removeBlacklist($userCode, $blackUserCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishPrivate"){// ���͵�����Ϣ������һ���û�������һ���û�������Ϣ��������Ϣ��� 128k��ÿ������෢�� 6000 ����Ϣ��ÿ�η����û�����Ϊ 1000 �ˣ��磺һ�η��� 1000 ��ʱ��ʾΪ 1000 ����Ϣ����
        $userCode = $_GET['userCode'];
        $targetUserCodeList = $_GET['getUserCodeList'];
        $content = $_GET['headerIcon'];
        $data = $RongCloud->user()->publishPrivate($userCode, $targetUserCodeList, 'RC:VcMsg', "{\"content\":\"hello\",\"extra\":\"helloExtra\",\"duration\":20}", 'thisisapush', '{\"pushData\":\"hello\"}', '4', '0', '0', '0');
        //$result = $RongCloud->message()->publishPrivate('userId1', ["userId2","userid3","userId4"], 'RC:VcMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\",\"duration\":20}", 'thisisapush', '{\"pushData\":\"hello\"}', '4', '0', '0', '0');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishTemplate"){// ���͵���ģ����Ϣ������һ���û������û����Ͳ�ͬ��Ϣ���ݣ�������Ϣ��� 128k��ÿ������෢�� 6000 ����Ϣ��ÿ�η����û�����Ϊ 1000 �ˡ���
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $data = $RongCloud->user()->publishTemplate($userCode, $userName, $headerIcon);
        //$result = $RongCloud->message()->publishTemplate(file_get_contents($jsonPath.'TemplateMessage.json'));
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "PublishSystem"){// ����ϵͳ��Ϣ������һ���û���һ�������û�����ϵͳ��Ϣ��������Ϣ��� 128k���Ự����Ϊ SYSTEM��ÿ������෢�� 100 ����Ϣ��ÿ�����ͬʱ�� 100 �˷��ͣ��磺һ�η��� 100 ��ʱ��ʾΪ 100 ����Ϣ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $data = $RongCloud->user()->PublishSystem($userCode, $userName, $headerIcon);
        //$result = $RongCloud->message()->PublishSystem('userId1', ["userId2","userid3","userId4"], 'RC:TxtMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\"}", 'thisisapush', '{\"pushData\":\"hello\"}', '0', '0');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishSystemTemplate"){// ����ϵͳģ����Ϣ������һ���û���һ�������û�����ϵͳ��Ϣ��������Ϣ��� 128k���Ự����Ϊ SYSTEM.ÿ������෢�� 100 ����Ϣ��ÿ�����ͬʱ�� 100 �˷��ͣ��磺һ�η��� 100 ��ʱ��ʾΪ 100 ����Ϣ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishSystemTemplate(file_get_contents($jsonPath.'TemplateMessage.json'));
        $data = $RongCloud->user()->publishSystemTemplate($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishGroup"){// ����Ⱥ����Ϣ��������һ���û������Ⱥ�鷢����Ϣ��������Ϣ��� 128k.ÿ������෢�� 20 ����Ϣ��ÿ������� 3 ��Ⱥ�鷢�ͣ��磺һ���� 3 ��Ⱥ�鷢����Ϣ��ʾΪ 3 ����Ϣ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishGroup('userId', ["groupId1","groupId2","groupId3"], 'RC:TxtMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\"}", 'thisisapush', '{\"pushData\":\"hello\"}', '1', '1');
        $data = $RongCloud->user()->publishGroup($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishDiscussion"){// ������������Ϣ��������һ���û�����������鷢����Ϣ��������Ϣ��� 128k��ÿ������෢�� 20 ����Ϣ.��
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishDiscussion('userId1', 'discussionId1', 'RC:TxtMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\"}", 'thisisapush', '{\"pushData\":\"hello\"}', '1', '1');
        $data = $RongCloud->user()->publishDiscussion($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishChatroom"){// ������������Ϣ������һ���û��������ҷ�����Ϣ��������Ϣ��� 128k��ÿ������ 100 �Ρ���
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishChatroom('userId1', ["ChatroomId1","ChatroomId2","ChatroomId3"], 'RC:TxtMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\"}");
        $data = $RongCloud->user()->publishChatroom($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "broadcast"){// ���͹㲥��Ϣ������������Ϣ��һ��Ӧ���µ�����ע���û������û�δ���߻���������������ֻ��նˣ����û����� Push ��Ϣ��������Ϣ��� 128k���Ự����Ϊ SYSTEM��ÿСʱֻ�ܷ��� 1 �Σ�ÿ����෢�� 3 �Ρ���
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->broadcast('userId1', 'RC:TxtMsg',"{\"content\":\"����\",\"extra\":\"hello ex\"}", 'thisisapush', '{\"pushData\":\"hello\"}', 'iOS');
        $data = $RongCloud->user()->broadcast($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getHistory"){// ��Ϣ��ʷ��¼���ص�ַ��ȡ ������Ϣ��ʷ��¼���ص�ַ��ȡ��������ȡ APP ��ָ��ĳ��ĳСʱ�ڵ����лỰ��Ϣ��¼�����ص�ַ����Ŀǰ֧�ֶ��˻Ự�������顢Ⱥ�顢�����ҡ��ͷ���ϵͳ֪ͨ��Ϣ��ʷ��¼���أ�
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->getHistory('2014010101');
        $data = $RongCloud->user()->getHistory($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "deleteMessage"){// ��Ϣ��ʷ��¼ɾ��������ɾ�� APP ��ָ��ĳ��ĳСʱ�ڵ����лỰ��Ϣ��¼�����øýӿڷ��سɹ���date����ָ����ĳСʱ����Ϣ��¼�ļ���������5-10�����ڱ�����ɾ������
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->deleteMessage('2014010101');
        $data = $RongCloud->user()->deleteMessage($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addFiltWord"){// ������дʷ������������дʺ�App ���û������յ��������дʵ���Ϣ���ݣ�Ĭ��������� 50 �����дʡ���
        $filtWord = $_GET['filtWord'];
        $result = $RongCloud->wordfilter()->add($filtWord);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getFiltWordList"){// ��ѯ���д��б���
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->wordfilter()->getList();
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "deleteFiltWord"){// �Ƴ����дʷ����������д��б��У��Ƴ�ĳһ���дʡ���
        $filtWord = $_GET['filtWord'];
        $result = $RongCloud->wordfilter()->delete($filtWord);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "createGroup"){// ����Ⱥ�鷽��������Ⱥ�飬�����û������Ⱥ�飬�û��������յ���Ⱥ����Ϣ��ͬһ�û����ɼ��� 500 ��Ⱥ��ÿ��Ⱥ����� 3000 �ˣ�App �ڵ�Ⱥ������û������.ע����ʵ�������Ǽ���Ⱥ�鷽�� /group/join �ı�������
        $userCode = $_GET['userCode'];
        $addUserList = $_GET['addUserList'];
        $groupId = $_GET['groupId'];
		$groupName = $_GET['groupName'];
        $result = $RongCloud->group()->create(["userId1","userid2","userId3"], 'groupId1', 'groupName1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "syncGroup"){// ͬ���û�����Ⱥ�鷽��������һ���������Ʒ�����ʱ����Ҫ�����Ʒ������ύ userId ��Ӧ���û���ǰ�����������Ⱥ�飬�˽ӿ���ҪΪ��ֹӦ�����û�Ⱥ��Ϣͬ������֪���û�����Ⱥ��Ϣ��ͬ������
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $groupInfo['gourid1'] = 'gourpName1';
		$groupInfo['gourid2'] = 'gourpName2';
		$groupInfo['gourid3'] = 'gourpName3';
		$result = $RongCloud->group()->sync($userCode, $groupInfo);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishSystemTemplate"){// ����ϵͳģ����Ϣ������һ���û���һ�������û�����ϵͳ��Ϣ��������Ϣ��� 128k���Ự����Ϊ SYSTEM.ÿ������෢�� 100 ����Ϣ��ÿ�����ͬʱ�� 100 �˷��ͣ��磺һ�η��� 100 ��ʱ��ʾΪ 100 ����Ϣ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishSystemTemplate(file_get_contents($jsonPath.'TemplateMessage.json'));
        $data = $RongCloud->user()->publishSystemTemplate($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "refreshGroup"){// ˢ��Ⱥ����Ϣ����
        $groupId = $_GET['groupId'];
		$groupName = $_GET['groupName'];
        $result = $RongCloud->group()->refresh( $groupId, $groupName);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "joinGroup"){// ���û�����ָ��Ⱥ�飬�û��������յ���Ⱥ����Ϣ��ͬһ�û����ɼ��� 500 ��Ⱥ��ÿ��Ⱥ����� 3000 �ˡ�
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->join(["userId2","userid3","userId4"], 'groupId1', 'TestGroup');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryGroupUser"){// ��ѯȺ��Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->queryUser('groupId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "leaveGroup"){// �˳�Ⱥ�鷽�������û���Ⱥ���Ƴ������ٽ��ո�Ⱥ�����Ϣ.��
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->quit(["userId2","userid3","userId4"], 'TestGroup');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addGagUser"){// ��ӽ���Ⱥ��Ա�������� App �����������ĳһ�û���Ⱥ�з���ʱ���ɽ����û���Ⱥ���н��ԣ��������û����Խ��ղ鿴Ⱥ�����û�������Ϣ�������ܷ�����Ϣ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->addGagUser('userId1', 'groupId1', '1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "lisGagUser"){// ��ѯ������Ⱥ��Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->lisGagUser('groupId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "rollBackGagUser")// �Ƴ�����Ⱥ��Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->rollBackGagUser(["userId2","userid3","userId4"], 'groupId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "dismissGroup"){// ��ɢȺ�鷽����������Ⱥ��ɢ�������û����޷��ٽ��ո�Ⱥ����Ϣ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        result = $RongCloud->group()->dismiss('userId1', 'groupId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "createChartRoom"){// ���������ҷ���
        $chatRoomInfo['chatroomId1'] = 'chatroomInfo1';
		$chatRoomInfo['chatroomId2'] = 'chatroomInfo2';
		$chatRoomInfo['chatroomId3'] = 'chatroomInfo3';
		$result = $RongCloud->chatroom()->create($chatRoomInfo);
        $msg = "success";
        $data['code'] = 200;
    }else if($api == "joinChatRoom"){// ���������ҷ���
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->join(["userId2","userid3","userId4"], 'chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryChatRoomMessage"){// ��ѯ��������Ϣ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->query(["chatroomId1","chatroomId2","chatroomId3"]);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryChatRoomUser"){// ��ѯ���������û�����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->queryUser('chatroomId1', '500', '2');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "stopDistributionMessage"){// ��������Ϣֹͣ�ַ���������ʵ�ֿ��ƶ�����������Ϣ�Ƿ���зַ���ֹͣ�ַ������������û����͵���Ϣ�����Ʒ���˲����ٽ���Ϣ���͸��������������û�����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->stopDistributionMessage('chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "resumeDistributionMessage"){// ��������Ϣ�ָ��ַ�����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->resumeDistributionMessage('chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomGagUser"){// ��ӽ��������ҳ�Ա�������� App �����������ĳһ�û����������з���ʱ���ɽ����û����������н��ԣ��������û����Խ��ղ鿴���������û�������Ϣ�������ܷ�����Ϣ.��
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->addGagUser('userId1', 'chatroomId1', '1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getListGagUser"){// ��ѯ�����������ҳ�Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->ListGagUser('chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "rollbackChatRoomGagUser"){// �Ƴ����������ҳ�Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->rollbackGagUser('userId1', 'chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomBlockUser"){// ��ӷ�������ҳ�Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->addBlockUser('userId1', 'chatroomId1', '1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getListChatRoomBlockUser"){// ��ѯ����������ҳ�Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->getListBlockUser('chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "rollbackChatRoomBlockUser"){// �Ƴ���������ҳ�Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->rollbackBlockUser('userId1', 'chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomPriority"){// �����������Ϣ���ȼ�����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->addPriority(["RC:VcMsg","RC:ImgTextMsg","RC:ImgMsg"]);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "destroyChatRoom"){// ���������ҷ���
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->destroy(["chatroomId","chatroomId1","chatroomId2"]);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addchatRoomWhiteListUser"){// ��������Ұ�������Ա����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->addWhiteListUser('chatroomId', ["userId1","userId2","userId3","userId4","userId5"]);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "setChatRoomUserPushTag"){// ��� Push ��ǩ����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->push()->setUserPushTag(file_get_contents($jsonPath.'UserTag.json'));
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "broadcastPush"){// �㲥��Ϣ������fromuserid �� messageΪnull��Ϊ����ص�push��
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->push()->broadcastPush(file_get_contents($jsonPath.'PushMessage.json'));
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getImageCode"){// ��ȡͼƬ��֤�뷽��
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->SMS()->getImageCode('app-key');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomPriority"){// ���Ͷ�����֤�뷽����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->SMS()->sendCode('13500000000', 'dsfdsfd', '86', '1408706337', '1408706337');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomPriority"){// ��֤����֤����
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->SMS()->verifyCode('2312312', '2312312');
        $msg = "success";
        $data['code'] = 200;
    }

    echo json_encode($data);
