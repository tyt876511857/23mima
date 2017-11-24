<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/youshi.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
<script>
$('.header ul li:eq(2) a').addClass('active');
</script>
	<div class="w1000 top-cont">
		<h3 class="title">23密码专业解读，让孩子赢在起跑线上</h3>
		<p>
			所有基因检测的报告均由遗传学专家结合基因的功能进行专业的解读，<br/>
			教育学专家制定相关儿童成长计划，<br/>
			儿科学专家制定相关儿童的营养健康计划。<br/>
			3大专家量身定制科学计划，让每个孩子都能健康成长，快乐成材。
		</p>
	</div>
	
	<div style="background:#f1f1f1;">
		<div class="w1000 overflow">
			<div class="l_cont">
				<h3>领先的基因测序技术 </h3>
				<p>23密码采用标准化样本管理系统，确保样本与客户信息的一一对应由经验丰富的专业分子实验团队组成，保证所提取的DNA质量可靠所有检测项目均采用最新的一代测序或二代测序技术，检测结果准确性高达99.99% </p>
			</div>
			<div class="r_cont">
				<img src="/public/gaiban/images/youshi01.jpg" width="100%"/>
			</div>
		</div>
	</div>
	<div class="w1000 overflow whirt">
			<div class="l_cont2">
				<img src="/public/gaiban/images/youshi02.jpg" width="100%"/>
			</div>
			<div class="r_cont2">
				<h3>权威的论文依据</h3>
				<p>23密码所有检测项目中的基因均来自国际权威大样本文献报道，由澳大利亚悉尼大学、复旦大学、浙江大学医学院附属儿童医院等国内外一流分子生物学、遗传学、儿科学专家团队共同研究基因与认知能力、体质特征、疾病易感性的相关信息，严格筛选出的符合中国儿童健康成长的相关基因。</p>
				
			</div>
	</div>
	<div style="background:#f1f1f1;">
		<div class="w1000 overflow">
			<div class="l_cont">
				<h3>专业的报告解读</h3>
				<p>所有基因检测的报告均由遗传学专家结合基因的功能进行专业的解读，教育学专家制定相关儿童成长计划，儿科学专家制定相关儿童的营养健康计划。所有专家定期也会对23密码的客户进行回访，结合儿童成长情况不断跟踪调整儿童的培养路线</p>
			</div>
			<div class="r_cont">
				<img src="/public/gaiban/images/youshi03.jpg" width="100%"/>
			</div>
		</div>
	</div>
	<div class="w1000 overflow pinzhi">
			
		<h3 class="t_title">23密码的品质保证</h3>
		<img class="img" src="/public/gaiban/images/youshi04.jpg"/>
		<div class="b_cont overflow">
			<a href="/news_21.html" class="first">
				<h4 class="title">领先的基因测序技术</h4>
				<p>23密码采用标准化样本管理系统，确保样本与客户信息的一一对应；由经验丰富的专业分子实验团队组成，保证所提取的DNA质量可靠；所有检测项目均采用最新的测序技术，检测结果准确性高达99.99% 。</p>
				<span>进一步了解</span>
			</a>
			<a href="/news_22.html">
				<h4 class="title">专业的报告解读</h4>
				<p>所有基因检测的报告均由遗传学专家结合基因的功能进行专业的解读，教育学专家制定相关儿童成长计划，儿科学专家制定相关儿童的营养健康计划。所有专家定期也会对23密码的客户进行回访，结合儿童成长情况不断跟踪调整儿童的培养路线。</p>
				<span>进一步了解</span>
			</a>
			<a href="/news_23.html">
				<h4 class="title">报告升级</h4>
				<p>23密码将致力于建立中国儿童的基因数据库，定期结合国际权威文献报道对数据库的基因和相关性状的关联进行更新，同时在建立数据库的基础上不断进行自我创新和研发，建立新的基因和性状的关联。</p>
				<span>进一步了解</span>
			</a>
			<a href="/news_24.html" class="last">
				<h4 class="title">权威的产品设计</h4>
				<p>所有产品由澳大利亚悉尼大学、香港大学医学院、复旦大学生命科学院、浙江大学医学院等国内外一流遗传学、分子生物学、生物信息学、儿科医学专家团队针对中国儿童成长发育、营养健康及遗传病诊断而设计的基因检测项目。</p>
				<span>进一步了解</span>
			</a>
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
<script>
function dialog(id){
	
	$('.dialog').fadeIn();
}

$('.dialog').siblings().click(function(){
	$('.dialog').fadeOut();
})
</script>
</html>