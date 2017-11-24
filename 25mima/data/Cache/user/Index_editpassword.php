<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改密码</title>
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <?php $this->display('index:Index:css','lib') ?>
    <link href="/public/gaiban/css/login.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="/public/gaiban/js/login.js"></script>
	
</head>

<body>
  <?php $this->display('index:Index:header','lib') ?>
    <div class="w1000">
        <div class="login">
            <form action="<?php echo U('/Index/update_pwd') ?>" method="post" name="login" class="loginForm">
                <div class="login_con">
                    <div class="login_mothed">
                        <!--
                      <span class="active"><i></i>手机动态登录<input type="radio" name="1" checked="checked"></span>
<span><i></i>密码登录<input type="radio" name="1"></span>
-->
                    </div>
                    <div class="left">
                        <div class="login_th">
                            <p>修改</p>
                            <p>密码</p>
                        </div>
                    </div>
                    <div class="left">
                        <div class="login_input ">
                            <dl>
                                <dt>新密码</dt>
                                <dd>
                                    <input type="password" name="mima1" class="login_pass" />
                                    <p class="login_info hide">不能为空</p>
                                </dd>
                            </dl>
                            <dl>
                                <dt>确认密码</dt>
                                <dd>
                                    <input type="password" name="mima2" class="login_pass" />
                                    <p class="login_info hide">密码不一致</p>
                                </dd>
                            </dl>
                            <div>
                                <input type="submit" value="登录" name="submit" class="login_btn" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $this->display('index:Index:footer','lib') ?>
</body>


</html>