<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>我的美舍订单</title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('css','lib') ?>
</head>
<body class="shopping3">
<?php $this->display('header','lib') ?>
	<div class="w1000" style="margin:20px auto 50px">
		<div class="shop_title3 shop_title"></div>
		<div class="dingdan">
			<h3>您的订单已成功提交，请尽快付款！</h3>
			<p>您的订单号：<span><?php if(isset($indent['indent'])){echo $indent['indent'];} ?></span>应付款项：<span>￥<?php if(isset($indent['price'])){echo $indent['price'];} ?></span></p>
			<form action="<?php echo U('Alipay/index','user') ?>" method='post' target="_blank">
			<p><!-- <strong>您选择的支付方式为：</strong><img src="/public/index/payment<?php if(isset($indent['payment'])){echo $indent['payment'];} ?>.jpg" /> -->
				<input name="id" type="hidden" value="<?php if(isset($indent['indent'])){echo $indent['indent'];} ?>" />
				<input name="submit" id="submit" type="submit" value="" />
			</p>
			</form>
			<!-- <h4>为了保证及时处理您的订单，请于下单后<span>4</span>天内支付，否则订单将会被取消。</h4> -->
			<div class="f_dingdan">
				<a href="#"></a>
				<a href="/" class="right">继续购物</a>
			</div>
		</div>
	</div>
<?php $this->display('footer','lib') ?>
<script src="/public/js/index.js"></script>
</body>
</html>
