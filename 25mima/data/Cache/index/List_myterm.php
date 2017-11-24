<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/myterm.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	
	<div class="w1000 top-cont">
		<h3 class="title">专家团队</h3>
		<p>
			所有基因检测的报告均由遗传学专家结合基因的功能进行专业的解读<br/>
			教育学专家制定相关儿童成长计划<br/>
			儿科学专家制定相关儿童的营养健康计划
		</p>
	</div>
	<div class="w1000 overflow">
		<div class="item">
			<div class="dlogo"><img src="/public/gaiban/images/liwei.png" /></div>
			<h4>李伟</h4>
			<p class="js">分子生物学  硕士</p>
			<p class="cont">浙江大学医学院附属儿童医院基因实验室 负责人<br/> 
23密码生物技术有限公司<br/>
产品研发总监<br/>
 从事儿童智力发育和遗传性疾病相关基因的检测和科研工作，在儿童基因诊断领域具有丰富的临床和科研经验。近3年来以第一作者身份或通讯作者身份发表SCI论文多达10余篇，获得国家级发明专利2项。
</p>
		</div>
		<div class="item">
			<div class="dlogo"><img src="/public/gaiban/images/simang.png" /></div>
			<h4>施莽</h4>
			<p class="js">悉尼大学生物与环境医学院<br/>生物信息学  博士后</p>
			<p class="cont">23密码生物技术有限公司 <br/>
 生物信息研发工程师 <br/> 
长期从事全基因组测序和分析工作，近年来已发表相关论文30余篇，其中包括New England journal of medicine，PNAS, Journal of virology等国际顶级期刊论文。</p>
		</div>
		<div class="item">
			<div class="dlogo"><img src="/public/gaiban/images/dongao.png" /></div>
			<h4>董敖</h4>
			<p class="js">浙江大学医学院 <br/>
							基础医学专业　硕士</p>
			<p class="cont"> 浙江大学医学院附属儿童医院骨髓影像学实验室负责人<br/>
参加工作以来一直从事骨髓细胞形态学诊断工作，承担浙江省儿童白血病、淋巴瘤、贫血等血液系统疾病的诊断任务，年阅片量在国内儿童医院中排名前三，年诊断白血病200例以上。在儿童血液系统疾病诊断方面积累了丰富的经验，常年为下级医院如绍兴市妇幼保健院、永康市妇幼保健院、台州市人民医院等提供技术指导。
</p>
		</div>
		<div class="item">
			<div class="dlogo"><img src="/public/gaiban/images/yingdingge.png" /></div>
			<h4>应鼎阁</h4>
			<p class="js">生物信息学,遗传学 博士</p>
			<p class="cont">主要研究领域及熟悉领域:<br/>
单核苷酸变异全基因组关联分析（SNP GWAS），数据预处理，数据质量管控，统计学分析以及相关算法和软件开发。（博士阶段）<br/>二代测序技术应用，包括全外显子测序和全基因组测序。二代测序在单基因疾病家系以及复杂疾病人群分析，从样本选择，分析流程建立，病理分析以及相关数据库建立及应用。（医院儿科研究助理阶段）
全转录组数据对疾病相关基因和变异的精确标注以及新基因的发现 （博士后阶段）

</p>
		</div>
		<div class="item">
			<div class="dlogo"><img src="/public/gaiban/images/chenweijun.png" /></div>
			<h4>陈维军</h4>
			<p class="js">儿科学硕士研究生  主治医生</p>
			<p class="cont">浙江大学医学院附属儿童医院         儿童保健科<br/>
主要从事生长发育监测、营养代谢类疾病和遗传染色体异常疾病的诊疗，发表核心论文数篇。
</p>
		</div>
		<div class="item">
			<div class="dlogo"><img src="/public/gaiban/images/zhangxing.png" /></div>
			<h4>张鑫</h4>
			<p class="js">儿科学硕士研究生   主治医生</p>
			<p class="cont">浙江大学医学院附属儿童医院         康复科<br/>
主要从事儿童智力发育迟缓的研究，发表核心论文数篇。</p>
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