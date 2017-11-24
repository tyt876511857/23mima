<html>
<head>
<title>管理页面</title>
<script language=JavaScript>
function logout(){
  if (confirm("您确定要退出控制面板吗？"))
  top.location = "<?php echo U('Login/out') ?>";
  return false;
}
</script>
<style>
  #top a{display:block;float:left;width:100px;text-align:center;color:#fff;}
</style>
<base target="main">
<link href="/Modules/admin/Tpl/public/css/skin.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0">
<table width="100%" height="64" border="0" cellpadding="0" cellspacing="0" class="admin_topbg">
  <tr>
    <td width="61%" height="64"><img src="/Modules/admin/Tpl/public/images/logo.gif" width="262" height="64"></td>
    <td width="39%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" height="38" class="admin_txt">管理员：<b><?php echo $admin; ?></b> 您好,感谢登陆使用！</td>
        <td id="top" width="60%">
          <a href="/" target="_blank">网站首页</a>
        </td>
        <td width="20%">
        <a href="#" target="_self" onClick="logout();"><img src="/Modules/admin/Tpl/public/images/out.gif" alt="安全退出" width="46" height="20" border="0"></a></td>
        <td width="4%">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="3">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
