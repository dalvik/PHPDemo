<?php
	include "./inc/access.php";
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
  <body>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">欢迎您！</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" valign="top">&nbsp;</td>
        <td>&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><span class="left_bt"><%=session("log_name")%>，欢迎来到<font color="#FF0000"><%=gdb("select web_name from web_settings ")%></font>网站后台管理系统</span>。
          <span class="left_txt"><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您现在使用的是个人网站后台管理系统。通过该系统建立您的个人网站将变得轻而易举。
<br>
          </span><br>
<span class="left_ts">开发者联系方式：</span><br>
<span class="left_txt"><img src="images/icon-mail2.gif" width="16" height="11" /> 邮箱：sky.xctc@163.com&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QQ：1641117893 <br />
<img src="images/icon-phone.gif" width="17" height="14" /> 官方网站：<a href="http://www.drovik.com/" target="_blank">http://www.drovik.com/ </a> <br>给作者留言：<a href="http://www.drovik.com" target="_blank">http://www.drovik.com</a></span></td>
        <td width="7%">&nbsp;</td>
        <td width="40%" rowspan="3" valign="top"><table width="100%" height="144" border="0" cellpadding="0" cellspacing="0" class="line_table">
          <tr>
            <td width="7%" height="27" background="images/news-title-bg.gif"><img src="images/news-title-bg.gif" width="2" height="27" /></td>
            <td width="93%" background="images/news-title-bg.gif" class="left_bt2 left_ts">使用之前，读一读，很有用哦！</td>
          </tr>
          <tr>
            <td height="102" colspan="2" valign="top"><span class="left_ts">1、</span> 第一次打开网站后台，先将您的网站基本信息设置一下吧，在“基本设置”-“<a href="web_settings.asp">网站信息设置</a>”处。 <br />
                <span class="left_ts">2、</span> 接下来，基于安全性考虑，修改一下默认的密码吧，在“基本设置”-“<a href="admin_list.asp">后台用户管理</a>”处。<br />
                <span class="left_ts">3、</span> 需要写一篇文章吗？在“文章管理”-“<a href="article_add.asp">添加文章</a>”处。 <br />
                <span class="left_ts">4、</span> 需要上传一张图片吗？在“相册管理”-“<a href="ad_add.asp">添加图片</a>”处。 <br />
                <span class="left_ts">9、</span>有疑问，程序有BUG？和我们联系的方式是多样的，欢迎到官方网站(<a href="http://www.drovik.com/" target="_blank">www.drovik.com</a>)留言或是发邮件(sky.xctc@163.com)。</td>
          </tr>
          <tr>
            <td height="5" colspan="2">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td colspan="2" valign="top"><!--JavaScript部分-->
              <SCRIPT language=javascript>
					function secBoard(n)
					{
					for(i=0;i<secTable.cells.length;i++)
					secTable.cells[i].className="sec1";
					secTable.cells[n].className="sec2";
					for(i=0;i<mainTable.tBodies.length;i++)
					mainTable.tBodies[i].style.display="none";
					mainTable.tBodies[n].style.display="block";
					}
          		</SCRIPT>
              <!--HTML部分-->
              <TABLE width=72% border=0 cellPadding=0 cellSpacing=0 id=secTable>
                <TBODY>
                  <TR align=middle height=20>
                    <TD align="center" class=sec2 onclick=secBoard(0)>网站信息</TD>
                    <TD align="center" class=sec1 onclick=secBoard(1)>博客信息</TD>
                    <TD align="center" class=sec1 onclick=secBoard(2)>相册信息</TD>
                    <TD align="center" class=sec1 onclick=secBoard(3)>访客留言</TD>
                  </TR>
                </TBODY>
              </TABLE>
          <TABLE class=main_tab id=mainTable cellSpacing=0
