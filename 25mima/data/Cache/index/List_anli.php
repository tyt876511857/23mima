<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('css','lib') ?>
<link href="/public/css/meiquan.css" rel="stylesheet" type="text/css">
</head>
<body class='list_anli'>
<?php $this->display('header','lib') ?>
  <?php if(empty($field['litpic'])){?>
    <?php 
$attr =<<<Eof
type='type_banner'
Eof;
$c =<<<Eof
<div class="banner" style="background-image:url([field:litpic /]);"></div>
Eof;

	$data = $this->taglib->_myad($attr,$c);eval($data);?>
  <?php }else{ ?>
    <div class="banner" style="background-image:url(<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>);"></div>
  <?php } ?>
  <div id="position">
    <div class="position w1000">
      <a href="/">首页</a> &gt; <?php if(isset($field['typename'])){echo $field['typename'];} ?>
    </div>
  </div>
<div class="content w1000">
  <h3></h3>
  <?php foreach ($list as $v){ ?>
  <a class="anli" href="<?php if(isset($v['url'])){echo $v['url'];} ?>">
  	<img src="<?php if(isset($v['litpic'])){echo $v['litpic'];} ?>" alt="">
  	<p><?php if(isset($v['title'])){echo $v['title'];} ?></p>
  </a>
  <?php } ?>
</div>
<div class="anli_banner"></div>
<?php $this->display('footer','lib') ?>
<script src="/public/js/index.js"></script>
</body>
</html>