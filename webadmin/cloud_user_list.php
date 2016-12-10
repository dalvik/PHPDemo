<?php
	header("Content-Type:text/html;charset=gb2312");
	include "./inc/access.php";
	include "./inc/Functions.php";
	include "../dbutil/mysqlinfo.php";
	include "../dbutil/mysql.php";
	$TABLE_CLOUD_USER_LIST = "cloud_users";
?>
<link href="images/skin.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

  <style type="text/css">
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		background-color: #EEF2FB;
	}
</style>

<script language="JavaScript">
	function ask(msg) {
		if( msg=='' ) {
			msg='警告：删除后将不可恢复，可能造成意想不到后果？';
		}
		if (confirm(msg)) {
			return true;
		} else {
			return false;
		}
	}
</script>

	<table cellpadding='3' cellspacing='1' border='0' class='tableBorder' align=center>
	<tr>
	  <th width="100%" height=25 class='tableHeaderText'>后台用户管理</th>
	
	<tr><td height="400" valign="top"  class='forumRow'><br>
	    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class='TipTitle'>&nbsp;√ 操作提示</td>
          </tr>
          <tr>
            <td height="30" valign="top" class="TipWords"><p>1、后台管理员分两个级别：超级管理员和普通管理员，普通管理员没有“基本设置”、“模板管理”权限。</p>
                <p>2、建议经常更换密码，保障后台安全。</p>
            </td>
          </tr>
          <tr>
            <td height="10" ></td>
          </tr>
        </table>
	    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class='forumRowHighLight'>&nbsp;| <a href="admin_add.php">添加新的用户</a></td>
          </tr>
          <tr>
            <td height="30">&nbsp;</td>
          </tr>
      </table>
	    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2">
          <tr>
            <td width="22%" height="30" class="TitleHighlight"><div align="center" style="font-weight: bold;color:#ffffff">用户名</div></td>
            <td width="22%" class="TitleHighlight"><div align="center" style="font-weight: bold;color:#ffffff">用户权限</div></td>
            <td width="18%" class="TitleHighlight"><div align="center" style="font-weight: bold;color:#ffffff">授权时间</div></td>
			<td width="18%" class="TitleHighlight"><div align="center" style="font-weight: bold;color:#ffffff">最后登录时间</div></td>
            <td width="20%" class="TitleHighlight"><div align="center" style="font-weight: bold;color:#ffffff">操作</div></td>
          </tr>
		  <?php 
			$db = new mysql($db_hostname, $db_username, $db_password, $db_name, $db_charset);
			$result =  $db->findMore(TABLE_CLOUD_USER_LIST, "", "*", "", "", "");
			foreach($result as $tmp){			
		  ?>
			<tr>
            <td height="35" class='forumRowHighLight'>
            <div align="center"><?php echo $tmp['alumb_name'] ?></div></td>
            <td class='forumRowHighLight'>
				 <div align="center">
					<a href="admin_class.asp?id=<?php echo $tmp['_id'] ?>"> 
					<?php if ($tmp['alumb_role']==0) {  
						echo "<span style='color:#FF0000'>超级管理员</span>";
					} else { 
						echo "一般用户";
					}
					?>
					</a>
				</div>
			</td>
            <td class='forumRowHighLight'><div align="center"><?php echo $tmp['alumb_authorize_time'] ?></div></td>
			<td class='forumRowHighLight'><div align="center"><?php echo $tmp['alumb_login_time'] ?></div></td>
            <td class='forumRowHighLight'>
            <div align="center" id="loginform"><a href="admin_edit.php?id=<?php echo $tmp['_id'] ?>" >修改密码</a>
				<?php 
					$link="";
					if($tmp['alumb_role']!=0){
						echo "&nbsp;|&nbsp;";
						$link="删除";
					}
				?>
				<a href="javascript:if(ask('警告：删除后将不可恢复，可能造成意想不到后果？')) location.href='admin_del.php?id=<?php echo $tmp['_id'] ?>&username=<?php echo $tmp['alumb_name'] ?>';"><?php echo $link ?></a>
              </div></td>
             </tr>
		  <?php
			}
		  ?>
      </table>
	    <br></td>
	</tr>
	</table>
