<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>找回密码</title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('css','lib') ?>
</head>
<body id="email">
<?php $this->display('header','lib') ?>
<div id="position">
  <div class="position w1000">
    <a href="/">首页</a> &gt;找回密码
  </div>
</div>
<div class="content w1000">
  <h3>请输入您要找回密码的邮箱</h3>
  <form action="<?php echo U('User/update') ?>" method="post">
    <p><input type="text" name="email" size="40" value="请输入邮箱" onfocus="if(value=='请输入邮箱') {value=''}" onblur="if (value=='') {value='请输入邮箱'}"/></p>
    <p><input class='wenbenkuang' name='captcha' type='text' value="验证码" onfocus="if(value=='验证码') {value=''}" onblur="if (value=='') {value='验证码'}" maxLength='4' size='30'>
    <img src="<?php echo U('/Login/captcha','admin') ?>" alt="CAPTCHA" onclick= this.src="<?php echo U('/Login/captcha','admin') ?>" style="cursor: pointer;" /></p>
    <input type="submit" id="submit">
  </form>
</div>
<?php $this->display('footer','lib') ?>
<script src="/public/js/index.js"></script>
</body>
</html>