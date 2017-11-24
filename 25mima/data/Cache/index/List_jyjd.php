<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<meta name="renderer" content="webkit|ie-comp|ie-stand">

<link href="/public/gaiban/css/jyjd.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<?php $this->display('index:Index:header','lib') ?>
	
	<div class="w1000">
		<div class="row">
			<h3 class="titlec"><img src="/public/gaiban/images/title_jyjb.png"  /></h3>
			<p class="desc">所有基因检测的报告均由遗传学专家结合基因的功能进行专业的解读，教育学专家制定相关儿童成长计划，儿科学专家制定相关儿童的营养健康计划。所有专家定期也会对23密码的客户进行回访，结合儿童成长情况不断跟踪调整儿童的培养路线。</p>
			<div class="main">
				<div class="left-cont">
					<p>遗传学和分子生物学专业的技术人员对国际权威文献进行解读，建立基因和性状的关联。</p>
					<img src="/public/gaiban/images/jyjd01.jpg" />
				</div>
				<div class="right-cont">
					<p>生物信息学专业技术人员对基因测序结果进行分析。</p>				
					<img src="/public/gaiban/images/jyjd02.jpg" />		
				</div>
				<div class="left-cont">
					
					<img src="/public/gaiban/images/jyjd03.jpg" />
					<p>遗传咨询师对测序结果进行解读，报告每个样本基因测序结果对应的性状。</p>
				</div>
				<div class="right-cont">
								
					<img src="/public/gaiban/images/jyjd04.jpg" />		
					<p>教育学专家或儿科医生就性状结果，给出专业的建议和指导。</p>	
				</div>
			</div>
		</div>
	</div>
	
	<?php $this->display('index:Index:footer','lib') ?>
</body>

</html>