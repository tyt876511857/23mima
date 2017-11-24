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
		.ICP{position:absolute;bottom:0.55rem;right:0}
		</style>
	</head>

	<body style="background: #F6F4F5;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<ul class="ui-list ui-list-pure ui-border-tb">
				<li class="ui-border-t">
					<ul class="ui-row">
						<li class="ui-col ui-col-100"><img src="/public/wap1/user/img.png"></li>
					</ul>
				</li>	
			</ul>
			<ul class="ui-list ui-list-pure ui-border-t">
				<li class="ui-border-t">
					<ul class="ui-row">	
						<li class="ui-col ui-col-50">顺丰快递</li>					
						<li class="ui-col ui-col-50"><a href="tel:95338">95338</a></li>
					</ul>
				</li>	
			</ul>
			<ul class="ui-list ui-list-pure ui-border-t">
				<li class="ui-border-t">
					<ul class="ui-row">	
						<li class="ui-col ui-col-50">圆通快递</li>
						<li class="ui-col ui-col-50"><a href="tel:95554">95554</a></li>
					</ul>
				</li>	
			</ul>
			<ul class="ui-list ui-list-pure ui-border-t">
				<li>
					<ul class="ui-row">	
						<li class="ui-col ui-col-50">申通快递</li>
						<li class="ui-col ui-col-50"><a href="tel:95543">95543</a></li>
					</ul>
				</li>	
			</ul>
			<ul class="ui-list ui-list-pure ui-border-t">
				<li class="ui-border-t">
					<ul class="ui-row">	
						<li class="ui-col ui-col-50">中通快递</li>
						<li class="ui-col ui-col-50"><a href="tel:95311">95311</a></li>
					</ul>
				</li>	
			</ul>
			<ul class="ui-list ui-list-pure ui-border-t ">
				<li class="ui-border-t">
					<ul class="ui-row">	
						<li class="ui-col ui-col-50">EMS</li>
						<li class="ui-col ui-col-50"><a href="tel:11183">11183</a></li>
						
					</ul>
				</li>
				
			</ul>
		</section>
		<?php $this->display('footer','lib') ?>
	</body>
</html>
