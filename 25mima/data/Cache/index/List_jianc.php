<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jyb.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	<div class="w1000">
		<div class="row">
			<h3 class="titlec">实验室检测流程</h3>
			<div class="main">
				<div class="left-cont">
					<div>
						<span>1</span>
						<div  class="text">
							<h3>样品确认</h3>
							<p>实验室收到样本后，检查样本保存管的完整性和样本的有效性。根据样本编号确认客户完成绑定情况。 </p>
						</div>
					</div>
					<img src="/public/gaiban/images/jyb01.jpg" />
				</div>
				<div class="right-cont">
					<div>
						<span>2</span>
						<div  class="text">
							<h3>DNA制备</h3>
							<p>将含有口腔上皮细胞的DNA保护液移至EPPENDORF管中，利用口腔拭子DNA抽提试剂盒提取基因组DNA。</p>
						</div>
					</div>
					<img src="/public/gaiban/images/jyb02.jpg" />
				</div>
				<div class="left-cont">
					<div>
						<span>3</span>
						<div  class="text">
							<h3>DNA含量测定</h3>
							<p>将提取好的基因组DNA进行含量测定。</p>
						</div>
					</div>
					<img src="/public/gaiban/images/jyb03.jpg" />
				</div>
				<div class="right-cont">
					<div>
						<span>4</span>
						<div  class="text">
							<h3>高通量测序</h3>
							<p>将制备好的DNA进行高通量测序。</p>
						</div>
					</div>
					<img src="/public/gaiban/images/jyb04.jpg" />
				</div>
				<div class="left-cont">
					<div>
						<span>5</span>
						<div  class="text">
							<h3>生物信息分析</h3>
							<p>对DNA测序数据进行相关生物学信息分析，并转换为最终报告 </p>
						</div>
					</div>
					<img src="/public/gaiban/images/jyb05.jpg" />
				</div>
				<div class="right-cont">
					<div>
						<span>6</span>
						<div  class="text">
							<h3>DNA存储 </h3>
							<p>DNA保存在专业的-80℃冷冻冰箱中，可保存30年以上。</p>
						</div>
					</div>
					<img src="/public/gaiban/images/jyb06.jpg" />
				</div>
			</div>
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
</html>