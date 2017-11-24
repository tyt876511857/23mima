<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>特长基因眼示例报告</title>
		<?php $this->display('css','lib') ?>
		<script type="text/javascript" src="/public/wap1/js/highcharts.js"></script>
		<script type="text/javascript" src="/public/wap1/js/highcharts-more.js"></script>
		<style>
			.grad {
				background: -webkit-linear-gradient(left top, #163554, #19699E, #163554);
				/* Safari 5.1 - 6.0 */
				background: -o-linear-gradient(bottom right, #163554, #19699E, #163554);
				/* Opera 11.1 - 12.0 */
				background: -moz-linear-gradient(bottom right, #163554, #19699E, #163554);
				/* Firefox 3.6 - 15 */
				background: linear-gradient(to bottom right, #163554, #19699E, #163554);
				/* 标准的语法 */
			}
			
		</style>
	</head>

	<body class="grad">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<div ui-row>
				<div id="container" style="width:100%;height:3.5rem;"></div>
				<script>
					$(function() {
						$('#container').highcharts({
							chart: {
								polar: true,
								backgroundColor: {
									linearGradient: [0, 300, 300, 400],
									stops: [
										[0, 'rgb(22, 53, 84)'],
										[1, 'rgb(25, 105, 158)'],
										[1, 'rgb(22, 53, 84)']
									]
								},
							},
							pane: {
								size: '65%'
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
										color: '#FFFFFF',
										fontSize: '1em'
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
									color: 'rgba(233,204,113,.9)',
									lineWidth: 0,

								}
							},
							series: [{
								type: 'area',
								name: 'Area',

								data: [<?php foreach ($zheye as $v){ ?>
								<?php foreach ($v as $j){ ?>
								<?php if(isset($j['fenshu1'])){echo $j['fenshu1'];} ?>,
								<?php } ?>
								<?php } ?>]
							}]
						});
					});
				</script>
				<img src="/public/wap1/images/report/top.png" alt="" width="100%" />
				<h3 style="text-align: center;font-size: 1.5em;color: #FFFFFF;"><?php if(isset($field1['name'])){echo $field1['name'];} ?></h3>
				<div class="ui-row gene_con">
					<?php foreach ($zheye as $v){ ?>
					<?php foreach ($v as $j){ ?>
					<div class="ui-whitespace gene_con_cell">
						<a href='<?php echo U("Index/baogao1/id/$_GET[id]/key/$j[id]/f/$j[fenshu1]") ?>'>
							<div class="gene_con_bg">
								<div class="gene_con_word">
									<p style="color:#3D393A;font-size: 1.5em;"><?php if(isset($j['name'])){echo $j['name'];} ?></p>
									<p style="color: #58585A;"><?php if(isset($j['name'])){echo $j['name'];} ?><?php if(isset($j['pingjia'])){echo $j['pingjia'];} ?></p>
								</div>
							</div>
							<div class="gene_con_pic"><img src="<?php if(isset($j['litpic1'])){echo $j['litpic1'];} ?>" alt="" width="100%">
								<div class="light lv<?php if(isset($j['fenshu1'])){echo $j['fenshu1'];} ?>">
							<?php
					  			for($i=1;$i<=5;$i++){
					  				if($i<=$j['fenshu1']){
					  					echo '<img src="/public/baogao/tal_star.png" class="tal-star">';
					  				}else{
					  					echo '<img src="/public/baogao/tal_star.png" class="tal-star pictures">';
					  				}
					  			}
					  		  ?>
									</div>
							</div>
							<style>
.light{background:none;}.light img{width:20px;}.pictures{filter: alpha(opacity=50) Gray;-webkit-filter: grayscale(100%);opacity: 0.5;}
							</style>
						</a>
					</div>
					<?php } ?>
					<?php } ?>
					
					</div>
				</div>
				<img src="/public/wap1/images/report/bottom.png" width="100%" alt="" style="position: relative;bottom:-10px">
			</div>
		</section><?php $this->display('footer','lib') ?>
	</body>
</html>
<style>
.gene_con_cell:nth-child(even) .gene_con_word{right:35%;}
.power5{width:150px;}
.power4{width:120px;}
.power3{width:100px;}
</style>