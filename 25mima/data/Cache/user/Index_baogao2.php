<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>23密码 | 基因检测结果</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jyy_a_bg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/public/gaiban/js/highcharts.js"></script>
<script type="text/javascript" src="/public/gaiban/js/highcharts-more.js"></script>
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	<div class="w1000 topnav">
		
			<div class="left"><a>我的报告</a>｜<span>报告概览</span></div>
			<div class="right">
				<?php $this->display('baogao','lib') ?>
			</div>
		
	</div>
	<div class="w1000">
		<div class="row" style="margin-bottom:0;">
			<span class="">您的宝贝</span>
			<?php
			if($field1['moban'] == 'baogao2'){
				echo '<h3><span>小</span><span>天</span><span>才</span><span>基</span><span>因</span></h3>';
			}else{
				echo '<h3><span>特</span><span>长</span><span>基</span><span>因</span><span>眼</span></h3>';
			}
			?>
			
			<span class="">检测结果</span>
			<div class="tab">
				<div class="field">
					<span><?php echo $field['tuoye']['name'];?></span>
					<span><?php echo $field['tuoye']['birthtime'];?></span>
				</div>
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
	<img src="/public/gaiban/images/xtc.jpg" width="100%" />
	
		<div class="w1000 overflow">
			<div class="row">
				<?php foreach ($zheye as $v){ ?>
				<?php foreach ($v as $j){ ?>
				<a class="item" href='<?php echo U("Index/baogao1/id/$_GET[id]/key/$j[id]/f/$j[fenshu1]") ?>'>
					<img src="<?php if(isset($j['litpic'])){echo $j['litpic'];} ?>" class="left" width="200px"/>
					<div class="left">
						<p class="title"><?php if(isset($j['name'])){echo $j['name'];} ?></p>
						<span>
						<?php
						for($i=1;$i<=5;$i++){
			  				if($i<=$j['fenshu1']){
			  					echo '<img src="/public/gaiban/images/tal_star.png" />';
			  				}else{
			  					//echo '<img src="/public/baogao/tal_star.png" class="tal-star pictures">';
			  				}
			  			}
						?>
						</span>
						<p class="desc"><?php if(isset($j['name'])){echo $j['name'];} ?><?php if(isset($j['pingjia'])){echo $j['pingjia'];} ?></p>
					</div>
				</a>
				<?php } ?>
				<?php } ?>
			</div>
		</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
<script src="/public/gaiban/js/fit_a.js"></script>
</html>