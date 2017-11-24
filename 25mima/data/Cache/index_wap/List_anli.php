<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
<div class="list_anli">
  <?php foreach ($list as $v){ ?>
  <a href="<?php if(isset($v['url'])){echo $v['url'];} ?>">
    <img src="<?php if(isset($v['litpic'])){echo $v['litpic'];} ?>" alt="">
    <p><?php if(isset($v['title'])){echo $v['title'];} ?></p>
  </a>
  <?php } ?>
</div>
<?php $this->display('footer','lib') ?>
</div>
</body></html>