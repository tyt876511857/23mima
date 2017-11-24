<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jiance.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	<div style="background:#f2f2f2">
		<div class="w1000">
			<div class="row1">
				<img src="/public/gaiban/images/jiance.jpg" width="100%"/>
			</div>
		</div>
		<div class="w1000" style="padding-bottom:60px;">
			<div class="row2">
				<div class="cont">
					<span>Tip小知识：</span>
					<h3>为什么口腔刮刮就可以做基因检测？</h3>
					<p>一个人体细胞中的遗传物质----DNA是基本一致的，所以理论上DNA可以从身体的任何细胞中获取。利用拭子在口腔上刮取的是口腔上皮细胞，口腔上皮细胞中具有完整的人类基因组DNA序列。为了实现无创的DNA检测，口腔拭子刮取的上皮细胞可以代替血液成为基因组DNA的来源。</p>
				</div>
				<img src="/public/gaiban/images/jiance01.jpg" />
			</div>
		</div>
		<div class="w1000" style="padding-bottom:60px;">
			<div class="row3">
				<div class="cont">
					
					<h3>进一步了解23密码实验室检测过程</h3>
					<p>了解23密码是如何通过唾液样本为我们研究出基因检测报告</p>
					<a href="/news_6.html">进一步了解</a>
				</div>
				<img src="/public/gaiban/images/jiance02.jpg" />
			</div>
		</div>
	</div>
	<div class="w1000">
		<div class="row1">
			<h3 class="title">采样流程</h3>
			<div class="e-sort">
				<a href="#"><span>1</span><img src="/public/gaiban/images/1-01.jpg" width="100%" /><p>扫瞄二维码直接进行采样盒绑定。</p></a>
				<a href="#"><span>2</span><img src="/public/gaiban/images/2-01.jpg" width="100%" /><p>打开医用消毒包装袋，取出采样拭子。注意请勿直接接触拭子头部。</p></a>
				<a href="#"><span>3</span><img src="/public/gaiban/images/3-01.jpg" width="100%" /><p>将拭子伸入一侧口腔，紧靠脸颊内侧来回刮拭20次以上。刮拭过程中请不时旋转棉棒，保证拭子头部充分接触口腔黏膜。</p></a>
				<a href="#"><span>4</span><img src="/public/gaiban/images/4-01.jpg" width="100%" /><p>采样完毕后，拧开采样管，沿着拭子头部约2cm折缝处折断，使拭子头部落入采样管的DNA保存液中。</p></a>
				<a href="#" ><span>5</span><img src="/public/gaiban/images/5-01.jpg" width="100%" /><p>将采样管管盖旋紧。</p></a>
				<a href="#"><span>6</span><img src="/public/gaiban/images/6-01.jpg" width="100%" /><p>请在另一侧口腔重复第2步－第5步，采集DNA于另一采样管中。</p></a>
				<a href="#"><span>7</span><img src="/public/gaiban/images/7-01.jpg" width="100%" /><p>将盖好的采样管放入包装盒中。</p></a>
				<a href="#" ><span>8</span><img src="/public/gaiban/images/8-01.jpg" width="100%" /><p>请将采样盒回寄到23密码。</p></a>
				<a href="#"><span>9</span><img src="/public/gaiban/images/9-01.jpg" width="100%" /><p>电子检测报告将于收到您样本后的10天内得出，请在收到提示短信后，登录网站或微信服务号查看报告。</p></a>
				<div class="alert">
					<h3>注意事项</h3>
					<ul>
						<li><p>采样前30分钟内，请勿进食、饮水、嚼口香糖或涂抹润唇膏。</p></li>
						<li><p>请勿食用采样管中的DNA保存液，若不慎溅入眼睛或皮肤上，请立即用清水清洗。</p></li>
						<li><p>采样后请于48小时内回寄到实验室。</p></li>
						<li><p>采样前请你和宝贝清洗双手。</p></li>
						<li><p>请勿将采集器放入高温或极度低温环境中，勿靠近火源。</p></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>

</html>