<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="����׿ά��Ϣ��׿��ͨ��׿άӰ����Android������ᣬAndroid��Ϣ��ʿ��AndroidSIP�绰��Android SIP������Android ����¼��" />
<meta name="description" content="׿ά��Ϣ - ������3G/4G������ʱ��IP�����Ƶ�绰�Ŀ�������������Ϣ��ȫ����Ϊ�û���Ϣ��ȫ���ݻ�����" />
<meta name="baidu-site-verification" content="qGhtGX94jS" />
<title>׿ά�Ƽ� - ������3G/4G������ʱ��������¼������¼����SIP��ѵ绰����Ϣ��ȫ����������Ƶ���ţ�Ϊ�û���Ϣ��ȫ���ݻ�����</title>
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
    <div class="at1">�ֻ����� wap.davmb.com</div>
    <div class="clear"></div>
  </div>
  <div class="nav">
    <ul>
      <li><a href="index.php">��ҳ</a></li>
      <li><a href="droviksms.php">׿ά��Ϣ��ʿ</a></li>
      <li><a href="drovikplay.php">׿άӰ��</a></li>
      <li><a href="droviknews.php">���¶�̬</a></li>
      <li><a href="drovikmessage.php">���԰�</a></li>
      <li class="hover"><a href="drovikhelp.php">��������</a></li>
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
              <li id="one1" onmouseover="setTab('one',1,2)" class="hover">׿ά��Ϣ��ʿ</li>
              <li id="one2" onmouseover="setTab('one',2,2)">׿άӰ��</li>
            </ul>
          </div>
          <div class="con_t1" id="con_one_1">
            <table width="100%" border="0">
              <tr>
                <td width="60" height="40" align="right">�û���&nbsp;</td>
                <td><input type="text" value="" class="text2" /></td>
              </tr>
              <tr>
                <td width="60" height="40" align="right">��&nbsp;&nbsp;��&nbsp;</td>
                <td><input type="password" value="" class="text2"/></td>
              </tr>
              <tr>
                <td width="60" height="40" align="right">&nbsp;</td>
                <td><div class="c4">
                    <input type="submit" value="" class="btn2" />
                    &nbsp;&nbsp;<a href="#" style="font-weight:normal; font-size:12px; color:#610007">��������</a></div></td>
              </tr>
            </table>
          </div>
          <div class="con_t1" id="con_one_2" style="display:none">
            <table width="100%" border="0">
              <tr>
                <td width="60" height="40" align="right">�û���&nbsp;</td>
                <td><input type="text" value="" class="text2" /></td>
              </tr>
              <tr>
                <td width="60" height="40" align="right">��&nbsp;&nbsp;��&nbsp;</td>
                <td><input type="password" value="" class="text2"/></td>
              </tr>
              <tr>
                <td width="60" height="40" align="right">&nbsp;</td>
                <td><div class="c4">
                    <input type="submit" value="" class="btn2" />
                    &nbsp;&nbsp;<a href="#">��������</a></div></td>
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
        <h2><a href="#">׿��ͨ</a></h2>
        <div class="txt2">
          <p>��Ϣ��ȫ����Ϣ���գ���Ϣ���ܣ���Ϣ���ݣ���ϢȺ���Ȼ�����Ϣ�������Ϣ��ȫ��ʿ��</p>
        </div>
        <div class="at2"> <a href="javascript:" onclick="foo_vefiry(1001)"><img src="img/btn1.jpg"  width="142" height="39"/></a><span><a href="drovikdown.php">>>�˽�����</a></span> </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="box1">
      <div class="img1"><img src="img/icon4.jpg"  width="122" height="122"/></div>
      <div class="txt">
        <h2><a href="#">׿άӰ��</a></h2>
        <div class="txt2">
          <p>��Ƶ���ţ�ͼƬ�������ͼ����</p>
        </div>
        <div class="at2"> <a href="#"><img src="img/btn1.jpg"  width="142" height="39"/></a><span><a href="drovikdown2.php">>>�˽�����</a></span> </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div style="background:url(img/bg6.jpg) repeat-x; height:2px; width:100%; margin-bottom:18px; overflow:hidden"></div>
    <div class="box2">
      <h2 class="title1"><img src="img/icon1.jpg" />&nbsp;&nbsp;���¶�̬</h2>
      <ul class="menu1">
        <li><a href="#">׿ά��Ϣ��ʿ��������</a><span>2014-08-01</span></li>
      </ul>
      <div><a href="droviknews.php" style="float:right; color:#b05004">>>�˽�����</a></div>
    </div>
    <div class="box3">
      <div class="txt3">
        <h2 class="title2"><img src="img/icon2.gif" />&nbsp;&nbsp;�ͷ�����</h2>
        <img src="img/phone.gif" width="198" height="111"/> </div>
      <div class="img2"><a href="drovikmessage.php"><img src="img/icon5.gif" width="162" height="158"/></a></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="foot">
  <div class="foot_nav"><a href="drovikhelp.php">��������</a>|<a href="#">��˽����</a>|<a href="drovikabout.php">��������</a></div>
  <!--<div class="foot_center" style="text-align:top"><?php echo "���Ǳ�վ�� "; require("count.php"); echo " λ�ÿ�"; ?></div>-->
  <div class="foot_bar"><img src="img/logo2.jpg"  width="114" height="42" align="left"/>&copy;2014. ׿ά��Ϣ<br />
    ��ICP��08009100
   </div>
  <div class="clear"></div>
</div>


</body>
</html>
