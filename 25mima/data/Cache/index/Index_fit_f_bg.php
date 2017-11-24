<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>23密码 | 基因检测结果</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<?php $this->display('index:Index:css','lib') ?>
<meta name="renderer" content="webkit|ie-comp|ie-stand">

<link href="/public/gaiban/css/fit_f_bg.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="/public/gaiban/js/jquery-1.8.3.min.js"></script>


<!--[if lt IE 9]>
    <script type="text/javascript" src="js/PIE_IE678.js"></script>
	</script>
    <![endif]-->
<!--[if gt IE 8]>
	<script type="text/javascript" src="js/PIE_IE9.js"></script>
 <![endif]-->


</head>
<body>
	<?php $this->display('index:Index:header','lib') ?>
	<div class="w1000 topnav">
		
			<div class="left"><a >您的报告</a>｜<span>报告概览</span></div>
			<div class="right">
				<?php $this->display('baogao','lib') ?>
			</div>
		
	</div>
	<div class="topimg">
	<img src="<?php if(isset($zheye['litpic2'])){echo $zheye['litpic2'];} ?>" width='100%' />
	<p style="color:<?php echo $zheye['yichuanglv'][0];?>">
	<?php if(isset($zheye['name'])){echo $zheye['name'];} ?>对减肥的作用<br/>
	<font style="color:<?php echo $zheye['yichuanglv'][1];?>"><?php if(isset($zheye['title_c'])){echo $zheye['title_c'];} ?>  <?php if(isset($fenshu1['description'])){echo $fenshu1['description'];} ?></font>
	</p>
	</div>
	<div class="w1000">
		<div class="row">
			<div class="left"><h3 class="titlec1">基因解读<img src="/public/gaiban/images/fit (10).jpg" height="108"/></h3></div>
			<div class="right jiedu">
				<?php if(isset($zheye['jianyi1'])){echo $zheye['jianyi1'];} ?>
			</div>
			<a class="ckwx" href="/content_<?php if(isset($zheye['typeid'])){echo $zheye['typeid'];} ?>.html">参考文献</a>
			
		</div>
	</div>
	
	<div class="w1000 overflow">
		<div class="row">
			<div class="left"><h3 class="titlec1">基因明细<img src="/public/gaiban/images/fit (4).jpg" height="108"/></h3></div>
			<div class="right">
				
				<table>
					<thead>
						<tr>
							<th>基因</th><th>检测位点</th><th>基因型</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php if(isset($zheye['title_c'])){echo $zheye['title_c'];} ?></td><td><?php if(isset($zheye['SNP'])){echo $zheye['SNP'];} ?></td><td><?php if(isset($fenshu1['name'])){echo $fenshu1['name'];} ?></td>
						</tr>
						
						
					</tbody>
				</table>
				
			</div>
			
			
		</div>
	</div>
	<div class="w1000">
		<div class="row">
			<div class="left">
				<h3 class="titlec3">专家减肥建议<img src="/public/gaiban/images/fit (11).jpg" height="162"/></h3>
			</div>
			<div class="left">
				<div class="advice">
				
				
					<?php if(isset($zheye['content3'])){echo $zheye['content3'];} ?>
				
				</div>
			</div>
			
		</div>
	</div>
	<?php $this->display('index:Index:footer','lib') ?>
</body>
<script src="/public/gaiban/js/fit_a.js"></script>
</html>