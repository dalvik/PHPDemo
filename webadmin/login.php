<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html;charset=gb2312" />
<head>
<title>Steersman个人网站后台管理系统</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	overflow:hidden;
	font-family:"arial";
	font-size:12px;
	background-color:#152753;
}
.STYLE3 {font-size: 12px; color: #adc9d9; }

.resetbutton{
background:url(images/cz.gif) no-repeat left top;border:none;width:57px;height:20px;}
.loginbutton{
background:url(images/dl.gif) no-repeat left top;border:none;width:57px;height:20px;}
input{
	font-family:arial;}
-->
</style>

</head>

<body><FORM action="admin_login.php" method="post" name="loginfrm"><INPUT type=hidden value=chklogin name=reaction>
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="608" background="images/login_03.gif"><table width="847" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="318" background="images/login_04.gif">&nbsp;</td>
      </tr>
      <tr>
        <td height="84"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="381" height="84" background="images/login_06.gif">&nbsp;</td>
            <td width="162" valign="middle" background="images/login_07.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="44" height="24" valign="bottom"><div align="right"><span class="STYLE3">用户</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td height="24" colspan="2" valign="bottom">
                  <div align="left">
                    <input type="text" name="username" id="username" style="width:100px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; ">
                  </div></td>
              </tr>
              <tr>
                <td height="24" valign="bottom"><div align="right"><span class="STYLE3">密码</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td height="24" colspan="2" valign="bottom"><input type="password" name="password" id="password" style="width:100px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; "></td>
              </tr>
              <tr>
                <td height="24" valign="bottom"><div align="right"><span class="STYLE3">验证码</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td width="52" height="24" valign="bottom"><input type="text" name="verifycode" id="verifycode" style="width:50px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; "></td>
                <td width="62" valign="bottom">
					<div align="left">
					<img style="CURSOR: pointer" onclick="this.src=this.src+'?'" alt="验证码,看不清楚?请点击刷新验证码" src="./inc/getcode.php"/><br />
					</div>
				</td>
              </tr>
              <tr></tr>
            </table></td>
            <td width="26"><img src="images/login_08.gif" width="26" height="84"></td>
            <td width="67" background="images/login_09.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25"><div align="center"><input type="submit" class="loginbutton" value=""></div></td>
              </tr>
              <tr>
                <td height="25"><div align="center"><input type="reset" class="resetbutton"   value=""></div></td>
              </tr>
            </table></td>
            <td width="211" background="images/login_10.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="206" valign="top" background="images/login_11.gif">&nbsp;
          <div align="center"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#152753"><div align="center" class="STYLE3">&copy; 2011 <a href="http://www.drovik.com/" target="_blank" style="color: #999999">www.drovik.com/</a> All rights reserved  Steersman个人博客系统 版权所有</div></td>
  </tr>
</table></FORM>
</body>
</html>