cellPadding=0 width=100% border=0>
                <!--关于TBODY标记-->
                <TBODY style="DISPLAY: block">
                  <TR>
                    <TD vAlign=top align=middle>
						<%
						'首页基本信息内容读取替换
						set rs=server.createobject("adodb.recordset")
						sql="select web_name,web_slogan,web_url,web_title,web_person,web_birthdate,web_birthplace,web_shortintro from web_settings"
						rs.open(sql),cn,1,1
						if not rs.eof and not rs.bof then
						web_name=rs("web_name")
						web_url=rs("web_url")
						web_slogan=rs("web_slogan")
						web_title=rs("web_title")
						web_person=rs("web_person")
						web_birthdate=rs("web_birthdate")
						web_birthplace=rs("web_birthplace")
						web_shortintro=rs("web_shortintro")
						end if
						rs.close
						set rs=nothing
						%>
					<TABLE width=98% height="110" border=0 align="center" cellPadding=0 cellSpacing=0>
                        <TBODY>
                          <TR>
                            <TD height="5" colspan="3"></TD>
                          </TR>
                          <TR>
                            <TD width="4%" bgcolor="#FAFBFC">&nbsp;</TD>
                            <TD width="42%" height="25" bgcolor="#FAFBFC"><span class="left_txt">网站名称： </span>
                               
                                <span class="left_ts"><%=web_name%> </span></TD>
                            <TD width="54%" height="25" bgcolor="#FAFBFC"><span class="left_txt">网站网址： </span>
                               
                                <span class="left_ts"><%=web_url%> </span></TD>
                          </TR>
                          <TR>
                            <TD bgcolor="#FAFBFC">&nbsp;</TD>
                            <TD height="25" bgcolor="#FAFBFC"><span class="left_txt">首页标题： </span>
                               
                                <span class="left_ts"> <%=web_title%></span></TD>
                            <TD height="25" bgcolor="#FAFBFC"><span class="left_txt">网站标语： </span>
                               
                                <span class="left_ts"><%=web_slogan%> </span></TD>
                          </TR>
                          <TR>
                            <TD bgcolor="#FAFBFC">&nbsp;</TD>
                            <TD height="25" bgcolor="#FAFBFC"><span class="left_txt">网站站长： </span>
                                <span class="left_ts"> <%=web_person%></span></TD>
                            <TD height="25" bgcolor="#FAFBFC"><span class="left_txt">出生年月： </span>
                               
                                <span class="left_ts"> <%=web_birthdate%></span></TD>
                          </TR>
                          <TR>
                            <TD bgcolor="#FAFBFC">&nbsp;</TD>
                            <TD height="25" bgcolor="#FAFBFC"><span class="left_txt">户籍： </span>
                               
                                <span class="left_ts"><%=web_birthplace%> </span></TD>
                            <TD height="25" bgcolor="#FAFBFC"><span class="left_txt">简介： </span>
                                <span class="left_ts"> <%=left(web_shortintro,10)&"..."%></span></TD>
                          </TR>
                          <TR>
                            <TD height="5" colspan="3"></TD>
                          </TR>
                        </TBODY>
                    </TABLE></TD>
                  </TR>
                </TBODY>
                <!--关于cells集合-->
                <TBODY style="DISPLAY: none">
                  <TR>
                    <TD vAlign=top align=middle><TABLE width=98% height="110" border=0 align="center" cellPadding=0 cellSpacing=0>
                        <TBODY>
                          <TR>
                            <TD height="5" colspan="2"></TD>
                          </TR>
								<%
								'文章文件夹获取
								set rs_1=server.createobject("adodb.recordset")
								sql="select FolderName from web_Models_type where [id]=9"
								rs_1.open(sql),cn,1,1
								if not rs_1.eof then
								Article_FolderName=rs_1("FolderName")
								end if
								rs_1.close
								set rs_1=nothing
								
								set rs=server.createobject("adodb.recordset")
								sql="select top 5 [id],[title],[url],[file_path],[time] from [article] where view_yes=1 order by time desc"
								rs.open(sql),cn,1,1
								if not rs.eof then
								do while not rs.eof  %>                          
                          <TR>
                            <TD bgcolor="#FAFBFC">&nbsp;</TD>
                            <TD height="25" bgcolor="#FAFBFC">·<span class="left_txt"><a href="<%="/"&Article_FolderName&"/"&rs("File_Path")%>" target="_blank"><%=left(rs("title"),25)%></a> (<%=rs("time")%>)</span></TD>
                          </TR>
								<%
								rs.movenext
								loop
								else
								response.write "暂无信息"
								end if
								rs.close
								set rs=nothing
								%>						  
                          <TR>
                            <TD height="5" colspan="2"></TD>
                          </TR>
                        </TBODY>
                    </TABLE></TD>
                  </TR>
                </TBODY>
                <!--关于tBodies集合-->
                <TBODY style="DISPLAY: none">
                  <TR>
                    <TD vAlign=top align=middle><TABLE width=98% border=0 align="center" cellPadding=0 cellSpacing=0>
                        <TBODY>
                          <TR>
                            <TD colspan="2"></TD>
                          </TR>
                          <TR>
                            <TD height="5" colspan="2"></TD>
                          </TR>
								<%
								'相册文件夹获取
								set rs_1=server.createobject("adodb.recordset")
								sql="select FolderName from web_Models_type where [id]=5"
								rs_1.open(sql),cn,1,1
								if not rs_1.eof then
								Gallery_FolderName=rs_1("FolderName")
								end if
								rs_1.close
								set rs_1=nothing
								
								set rs=server.createobject("adodb.recordset")
								sql="select top 5 [id],[name],[time] from [web_ad_position] where view_yes=1 order by time desc"
								rs.open(sql),cn,1,1
								if not rs.eof then
								do while not rs.eof  %>                          
                          <TR>
                            <TD bgcolor="#FAFBFC">&nbsp;</TD>
                            <TD height="25" bgcolor="#FAFBFC">·<span class="left_txt"><a href="<%="/"&Gallery_FolderName&"/"&rs("id")%>" target="_blank"><%=left(rs("name"),25)%></a> (<%=rs("time")%>)</span></TD>
                          </TR>
								<%
								rs.movenext
								loop
								else
								response.write "暂无信息"
								end if
								rs.close
								set rs=nothing
								%>	
                         
                          <TR>
                            <TD height="5" colspan="2"></TD>
                          </TR>
                        </TBODY>
                    </TABLE></TD>
                  </TR>
                </TBODY>
                <!--关于display属性-->
                <TBODY style="DISPLAY: none">
                  <TR>
                    <TD vAlign=top align=middle><TABLE width=98% border=0 align="center" cellPadding=0 cellSpacing=0>
                        <TBODY>
                          <TR>
                            <TD colspan="3"></TD>
                          </TR>
                          <TR>
                            <TD height="5" colspan="3"></TD>
                          </TR>
							<%
							'留言文件夹获取
							set rs_1=server.createobject("adodb.recordset")
							sql="select FolderName from web_Models_type where [id]=7"
							rs_1.open(sql),cn,1,1
							if not rs_1.eof then
							Post_FolderName=rs_1("FolderName")
							end if
							rs_1.close
							set rs_1=nothing
							
							set rs=server.createobject("adodb.recordset")
							sql="select top 5 [content],[time],[name] from web_article_comment where view_yes=1 and article_id=0  order by [time] desc"
							rs.open(sql),cn,1,1
							if not rs.eof then
							do while not rs.eof  %>                          
                          <TR>
                            <TD bgcolor="#FAFBFC">&nbsp;</TD>
                            <TD height="25" bgcolor="#FAFBFC">·<span class="left_txt"><a href="<%="/"&Post_FolderName&"/"%>" target="_blank"><%=left(nohtml(rs("content")),25)&"..."%></a> (<%=rs("time")%>)</span></TD>
                          </TR>
								<%
								rs.movenext
								loop
								else
								response.write "暂无信息"
								end if
								rs.close
								set rs=nothing
								%>	
                          <TR>
                            <TD height="5" colspan="3"></TD>
                          </TR>
                        </TBODY>
                    </TABLE></TD>
                  </TR>
                </TBODY>
            </TABLE></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="51%" class="left_txt">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td background="images/mail_rightbg.gif">&nbsp;</td>
  </tr>
  <tr>
    <td valign="bottom" background="images/mail_leftbg.gif"><img src="images/buttom_left2.gif" width="17" height="17" /></td>
    <td background="images/buttom_bgs.gif"><img src="images/buttom_bgs.gif" width="17" height="17"></td>
    <td valign="bottom" background="images/mail_rightbg.gif"><img src="images/buttom_right2.gif" width="16" height="17" /></td>
  </tr>
</table>
</body>
