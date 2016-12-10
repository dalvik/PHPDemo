<?php
header("Content-Type:text/html; charset=gb2312");
include "inc/access.php";
include "../dbutil/mysqlinfo.php";
include "../dbutil/mysql.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<head>
	<title> - Steersman个人博客后台管理系统</title>
</head>
<frameset rows="64,*"  frameborder="NO" border="0" framespacing="0">
	<frame src="admin_top.php" noresize="noresize" frameborder="NO" name="topFrame" scrolling="no" marginwidth="0" marginheight="0" target="main" />
  <frameset cols="220,*"   id="frame">
	<frame src="admin_left.php" name="leftFrame" noresize="noresize" marginwidth="0" marginheight="0" frameborder="0" scrolling="yes" target="main" />
	<frame src="admin_right.php" name="main" marginwidth="0" marginheight="0" frameborder="0" scrolling="auto" target="_self" />

	<noframes>
		<body>
		</body>
   </noframes>
  </frameset>
</frameset>
    
      
</html>