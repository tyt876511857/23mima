<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/dynamic.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
<script>
$('.header ul li:eq(3) a').addClass('active');
</script>
	<div style="background:#efefef">
	<div class="w1000" style="overflow:auto">
		<div class="list">
		
			<div class="content">
				<?php foreach ($list as $k=>$v){ ?>
				<?php 
				if($k==0){
					$class = 'first';
				}elseif($k%2==1){
					$class = 'left';
				}else{
					$class = 'right';
				}
				?>
				<a href="<?php if(isset($v['url'])){echo $v['url'];} ?>" class="<?php echo $class; ?>">
					<?php
					if($v['litpic']){
					
					?>
						<img src="<?php if(isset($v['litpic'])){echo $v['litpic'];} ?>" width="100%"/>
				
					<?php } 
					?>
					<h4><?php if(isset($v['title'])){echo $v['title'];} ?></h4>
					<span><?php echo date('Y-m-d',$v['add_time']) ?></span>
					<div class="cont">
						<p><?php echo str_replace('&amp;nbsp;','',$v['info'])?></p>
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>

<script language="javascript" src="js/base2.js"></script>

</html>