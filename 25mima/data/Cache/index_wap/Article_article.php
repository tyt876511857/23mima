<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('css','lib') ?>
</head>
<body class="list_news">
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
<div class="news_title">
  <h3><?php if(isset($field['postname'])){echo $field['postname'];} ?></h3>
  <span>来源：23密码 <?php echo date('Y-m-d',$field["add_time"]) ?></span>
</div>
<div class="cont"><?php if(isset($field['content'])){echo $field['content'];} ?></div>
<div class="news_bottom">
<?php 
$attr =<<<Eof
type='wap_news'
Eof;
$c =<<<Eof

<a href="[field:url /]">
    <img src="[field:litpic /]" alt="">
    <p>[field:content /]</p>
    <span>了解更多</span>
</a>

Eof;

	$data = $this->taglib->_myad($attr,$c);eval($data);?>
</div>
<?php $this->display('footer','lib') ?>
</div>
</body></html>