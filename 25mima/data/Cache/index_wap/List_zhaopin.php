<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('css','lib') ?>
</head>
<body>
<?php $this->display('header','lib') ?>
<div id="wrapper">
<?php 
$attr =<<<Eof
type='wap_type_banner'
Eof;
$c =<<<Eof

<div class="banner"><img src="[field:litpic /]" alt=""></div>

Eof;

	$data = $this->taglib->_myad($attr,$c);eval($data);?>
<div class="list_title"><?php if(isset($field['typename'])){echo $field['typename'];} ?></div>
<div class="mtbd">
	<ul class="lb">
	<?php foreach ($list as $v){ ?>
	<li>
		<div class="mtbd-box">
		<p class="mtbd02"><?php if(isset($v['title'])){echo $v['title'];} ?></p>
		<p class="mtbd03"><a href="<?php if(isset($v['url'])){echo $v['url'];} ?>">查看详情</a></p>
		</div>
	</li>
	<?php } ?>
	</ul>
	<div class="page"><?php echo $page; ?></div>
</div>
<?php $this->display('footer','lib') ?>
</div>
</body></html>
<style>
.mtbd03,.mtbd02{margin:0 auto;text-align:center;font-size:1em;top:0;}
</style>
