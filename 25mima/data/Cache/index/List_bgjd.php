<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/dnawd.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	<div class="w1000">
		<div class="row">
			<div class="left_cont">
				<img src="/public/gaiban/images/dna01.jpg">
				<h3>Chr.<span>20</span></h3>
				<p><span>CHRNA4</span>（nicotinic acetylcholine receptor α4-subunit）基因位于人类20号染色体上 </p>
			</div>
			<div class="right_cont"><img src="/public/gaiban/images/dan02.jpg"></div>
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>

</html>