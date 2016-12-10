<?php
    /**
     * 融云 Server API PHP 客户端
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
    if($api == "getToken"){// 获取 Token 方法
    	$userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $data = $RongCloud->user()->getToken($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "refresh"){// 刷新用户信息方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $data = $RongCloud->user()->refresh($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "checkOnline"){// 检查用户在线状态 方法
        $userCode = $_GET['userCode'];
        $data = $RongCloud->user()->checkOnline($userCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "block"){// 封禁用户方法（每秒钟限 100 次）
        $userCode = $_GET['userCode'];
        $blockTime = $_GET['blockTime'];
        $data = $RongCloud->user()->block($userCode, $blockTime);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "unBlock"){// 解除用户封禁方法（每秒钟限 100 次）
        $userCode = $_GET['userCode'];
        $data = $RongCloud->user()->unBlock($userCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryBlock"){// 获取被封禁用户方法（每秒钟限 100 次）
        $data = $RongCloud->user()->queryBlock();
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addBlacklist"){// 添加用户到黑名单方法（每秒钟限 100 次）
        $userCode = $_GET['userCode'];
        $blackUserCode = $_GET['blackUserCode'];
        $data = $RongCloud->user()->addBlacklist($userCode, $userCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryBlacklist"){// 获取某用户的黑名单列表方法（每秒钟限 100 次）
        $userCode = $_GET['userCode'];
        $data = $RongCloud->user()->queryBlacklist($userCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "removeBlacklist"){// 从黑名单中移除用户方法（每秒钟限 100 次）
        $userCode = $_GET['userCode'];
        $blackUserCode = $_GET['blackUserName'];
        $data = $RongCloud->user()->removeBlacklist($userCode, $blackUserCode);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishPrivate"){// 发送单聊消息方法（一个用户向另外一个用户发送消息，单条消息最大 128k。每分钟最多发送 6000 条信息，每次发送用户上限为 1000 人，如：一次发送 1000 人时，示为 1000 条消息。）
        $userCode = $_GET['userCode'];
        $targetUserCodeList = $_GET['getUserCodeList'];
        $content = $_GET['headerIcon'];
        $data = $RongCloud->user()->publishPrivate($userCode, $targetUserCodeList, 'RC:VcMsg', "{\"content\":\"hello\",\"extra\":\"helloExtra\",\"duration\":20}", 'thisisapush', '{\"pushData\":\"hello\"}', '4', '0', '0', '0');
        //$result = $RongCloud->message()->publishPrivate('userId1', ["userId2","userid3","userId4"], 'RC:VcMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\",\"duration\":20}", 'thisisapush', '{\"pushData\":\"hello\"}', '4', '0', '0', '0');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishTemplate"){// 发送单聊模板消息方法（一个用户向多个用户发送不同消息内容，单条消息最大 128k。每分钟最多发送 6000 条信息，每次发送用户上限为 1000 人。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $data = $RongCloud->user()->publishTemplate($userCode, $userName, $headerIcon);
        //$result = $RongCloud->message()->publishTemplate(file_get_contents($jsonPath.'TemplateMessage.json'));
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "PublishSystem"){// 发送系统消息方法（一个用户向一个或多个用户发送系统消息，单条消息最大 128k，会话类型为 SYSTEM。每秒钟最多发送 100 条消息，每次最多同时向 100 人发送，如：一次发送 100 人时，示为 100 条消息。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $data = $RongCloud->user()->PublishSystem($userCode, $userName, $headerIcon);
        //$result = $RongCloud->message()->PublishSystem('userId1', ["userId2","userid3","userId4"], 'RC:TxtMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\"}", 'thisisapush', '{\"pushData\":\"hello\"}', '0', '0');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishSystemTemplate"){// 发送系统模板消息方法（一个用户向一个或多个用户发送系统消息，单条消息最大 128k，会话类型为 SYSTEM.每秒钟最多发送 100 条消息，每次最多同时向 100 人发送，如：一次发送 100 人时，示为 100 条消息。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishSystemTemplate(file_get_contents($jsonPath.'TemplateMessage.json'));
        $data = $RongCloud->user()->publishSystemTemplate($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishGroup"){// 发送群组消息方法（以一个用户身份向群组发送消息，单条消息最大 128k.每秒钟最多发送 20 条消息，每次最多向 3 个群组发送，如：一次向 3 个群组发送消息，示为 3 条消息。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishGroup('userId', ["groupId1","groupId2","groupId3"], 'RC:TxtMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\"}", 'thisisapush', '{\"pushData\":\"hello\"}', '1', '1');
        $data = $RongCloud->user()->publishGroup($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishDiscussion"){// 发送讨论组消息方法（以一个用户身份向讨论组发送消息，单条消息最大 128k，每秒钟最多发送 20 条消息.）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishDiscussion('userId1', 'discussionId1', 'RC:TxtMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\"}", 'thisisapush', '{\"pushData\":\"hello\"}', '1', '1');
        $data = $RongCloud->user()->publishDiscussion($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishChatroom"){// 发送聊天室消息方法（一个用户向聊天室发送消息，单条消息最大 128k。每秒钟限 100 次。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishChatroom('userId1', ["ChatroomId1","ChatroomId2","ChatroomId3"], 'RC:TxtMsg',"{\"content\":\"hello\",\"extra\":\"helloExtra\"}");
        $data = $RongCloud->user()->publishChatroom($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "broadcast"){// 发送广播消息方法（发送消息给一个应用下的所有注册用户，如用户未在线会对满足条件（绑定手机终端）的用户发送 Push 信息，单条消息最大 128k，会话类型为 SYSTEM。每小时只能发送 1 次，每天最多发送 3 次。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->broadcast('userId1', 'RC:TxtMsg',"{\"content\":\"哈哈\",\"extra\":\"hello ex\"}", 'thisisapush', '{\"pushData\":\"hello\"}', 'iOS');
        $data = $RongCloud->user()->broadcast($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getHistory"){// 消息历史记录下载地址获取 方法消息历史记录下载地址获取方法。获取 APP 内指定某天某小时内的所有会话消息记录的下载地址。（目前支持二人会话、讨论组、群组、聊天室、客服、系统通知消息历史记录下载）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->getHistory('2014010101');
        $data = $RongCloud->user()->getHistory($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "deleteMessage"){// 消息历史记录删除方法（删除 APP 内指定某天某小时内的所有会话消息记录。调用该接口返回成功后，date参数指定的某小时的消息记录文件将在随后的5-10分钟内被永久删除。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->deleteMessage('2014010101');
        $data = $RongCloud->user()->deleteMessage($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addFiltWord"){// 添加敏感词方法（设置敏感词后，App 中用户不会收到含有敏感词的消息内容，默认最多设置 50 个敏感词。）
        $filtWord = $_GET['filtWord'];
        $result = $RongCloud->wordfilter()->add($filtWord);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getFiltWordList"){// 查询敏感词列表方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->wordfilter()->getList();
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "deleteFiltWord"){// 移除敏感词方法（从敏感词列表中，移除某一敏感词。）
        $filtWord = $_GET['filtWord'];
        $result = $RongCloud->wordfilter()->delete($filtWord);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "createGroup"){// 创建群组方法（创建群组，并将用户加入该群组，用户将可以收到该群的消息，同一用户最多可加入 500 个群，每个群最大至 3000 人，App 内的群组数量没有限制.注：其实本方法是加入群组方法 /group/join 的别名。）
        $userCode = $_GET['userCode'];
        $addUserList = $_GET['addUserList'];
        $groupId = $_GET['groupId'];
		$groupName = $_GET['groupName'];
        $result = $RongCloud->group()->create(["userId1","userid2","userId3"], 'groupId1', 'groupName1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "syncGroup"){// 同步用户所属群组方法（当第一次连接融云服务器时，需要向融云服务器提交 userId 对应的用户当前所加入的所有群组，此接口主要为防止应用中用户群信息同融云已知的用户所属群信息不同步。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $groupInfo['gourid1'] = 'gourpName1';
		$groupInfo['gourid2'] = 'gourpName2';
		$groupInfo['gourid3'] = 'gourpName3';
		$result = $RongCloud->group()->sync($userCode, $groupInfo);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "publishSystemTemplate"){// 发送系统模板消息方法（一个用户向一个或多个用户发送系统消息，单条消息最大 128k，会话类型为 SYSTEM.每秒钟最多发送 100 条消息，每次最多同时向 100 人发送，如：一次发送 100 人时，示为 100 条消息。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        //$result = $RongCloud->message()->publishSystemTemplate(file_get_contents($jsonPath.'TemplateMessage.json'));
        $data = $RongCloud->user()->publishSystemTemplate($userCode, $userName, $headerIcon);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "refreshGroup"){// 刷新群组信息方法
        $groupId = $_GET['groupId'];
		$groupName = $_GET['groupName'];
        $result = $RongCloud->group()->refresh( $groupId, $groupName);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "joinGroup"){// 将用户加入指定群组，用户将可以收到该群的消息，同一用户最多可加入 500 个群，每个群最大至 3000 人。
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->join(["userId2","userid3","userId4"], 'groupId1', 'TestGroup');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryGroupUser"){// 查询群成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->queryUser('groupId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "leaveGroup"){// 退出群组方法（将用户从群中移除，不再接收该群组的消息.）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->quit(["userId2","userid3","userId4"], 'TestGroup');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addGagUser"){// 添加禁言群成员方法（在 App 中如果不想让某一用户在群中发言时，可将此用户在群组中禁言，被禁言用户可以接收查看群组中用户聊天信息，但不能发送消息。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->addGagUser('userId1', 'groupId1', '1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "lisGagUser"){// 查询被禁言群成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->lisGagUser('groupId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "rollBackGagUser")// 移除禁言群成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->group()->rollBackGagUser(["userId2","userid3","userId4"], 'groupId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "dismissGroup"){// 解散群组方法。（将该群解散，所有用户都无法再接收该群的消息。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        result = $RongCloud->group()->dismiss('userId1', 'groupId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "createChartRoom"){// 创建聊天室方法
        $chatRoomInfo['chatroomId1'] = 'chatroomInfo1';
		$chatRoomInfo['chatroomId2'] = 'chatroomInfo2';
		$chatRoomInfo['chatroomId3'] = 'chatroomInfo3';
		$result = $RongCloud->chatroom()->create($chatRoomInfo);
        $msg = "success";
        $data['code'] = 200;
    }else if($api == "joinChatRoom"){// 加入聊天室方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->join(["userId2","userid3","userId4"], 'chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryChatRoomMessage"){// 查询聊天室信息方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->query(["chatroomId1","chatroomId2","chatroomId3"]);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "queryChatRoomUser"){// 查询聊天室内用户方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->queryUser('chatroomId1', '500', '2');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "stopDistributionMessage"){// 聊天室消息停止分发方法（可实现控制对聊天室中消息是否进行分发，停止分发后聊天室中用户发送的消息，融云服务端不会再将消息发送给聊天室中其他用户。）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->stopDistributionMessage('chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "resumeDistributionMessage"){// 聊天室消息恢复分发方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->resumeDistributionMessage('chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomGagUser"){// 添加禁言聊天室成员方法（在 App 中如果不想让某一用户在聊天室中发言时，可将此用户在聊天室中禁言，被禁言用户可以接收查看聊天室中用户聊天信息，但不能发送消息.）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->addGagUser('userId1', 'chatroomId1', '1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getListGagUser"){// 查询被禁言聊天室成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->ListGagUser('chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "rollbackChatRoomGagUser"){// 移除禁言聊天室成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->rollbackGagUser('userId1', 'chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomBlockUser"){// 添加封禁聊天室成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->addBlockUser('userId1', 'chatroomId1', '1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getListChatRoomBlockUser"){// 查询被封禁聊天室成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->getListBlockUser('chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "rollbackChatRoomBlockUser"){// 移除封禁聊天室成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->rollbackBlockUser('userId1', 'chatroomId1');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomPriority"){// 添加聊天室消息优先级方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->addPriority(["RC:VcMsg","RC:ImgTextMsg","RC:ImgMsg"]);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "destroyChatRoom"){// 销毁聊天室方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->destroy(["chatroomId","chatroomId1","chatroomId2"]);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addchatRoomWhiteListUser"){// 添加聊天室白名单成员方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->chatroom()->addWhiteListUser('chatroomId', ["userId1","userId2","userId3","userId4","userId5"]);
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "setChatRoomUserPushTag"){// 添加 Push 标签方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->push()->setUserPushTag(file_get_contents($jsonPath.'UserTag.json'));
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "broadcastPush"){// 广播消息方法（fromuserid 和 message为null即为不落地的push）
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->push()->broadcastPush(file_get_contents($jsonPath.'PushMessage.json'));
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "getImageCode"){// 获取图片验证码方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->SMS()->getImageCode('app-key');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomPriority"){// 发送短信验证码方法。
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->SMS()->sendCode('13500000000', 'dsfdsfd', '86', '1408706337', '1408706337');
        $msg = "success";
        $data['code'] = 200;
    } else if($api == "addChatRoomPriority"){// 验证码验证方法
        $userCode = $_GET['userCode'];
        $userName = $_GET['userName'];
        $headerIcon = $_GET['headerIcon'];
        $result = $RongCloud->SMS()->verifyCode('2312312', '2312312');
        $msg = "success";
        $data['code'] = 200;
    }

    echo json_encode($data);
