<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>23密码</title>
		<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
		<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
		<?php $this->display('css','lib') ?>
		<link rel="stylesheet" type="text/css" href="/public/wap1/user/iconfont3.css" />
		<style>
		.ui-row li{text-align:center}
		.ui-tiled li a div{color:#333}
		.ui-list-info h4{color:#333}
		</style>
	</head>

	<body style="background: #F6F4F5;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<div class="ui-row-flex ui-row-flex-ver" style="height:2rem;">
				<div class="ui-col ui-col-2" style="background:url('/public/wap1/user/user.jpg') no-repeat #000;background-size:100%;">
					<div class="ui-row-flex ui-whitespace ui-row-flex-ver" style="height: 1.3rem;padding:0.5em;">
						<div class="ui-col ui-col-3" style="text-align:center;"><img src="/public/wap1/user/user.png" style="border-radius: 100%;width:5em;border: 2px solid #fff"></div>
						<div class="ui-col" style="text-align:center;color:#fff"><?php if(isset($_SESSION['user_userid'])){echo $_SESSION['user_userid'];} ?></div>
					</div>
				</div>
				<div class="ui-col">
					<ul class="ui-tiled">
						<li><a href="<?php echo U('Indent/index','user') ?>"><i class="iconfont3 icon-fahuo"></i><div>未付款</div></a></li>
						<li><a href="<?php echo U('Indent/index','user') ?>"><i class="iconfont3 icon-order"></i><div>已发货</div></a></li>
						<li><a href="<?php echo U('Indent/index','user') ?>"><i class="iconfont3 icon-yifahuoshouji"></i><div>已收货</div></a></li>
						<li><a href="<?php echo U('Index/mytuoye','user') ?>"><i class="iconfont3 icon-hezi01"></i><div>样品盒</div></a></li>
						<li><a href="<?php echo U('Index/baogao','user') ?>"><i class="iconfont3 icon-baogao"></i><div>我的报告</div></a></li>
					</ul>
					
				</div>
			</div>
			<ul class="ui-list ui-list-one ui-list-link ui-border-tb">
				<li class="ui-border-t">
					<a class="ui-list-info" href="<?php echo U('index/kuaidi') ?>">
						<h4 class="ui-nowrap">呼叫快递</h4>
						<div class="ui-txt-info"></div>
					</a>
				</li>
				<li class="ui-border-t">
					<a class="ui-list-info" href="<?php echo U('index/youhui') ?>">
						<h4 class="ui-nowrap">我的优惠码</h4>
						<div class="ui-txt-info"></div>
					</a>
				</li>
				<li class="ui-border-t">
					<a class="ui-list-info" href="<?php echo U('index/editpassword') ?>">
						<h4 class="ui-nowrap">修改密码</h4>
						<div class="ui-txt-info"></div>
					</a>
				</li>
			</ul>
		</section>
		<?php $this->display('footer','lib') ?>
	</body>
</html>
