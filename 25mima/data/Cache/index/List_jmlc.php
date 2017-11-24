<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jmlc.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	<div class="w1000">
		<div class="row">
			<h3 class="titlec"><span><img src="/public/gaiban/images/jm (1).jpg" /></span>加盟流程</h3>
			<div class="desc">
				
					<div class="left">
						<p class="first"><img src="/public/gaiban/images/jm (5).jpg" /></p>
						<p class="second"><img src="/public/gaiban/images/jm (4).jpg" /></p>
					</div>
					<a href="/news_18.html" class="right"><img src="/public/gaiban/images/jm (3).jpg" /></a>
				
			</div>
			
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
</html>