<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>基因检测结果-美容基因 </title>
<meta name="Description" content="" />
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jyy_a_bg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/public/gaiban/js/highcharts.js"></script>
<script type="text/javascript" src="/public/gaiban/js/highcharts-more.js"></script>
<style>
.w1000{width:100%; page-break-inside:avoid;}
.topnav li{ line-height40px; height:40px;}
.topnav li b{ font-size:16px; width:100px; float:left; text-align:right}
</style>
</head>
<body>
	<div class="w1000 topnav">
		<img src='http://23mima.com/uploads/meirong_bg/1.jpg' width='100%'>
	</div>
	<div class="w1000 topnav" style='background:#fff'>

		<img src='http://23mima.com/uploads/meirong_bg/021.jpg' width='100%'>
		<ul style=' width:400px; margin:0 auto;'>
			<li><b>姓名：</b><?php echo $field['tuoye']['name'];?></li>
			<li><b>性别：</b><?php echo $field['tuoye']['sex'];?></li>
			<li><b>年龄：</b><?php echo $field['tuoye']['birthtime'];?></li>
			<li><b>联系电话：</b><?php echo $field['tuoye']['tel'];?></li>
			<li><b>联系地址：</b><?php echo $field['tuoye']['adress'];?></li>
			<li><b>绑定日期：</b><?php echo $field['tuoye']['name'];?></li>
			<li><b>报告日期：</b><?php echo $field['tuoye']['name'];?></li>
			<li><b>样品编号：</b><?php echo $field['tuoye']['identifier'];?></li>
		</ul>
	</div>
	<div class="w1000 topnav">
		<img src='http://23mima.com/uploads/meirong_bg/3.jpg' width='100%'>
	</div>
	<div class="w1000 topnav">
		<img src='http://23mima.com/uploads/meirong_bg/4.jpg' width='100%'>
	</div>
	<div class="w1000 topnav">
		<img src='http://23mima.com/uploads/meirong_bg/5.jpg' width='100%'>
	</div>
	<div class="w1000 topnav">
		<img src='http://23mima.com/uploads/meirong_bg/061.jpg' width='100%'>
		<div class="row" style="margin-bottom:0;">
			<div class="tab">			
				<div id="container" style="width:800px;height:800px;margin:0 auto;"></div>
				<script>
					$(function() {
						$('#container').highcharts({
							chart: {
								polar: true,
								backgroundColor: {
									linearGradient: [0, 300, 300, 400],
									stops: [
										[0, '#849cc8'],
										[1, '#849cc8'],
										[1, '#849cc8']
									]
								},
							},
							pane: {
								size: '80%',
								background: [ {
												backgroundColor: '#eeefef',
												borderWidth: 0,
												outerRadius: '100%'
											}]
							},
							title: {
								text: null
							},
							tooltip: {
								enabled: false
							},
							legend: {
								enabled: false
							},
							credits: {
								enabled: false
							},
							xAxis: {

								categories: [
								<?php foreach ($zheye as $v){ ?>
								<?php foreach ($v as $j){ ?>
								'<?php if(isset($j['name'])){echo $j['name'];} ?>',
								<?php } ?>
								<?php } ?>
								],
								tickmarkPlacement: 'on',
								lineWidth: 0,
								labels: {
									style: {
										color: '#7f7f80',
										fontSize: '24px'
									}
								}
							},
							yAxis: {
								categories: ["", "", "", "", "", "", "", ""],
								tickmarkPlacement: 'on',
								lineWidth: 0
							},
							plotOptions: {
								series: {
									color: '#849cc8',
									lineWidth: 0,

								}
							},
							series: [{
								type: 'area',
								name: 'Area',

								data: [													
								<?php foreach ($zheye as $v){ ?>
								<?php foreach ($v as $j){ ?>
								<?php if(isset($j['fenshu1'])){echo $j['fenshu1'];} ?>,
								<?php } ?>
								<?php } ?>]
							}]
						});
					});
				</script>
			</div>
			
		</div>
		</div>
		<img src='http://23mima.com/uploads/meirong_bg/062.jpg' width='100%'>
		
		
	</div>
	
</body>
<script src="/public/gaiban/js/fit_a.js"></script>
</html>