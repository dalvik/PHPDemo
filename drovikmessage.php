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
			exit("<script>alert('����Ϊ�ա�');location.href='drovikmessage.php'</script>");
		}else if($code == 1){
			exit("<script>alert('�绰����Ϊ�ա�');location.href='drovikmessage.php'</script>");
		}else if($code == 2){
			exit("<script>alert('��������Ϊ�ա�');location.href='drovikmessage.php'</script>");
		}else if($code == 3){
			exit("<script>alert('��������̫����');location.href='drovikmessage.php'</script>");
		}else if($code == 4){
			exit("<script>alert('��֤�����');location.href='drovikmessage.php'</script>");
		}else if($code == 5){
			exit("<script>alert('�ύ�ɹ�����ȴ��ظ���лл��');location.href='drovikmessage.php'</script>");
		}else if($code == 6){
			exit("<script>alert('�ύʧ�ܡ�');location.href='drovikmessage.php'</script>");
		}else{
			exit("<script>alert('".$code."');location.href='drovikmessage.php'</script>");
		}
		
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>���԰� ׿ά��Ϣ����</title>
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
			alert("���䲻��Ϊ�գ�");
			email.focus();
			return false;
		}
		if(!isEmail(email.value)){
			alert("�����ʽ����ȷ��");
			email.focus();
			return false;
		}
		if (phone.value==null || phone.value==""){
			alert("�绰���벻��Ϊ�գ�");
			phone.focus();
			return false;
		}
		if(!isPhone(phone.value)){
			alert("�����ֻ����룡");
			phone.focus();
			return false;
		}
		if(content.value==null || content.value==""){
			alert("�������ݲ���Ϊ�գ�");
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
    <div class="at1">�ֻ����� www.davmb.com</div>
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
    <div class="banner2"><img src="img/banner2.jpg"  width="1000" height="100"/></div>
    <div class="bar"><b>���¶�̬</b><span>��ǰλ�ã�<a href="index.php">��ҳ ></a><a href="#">���¶�̬</a></span></div>
    <div class="left">
        <h2 class="title6">ͨ����׿ά��Ϣ���ԣ����������������</h2>
        <p>�ɹ��ύ�����Խ���12Сʱ�ڸ���ظ� ���ǽ��ѻظ������������䣬�������д��ȷ�������ַ</p>
		<form action="post_message.php" onsubmit="return validate_form(this)" method="post">
			<div class="liuy">
			   <div class="c">
				  <div class="l">�����ַ��</div>
				  <div class="r"><input name="email" id="email" type="text" class="text1" /></div>
				  <div class="clear"></div>
			   </div>
			   <div class="c">
				  <div class="l">�ֻ����룺</div>
				  <div class="r"><input name="phone" id="phone" type="text" class="text1" /></div>
				  <div class="clear"></div>
			   </div>
			   <div class="c">
				  <div class="l">�������ݣ�</div>
				  <div class="r"><textarea name="content" id="content" class="textarea"></textarea></div>
				  <div class="clear"></div>
			   </div>
			   <div class="c">
				  <div class="l">�� ֤ �룺</div>
				  <div class="r"><input type="text" name="verifycode" id="verifycode" class="text1" />&nbsp;&nbsp;<img onclick="this.src=this.src+'?'" alt="��֤��,�������?����ˢ����֤��" src="webadmin/inc/getcode.php" /></div>
				  <div class="clear"></div>
			   </div>
			   <div style="text-align:center; padding:10px 0"><input type="submit" value="" class="btn1" /></div>
			</div>
		<form/>
        <div class="hist">
            <h2 class="title7">��ʷ����</h2>
			<?php
				$db = new mysql($hostname, $username, $password, $dbname, $charset);
				$dav_message = "dav_message";
				$result =  $db->findMore($dav_message, "type=0", "time, content, replay_content, replay_time", "", "","");
				foreach($result as $value){
			?>
				<div class="list1">
				   <div class="list1_l"><img src="img/icon10.jpg"  width="23" height="26"/></div>
				   <div class="list1_r">
					  <h3>��ѯ���ݣ�<span class="time"><?php echo $value['time'];?></span></h3>
					  <p><?php echo mb_convert_encoding($value['content'], "GBK", "UTF-8");?></p>
				   </div>
				   <div class="clear"></div>
				</div>
				<div class="list1">
				   <div class="list1_l"><img src="img/icon11.jpg"  width="23" height="26"/></div>
				   <div class="list1_r1">
				   <div class="jiantou2"></div>
					  <h3>׿ά��Ϣ�ظ���
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
							echo "��ȴ��ظ���������лл��";
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
                  <h3>��ѯ���ݣ�<span class="time">2011-05-25 11:21</span></h3>
                  <p>Ϊʲô���ڻָ�ͨѶ¼���֮����ʾ���ҵ�ͨѶ¼�Ѿ������µ��˲����ֻ���ȴû��һ���绰��</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="list1">
               <div class="list1_l"><img src="img/icon11.jpg"  width="23" height="26"/></div>
               <div class="list1_r1">
               <div class="jiantou2"></div>
                  <h3>�ڱ��ظ���<span class="time">2011-05-25 11:21</span></h3>
                  <p>�ǳ���л���Ľ��飬ɾ���ɱ����������Ӧ���ǿ��Եģ�ֻ�����߱༭������¼���Ǿ��û�����׵��º��ֻ��ϵ����ݲ�һ�£����������ֻ��ϸ��ˣ�Ȼ���ٱ��ݵ���������</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="line"></div>
              <div class="list1">
               <div class="list1_l"><img src="img/icon10.jpg"  width="23" height="26"/></div>
               <div class="list1_r">
                  <h3>��ѯ���ݣ�<span class="time">2011-05-25 11:21</span></h3>
                  <p>Ϊʲô���ڻָ�ͨѶ¼���֮����ʾ���ҵ�ͨѶ¼�Ѿ������µ��˲����ֻ���ȴû��һ���绰��</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="list1">
               <div class="list1_l"><img src="img/icon11.jpg"  width="23" height="26"/></div>
               <div class="list1_r1">
               <div class="jiantou2"></div>
                  <h3>�ڱ��ظ���<span class="time">2011-05-25 11:21</span></h3>
                  <p>�ǳ���л���Ľ��飬ɾ���ɱ����������Ӧ���ǿ��Եģ�ֻ�����߱༭������¼���Ǿ��û�����׵��º��ֻ��ϵ����ݲ�һ�£����������ֻ��ϸ��ˣ�Ȼ���ٱ��ݵ���������</p>
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
              <p>�κ�ʱ���׿άӰ���������������һ����Ӿ����������ܡ�</p>
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
            <h2 class="title3"><img src="img/icon8.jpg"  width="32" height="32"/>&nbsp;��������</h2>
            <ul class="menu2">
              <li><a href="#">��ͼ�޷���ʾ</a></li>
            </ul>
            <div class="more"><a href="#">>>�˽�����</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="foot">
  <div class="foot_nav"><a href="drovikhelp.php">��������</a>|<a href="#">��˽����</a>|<a href="drovikabout.php">��������</a></div>
  <!--<div class="foot_center" style="text-align:top"><?php echo "���Ǳ�վ�� "; require("count.php"); echo " λ�ÿ�"; ?></div>-->
  <div class="foot_bar"><img src="img/logo2.jpg"  width="114" height="42" align="left"/>&copy;2014. ׿ά��Ϣ<br />
    ��ICP��08009100</div>
  <div class="clear"></div>
</div>
</body>
</html>
