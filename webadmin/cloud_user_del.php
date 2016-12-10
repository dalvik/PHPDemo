<?php
	header("Content-Type:text/html;charset=gb2312");
	include "./inc/access.php";
	include "./inc/Functions.php";
	include "../dbutil/mysqlinfo.php";
	include "../dbutil/mysql.php";
?>
	<table cellpadding='3' cellspacing='1' border='0' class='tableBorder' align=center>
	<tr>
	  <th width="100%" height=25 class='tableHeaderText'>删除后台用户</th>
	
	<tr><td height="400" valign="top"  class='forumRow'><br>
	    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" bgcolor="#B1CFF8"><div align="center"></div></td>
          </tr>
          <tr>
            <td height="100">
			<?php
				$db = new mysql($db_hostname, $db_username, $db_password, $db_name, $db_charset);
				$id = $_GET['id'];
				$name = $_GET['username'];
				$result =  $db->findMore("alumb_users", "", "alumb_name, alumb_role", "", "", "");
				foreach($result as $v){
					if($v['alumb_name'] == $name && $v['alumb_role'] == 0){
						alert("用户 ".$name." 不能删除！","admin_user_list.php");
					}
				}
				if($db->del("alumb_users", "_id='".$id."'")){
					alert($name." 删除成功！","admin_user_list.php");
				}
			?>
		  </td>
          </tr>
        </table>
	    </td>
	</tr>
	</table>