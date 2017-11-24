<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>登陆页面</title>
		<link rel="stylesheet" type="text/css" href="/public/wap1/css/frozen.css" />
		<link rel="stylesheet" type="text/css" href="/public/wap1/font2/iconfont2.css" />
		<script src="/public/js/jquery-1.9.1.min.js"></script>
		<style>
			.login {
				padding-top: 20px;
			}
			
			.login_con {
				margin-top: 20px;
			}
			
			.login_name,
			.login_code {
				padding: 10px;
				border: 1px solid #8ED6EE;
				border-radius: 10px;
				line-height: 25px;
			}
			.login_name{
				margin-top: 10px;
			}
			.login_name_icon {
				display: inline-block;
				width: 25px;
				height: 25px;
				float: left;
				margin-right: 10px;
			}
			
			.login_name_icon img {
				width: 100%;
			}
			
			.login_code input[type=text],
			.login_name input[type=text] {
				border: none;
				border-left: 1px solid #A6A6A6;
				padding: 0 5px;
			}
			
			.login_code {
				margin-top: 20px;
				width: 50%;
			}
			
			.login_code input[type=text] {
				width: 60%;
			}
			
			.login_buttin {
				border-radius: 10px;
				border: none;
				background: #F8B62A;
				color: #FFFFFF;
				padding: 10px 15px;
				position: absolute;
				right: 0;
				top: 8px;
			}
			.login_go{
				background: #1FADDD;
				width: 100%;
				color: #FFFFFF;
				border: none;
				border-radius: 10px;
				padding: 10px 0;
				margin-top: 30px;
			}
		</style>
	</head>

	<body style="background: #FFFFFF;">
		<section class="ui-container ui-center login">
			<img src="/public/wap1/images/23_logo.png" alt="23_logo" />
			<form action="<?php echo U('Login/running') ?>" method="post" name="">
				<div class="login_con">
					<h5>帐号密码登录</h5>
					<div class="login_name">
						<span class="login_name_icon"><img src="/public/wap1/images/login01.png"></span>
						<input type="text" name="username" placeholder="请输入帐号" maxlength="11" />
					</div>
					<div style="position: relative;">
						<div class="login_code">
							<span class="login_name_icon"><img src="/public/wap1/images/login02.png"></span>
							<input type="text" name="password" placeholder="请输入密码"  />
						</div>
					</div>
					<input type="submit" class="login_go" name="" value="登录"/>
				</div>
			</form>
		</section>
	</body>

</html>