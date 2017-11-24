<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/updatelevel.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	<img src="/public/gaiban/images/updatelevel.jpg" width="100%" />
	<div class="w1000">
		<div class="row jishu01">
			<img src="/public/gaiban/images/updatelevel01.jpg" />
			<div class="jcont">
				
				<p>定期结合国际权威文献报道对数据库的基因和相关性状的关联进行更新，同时在建立数据库的基础上不断进行自我创新和研发，建立新的基因和性状的关联。</p>
			</div>
		</div>
	</div>
	<div class="w1000">
		<div class="row jishu02">
			<img src="/public/gaiban/images/updatelevel02.jpg" />
			<div class="jcont">
				
				<p> 在此基础上持续丰富检测项目的基因数目，不断优化现有基因检测产品和开发新的基因检测产品。</p>
			</div>
		</div>
	</div>
	<div class="w1000">
		<div class="row jishu03">
			<img src="/public/gaiban/images/updatelevel03.jpg" />
			<div class="jcont">
				
				<p> 后期针对产品的优化和丰富将自动升级到已完成检测的客户报告中，实现一次基因检测，终生受益。</p>
			</div>
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
<script>
function dialog(id){
	
	$('.dialog').fadeIn();
}

$('.dialog').siblings().click(function(){
	$('.dialog').fadeOut();
})
</script>
</html>