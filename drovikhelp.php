<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>帮助中心</title>
<link rel="stylesheet" type="text/css" href="img/style.css"/>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fe0ef9b207da00dbf94e53c1a13338019' type='text/javascript'%3E%3C/script%3E"));
</script>
</head>
<script type="text/javascript" src="img/tab.js"></script>
<script type="text/javascript" src="img/jquery-1.3.2.min.js"></script>
<!--[if lt IE 7]>
<script type="text/javascript" src="img/putaojiayuan.js"></script>
<![endif]-->
<script type="text/javascript">

	$(function(){
				$('dt').hover(function(){
			
					if($(this).hasClass('expand')) return;
					$(this).attr('class','focus');
				},function(){
					if($(this).hasClass('expand')) return;
					$(this).attr('class','original');}
				);
 
				$('dt').click(function(){
					if($(this).hasClass('expand')){
						$(this).next().hide();
						$(this).attr('class','original');;
						return;
					}
					$('dd').hide();
					$('dt').attr('class','original');
					$(this).attr('class','expand');
					$(this).next().show();
				});
			})
 
	function helpTeb(name,cursel,n){
		  for(i=1;i<=n;i++){
		  var no=document.getElementById(name+""+i);
		  var content=document.getElementById("content"+name+i);
		  if(content==null){
			return;
		  }
		  content.style.display=i==cursel?"block":"none";
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
    <div class="bar"><b>用户中心</b><span>当前位置：<a href="index.php">首页 ></a><a href="#">用户中心</a></span></div>
    <div class="left1">
          <div class="box7">
             <h3 class="bar5">帮助中心</h3>
             <ul class="menu6">
                <li><a id="NO1" onclick="helpTeb('NO',1,8)" href="#">常见问题</a></li>
                <li><a id="NO2" onclick="helpTeb('NO',2,8)" href="#">其他问题</a></li>
             </ul>
             <h3 class="bar5">关于我们</h3>
             <ul class="menu6">
                <li><a id="NO3" onclick="helpTeb('NO',3,8)" href="#">加入我们</a></li>
                <li><a id="NO4" onclick="helpTeb('NO',4,8)" href="#">联系我们</a></li>
             </ul>
          </div>
    </div>
    <div class="right1" id="contentNO1" style="display: block">
	<div class="wenti" style="width:640px; margin:0 auto;">
		 <dl>
		 	<dt class="original">如何下载安装卓信通</dt>
			<dd>先看看我特别为您准备的教程吧。<a href="#">立即查看</a></dd>
			
			<dt class="original">如何群发短信？</dt>
			<dd>编辑您需要发送的短信，点击联系人列表，选择多个联系人，然后点击发送。</dd>
			
			<dt class="original">积分有什么用处？</dt>
			<dd>
			<p><strong>方法一、</strong>在我的积分页面中,点“消费”按钮,在弹出的界面中就可以凭积分换购您需要的商品了。<a href="#">去看看吧</a></p><br/>
			<p><strong>方法二、</strong>直接转发短信或者将二维码转发给给朋友就可以啦！</p>
			</dd>
		 </dl>
 
		</div>
    </div>
	
	<div class="right1" id="contentNO2" style="display: none">
	<div class="wenti" style="width:640px; margin:0 auto;">
	 <dl>
		<dt class="original">卓维影音无法播放视频</dt>
		<dd>处理方法：<br/>
		1)	重启手机，打开软件重试几次。<br/>
		2)	如果问题仍然存在，请打开卓维影音官网：www.davmb.com下载最新的软件及解码器</dd>
		
		<dt class="original">卓维影音无法下载图片</dt>
		<dd>处理方法：<br/>
		1)	检查手机是否可以连接互联网。<br/>
		2)  检查防火墙软件是否允许卓维影音连接互联网。
		3)	如果依然无法下载视频，请打开卓维影音官网：www.davmb.com下载最新的软件</dd>
		
		<dt class="original">无法评论图片？</dt>
		<dd>
		<p>出现无法评论图片的原因是因为您的积分不足，请按照提示获取积分就可以发表评论了。</p><br/>

		</dd>
		<dt class="original">积分有什么用处？</dt>
		<dd>
		<p>在我的积分页面中,点“消费”按钮,在弹出的界面中就可以凭积分换购您需要的商品了。</p><br/>
		</dd>
	 </dl>

	</div>
	</div>
	
	<div id="contentNO3" class="right1" style="width:640px; margin:0 auto; display: none">
    <div class="bar3"><b style="font-family: 粗体">加入卓维</b><span style="padding-left: 100px;">&nbsp;</span>

	<div class="row" style="color:#666666">
	卓维信息是一家正处在快速成长期的互联网公司，目前我们主要专注于3G/4G的互联网应用领域的开发，对于公司的企业文化，我们非常注重员工的个性的培养，推崇开放式的工作模式，不拘泥于现有的条条框框，鼓励
	提倡员工创新，如果您认同我们的这些观点，并拥有以下一项或多项技能，请第一时间将您 的简历发到：
	<span style="color:#FF1900">sky.xctc@163.com</span>
	</div>
	<div style="color:#666666">
	<div class="item">熟练掌握Android API</div>
	<div class="item">熟练运用Eclipse、SourceInside等开发工具</div>
	<div class="item">能基于Android进行应用开发</div>
	<div class="item">具有良好的编码规范和刻苦钻研的精神</div>
	<div class="item">能对软件进行自动化功能测试</div>
	<div class="item">能完成无线业务产品的推广策划工作</div>
	</div>
	<div class="row" style="height:1px"></div>
	</div>
	</div>
	
	<div id="contentNO4" class="right1" style="width:640px; margin:0 auto; display: none">
    <div class="bar3"><b style="font-family: 粗体">联系我们</b><span style="padding-left: 100px;">&nbsp;</span>

	<div class="row" style="color:#666666">
	我们欢迎一切有积极意义的反馈或批评!
	   如果您在使用我们的软件过程中碰到任何疑问,或对我们的团队及产品有其它建议,请通过以下方式联系我们，非常感谢！	
	</div>
	<div class="" style="color:#666666">
	地　址: 杭州市天目山路160号国际花园19L<br/>
	邮　编: 310012<br/>
	电　话: 150-6888-5227<br/>
	Email : sky.xctc@163.com<br/>
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
