<?php
	header("Content-Type:text/html;charset=gb2312");
	include "./inc/access.php";
	include "./inc/Functions.php";
	include "../dbutil/mysqlinfo.php";
	include "../dbutil/mysql.php";
?>
<link href="images/skin.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script type="text/javascript" charset="utf-8" src="../KKKeditor/kindeditor.js"></script>
<script type="text/javascript" src="../KKKeditor/editor.js"></script>	
  <style type="text/css">
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		background-color: #EEF2FB;
	}
</style>
<?php
	
	$db = new mysql($db_hostname, $db_username, $db_password, $db_name, $db_charset);
	if(isset($_POST["submit"]) && !empty($_POST["submit"])){
		$result =  $db->find("alumb_settings", "", "*", "", "");
		$web_name = $_POST['web_name'];
		$web_slogan = $_POST['web_slogan'];
		$web_url = $_POST['web_url'];
		$web_title = $_POST['web_title'];
		$web_keywords = $_POST['web_keywords'];
		$web_description = $_POST['web_description'];
		$web_copyright = $_POST['web_copyright'];
		$web_email = $_POST['web_email'];
		$web_shortintro = $_POST['web_shortintro'];
		$web_tel = $_POST['web_tel'];
		$web_time = $_POST['web_time'];
		$sql = "alumb_web_name='".$web_name."', alumb_web_slogan='".$web_slogan."' , alumb_web_url='".$web_url."' , alumb_web_title='".$web_title."' , alumb_web_keywords='".$web_keywords."', alumb_web_description='".$web_description."' , alumb_web_copyright='".$web_copyright."' , alumb_web_email='".$web_email."' , alumb_web_shortintro='".$web_shortintro."' , alumb_web_tel='".$web_tel."' , alumb_web_time='".$web_time."'";

		if(empty($result)){
			$db->add("alumb_settings", $sql);
		} else {
			$db->edit("alumb_settings", $sql, "_id='".$result['_id']."'");
		}
	}
?>

<?php
$result =  $db->find("alumb_settings", "", "*", "", "");
?>
  <form id="form1" name="form1" method="post" action="?act=save">
         <script language='javascript'>
			function checksignup1() {
			if ( document.form1.web_name.value == '' ) {
			window.alert('请输入网站名称^_^' + document.form1.web_title.value);
			document.form1.web_name.focus();
			return false;}
			return true;}
		</script>
	<SCRIPT src="images/qq/ServiceQQ.htm"></SCRIPT>
	 
	<table cellpadding='3' cellspacing='1' border='0' class='tableBorder' align=center>
	<tr>
	  <th class='tableHeaderText' colspan=2 height=31>网站信息设置</th>
	<tr>
	  <td height=23 colspan="2" class='forumRow'><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="20" class='TipTitle'>&nbsp;√ 操作提示</td>
        </tr>
        <tr>
          <td height="30" valign="top" class="TipWords"><p>1、怎样才算是属于一个您的博客或个人网站呢？网站叫什么名，地址是多少，您的个人信息、联系方式等。在这里一一设置吧。</p>
            <p>2、“网站底部信息”一栏用于设置所有页面的底部信息，如备案号、统计代码等，免费统计代码推荐<a href="http://www.cnzz.com/" target="_blank">站长统计</a>、<a href="http://www.51.la/" target="_blank">网站统计</a>、<a href="http://tongji.baidu.com/" target="_blank">百度统计</a>。</p>
            <p>3、修改了某项信息后，默认只会自动生成网站首页，其它页面需要手动到"生成管理"处<a href="html_items.asp">生成栏目</a>和<a href="html_article.asp">生成内容</a>才会看到修改后的效果。</p></td>
        </tr>
        <tr>
          <td height="10">&nbsp;</td>
        </tr>
      </table></td>
	  </tr>

	<tr>
	<td width="15%" height=23 class='forumRowHighLight'>网站名称</td>
	<td class='forumRowHighLight'><input name='web_name' type='text' id='web_name' value="<?php echo $result['alumb_web_name'] ?>" size='40'></td>
	</tr>
	<tr>
	  <td class='forumRow' height=23>网站slogan</td>
	  <td class='forumRow'><span class="forumRow">
	    <input name='web_slogan' type='text' id='web_slogan' value="<?php echo $result['alumb_web_slogan'] ?>" size='40'>
	  </span></td>
	  </tr>
	<tr>
	<td class='forumRowHighLight' height=23>网站网址</td>
