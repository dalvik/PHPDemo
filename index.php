<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="杭州卓维信息，卓信通，卓维影音，Android网络相册，Android信息卫士，AndroidSIP电话，Android SIP语音，Android 蓝牙录音" />
<meta name="description" content="卓维信息 - 致力于3G/4G互联网时代IP免费视频电话的开发，致力于信息安全管理，为用户信息安全保驾护航。" />
<meta name="baidu-site-verification" content="qGhtGX94jS" />
<title>卓维科技 - 致力于3G/4G互联网时代开发，录像、蓝牙录音，SIP免费电话，信息安全管理，高清视频播放，为用户信息安全保驾护航。</title>
<link rel="stylesheet" type="text/css" href="img/style.css"/>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fe0ef9b207da00dbf94e53c1a13338019' type='text/javascript'%3E%3C/script%3E"));
</script>
</head>
<!--[if lt IE 7]>
<script type="text/javascript" src="img/putaojiayuan.js"></script>
<![endif]-->
<script type="text/javascript" src="img/tab.js"></script>
<SCRIPT src="img/jquery.min.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript> 
var _c = _h = 0;
/*
$(document).ready(function () {
    $('#play  li').click(function(){
        var i = $(this).attr('alt') - 1;
        clearInterval(_h);
        _c = i;
        //play();
        change(i);       
    })
    $("#pic img").hover(function(){clearInterval(_h)}, function(){play()});
    play();
})
function play()
{
    _h = setInterval("auto()", 8000);
 
}
function change(i)
{
    $('#play li').css('background-color','#000000').eq(i).css('background-color','#FF3000').blur();
    $("#pic img").fadeOut('slow').eq(i).fadeIn('slow');
}
function auto()
{   
    _c = _c > 6 ? 0 : _c + 1;
 
    change(_c);
}*/
function foo_vefiry(pass){ 
    $.post('action/api/apk_download.php', {apk_id:pass}, function(data){
		if(data == 1001){
			window.location.href="download/apk/SmsGuarder.zip";
		}
    }); 
}
</SCRIPT>
<style type="text/css">
.img_switch {margin:0 auto;WIDTH:1000px;HEIGHT: 261px; overflow:hidden}
.img_switch_content {HEIGHT: 261px;position:relative;}
.img_switch_text {width: 262px;position: absolute;z-index:10; bottom:5px;left:10px;HEIGHT: 15px; z-index:10000 !important}
.number_nav {DISPLAY: inline;FLOAT: left;}
.number_nav UL {font:12px Arial, Helvetica, sans-serif;padding: 0px;MARGIN: 0px;LIST-STYLE-TYPE: none;color:#fff;}
.number_nav UL LI {float: left;font-weight: bold;background: #000;float: left;margin-right: 8px;width: 23px;cursor: pointer;line-height: 17px;height: 17px;text-align: center;filter:alpha(opacity=75);-moz-opacity:0.75;opacity: 0.75;}
#pic {OVERFLOW: hidden}
</style>
<body>
<div class="top">
  <div class="top_bar">
    <div class="logo"></div>
    <div class="at1">手机访问 wap.davmb.com</div>
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
    <div class="container">
	  <!--
      <div class="denglu">
        <div class="tabbox">
          <div class="menu5">
            <ul>
              <li id="one1" onmouseover="setTab('one',1,2)" class="hover">卓维信息卫士</li>
              <li id="one2" onmouseover="setTab('one',2,2)">卓维影音</li>
            </ul>
          </div>
          <div class="con_t1" id="con_one_1">
            <table width="100%" border="0">
              <tr>
                <td width="60" height="40" align="right">用户名&nbsp;</td>
                <td><input type="text" value="" class="text2" /></td>
              </tr>
              <tr>
                <td width="60" height="40" align="right">密&nbsp;&nbsp;码&nbsp;</td>
                <td><input type="password" value="" class="text2"/></td>
              </tr>
              <tr>
                <td width="60" height="40" align="right">&nbsp;</td>
                <td><div class="c4">
                    <input type="submit" value="" class="btn2" />
                    &nbsp;&nbsp;<a href="#" style="font-weight:normal; font-size:12px; color:#610007">忘记密码</a></div></td>
              </tr>
            </table>
          </div>
          <div class="con_t1" id="con_one_2" style="display:none">
            <table width="100%" border="0">
              <tr>
                <td width="60" height="40" align="right">用户名&nbsp;</td>
                <td><input type="text" value="" class="text2" /></td>
              </tr>
              <tr>
                <td width="60" height="40" align="right">密&nbsp;&nbsp;码&nbsp;</td>
                <td><input type="password" value="" class="text2"/></td>
              </tr>
              <tr>
                <td width="60" height="40" align="right">&nbsp;</td>
                <td><div class="c4">
                    <input type="submit" value="" class="btn2" />
                    &nbsp;&nbsp;<a href="#">忘记密码</a></div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
	  -->
      <DIV class="img_switch">
      <DIV class="img_switch_content" id="pic"> <a href="#"><IMG  src="img/banner3.jpg"></a> <!--<a href="#"><IMG  src="img/banner4.jpg"></a> <a href="#"><IMG  src="img/banner3.jpg"></a> <a href="#"><IMG  src="img/banner4.jpg"></a> <a href="#"><IMG  src="img/banner3.jpg"></a> <a href="#"><IMG  src="img/banner4.jpg"></a> <a href="#"><IMG  src="img/banner3.jpg"></a> <a href="#"><IMG  src="img/banner4.jpg"></a>-->
        <DIV class="img_switch_text">
          <DIV class="#"><!--number_nav-->
            <UL id="#"><!--play-->
              <LI alt="1" style="background:#f00;"></LI>
			  <!--
              <LI alt="2">2</LI>
              <LI alt="3">3</LI>
              <LI alt="4">4</LI>
              <LI alt="5">5</LI>
              <LI alt="6">6</LI>
              <LI alt="7">7</LI>
              <LI alt="8">8</LI> -->
            </UL>
          </DIV>
        </DIV>
      </DIV>
    </DIV>
    </div>
    <div class="box1">
      <div class="img1"><img src="img/icon3.jpg"  width="122" height="122"/></div>
      <div class="txt">
        <h2><a href="#">卓信通</a></h2>
        <div class="txt2">
          <p>信息安全，信息接收，信息加密，信息备份，信息群发等基于信息服务的信息安全卫士。</p>
        </div>
        <div class="at2"> <a href="javascript:" onclick="foo_vefiry(1001)"><img src="img/btn1.jpg"  width="142" height="39"/></a><span><a href="drovikdown.php">>>了解详情</a></span> </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="box1">
      <div class="img1"><img src="img/icon4.jpg"  width="122" height="122"/></div>
      <div class="txt">
        <h2><a href="#">卓维影音</a></h2>
        <div class="txt2">
          <p>视频播放，图片浏览，美图欣赏</p>
        </div>
        <div class="at2"> <a href="#"><img src="img/btn1.jpg"  width="142" height="39"/></a><span><a href="drovikdown2.php">>>了解详情</a></span> </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div style="background:url(img/bg6.jpg) repeat-x; height:2px; width:100%; margin-bottom:18px; overflow:hidden"></div>
    <div class="box2">
      <h2 class="title1"><img src="img/icon1.jpg" />&nbsp;&nbsp;最新动态</h2>
      <ul class="menu1">
        <li><a href="#">卓维信息卫士发布啦！</a><span>2014-08-01</span></li>
      </ul>
      <div><a href="droviknews.php" style="float:right; color:#b05004">>>了解详情</a></div>
    </div>
    <div class="box3">
      <div class="txt3">
        <h2 class="title2"><img src="img/icon2.gif" />&nbsp;&nbsp;客服中心</h2>
        <img src="img/phone.gif" width="198" height="111"/> </div>
      <div class="img2"><a href="drovikmessage.php"><img src="img/icon5.gif" width="162" height="158"/></a></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="foot">
  <div class="foot_nav"><a href="drovikhelp.php">帮助中心</a>|<a href="#">隐私条款</a>|<a href="drovikabout.php">关于我们</a></div>
  <!--<div class="foot_center" style="text-align:top"><?php echo "您是本站第 "; require("count.php"); echo " 位访客"; ?></div>-->
  <div class="foot_bar"><img src="img/logo2.jpg"  width="114" height="42" align="left"/>&copy;2014. 卓维信息<br />
    浙ICP备08009100
   </div>
  <div class="clear"></div>
</div>


</body>
</html>
