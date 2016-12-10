<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>卓维影音</title>
<link rel="stylesheet" type="text/css" href="img/style.css"/>
<script type="text/javascript" src="img/putaojiayuan.js"></script>
<SCRIPT type=text/javascript> 
function foo_vefiry(pass){ 
    $.post('action/api/apk_download.php', {apk_id:pass}, function(data){
		if(data == 1002){
			window.location.href="download/apk/SmartPlayer.zip";
		}
    }); 
}
</SCRIPT>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fe0ef9b207da00dbf94e53c1a13338019' type='text/javascript'%3E%3C/script%3E"));
</script>
</head>

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
  <div class="banner2"><img src="img/banner5.jpg"  width="1000" height="100"/></div>
   <div class="bar"><b>卓维影音</b><span>当前位置：<a href="index.php">首页 ></a><a href="#">卓维影音</a></span></div>
   <div class="left">
     <div class="at3">
        <div class="at3_l"><img src="img/icon3.gif" width="90" height="90" /></div>
        <div class="at3_c">
        <h2>卓维影音<span>（版本 v2.9）</span></h2>
        <p>集视频播放，图片浏览，美图欣赏于一体，为您提供美轮美奂的影音享受。</p>
        </div>
        <div class="at3_r"><a href="javascript:" onclick="foo_vefiry(1002)"><img src="img/btn1.jpg"  width="142" height="39"/></a></div>
        <div class="clear"></div>
     </div>
      <div class="box4">
         <div class="box4_l"><a href="#"><img src="img/1.jpg" width="59" height="60" /></a></div>
         <div class="box4_r">
            <h2><a href="#">万能解码</a></h2>
            <p>集众多的影音解码方案，解除影音转码的烦恼，<a href="#"></a></p>
         </div>
         <div class="clear"></div>
      </div>
      <div class="box4">
         <div class="box4_l"><a href="#"><img src="img/2.jpg" width="59" height="60" /></a></div>
         <div class="box4_r">
            <h2><a href="#">高清海量图片高速浏览</a></h2>
            <p>读图时代，海量高清美景、美女图片释然你的高压生活。数万张美图，每天动态更新。</p>
         </div>
         <div class="clear"></div>
      </div>
      <div class="box4">
         <div class="box4_l"><a href="#"><img src="img/3.jpg" width="59" height="60" /></a></div>
         <div class="box4_r">
            <h2><a href="#">软件界面简约、操作方便快捷</a></h2>
            <p>界面简约，内容丰富，操作得心应手。</p>
         </div>
         <div class="clear"></div>
      </div>
      <div class="box4">
         <div class="box4_l"><a href="#"><img src="img/4.jpg" width="59" height="60" /></a></div>
         <div class="box4_r">
            <h2><a href="#">卓维影音掌中握，畅享移动新生活</a></h2>
            <p>努力打造移动影音之王是卓维影音孜孜以求的目标。</p>
         </div>
         <div class="clear"></div>
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
              <img src="img/img2.jpg" />
            </div>
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
