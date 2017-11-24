<html>
<head>
<title>管理中心</title>
<meta http-equiv='Content-Type' content='text/html';charset='utf-8'>
<?php $this->display('index:Index:css','lib') ?>
<?php $this->display('css','lib') ?>
</head>
<body id="site">
<?php $this->display('index:Index:header','lib') ?>
<div class="w1200">
    <?php $this->display('left','lib') ?>
	<div class="user_right">
        <p class="user_title">个人信息</p>
        <form action="<?php echo U('/Index/update') ?>" method="post" enctype="multipart/form-data">
<!--             <p>
    <img src="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>" width="100" height="100">
    <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
</p> -->
            <p><span>姓名：</span><input type="text" name="name" value="<?php if(isset($field['name'])){echo $field['name'];} ?>" /></p>
            <p><span>注册时间：</span><?php echo date('y-m-d',$field['register']) ?></p>
            <p><span>昵称：</span><input type="text" name="username" value="<?php if(isset($field['username'])){echo $field['username'];} ?>" /></p>
            <p><span>QQ：</span><input type="text" name="qq" value="<?php if(isset($field['qq'])){echo $field['qq'];} ?>" /></p>
            <p><span>邮箱：</span><input type="text" name="email" value="<?php if(isset($field['email'])){echo $field['email'];} ?>" /></p>
            <p><span>新密码：</span><input type="password" name="pwd1" /></p>
            <p><span>卡号：</span><input type="text" value="<?php if(isset($field['cardid'])){echo $field['cardid'];} ?>" /></p>
            <p><span>确认新的密码：</span><input type="password" name="pwd2" /></p>
            <input type="submit" id="submit" value="保存修改" />
        </form>
	</div>
</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
</html>
<style>
    form p{width:50%;float:left;color:#707378;line-height:30px;}
    #submit{background:none;border:solid 1px #000;border-radius:5px;padding:5px 10px;width:86px;margin:20px 0 0 40%;display:block;}
</style>