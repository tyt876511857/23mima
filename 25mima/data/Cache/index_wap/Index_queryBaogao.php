<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>查询页面</title>
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
				top: 4px;
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
			<form action="<?php echo U('Index/getBaogaoList') ?>" method="post" name="" onsubmit = "return checkUser();" >
				<div class="login_con">
					<h5>手机动态密码查询报告</h5>
					<div class="login_name">
						<span class="login_name_icon"><img src="/public/wap1/images/login01.png"></span>
						<input type="text" name="phone" placeholder="请输入正确的手机号码" maxlength="11" />
					</div>			
					<!-- <input type='hidden' name='parent_id' value='<?php echo $parent_id; ?>' /> -->

					<div style="position: relative;">
						<div class="login_code">
							<span class="login_name_icon"><img src="/public/wap1/images/login02.png"></span>
							<input type="text" name="yzm" placeholder="动态密码" maxlength="6" />
						</div>
						<input type="button" onclick='yzm1();' value="获取密码" class="login_buttin" name="" />
					</div>
					<input type="submit" class="login_go" name="" value="查询"/>
				</div>
			</form>
		</section>
<?php $this->display('footer','lib') ?>
	</body>

</html>
<script>
    function yzm1(){
        var phone = $('[name=phone]').val();
        if(phone.length!=11){
          alert('手机号不正确！');
        }else{
          $.post('/index/Index/yzm',{'phone':phone},
          function(data,status){
              alert(data);
          });
          alert('已发送');
        }
    }
    function checkUser() {
    	var phone = $('[name=phone]').val();
    	var yzm = $('[name=yzm]').val();
    	if (!phone||!yzm) {
    		alert('请填写信息');
    		return false;
    	}
    }
</script>
