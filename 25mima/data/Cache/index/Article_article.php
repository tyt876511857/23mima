<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/article.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	
	<div class="w1000">
		<div class="row list">
			
			<h3 class="title"><span><?php if(isset($field['postname'])){echo $field['postname'];} ?></span></h3>
			<p class="ly"><?php echo date('Y-m-d',$field["add_time"]) ?> 来源：23密码 </p>
			<div class="content">
				<?php if(isset($field['content'])){echo $field['content'];} ?>
			</div>
			
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>



</html>