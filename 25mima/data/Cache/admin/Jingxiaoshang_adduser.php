<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加经销商</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加经销商</p></div>
  <table class="table" border="1" align="center">
	<form action='<?php echo U('/Jingxiaoshang/adduser') ?>' method='post' name='form'>
		<tr> <td width="10%">用户名</td>
      <td style='text-align:left'><input type='text' name='username' /></td></tr>
	  <tr> <td width="10%">密码</td>
      <td style='text-align:left'><input type='text' name='pwd' /></td></tr> 
	  <tr> <td width="10%">确认密码</td>
      <td style='text-align:left'><input type='text' name='pwd2' /></td></tr>
	  <tr>
      <td width="10%">qq</td>
       <td style='text-align:left'><input type='text' name='qq' /></td></tr><tr>
     <td width="10%">邮箱</td>
       <td style='text-align:left'><input type='text' name='email' /></td></tr>
	   <tr>
     <td width="10%">联系人</td>
      <td style='text-align:left'><input type='text' name='name' /></td></tr>
		</tr><tr>
     <td></td>
      <td style='text-align:left'><input type="submit" value='添加' /></td></tr>
    </tr>
    </form>
  </table>
  
</div>
</body>
</html>