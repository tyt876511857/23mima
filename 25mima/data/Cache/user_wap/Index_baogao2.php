<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>小天才基因报告</title>
		<?php $this->display('css','lib') ?>
		<script type="text/javascript" src="/public/wap1/js/highcharts.js"></script>
		<script type="text/javascript" src="/public/wap1/js/highcharts-more.js"></script>
	</head>

	<body style="background: #FFFFFF;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<div class='ui-row'>
				<div id="container" style="width:100%;height:3.5rem;"></div>
				<script>
					$(function() {
						$('#container').highcharts({
							chart: {
								polar: true
							},
							 pane: {
								size: '60%'
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
								lineWidth: 0
							},
							yAxis: {

								categories: ["", "", "", "", "", "", "", ""],
								tickmarkPlacement: 'on',
								lineWidth: 0
							},
							plotOptions: {
								series: {
									color: 'rgba(233,204,113,.9)',
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
				<img src="/public/wap1/images/report/top.png" alt="" width="100%" />
				<h3 style="text-align: center;font-size: 1.5em;"><?php if(isset($field1['name'])){echo $field1['name'];} ?></h3>
				<div class="ui-row gene_con">
					<?php foreach ($zheye as $v){ ?>
					<?php foreach ($v as $j){ ?>
					<div class="ui-whitespace gene_con_cell">
						<a href='<?php echo U("Index/baogao1/id/$_GET[id]/key/$j[id]/f/$j[fenshu1]") ?>'>
								<div class="gene_con_bg">
									<div class="gene_con_word">
										<p style="color:#3D393A;font-size: 1.5em;"><?php if(isset($j['name'])){echo $j['name'];} ?></p>
										<p style="color: #58585A;"><?php if(isset($j['name'])){echo $j['name'];} ?><?php if(isset($j['pingjia'])){echo $j['pingjia'];} ?></p>
										<p style="color: #58585A;">点击详情</p>
								</div>
								</div>
								<div class="gene_con_pic"><img src="<?php if(isset($j['litpic1'])){echo $j['litpic1'];} ?>" alt="" width="100%">
									<div class="power power100 power5" style="background:url(/public/wap1/images/xuetiao<?php if(isset($j['fenshu1'])){echo $j['fenshu1'];} ?>.png) no-repeat center top;height:27px;background-size:100% 100%;"></div>
								</div>
							</a>
							<style>.power{width:200px;}</style>
					</div>
					<?php } ?>
					<?php } ?>
				</div>
				<img src="/public/wap1/images/report/bottom.png" width="100%" alt="" style="position: relative;bottom:-10px">
			</div>
		</section><?php $this->display('footer','lib') ?>
	</body>

</html>
<style>
.gene_con_cell:nth-child(even) .gene_con_word{right:35%;}
</style>