<td class='forumRowHighLight'><input type='text' id='web_url' name='web_url' value="<?php echo $result['alumb_web_url'] ?>" size='40'> 
  &nbsp;请以http://开头，最后必须带 / 。如：http://www.drovik.com/</td>
	</tr>
	   <!--<tr>
	    <td class='forumRow' height=23>个人头像</td>
	    <td width="85%" class='forumRow'><table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td width="22%"  class='forumRow'><input name="web_image" type="text" id="web_image"  value="#"  size="30"></td>
           <td width="78%"  class='forumRow'><iframe width="500" name="ad" frameborder=0 height=30 scrolling=no src=upload.asp></iframe></td>
         </tr>
       </table></td>
      </tr>-->
	  
	    <td class='forumRowHighLight' height=23>首页标题(Title)</td>
	      <td class='forumRowHighLight'><input type='text' id='web_title' name='web_title'   value="<?php echo $result['alumb_web_title'] ?>" size='80'></td>
	</tr>
	    <td class='forumRow' height=11>网站关键字(keywords)</td>
	      <td class='forumRow'><input type='text' id='v3' name='web_keywords' value="<?php echo $result['alumb_web_keywords'] ?>" size='80'>
	  &nbsp;请以，隔开</td>
	</tr><tr>
	  <td class='forumRowHighLight' height=11>网站描述(Description)</td>
	  <td class='forumRowHighLight'><textarea name='web_description'  cols="100" rows="4" ><?php echo $result['alumb_web_description'] ?></textarea></td>
	</tr>
	<tr>
	  <td class='forumRow' height=23>底部信息HTML代码</td>
	  <td class='forumRow'> <textarea name='web_copyright' cols="100"  rows="10"><?php echo $result['alumb_web_copyright'] ?></textarea></td>
	</tr>
	<!--<tr>
	  <td class='forumRow' height=23>联系信息</td>
	  <td class='forumRow'> <textarea name="a_content" id="a_content" style=" width:100%; height:400px; visibility:hidden;"  ><%=rs("web_contact")%></textarea></td>
	</tr>	
	 
	<tr>
	  <td class='forumRowHighLight' height=23>网站站长</td>
	  <td class='forumRowHighLight'><input type='text' id='v42' name='web_person'  value="<%=rs("web_person")%>"  size='40'></td>
	</tr>
	<tr>
	  <td class='forumRow' height=23>出生时间</td>
	  <td class='forumRow'><span class="forumRowHighLight">
	    <input name='web_birthdate' type='text' id='web_person'  value="<%=rs("web_birthdate")%>"  size='40' maxlength="30">
	  </span></td>
	  </tr>
	<tr>
	  <td class='forumRowHighLight' height=23>出生地</td>
	  <td class='forumRowHighLight'><span class="forumRowHighLight">
	    <input name='web_birthplace' type='text' id='web_person2'  value="<%=rs("web_birthplace")%>"  size='40' maxlength="30">
	  </span></td>
	  </tr>
	 -->
	<tr>
	  <td class='forumRow' height=23>联系方式</td>
	  <td class='forumRow'><input type='text' id='v43' name='web_email'   value="<?php echo $result['alumb_web_email'] ?>"  size='40'>可以是电子邮件、QQ或一句话，不宜过长</td>
	</tr>	  
	<tr>
	  <td class='forumRowHighLight' height=23>简短介绍</td>
	  <td class='forumRowHighLight'><span class="forumRowHighLight">
	    <input name='web_shortintro' type='text' id='web_person3'  value="<?php echo $result['alumb_web_shortintro'] ?>"  size='60' maxlength="100">
	    不能超过100字符
	  </span></td>
	  </tr>

	<tr>
	  <td class='forumRow' height=23>联系电话</td>
	  <td class='forumRow'><input type='text' id='v44' name='web_tel'  value="<?php echo $result['alumb_web_tel'] ?>" size='40'></td>
	</tr>
	<tr>
	  <td class='forumRow' height=23>修改时间</td>
	  <td class='forumRow'><input type='text' id='v45' name='web_time'  value="<?php echo $result['alumb_web_time'] ?>" size='40'> 
	  &nbsp;<a href="#" class="green" onClick="document.form1.web_time.value='<?php echo date('Y-m-d')?>'">同步到现在时间</a></td>
	</tr>
	
	<tr><td height="50" colspan=2  class='forumRow'><div align="center">
	  <INPUT type="submit" value='提交' onClick='javascript:return checksignup1()' name="submit">
	  </div></td></tr>
	</table>
</form>

<!--
<%
Call DbconnEnd()
else
response.write "暂时无数据"
end if %>
-->