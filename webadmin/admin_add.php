<?php
	header("Content-Type:text/html;charset=utf8");
	include "./inc/access.php";
	include "./inc/Functions.php";
	include "../dbutil/mysqlinfo.php";
	include "../dbutil/mysql.php";
?>

<?php
	if(isset($_POST["submit"]) && !empty($_POST["submit"]) && $_GET['act'] =="save"){
		$username = $_POST['username'];
		$password = trim($_POST['password']);
		$repassword = trim($_POST['repassword']);
		$role = trim($_POST['class']);
		$describe = trim($_POST['describe']);
		if($username=="" || $password == "" || $repassword =="") {
			 alert("用户名或密码不能为空！","admin_user_list.php");
		}else if(strLen($password)<6){
			alert("密码能少于六位！","admin_user_list.php");
		} else if($repassword != $password) {
			alert("两次输入的密码不一致！","admin_user_list.php");
		} else {
			$db = new mysql($db_hostname, $db_username, $db_password, $db_name, $db_charset);
			$result = $db->findMore("alumb_users","", "alumb_name",  "", "", "");
			$canAdd = 0;
			foreach ($result as $v){
				if($v['alumb_name'] == $username){
					alert("此用户名已经存在，请重新命名！","admin_user_list.php");
					$canAdd = 1;
				}
			}
			if($canAdd == 0){
				date_default_timezone_set('PRC');
				$date = date('Y-m-d H:i:s');
				$sql = "alumb_name='".$username."', alumb_password='".MD5($password)."', alumb_role='".$role."', alumb_role_describe='".$describe."', alumb_authorize_time='".$date."'";
				if($db->add("alumb_users", $sql)){
					alert("添加成功！","admin_user_list.php");
				} else {
					alert("添加失败！","admin_user_list.php");
				}
			}
		}
	}
	
?>

<form id="form1" name="form1" method="post" action="?act=save">
    <script language='javascript'>
		function checksignup1() {
			if ( document.form1.username.value == '' ) {
			window.alert('请输入用户名^_^');
			document.form1.username.focus();
			return false;}

			if ( document.form1.password.value == '' ) {
			window.alert('请输入密码^_^');
			document.form1.password.focus();
			return false;}

			if ( document.form1.repassword.value == '' ) {
			window.alert('请重复输入密码^_^');
			document.form1.repassword.focus();
			return false;}

		return true;}
	</script>
	<table cellpadding='3' cellspacing='1' border='0' class='tableBorder' align=center>
	<tr>
	  <th class='tableHeaderText' colspan=2 height=25>添加后台用户</th>
	<tr>
	  <td height=23 class='forumRow'>&nbsp;</td>
	  <td class='forumRow'>&nbsp;</td>
	  </tr>
	<tr>
	<td width="15%" height=23 class='forumRowHighLight'>用户名 (必填) </td>
	<td width="85%" class='forumRowHighLight'><input name='username' type='text' id='username' size='30' maxlength="20">
	  &nbsp;</td>
	</tr>
	  <tr>
	    <td class='forumRow' height=23>密码 (必填) </td>
	    <td class='forumRow'><input name='password' type='password' id='password' size='30' maxlength="20"></td>
      </tr>
	  
	  <tr>
	    <td class='forumRowHighLight' height=23>重复密码 <span class="forumRowHighLight">(必填) </span></td>
	    <td class='forumRowHighLight'><input name='repassword' type='password' id='repassword' size='30' maxlength="20"></td>
      </tr> 
	    <tr>
	    <td class='forumRow' height=23>用户权限<span class="forumRowHighLight"> </span></td>
	    <td class='forumRow'><label>
	      <input type="radio" name="class" value="0">
	      超级管理员&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <input name="class" type="radio" value="1">
	      普通管理员&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <input name="class" type="radio" value="3" checked>
	      普通用户&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <input name="class" type="radio" value="5">
	      测试用户&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <input name="class" type="radio" value="7">
	      访客</label>
		  </td>
	    </tr>
	  <tr>
	    <td class='forumRowHighLight' height=23> <span class="forumRowHighLight">用户描述</span></td>
	    <td class='forumRowHighLight'><input name='describe' type='text' id='describe' size='30' maxlength="20"></td>
      </tr>
	<tr><td height="50" colspan=2  class='forumRow'><div align="center">
	  <INPUT type="submit" value="提交" onClick='javascript:return checksignup1()' name="submit">
	  </div></td></tr>
	</table>
</form>