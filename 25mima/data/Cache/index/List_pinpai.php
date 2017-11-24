<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('css','lib') ?>


<link href="/public/gaiban/css/brand.css" rel="stylesheet" type="text/css" />
</head>
<body class='list_pinpai'>
<?php $this->display('header','lib') ?>

	<img src="/public/gaiban/images/brand01.jpg" width="100%">
	<div class="w1000">
		<div class="row">
			<div class="desc">
				<a href="javascript:$('html,body').animate({scrollTop: '1243px'}, 800);" class="first">
					<img src="/public/gaiban/images/brand02.jpg" width="100%" />
					<span>01<hr width="80%"/></span>
					<h3>创办初衷</h3>
					<p>让我们携手做一件有意义的事</p>
				</a>
				<a href="javascript:$('html,body').animate({scrollTop: '1607px'}, 800);">
					<img src="/public/gaiban/images/brand03.jpg" width="100%" />
					<span>02<hr width="80%"/></span>
					<h3>前景方向</h3>
					<p>儿童天赋基因检测是我们的事业</p>
				</a>
				<a href="javascript:$('html,body').animate({scrollTop: '1981px'}, 800);">
					<img src="/public/gaiban/images/brand04.jpg" width="100%" />
					<span>03<hr width="80%"/></span>
					<h3>技术支持</h3>
					<p>大数据库、知名院校支撑，让准确解读触手可及</p>
				</a>
				<a href="javascript:$('html,body').animate({scrollTop: '2347px'}, 800);" class="last">
					<img src="/public/gaiban/images/brand05.jpg" width="100%" />
					<span>04<hr width="80%"/></span>
					<h3>创办宗旨</h3>
					<p>解读国人智慧密码缔造儿童成功未来</p>
				</a>
				
			</div>
			<div class="main">
				<div class="cont" >
										<img src="/uploads/pp/11.jpg" />

				</div>
				<div class="cont">
										<img src="/uploads/pp/22.jpg" />

				</div>
				<div class="cont">
										<img src="/uploads/pp/33.jpg" />

				</div>
				<div class="con">
										<img src="/uploads/pp/44.jpg" />

				</div>
			</div>
		</div>
	</div>
<?php $this->display('footer','lib') ?>
<script src="/public/js/index.js"></script>
</body>
</html>