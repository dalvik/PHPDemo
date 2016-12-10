<?php
	header("Content-Type:text/html;charset=utf-8");
	include "./inc/access.php";
	include "./inc/Functions.php";
	include "../dbutil/mysqlinfo.php";
	include "../dbutil/mysql.php";
?>

<?php
	if(isset($_POST["submit"]) && !empty($_POST["submit"]) && $_GET['act'] =="save"){
		$db = new mysql($db_hostname, $db_username, $db_password, $db_name, $db_charset);
		$id = $_GET['id'];
		$result = $db->find("alumb_users", "_id = '".$id."'", "alumb_password", "");
		$old_password = $_POST['password'];
		$new_password = $_POST['new_password'];
		$re_password = $_POST['renew_password'];
		date_default_timezone_set('PRC');
		$date = date('Y-m-d H:i:s');
		if($result['alumb_password'] != MD5($old_password) || $new_password != $re_password || strlen($new_password)<6){
			alert("密码更改失败！","admin_user_list.php");
		} else if($db->edit("alumb_users", "alumb_password ='".MD5($new_password)."', alumb_authorize_time='".$date."'", "_id = '".$id."'")){
			alert("密码更改成功，请牢记！","admin_user_list.php");
		} else {
			alert("密码更改失败！","admin_user_list.php");
		}
	}
?>

<?php
	$id = $_GET['id'];
	if($id>0){
		$db = new mysql($db_hostname, $db_username, $db_password, $db_name, $db_charset);
		$result = $db->find("alumb_users", "_id = '".$id."'", "alumb_name", "");
	}
?>

<form id="form1" name="form1" method="post" action="?act=save&id=<?php echo $id ?>">
         <script language='javascript'>
			function checksignup1() {
				if ( document.form1.password.value == '' ) {
				window.alert('请输入原有密码^_^');
				document.form1.password.focus();
				return false;}

				if ( document.form1.new_password.value == '' ) {
				window.alert('请输入新密码^_^');
				document.form1.new_password.focus();
				return false;}
				if ( document.form1.new_password.value.length < 6 ) {
				window.alert('新密码长度不能少于六位^_^');
				document.form1.new_password.focus();
				return false;}
				if ( document.form1.renew_password.value == '' ) {
				window.alert('请重复输入新密码^_^');
				document.form1.renew_password.focus();
				return false;}
				if ( document.form1.renew_password.value != document.form1.new_password.value ) {
				window.alert('两次密码不一致^_^');
				document.form1.new_password.focus();
				return false;}
			return true;}
		</script>
	<table cellpadding='3' cellspacing='1' border='0' class='tableBorder' align=center>
	<tr>
	  <th class='tableHeaderText' colspan=2 height=25>修改用户密码</th>
	<tr>
	  <td height=23 class='forumRow'>用户名</td>
	  <td class='forumRow'><span class="forumRowHighLight">
	    <input name='username' type='text' id='username' size='30' maxlength="20"  value="<?php echo $result['alumb_name'] ?>" readonly>
	  </span></td>
	  </tr>
	<tr>
	<td width="15%" height=23 class='forumRowHighLight'>原有密码 (必填) </td>
	<td width="85%" class='forumRowHighLight'><input name='password' type='password' id='password' size='30'   maxlength="20">
	  &nbsp;</td>
	</tr>
	  <tr>
	    <td class='forumRow' height=23>新密码 (必填) </td>
	    <td class='forumRow'><input name='new_password' type='password' id='new_password' size='30'   maxlength="20"></td>
      </tr>
	  
	  <tr>
	    <td class='forumRowHighLight' height=23>重复新密码 <span class="forumRowHighLight">(必填) </span></td>
	    <td class='forumRowHighLight'><input name='renew_password' type='password' id='renew_password' size='30'   maxlength="20"></td>
      </tr>
	<tr><td height="50" colspan=2  class='forumRow'><div align="center">
	  <INPUT type="submit" value="提交" onClick='javascript:return checksignup1()' name="submit">
	  </div></td></tr>
	</table>
</form>