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
<body class='article_meiquan'>
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
<div class="content w1000">
  <?php if(isset($field['content'])){echo $field['content'];} ?>
</div>
<?php $this->display('footer','lib') ?>
<script src="/public/js/index.js"></script>
</body>
</html>