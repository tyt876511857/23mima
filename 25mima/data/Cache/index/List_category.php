<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('css','lib') ?>
<link href="/public/gaiban/css/list.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
<script>
$('.header ul li:eq(1) a').addClass('active');
</script>
	<div class="w1000">
		<div class="row list">
			
			<h3 class="title">儿童 · 健康 · 科技</h3>
			<div class="content">
				<?php foreach ($list as $v){ ?>
				<a href="<?php if(isset($v['url'])){echo $v['url'];} ?>" class="first">
					<img src="<?php if(isset($v['goods_img'])){echo $v['goods_img'];} ?>" width="100%" height="238"/>
					<div class="cont">
						<h3><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></h3>
						<p><?php if(isset($v['description'])){echo $v['description'];} ?></p>
						<span>体验价<br/>￥<?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?></span>
					</div>
				</a>
				<?php } ?>
			</div>
			
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
<script language="javascript" src="js/base2.js"></script>
</html>
<style>
.list .content a p{height:50px;}
</style>