<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/hz.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
<script>
$('.header ul li:eq(4) a').addClass('active');
</script>
	<img src="/public/gaiban/images/hz.jpg" width="100%">
	<div style="background:#88a0af">
		<p class="w1000 zsrx">招商热线 400-109-2599</p>
	</div>
	<div class="w1000">
		<div class="row">
			<div class="desc">
				<a class="first">
					<img src="/public/gaiban/images/hz01.jpg" width="100%" />
					
					<h3 class="font1">模式灵活</h3>
					<p>一级二级代理模式</p>
				</a>
				<a>
					<img src="/public/gaiban/images/hz02.jpg" width="100%" />
					
					<h3 class="font2">产品宣传</h3>
					<p>完善的产品宣传支持</p>
				</a>
				<a>
					<img src="/public/gaiban/images/hz03.jpg" width="100%" />
					
					<h3 class="font3">价格控制</h3>
					<p>严格执行市场统一零售价，保证代理商利润。</p>
				</a>
				<a class="last">
					<img src="/public/gaiban/images/hz04.jpg" width="100%" />
					
					<h3 class="font4">系统培训</h3>
					<p>23密码对所有代理商提供系统完善的市场营销培训。</p>
				</a>
				
			</div>
			<div class="main">
				<h3 class="titlec">市场需求</h3>
				<div class="cont1">
					<img src="/public/gaiban/images/hz05.jpg" />
					<p>苹果公司创始人史蒂夫•乔布斯罹患癌症期间，也曾接受过全基因组测序，基于乔布斯的个人基因组，医生给出了相对精准的用药方案。 </p>
				</div>
				<div class="cont2">
					<img src="/public/gaiban/images/hz06.jpg" />
					<p>著名好莱坞影星安吉丽娜 •朱莉通过基因检测，发现自己拥有患乳腺癌的高风险基因，因此主动选择切除乳腺。明星效应让基因检测迅速引起世人关注。 </p>
				</div>
				<div class="cont3">
					<img src="/public/gaiban/images/hz07.jpg" />
					<p>著名歌手梁咏琪怀孕6个多月，初为人母，她最担心是胎儿健康。2015年她获得香港某公司邀请，接受无创产前基因检测，并成为首位代言人。 </p>
				</div>
			</div>
		</div>
	</div>
	<div style="background:#f4f4f4">
	<div class="w1000" >
		<div class="row" style="margin-bottom:0">
		<h3 class="titlec title_m">政府支持</h3>
		<ul class="country">
			<li>
				<span class="icon icon1"></span>
				<p class="text_m">2015年1月，美国总统奥巴马宣布启动“精准医学计划”，2016财年投入2.15亿美元以个性化治疗引领医学新时代。</p>
				<span class="cricle cricle1">美国<span>
			</li>
			<li>
				<span class="icon icon2"></span>
				<p class="text_m">2014年8月，英国率先投资3亿英镑欲改变疾病的诊断和治疗方式，发起10万人基因组计划。</p>
				<span class="cricle cricle2">英国<span>
			</li>
			<li>
				<span class="icon icon3"></span>
				<p>2015年1月，国家食品药品监督管理总局（CFDA）首次批准基因测序产品三类医疗器械注册证。2015年中国政府启动“精准医疗计划”，计划在2030年前投入600亿。国家卫计委和科技部组织专家论证，“精准医疗”有望写入国家“十三五”科技规划。</p>
				<span class="cricle cricle3">中国<span>
			</li>
		</ul>
		</div>
	</div>
	</div>
	<img src="/public/gaiban/images/hz11.jpg" width="100%">
	<div style="background:#f4f4f4">
		<div class="w1000" >
			<div class="row" style="margin-bottom:0">
			<h3 class="titlec title_m">携手共创互赢</h3>
			<ul class="text">
				<li>
					<img src="/public/gaiban/images/hz12.jpg" width="100%">
					<div class="cont1">
					<h3>商务合作</h3>
					<p class="">23密码开放渠道采购、学校团购等窗口，并将提供相关产品的专属服务及知识体系支持。</p>
					</div>
				</li>
				<li>
					
					<div class="cont2">
					<h3>品牌合作</h3>
					<p class="">以崭新的视角及形式进行产品协作，以品牌号召力为主，实现对群众产生一万点暴击的品牌效应。</p>
					</div>
					<img src="/public/gaiban/images/hz13.jpg" width="100%">
				</li>
				<li>
					<img src="/public/gaiban/images/hz14.jpg" width="100%">
					<div class="cont1">
					<h3>加盟合作</h3>
					<p class="">集团化的体系支持，精准化的产品定位，严格化的价格管控，专业化的产品服务</p>
					</div>
				</li>
				
			</ul>
			</div>
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>

</html>