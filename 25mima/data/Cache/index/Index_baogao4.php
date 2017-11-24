<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>基因检测结果-美容基因 </title>
<meta name="Description" content="" />
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jyy_a_bg.css" rel="stylesheet" type="text/css" />
<link href="/public/gaiban/css/fit_a_bg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/public/js/echarts.js"></script>
<!-- <script type="text/javascript" src="/public/gaiban/js/highcharts.js"></script>
<script type="text/javascript" src="/public/gaiban/js/highcharts-more.js"></script> -->
<style>
.ml20{margin-left:20px; }
.w1000{width:100%; page-break-inside:avoid;}
table {
    width: 480px;
    text-align: center;
    border-top: 4px solid #d2d2d2;
}
p{text-align: justify;}
table tr{color:#515151;height: 74px;}
.tr th{
	font-size: 16px;
}
.beizhu{text-align: right;width: 100%;line-height: 36px;margin-top: 20px;}
.topnav li{ line-height40px; height:40px; list-style:none;}
.topnav li b{ font-size:16px; width:100px; float:left; text-align:right}

.cont{
	width:1060px;margin:0 auto;position: relative;background-position: 100% 0%; background-size:100%;background-repeat:no-repeat;
}
.bg1{
	background-image: url(/public/gaiban/images/bg8.jpg);
}
.bg2{
	background-image: url(/public/gaiban/images/bg9.jpg);
}
.cont span{
	color: #a196d6;font-size: 30px;
}
.dnap{
	text-align: center;font-size: 34px;color: #b097c1;margin-top: 200px;
}
.zbgp{
	margin: 80px auto;font-size: 19px;width: 825px;line-height: 42px;color: #3f3b3a;
}
.titlep{
	font-size: 28px;position: absolute;left: 80px;top: 110px;
}
.leftdiv{
	width: 480px;/*height:810px;*/float: left;border-right: 2px solid #d2d2d2;padding-right: 20px;
}
.commonp{
	line-height: 26px;margin-top: 60px;font-size: 16px;color: #3f3b3a;
}
.commonp span,.lastp span,.applebgp span{
	color: #c6b6d2;display: block;font-size: 23px;margin-bottom: 10px;
}
.lastp{
	margin-left: 10px;padding: 10px;height: 460px;line-height: 26px;margin-top: 40px;font-size: 16px;color: #3f3b3a;background: #fbeffa;width: 90%;
}
.rightdiv{
	width: 540px;float: left;
}
.applebg{
	display: inline-block;width: 215px;height: 170px;background: url(/public/gaiban/images/apple.png);background-size:180px 180px;background-repeat:no-repeat;border-right: 4px solid #d2d2d2;
}
.applebgp{
	float: right;width: 284px;line-height: 26px;font-size: 16px;color: #3f3b3a;
}

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
			<li><b>性别：</b><?php echo $field['tuoye']['rcvSex']?'男':'女';?></li>
			<li><b>年龄：</b><?php echo $field['tuoye']['birthtime'];?></li>
			<li><b>联系电话：</b><?php echo $field['tuoye']['tel'];?></li>
			<li><b>联系地址：</b><?php echo $field['tuoye']['adress'];?></li>
			<li><b>绑定日期：</b><?php echo date("Y-m-d H:i",$field['tuoye']['time0']);?></li>
			<li><b>报告日期：</b><?php echo date("Y-m-d H:i",$field['tuoye']['time5']);?></li>
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
				<div id="container" style="width:800px;height:500px;margin:0 auto;"></div>
				<script>
				 var myChart = echarts.init(document.getElementById('container'));
					option = {
						
						    radar: [
						       
						        {
						            indicator: [
						            <?php if (!empty($this->zheye)) {
						            	foreach ($this->zheye as $key=>$value) {
						            		foreach($value as $vname) {
						            			echo '{text:\''.$vname['name'].'\',max:100,\'color\':\'#000\'},';
						            		}
						            	}

						            ?>
						            <?php }?>
						            ],
						            radius: 200
						        }
						    ],
						    series: [
						        {
						            name: '成绩单',
						            type: 'radar',
						            radarIndex: 0,
						            data: [
						                {
						                    value: [
						             <?php if (!empty($this->zheye)) {
						            	foreach ($this->zheye as $key=>$value) {
						            		foreach($value as $vname) {
						            			echo $vname['fenshu'].',';
						            		}
						            	}

						            ?>
						            <?php }?>
						 

						                    ],
						                    name: '李四',
						                     lineStyle: {
						                        normal: {
						                            color:"#b097c1"
						                        }
						                    },
						                    itemStyle : {
						                         normal : {
						                            color:'#b097c1'
						                        }
						                    },
						                    areaStyle: {
						                        normal: {
						                            opacity: 0.7,
						                            color: new echarts.graphic.RadialGradient(0.5, 0.5, 1, [
						                                {
						                                    color: '#c6b6d2',
						                                    offset: 0
						                                },
						                                {
						                                    color: '#c6b6d2',
						                                    offset: 1
						                                }
						                            ])
						                        }
						                    }
						                }
						            ]
						        }
						    ]
						}
						myChart.setOption(option);
				</script>
			</div>
			
		</div>
		<div class="dnap">
			您的DNA年龄得分
			<p style="text-align: center;font-size: 50px;color: #b097c1;margin-bottom: 20px;"><?php echo $this->dnaScore;?></p>
			<div  style="border-radius: 100px;width: 500px;height: 30px;background-color: #ccc;position: relative;left: 32%;"> 
				<div style="border-radius: 100px;width: <?php echo "$this->dnaScore".'%';?>;height: 30px;background-color: #b097c1;">
				
				</div>
				<span style="position: absolute;left: 0%;">0</span>
				<span style="position: absolute;left: 23%;">25</span>
				<span style="position: absolute;left: 48%;">50</span>
				<span style="position: absolute;left: 73%;">75</span>
				<span style="position: absolute;left: 95%;">100</span>
			</div>
			
		</div>
		<p class="zbgp">
			我们通过分析从您口腔里收集的细胞DNA样本来检测您皮肤的遗传健康状态，主要通过以上9个方面来检测您皮肤的遗传健康状态。我们将通过计算您的DNA变化的数量和位置（或是独特基因标记）以及其影响正常细胞功能的程度来对您肌肤的遗传健康进行打分。详细的检测项目将会在分报告中一一展现。
		</p>
	</div>
	

<!--子报告开始  -->
	<div class="w1000" >
		<div class="cont bg1">
			<p class="titlep"> 抗紫外线过敏能力：<span><?php echo $this->fzheye['4']['fenshu1']==5 ?'强':($this->fzheye['4']['fenshu1']==4 ?'一般':'弱'); ?></span></p>
			<div style="margin-left: 60px;padding-top: 160px;">
				<svg height="340" version="1.1" width="250" xmlns="http://www.w3.org/2000/svg">
					<circle cx="125" cy="125" r="100" stroke="#ccc"stroke-width="20" fill="#fff"/>
					<path class="ring" stroke-linecap="round" rate="<?php echo $this->fzheye['4']['fenshu']-0.01;?>" fill="none" x="125" y="125" r="100" stroke="#a196d6"  stroke-width="24" />
					<text fill="<?php if(1){echo '#3f3b3a';}else{echo '#c9c9c9';} ?>">
						<tspan x='46' y='150' style="font-size:72px"><?php echo $this->fzheye['4']['fenshu'];?></tspan>
						<tspan x='<?php if(strpos($this->fzheye['4']['fenshu'],".")!==false || $this->fzheye['4']['fenshu']==100) {echo 180;}else{echo 145;} ?>' y='145' style="font-size:36px">%</tspan>
						<tspan x='40' y='280' style="font-size:18px;">您的分数: <?php echo $this->fzheye['4']['fenshu'];?>%</tspan>
					</text>
				</svg>
				<svg height="340" version="1.1" width="280" style="margin-left:50px" xmlns="http://www.w3.org/2000/svg">
					<circle cx="125" cy="125" r="100" stroke="#ccc"stroke-width="20" fill="#fff"/>
					<path class="ring" stroke-linecap="round" rate="<?php echo 10;?>" fill="none" x="125" y="125" r="100" stroke="#f7a0bc"  stroke-width="24" />
					<text fill="<?php if(1){echo '#3f3b3a';}else{echo '#c9c9c9';} ?>">
						<tspan x='46' y='150' style="font-size:72px"><?php echo $this->fzheye['4']['fenshu'];?></tspan>
						<tspan x='<?php if(strpos($this->fzheye['4']['fenshu'],".")!==false || $this->fzheye['4']['fenshu']==100) {echo 180;}else{echo 145;} ?>' y='145' style="font-size:36px">%</tspan>
						<tspan x='40' y='280' style="font-size:18px;">人口中的中等程度: <?php echo 
						$this->fzheye['4']['totalscore']/($this->fzheye['4']['good']+$this->fzheye['4']['common']+$this->fzheye['4']['excellent']);

						?>%</tspan>
					</text>
				</svg>
			</div>

			<p style="font-size: 16px;width: 780px;line-height: 30px;color: #3f3b3a;">
				紫外线过敏是日光作用于人体所引起的异常光变态性反应，人体中只要有少量的光感物质，经紫外线照射即会发生反应，表现为面、颈、前臂、身侧、手背等易暴露部位出现红斑、丘疹、风团或水疱样皮疹，经日光照射后，皮损明显加重，瘙痒感加剧。
			</p>

		</div>


		<div style="width:1060px;margin:50px auto;">
			<div class="leftdiv">
				<table>
					<thead>
						<tr class="tr">
							<th>测基因</th><th>位点</th><th>基因型</th><th>检测结果</th><th>PF%</th>
						</tr>
					</thead>
					<tbody>
						<tr >
							<td style="font-size: 16px;color: #3f3b3a;">COL5A1</td>
							<td style="font-size: 16px;color: #3f3b3a;">身体柔韧性</td>
							<td style="font-size: 16px;color: #3f3b3a;">CT</td>
							<td style="font-size: 16px;color: #3f3b3a;">身体柔韧性</td>
							<td style="font-size: 16px;color: #3f3b3a;">身体柔韧性</td>
						</tr>				
					</tbody>
				</table>
				<p class="beizhu" style="margin-top: 0px;">*注：FP%-在人口出现的频率，随数据的增多而进行不断的变化
				</p>

				<p class="commonp" style="margin-top: 20px;">
					<span >关于本系列</span>
					阳光中的UVA和UVB这两种穿透性紫外线，会直达皮肤真皮层，使过敏体质人群收照射区皮肤出现红、灼、热、痛，这便是医学是常说的日光性皮炎，即紫外线过敏；同时，紫外线辐射还会导致“健康杀手”——自由基在体内急剧增加，是局部皮肤产生皱纹、色素沉积、细胞损害，甚至可改变免疫系统，造成更严重的光毒性或光过敏反应。
				</p>

				<p class="commonp">
					<span >抗紫外线能力弱的表现</span>
					经紫外线照射即会发生反应，表现为面、颈、前臂、身侧、手背等易暴露部位出现红斑、丘疹、风团或水泡样皮疹，经日光照射后，皮损明显加重，瘙痒感加剧。
				</p>

				<p class="commonp">
					<span >为何我们要注意皮肤防晒</span>
					紫外线中的UVB的伤害和防护已经得到彻底的研究，它可以使皮肤在短时间内晒伤、晒红（对一般人来说是25分钟左右）。而UVA是可怕的阳光杀手，它借着波长比较长，穿透力强的本领，可以穿透皮肤表层，深入真皮以下组织，可以破坏胶原蛋白，弹性纤维组织等皮肤内部的细微结构，产生皱纹和幼纹，令皮肤松弛衰老。
				</p>
			</div>
		</div>

		<div class="rightdiv">
			<div class="ml20">
				<span class="applebg">
					
				</span>
				<p class="applebgp">
					<span style="color: #c6b6d2;display: block;font-size: 23px;margin-bottom: 10px;">紫外线的危害</span>
					紫外线是加速皮肤老化的原因之一，阳光损伤的症状包括：皮肤纹理改变，色素改变，皮肤癌。而且皮肤问题显现出来时，损伤已经产生太久。
				</p>
			</div>
			<p class="ml20 commonp" style="margin-top: 80px;">
					<span >抗紫外线能力DNA检测</span>
					帮助识别皮肤抗紫外线能力，提醒注意使用抗紫外线护肤产品、适当补充谷胱甘肽降低光敏风险。
			</p>

			<p class="lastp" >
					<span >科学建议</span>
					有些人天生对阳光过敏，曝晒后可能会出现成片红斑、水肿、丘疹、丘疱疹，严重者伴有发热、畏寒症状。这种表现称做多形性日光疹，多发于炎热的夏季，女性发病率高于男性。<br>目前该疾病的致病机制尚不明确，但较为公认的是以下两方面：一是紫外线照射，二是遗传因素的影响。谷胱甘肽转移酶P1（GSTP1）基因上的位点rs1695突变，会使氨基酸由异亮氨酸变为缬氨酸，导致谷胱甘肽蛋白结构发生改变，使得个体对阳光过敏的风险增高。<br>花青素和维生素E可以保护人体免受阳光伤害，延缓光老化、预防晒伤和抑制日晒红斑的生成，蓝莓中的紫檀芪可有效抗炎、抗癌、抗氧化，黑莓中的硒可提高人体免疫力，对紫外线过敏的人群需要多服用蔓越莓、黑莓、蓝莓等富含花青素的水果，保护机体免受紫外线伤害。

			</p>
		</div>
		<div style="clear: both;"></div>
	</div>
	<!--子报告结束  -->		

	<!--子报告开始2  -->
	<div class="w1000" >
		<div class="cont bg2">
			<p class="titlep"> 抗紫外线过敏能力：<span><?php echo $this->fzheye['4']['fenshu1']==5 ?'强':($this->fzheye['4']['fenshu1']==4 ?'一般':'弱'); ?></span></p>
			<div style="margin-left: 60px;padding-top: 160px;">
				<svg height="340" version="1.1" width="250" xmlns="http://www.w3.org/2000/svg">
					<circle cx="125" cy="125" r="100" stroke="#ccc"stroke-width="20" fill="#fff"/>
					<path class="ring" stroke-linecap="round" rate="<?php echo $this->fzheye['4']['fenshu']-0.01;?>" fill="none" x="125" y="125" r="100" stroke="#a196d6"  stroke-width="24" />
					<text fill="<?php if(1){echo '#3f3b3a';}else{echo '#c9c9c9';} ?>">
						<tspan x='46' y='150' style="font-size:72px"><?php echo $this->fzheye['4']['fenshu'];?></tspan>
						<tspan x='<?php if(strpos($this->fzheye['4']['fenshu'],".")!==false || $this->fzheye['4']['fenshu']==100) {echo 180;}else{echo 145;} ?>' y='145' style="font-size:36px">%</tspan>
						<tspan x='40' y='280' style="font-size:18px;">您的分数: <?php echo $this->fzheye['4']['fenshu'];?>%</tspan>
					</text>
				</svg>
				<svg height="340" version="1.1" width="280" style="margin-left:50px" xmlns="http://www.w3.org/2000/svg">
					<circle cx="125" cy="125" r="100" stroke="#ccc"stroke-width="20" fill="#fff"/>
					<path class="ring" stroke-linecap="round" rate="<?php echo 10;?>" fill="none" x="125" y="125" r="100" stroke="#f7a0bc"  stroke-width="24" />
					<text fill="<?php if(1){echo '#3f3b3a';}else{echo '#c9c9c9';} ?>">
						<tspan x='46' y='150' style="font-size:72px"><?php echo $this->fzheye['4']['fenshu'];?></tspan>
						<tspan x='<?php if(strpos($this->fzheye['4']['fenshu'],".")!==false || $this->fzheye['4']['fenshu']==100) {echo 180;}else{echo 145;} ?>' y='145' style="font-size:36px">%</tspan>
						<tspan x='40' y='280' style="font-size:18px;">人口中的中等程度: <?php echo 
						$this->fzheye['4']['totalscore']/($this->fzheye['4']['good']+$this->fzheye['4']['common']+$this->fzheye['4']['excellent']);

						?>%</tspan>
					</text>
				</svg>
			</div>

			<p style="font-size: 16px;width: 780px;line-height: 30px;color: #3f3b3a;">
				紫外线过敏是日光作用于人体所引起的异常光变态性反应，人体中只要有少量的光感物质，经紫外线照射即会发生反应，表现为面、颈、前臂、身侧、手背等易暴露部位出现红斑、丘疹、风团或水疱样皮疹，经日光照射后，皮损明显加重，瘙痒感加剧。
			</p>

		</div>


		<div style="width:1060px;margin:50px auto;">
			<div class="leftdiv">
				<table>
					<thead>
						<tr class="tr">
							<th>测基因</th><th>位点</th><th>基因型</th><th>检测结果</th><th>PF%</th>
						</tr>
					</thead>
					<tbody>
						<tr >
							<td style="font-size: 16px;color: #3f3b3a;">COL5A1</td>
							<td style="font-size: 16px;color: #3f3b3a;">身体柔韧性</td>
							<td style="font-size: 16px;color: #3f3b3a;">CT</td>
							<td style="font-size: 16px;color: #3f3b3a;">身体柔韧性</td>
							<td style="font-size: 16px;color: #3f3b3a;">身体柔韧性</td>
						</tr>				
					</tbody>
				</table>
				<p class="beizhu">*注：FP%-在人口出现的频率，随数据的增多而进行不断的变化
				</p>

				<p class="commonp" >
					<span >关于本系列</span>
					从生理角度来说，人的基础代谢从25岁就开始缓慢下降，皮肤的老化在30岁之前就开始表现出来。
				</p>

				<p class="commonp">
					<span >我们为什么要抗衰</span>
					表皮细胞的分化衰老收到外界环境和自身因素的影响。皮肤细胞在日晒，风吹等外界环境的作用下，很容易分化衰老。
				</p>

				<p class="commonp">
					<span >抗衰老能力差的表现</span>
					<img src="/public/gaiban/images/baogao/pimg/p1.jpg">
				</p>
			</div>
		</div>

		<div class="rightdiv">
			<p class="ml20 commonp" style="margin-top: 0;">
					<span >皮肤衰老曲线图</span>
					<img src="/public/gaiban/images/baogao/pimg/p2.jpg">
			</p>

			<p class="ml20 commonp" style="margin-bottom: 15px;margin-top: 35px;">
					<span >抗衰老指数DNA检测</span>
					抗衰老指数反应您的衰老速度是否处于正常的范围之内。
					<p>
					<span style="padding-right: 19px;margin-right:16px;float:left;width: 242px;line-height: 24px;border-right: 1px solid #d2d2d2;font-size: 16px;">
					<img width="76px;" src="/public/gaiban/images/baogao/pimg/p3.jpg" style="float:left;margin: 0px 10px 0px 10px;">
					正常衰老速度，皮肤处于较为健康的生理状态。
					</span>
					<span style="float:left;width: 238px;line-height: 24px;font-size: 16px;">
					<img width="76px;" src="/public/gaiban/images/baogao/pimg/p4.jpg" style="float:left;margin-right: 15px;">
					基因突变导出衰老速度快于正常速度。皮肤加速老化。
					</span>
					</p>
			</p>
			<div style="clear: both;"></div>

			<p class="lastp" >
					<span >科学建议</span>
					表皮细胞的分化衰老受到外界环境和自身因素的影响。皮肤细胞在日晒，风吹等外界环境的作用下，很容易分化衰老。STXBP5L基因在皮肤老化，皱纹的产生和皮肤下垂中起重要作用。研究人员发现携带T等位基因的人群更易抵抗外界环境，如光带来的细胞分化衰老。TERC基因上的位点rs10936599由C突变为T时，会使个体的平均端粒变短，细胞寿命变短，抗衰老能力降低，相当于使身体年龄比实际年龄大8岁左右。<br>
<br>
皮肤成分中有70%是由胶原蛋白组成，人体衰老的过程就是胶原蛋白流失的过程。补充胶原蛋白不但可以去皱纹，还能消除黑眼圈、红血丝。胶原蛋白还承担着刺激能产激素的腺体分泌的作用，平衡激素分泌，改善内分泌失调，延缓衰老。


			</p>
		</div>
		<div style="clear: both;"></div>
	</div>
	<!--子报告结束  -->	

</body>

<script src="/public/gaiban/js/fit_a.js"></script>
</html>