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
<div id="position">
  <div class="position w1000">
    
  </div>
</div>
<div class="content w1000">
  <div class="left" style="width:100%">
    
    <div class="main">
      <h3 style="border-top: 1px solid #D3D3D3"><?php if(isset($field['postname'])){echo $field['postname'];} ?></h3>
      <p class="laiyuan"><?php echo date('Y-m-d',$field["add_time"]) ?>&nbsp;来源：23密码&nbsp;</p>
      <!-- <p class="desc"><?php if(isset($field['description'])){echo $field['description'];} ?></p> -->
      <div class="cont"><?php if(isset($field['content'])){echo $field['content'];} ?></div>
<!--       <div class='prenext'>
  <?php 
$attr =<<<Eof
type='pre'
Eof;
$c =<<<Eof

    <a href="[field:url /]" class="az" title="[field:title /]"><span><上一篇</span>[field:title /]</a>
  
Eof;

	$data = $this->taglib->_prenext($attr,$c);eval($data);?>
  <?php 
$attr =<<<Eof
type='next'
Eof;
$c =<<<Eof

    <a href="[field:url /]" class="az" title="[field:title /]"><span>下一篇></span>[field:title /]</a>
  
Eof;

	$data = $this->taglib->_prenext($attr,$c);eval($data);?>
</div> -->
      <!-- <div class="guzhu"></div> -->
    </div>
    
	</div>
  
  </div>
</div>
<?php $this->display('footer','lib') ?>
<script src="/public/js/index.js"></script>
</body>
</html>