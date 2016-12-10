<?php
include "dbutil/mysqlinfo.php";
include "dbutil/mysql.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

	if(!empty($_GET)){
		$code = $_GET['errorcode'];
		if($code == 0){
			exit("<script>alert('邮箱为空。');location.href='drovikmessage.php'</script>");
		}else if($code == 1){
			exit("<script>alert('电话号码为空。');location.href='drovikmessage.php'</script>");
		}else if($code == 2){
			exit("<script>alert('留言内容为空。');location.href='drovikmessage.php'</script>");
		}else if($code == 3){
			exit("<script>alert('留言内容太长。');location.href='drovikmessage.php'</script>");
		}else if($code == 4){
			exit("<script>alert('验证码错误。');location.href='drovikmessage.php'</script>");
		}else if($code == 5){
			exit("<script>alert('提交成功，请等待回复，谢谢。');location.href='drovikmessage.php'</script>");
		}else if($code == 6){
			exit("<script>alert('提交失败。');location.href='drovikmessage.php'</script>");
		}else{
			exit("<script>alert('".$code."');location.href='drovikmessage.php'</script>");
		}
		
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>留言板 卓维信息技术</title>
<link rel="stylesheet" type="text/css" href="img/style.css"/>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fe0ef9b207da00dbf94e53c1a13338019' type='text/javascript'%3E%3C/script%3E"));
</script>
</head>
<script type="text/javascript" src="img/tab.js"></script>
<script type="text/javascript" src="img/putaojiayuan.js"></script>
<script type="text/javascript">
function chkemail(email) 
{
	var regm = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
	if (!email.match(regm)){
		return false;
	 }
	return true;
}

function isEmail(str){ 
	var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
	return reg.test(str); 
} 

function isPhone(str){
	var mobile = /^((\(\d{3}\))|(\d{3}\-))?13\d{9}|15[0-9]|18[0-9]\d{8}$/;
	return mobile.test(str);
} 

function validate_required(field,alerttxt)
{
	with (field) {
		if (value==null||value=="") {
			alert(alerttxt);
			return 0;
		} else {
			return 0;
		}
	}
}
function validate_form(thisform)
{
	with (thisform) {
		if (email.value==null || email.value=="") {
			alert("邮箱不能为空！");
			email.focus();
			return false;
		}
		if(!isEmail(email.value)){
			alert("邮箱格式不正确！");
			email.focus();
			return false;
		}
		if (phone.value==null || phone.value==""){
			alert("电话号码不能为空！");
			phone.focus();
			return false;
		}
		if(!isPhone(phone.value)){
			alert("不是手机号码！");
			phone.focus();
			return false;
		}
		if(content.value==null || content.value==""){
			alert("留言内容不能为空！");
			content.focus();
			return false;
		}
		return true;
	}
}
</script>
<body>
<div class="top">
  <div class="top_bar">
    <div class="logo"></div>
    <div class="at1">手机访问 www.davmb.com</div>
    <div class="clear"></div>
  </div>
  <div class="nav">
    <ul>
      <li><a href="index.php">首页</a></li>
      <li><a href="droviksms.php">卓维信息卫士</a></li>
      <li><a href="drovikplay.php">卓维影音</a></li>
      <li><a href="droviknews.php">最新动态</a></li>
      <li><a href="drovikmessage.php">留言板</a></li>
      <li class="hover"><a href="drovikhelp.php">帮助中心</a></li>
    </ul>
  </div>
</div>
<div class="content">
  <div class="main">
    <div class="banner2"><img src="img/banner2.jpg"  width="1000" height="100"/></div>
    <div class="bar"><b>最新动态</b><span>当前位置：<a href="index.php">首页 ></a><a href="#">最新动态</a></span></div>
    <div class="left">
        <h2 class="title6">通过给卓维信息留言，最快满足您的需求</h2>
        <p>成功提交的留言将在12小时内给予回复 我们将把回复发到您的邮箱，请务必填写正确的邮箱地址</p>
		<form action="post_message.php" onsubmit="return validate_form(this)" method="post">
			<div class="liuy">
			   <div class="c">
				  <div class="l">邮箱地址：</div>
				  <div class="r"><input name="email" id="email" type="text" class="text1" /></div>
				  <div class="clear"></div>
			   </div>
			   <div class="c">
				  <div class="l">手机号码：</div>
				  <div class="r"><input name="phone" id="phone" type="text" class="text1" /></div>
				  <div class="clear"></div>
			   </div>
			   <div class="c">
				  <div class="l">留言内容：</div>
				  <div class="r"><textarea name="content" id="content" class="textarea"></textarea></div>
				  <div class="clear"></div>
			   </div>
			   <div class="c">
				  <div class="l">验 证 码：</div>
				  <div class="r"><input type="text" name="verifycode" id="verifycode" class="text1" />&nbsp;&nbsp;<img onclick="this.src=this.src+'?'" alt="验证码,看不清楚?请点击刷新验证码" src="webadmin/inc/getcode.php" /></div>
				  <div class="clear"></div>
			   </div>
			   <div style="text-align:center; padding:10px 0"><input type="submit" value="" class="btn1" /></div>
			</div>
		<form/>
        <div class="hist">
            <h2 class="title7">历史留言</h2>
			<?php
				$db = new mysql($hostname, $username, $password, $dbname, $charset);
				$dav_message = "dav_message";
				$result =  $db->findMore($dav_message, "type=0", "time, content, replay_content, replay_time", "", "","");
				foreach($result as $value){
			?>
				<div class="list1">
				   <div class="list1_l"><img src="img/icon10.jpg"  width="23" height="26"/></div>
				   <div class="list1_r">
					  <h3>咨询内容：<span class="time"><?php echo $value['time'];?></span></h3>
					  <p><?php echo mb_convert_encoding($value['content'], "GBK", "UTF-8");?></p>
				   </div>
				   <div class="clear"></div>
				</div>
				<div class="list1">
				   <div class="list1_l"><img src="img/icon11.jpg"  width="23" height="26"/></div>
				   <div class="list1_r1">
				   <div class="jiantou2"></div>
					  <h3>卓维信息回复：
						<span class="time"><?php 
							$replay_time = mb_convert_encoding($value['replay_time'], "GBK", "UTF-8");
							if(!empty($replay_time)){
								echo $replay_time;
							}?>
						</span>
					  </h3>
					  <p><?php 
						$replay_content = mb_convert_encoding($value['replay_content'], "GBK", "UTF-8");
						if(empty($replay_content)){
							echo "请等待回复。。。，谢谢。";
						}else{
							echo $replay_content;
						}
						?>
					   </p>
				   </div>
				   <div class="clear"></div>
				</div>
			<?php
			}
			?>
			<!--
            <div class="line"></div>
            <div class="list1">
               <div class="list1_l"><img src="img/icon10.jpg"  width="23" height="26"/></div>
               <div class="list1_r">
                  <h3>咨询内容：<span class="time">2011-05-25 11:21</span></h3>
                  <p>为什么我在恢复通讯录完成之后提示‘我的通讯录已经是最新的了不的手机里却没有一个电话？</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="list1">
               <div class="list1_l"><img src="img/icon11.jpg"  width="23" height="26"/></div>
               <div class="list1_r1">
               <div class="jiantou2"></div>
                  <h3>亿贝回复：<span class="time">2011-05-25 11:21</span></h3>
                  <p>非常感谢您的建议，删除旧备份这个功能应该是可以的，只在在线编辑单条记录我们觉得会很容易导致和手机上的数据不一致，建议先在手机上改了，然后再备份到服务器。</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="line"></div>
              <div class="list1">
               <div class="list1_l"><img src="img/icon10.jpg"  width="23" height="26"/></div>
               <div class="list1_r">
                  <h3>咨询内容：<span class="time">2011-05-25 11:21</span></h3>
                  <p>为什么我在恢复通讯录完成之后提示‘我的通讯录已经是最新的了不的手机里却没有一个电话？</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="list1">
               <div class="list1_l"><img src="img/icon11.jpg"  width="23" height="26"/></div>
               <div class="list1_r1">
               <div class="jiantou2"></div>
                  <h3>亿贝回复：<span class="time">2011-05-25 11:21</span></h3>
                  <p>非常感谢您的建议，删除旧备份这个功能应该是可以的，只在在线编辑单条记录我们觉得会很容易导致和手机上的数据不一致，建议先在手机上改了，然后再备份到服务器。</p>
               </div>
               <div class="clear"></div>
            </div>-->
            <div class="line"></div>
            <div class="more2"><a href="#"><img src="img/more1.jpg" /></a><a href="#"><img src="img/more2.jpg" /></a><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#"><img src="img/more3.jpg" /></a><a href="#"><img src="img/more4.jpg" /></a></div>
                       
        </div>
    </div>
    <div class="right">
      <div class="box6">
        <div class="prot3">
          <div class="prot4">
            <div class="at4">
              <p>任何时候打开卓维影音都会给您带来不一般的视觉、听觉享受。</p>
              <br />
              <br />
              <img src="img/img2.jpg" /> </div>
            <div class="jiantou"></div>
          </div>
        </div>
      </div>
      <div class="box5">
        <div class="prot1">
          <div class="port2">
            <h2 class="title3"><img src="img/icon8.jpg"  width="32" height="32"/>&nbsp;常见问题</h2>
            <ul class="menu2">
              <li><a href="#">美图无法显示</a></li>
            </ul>
            <div class="more"><a href="#">>>了解详情</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="foot">
  <div class="foot_nav"><a href="drovikhelp.php">帮助中心</a>|<a href="#">隐私条款</a>|<a href="drovikabout.php">关于我们</a></div>
  <!--<div class="foot_center" style="text-align:top"><?php echo "您是本站第 "; require("count.php"); echo " 位访客"; ?></div>-->
  <div class="foot_bar"><img src="img/logo2.jpg"  width="114" height="42" align="left"/>&copy;2014. 卓维信息<br />
    浙ICP备08009100</div>
  <div class="clear"></div>
</div>
</body>
</html>
