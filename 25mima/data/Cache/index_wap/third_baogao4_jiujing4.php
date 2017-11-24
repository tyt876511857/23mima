<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>基因检测结果-酒精代谢基因 </title>
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jyy_a_bg.css" rel="stylesheet" type="text/css" />
<link href="/public/gaiban/css/fit_a_bg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/public/js/echarts.simple.min.js"></script>
<!-- <script type="text/javascript" src="/public/js/echarts.js"></script> -->
<!-- <script type="text/javascript" src="/public/gaiban/js/highcharts.js"></script>
<script type="text/javascript" src="/public/gaiban/js/highcharts-more.js"></script> -->
<style>
.indenx{padding: 0px 18px;}
p{text-align: justify;word-break: break-all;}
.ml20{margin-left:0px; }
.w1000{width:100%; page-break-inside:avoid;}
table {
    width: 100%;
    text-align: center;
    border-top: 4px solid #d2d2d2;
}
.tr th{
	font-size: 13px;
}
.topnav li{ line-height40px; height:40px; list-style:none;}
.topnav li b{ font-size:16px; width:100px; float:left; text-align:right}

.cont{
	width:100%;margin:0 auto;background: url(/public/gaiban/images/baogao/thirdbg4.jpg);background-position: 100% 0%; background-size:100%;background-repeat:no-repeat;position: relative;
}
.cont span{
	color: #21acdc;font-size: 30px;
}
.dnap{
	text-align: center;font-size: 34px;color: #b097c1;margin-top: 200px;
}
.zbgp{
	margin: 80px auto;font-size: 19px;width: 100%;line-height: 42px;color: #3f3b3a;
}
.titlep{padding-top: 130px;text-align: center;font-size: 23px;}
.leftdiv{
	width: 92%;margin: 0 auto;
}
.commonp{
	text-align: justify;line-height: 26px;margin-top: 40px;font-size: 15px;color: #3f3b3a;padding: 10px;
}
.commonp span,.lastp span,.applebgp span{
	color: #fff;display: block;font-size: 23px;margin-bottom: 10px;
}
.lastp{
	padding: 40px 10%;line-height: 31px;font-size: 15px;color: #fff;
}
.rightdiv{
	background: -webkit-gradient(linear, 0% 25%, 75% 100%, from(#21acdc), to(#81c4bf));
	width: 100%;
}
.rightdiv img{margin-top: -10px;margin-bottom: 50px;width: 100%;}
.chantu{
	border-radius: 100px;height: 20px;background-color: #ccc;position: relative;width: 80%;margin: 0 auto;
}
.chantu div{border-radius: 100px;width: <?php echo $this->fzheye['0']['fenshu1']*20;?>%;height: 20px;background: -webkit-gradient(linear, 0% 25%, 75% 100%, from(#21acdc), to(#81c4bf));}
.chantu span{font-size: 16px;color: #000;line-height: 30px;}
.yuan{display: inline-block;width: 8px;height: 8px;border-radius: 14px;background:#59A0C1;margin-bottom: 9px;margin-left: 6px;}
.yuanh{display: inline-block;width: 8px;height: 8px;border-radius: 14px;background: #ccc;margin-bottom: 9px;
 	margin-left: 6px;}
.ping{margin-top: 10px;}
.ban{margin-left: 10px;}
.topul li{ float: left;width: 20%;height: 40px; }
.cur{background: -webkit-gradient(linear, 0% 25%, 75% 100%, from(#21acdc), to(#81c4bf));color: #fff;}
.topul li span{line-height: 20px;width: 100%;text-align: center;display: inline-block;border-right: 1px solid #d2d2d2;margin-top:10px;color: inherit;}
.topul2 li{ float: left;width:49.8%;height: 70px;line-height: 20px;text-align: center;display: inline-block;border-right: 1px solid #d2d2d2;margin-top:10px;color:#000;font-size: 18px; }
.topul2{width: 90%;height: 100px;margin:0 auto;box-shadow:3px 3px 4px #e6e2e1;}
.topul2 li p{top:30px;color: #f29600;font-size: 20px;text-align: center;margin-top: 7px;font-weight: bold;}
#toolb li {float: left;height: 70px;width: 60px;border-radius: 15px;text-align: center;font-size: 16px;border:1px solid #fff;}
#toolb li span {display: inline-block;background: #91c7ae;width: 50px;height: 20px;border-radius: 10px;margin-top:13px;}
.qapf{background: #e6e2e1;line-height: 34px;font-size: 16px;padding: 0 10%;color: #3f3b3a;margin-top: 20px;}
.qapt{width: 80%;margin: 0 auto;line-height: 30px;font-size: 16px;color: #3f3b3a;text-indent:32px}
.jinp{width: 90%;margin: 20px auto;box-shadow: 3px 3px 4px 4px #e6e2e1;padding: 20px 0;}
.jinp p{padding: 0 20px;line-height: 23px;color: #3f3b3a;}
p.renqun{text-align: center;color: #1593e7;font-size: 20px;margin-top: 40px;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var $fen = <?php echo $this->fzheye['0']['defen'];?>;
		var $baseWidth = $(window).width()/2*0.9-165;
		var $titleWidth = $(window).width()/2*0.9-93;
		var $top;
		var $index;
		if ($fen > 92) {
			$baseWidth = $baseWidth+245;
			$top = '105px';
			$index = 4;
			$color = '#c23531';
		} else if($fen > 84) {
			$baseWidth = $baseWidth-10;
			$top = '240px';
			$index = 3;
			$color = '#d48265';
		} else if($fen > 69) {
			$baseWidth = $baseWidth+245;
			$top = '240px';
			$index = 2;
			$color = '#334b5c';
		} else if($fen > 55) {
			$baseWidth = $baseWidth+140;
			$top = '318px';
			$index = 1;
			$color = '#61a0a8';
		} else {
			$baseWidth = $baseWidth+20;
			$top = '105px';
			$index = 0;
			$color = '#91c7ae';
		}
		$("#titlehere").css("left",$titleWidth+'px');
		$("#here").css("left",$baseWidth+'px');
		$("#here").css("top",$top);
		$("#here").css("color",$color);
		//$(".titlep").css("padding-top",$(window).width()*186/376-55.5);
		$('#toolb div li:eq('+$index+')').css('border','1px solid '+ $color);

		$(".w1000").each(function(index,element){
			if(index== 0) {
				$(element).show();
			} else {
				$(element).hide();
			}
		});
		$("#pul li").click(function(){
			var clindex = $(this).index();
			$("#pul li").each(function(index,element){
				if (index!=clindex) {
					$(element).removeClass('cur');
					$("#pul li").eq(clindex).addClass('cur');
					$(".w1000").each(function(index,element){
						if(index== clindex) {
							$(element).show();
						} else {
							$(element).hide();
						}
					});
				}
			});
		  	//alert($(this).index());
		});
	});
</script>

</head>
<body>
<!--子报告开始  -->
<ul class="topul" id="pul">
<li id="tab1" class="cur"><span >综合结果</span></li>
<li id="tab2" ><span>检测基因</span></li>
<li id="tab3" ><span>位点解读</span></li>
<li id="tab4" ><span>Q&A</span></li>
<li id="tab5"><span style="border: none;">其他</span></li>

</ul>
<div style="clear: both;"></div>
	<div class="w1000" >
		<div class="cont">
			<p class="titlep"> 酒精代谢基因检测：<span><?php echo $this->fzheye['0']['result'];?></span></p>
			<div style="padding-top: 40px;">
				<ul class="topul2">
					<li >您的饮酒等级<p>渣渣</p></li>
					<li style="border-right:none;">您的检测得分 : <?php echo $this->fzheye['0']['defen'];?><p><?php echo $this->fzheye['0']['common'];?></p></li>
				</ul>
				<div style="clear: both;"></div>
	
			
				<p style="margin-top: 30px;text-align: center;font-size: 16px;">您的酒量：<?php $p=$this->fzheye['0']['ping'];echo $p;?>瓶啤酒

				</p>
				<div class="ping">
					<div style="margin: 0 auto;width: 242px;margin-bottom: 40px;">
						<?php if($p>=1) {?>
							<img src="/public/gaiban/images/baogao/p4.jpg" style="margin-left: 10px;">
						<?php } elseif($p>0.1) {?>
							<img src="/public/gaiban/images/baogao/p6.jpg" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/p5.jpg" style="margin-left: 10px;">
						<?php }?>
						<?php if ($p>1.1) {?>
							<span class="yuan"></span>
							<span class="yuan"></span>
							<span class="yuan"></span>
						<?php } else {?>
							<span class="yuanh"></span>
							<span class="yuanh"></span>
							<span class="yuanh"></span>
						<?php }?>

						<?php if($p>=2) {?>
							<img src="/public/gaiban/images/baogao/p4.jpg" style="margin-left: 10px;">
						<?php } elseif($p>1.1) {?>
							<img src="/public/gaiban/images/baogao/p6.jpg" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/p5.jpg" style="margin-left: 10px;">
						<?php }?>

						<?php if ($p>2) {?>
							<span class="yuan"></span>
							<span class="yuan"></span>
							<span class="yuan"></span>
						<?php } else {?>
							<span class="yuanh"></span>
							<span class="yuanh"></span>
							<span class="yuanh"></span>
						<?php }?>

						<?php if($p>2.5) {?>
							<img src="/public/gaiban/images/baogao/p4.jpg" style="margin-left: 10px;">
						<?php } elseif($p>2) {?>
							<img src="/public/gaiban/images/baogao/p6.jpg" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/p5.jpg" style="margin-left: 10px;">
						<?php }?>
					</div>
				</div>
			
			</div>
			<p style="font-size: 16px;margin:10px auto;padding:10px;line-height: 30px;color: #fff;height:400px;background: -webkit-gradient(linear, 0% 25%, 75% 100%, from(#21acdc), to(#81c4bf));width: 85%;"><b class="indenx" ></b>
				<?php echo $this->fzheye['0']['fenxi'];?>
			</p>

		</div>

		<div style="position: relative;box-shadow: 3px 3px 4px 4px #e6e2e1;width: 90%;margin:30px auto;padding-bottom: 30px;">
			<div id="container" style="width:100%;height:340px;margin:0 auto;padding-top: 20px;">
			</div>
			<span id="here" style="position: absolute;font-size: 16px;">您在这儿</span>
			<span id="titlehere" style="position: absolute;font-size: 16px;top:23px;margin:0 auto;left: 24%;">全国有<span style="color: #f29600;font-size: 20px;"><?php echo $this->fzheye['0']['percent'];?>%</span>的人与你相当</span>
			<ul id="toolb" >
				<div style="margin: 0 auto;width: 310px;">
					<li style="color: #91c7ae;">
						<span ></span>酒渣
					</li> 

					<li style="color: #61a0a8;">
						<span style="background: #61a0a8;"></span>酒徒
					</li> 
					<li style="color: #334b5c;">
						<span style="background: #334b5c;"></span>酒痴
					</li> 

					<li style="color: #d48265;" >
						<span style="background: #d48265;"></span>酒圣
					</li > 

					<li style="color: #c23531;">
						<span style="background: #c23531;"></span>酒仙
					</li> 
				</div>
			</ul>
			<div style="clear: both;"></div>
		</div>
		<script>
		 	var myChart = echarts.init(document.getElementById('container'));
			option = {
			    title : {
			        text: '',
			        x:'center'
			    },
			    tooltip : {
			        trigger: 'item',
			        formatter: "{a} <br/>{b} : {c} ({d}%)"
			    },
			    calculable : true,
			    series : [
			        {
			            name:'面积模式',
			            type:'pie',
			            radius : [20, 100],
			            center : ['50%', '50%'],
			            roseType : 'area',
			            data:[
			                {value:25, name:'酒仙'},
			                {value:20, name:'酒痴'},
			                {value:35, name:'酒徒'},
			                {value:30, name:'酒圣'},
			                {value:40, name:'酒渣'}
			            ]
			        }
			    ]
			};
			myChart.setOption(option);
		</script>
		
		<div style="clear: both;"></div>
	</div>
	<!--子报告结束  -->	






<div class="w1000">
		<div style="width:100%;margin:30px auto;">
			<div class="leftdiv">
				<table>
					<thead>
						<tr class="tr">
							<th>基因名称</th><th>您的结果</th><th>基因功能</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($this->fzheye['0']['CT'] as $key=>$vk) { ?>
						<tr>
							<td style="font-size: 12px;width: 33.3%;"><?php print_r($vk['5']);?></td>
							<td style="font-size: 12px;color: #3f3b3a;width: 33.3%;color: #f29600;"><?php print_r($vk['4']);?></td>
					
							<td style="font-size: 12px;color: #3f3b3a;width: 33.3%;"><p style="text-align: center;"><?php print_r($vk['3']);?></p></td>
						</tr>
					<?php }?>				
					</tbody>
				</table>
				<p style="width: 92%;color: #3f3b3a;margin-top: 20px;font-size: 13px;line-height: 25px;padding: 0 4%;">
				 声明：<br>本报告结果为酒精代谢能力相关联的特定基因变异。环境和生活方式等因素造成的影响不在本报告结果之内。检测结果只针对本次送检样本，非临床诊断指标；检测结果仅包括检测范围内的位点多态性，不能反应您的全部风险。由于个体差异以及其他一些不可控原因，可能出现假阳性或假阴性结果。以上结论是根据此基因携带人群的平均水平得出的，相同基因型携带者之间的个人水平有可能与相应人群的平均水平有一定差异。
				</p>

				<p class="commonp" style="box-shadow:3px 3px 4px 4px #e6e2e1;">
					<img src="/public/gaiban/images/baogao/thirdp4.jpg" width="100%">
					<b class="indenx"></b>一个人酒量的好坏，取决于其肝脏中的<a style="color: #f29600;">乙醇脱氢酶（ADH1B）</a>和<a style="color: #f29600;">乙醛脱氢酶（ALDH2）</a>的活性。酒精进入人体后，不到10%会以乙醇的形式由肺和肾排出，剩下的90%多都是在肝脏代谢的。代谢过程如下： 
<br>1、酒精在体内乙醇脱氢酶的催化下变成乙醛； 
<br>2、乙醛在体内乙醛脱氢酶的作用下变成乙酸; 
<br>3、乙酸参与到体内的多个代谢途径中，最终变成二氧化碳和水并排出体外。
<br><b class="indenx"></b>在这个过程中，乙醛脱氢酶最为关键，它使乙醛氧化为乙酸，并决定着酒精的代谢速度。每个人体内这两种酶的活性不同,决定了其对酒精的代谢能力和生理反应也各不相同。喝酒脸红是因为乙醛不能及时分解，乙醛使人体产生热效应，导致心跳频率加快，毛细血管扩张，而脸部毛细血管扩张是喝酒脸红的主要原因，同时乙醛还会刺激肠胃让人产生恶心反胃的行为。乙醛的毒性是乙醇的30倍左右，对许多组织和器官都有毒性，可能造成DNA损伤，导致组织细胞癌变，特别是可以对食道造成损伤，久而久之可能引发食道癌。乙醛对人体肝脏和胰脏功能的影响最为严重。<br><b class="indenx"></b>酒精代谢能力主要由遗传决定，有时也可被酒精诱导，经常喝酒促进酶活性增加，从而酒量增加。此外，酒精代谢能力还受种族、性别和体重等多个因素的影响。
				</p>
				
				<p style="color: #3f3b3a;margin-top: 40px;line-height: 25px;padding: 0 4%;">
				 <span style="color:#000;font-size: 15px;">参考文献</span><br>1、Yokoyama A, Yokoyama T, Matsui T, et al. Alcohol Dehydrogenase-1B (rs1229984) and Aldehyde Dehydrogenase-2 (rs671) Genotypes Are Strong Determinants of the Serum Triglyceride and Cholesterol Levels of Japanese Alcoholic Men.[J]. Plos One, 2015, 10(8):e0133460.<br>2、Murata S,Hayashida M, Ishigurotanaka Y, et al.Verification and Validation on Single Nucleotide Polymorphism Analysis of Alcohol Metabolism-Related Genes ADH1B and ALDH2, Using Dried-Saliva Samples.[J]. Rinsho Byori. 2015, 63(11):1253-1258.<br>3、Pavanello S, Snenghi R, Nalesso A, et al. Alcohol drinking, mean corpuscular volume of erythrocytes, and alcohol metabolic genotypes in drunk drivers[J]. Alcohol, 2012, 46(1):61-68.<br>4、Tsuchihashimakaya M, Serizawa M, Yanai K, et al. Gene|[ndash]|environmental interaction regarding alcohol-metabolizing enzymes in the Japanese general population[J]. Hypertension Research Official Journal of the Japanese Society of Hypertension, 2009, 32(3):207-13.

				</p>
			</div>
		</div>
</div>
<div class="w1000">

<?php foreach($this->fzheye['0']['CT'] as $key=>$vk) { ?>
	<div class="jinp">
		<p>基因：<span style="color:#f39800;"><?php echo $vk['5'];?></span></p>
		<p>位点：<?php echo $key;?></p>
		<p>您的结果：<span ><?php echo $vk['1'];?></span>    <?php echo $vk['3'];?></p>
		<p><img width="100%" src="/public/gaiban/images/baogao/gene/<?php echo $key;?>_j.png"></p>
		<p>生物学功能：<?php echo $vk['7'];?></p>
		<p class="renqun">中国人群分布图</p>
		<p><img width="100%" src="/public/gaiban/images/baogao/gene/<?php echo $key;?>.png"></p>
	</div>
<?php }?>



</div>
<div class="w1000">
<p class="qapf" style="">1、基因是什么</p>
<p class="qapt" style="">基因（gene）也称为遗传因子。是细胞内遗传物质的结构和功能单位。所有生物都含有他们各自的基因。通过指导蛋白质的合成来表达自己所携带的遗传信息，从而控制生物个体的性状表现。基因通过复制把遗传信息传递给下一代，使后代出现与亲代相似的性状。DNA 与基因的关系为基因的化学本质是DNA。可以将两者简单地看成是同一个对象的两种名称。</p>
<p class="qapf" style="">2、基因在哪里？</p>
<p class="qapt" style="">在细胞的细胞核里含有核酸，它包括DNA（脱氧核糖核酸）和RNA（核糖核酸），我们人类的基因就存在于DNA上，它就是DNA上的一个核苷酸片断。从遗传学角度讲，它就是基本遗传因子。 </p>
<p class="qapf" style="">3、什么是DNA？</p>
<p class="qapt" style="">脱氧核糖核酸，英文缩写为DNA，又称去氧核糖核酸，是染色体的主要组成部分，基因就是DNA双螺旋上面的片断。DNA具有双螺旋结构和半保留复制的结构特点。</p>
<p class="qapf" style="">4、什么是染色体？人类有多少条染色体？</p>
<p class="qapt" style="">DNA分子在细胞核中跟蛋白质一起高度缠绕就形成染色体。人类共有23对46条染色体，其中22对染色体男女相同，另外一对是性染色体，男性为XY，女性为XX。</p>
<p class="qapf" style="">5、人体有多少细胞？人类的DNA上有多少对核苷酸？有多少个基因？</p>
<p class="qapt" style="">根据人类基因组的最新研究，人体约有60万亿个细胞，每个细胞里的DNA含有30亿碱基对的序列，其中所含有的基因约有2.5万-3万个，有32亿核苷酸对，如果将人类基因组印刷在A4纸上，每页30行，每行50个字母，那么人类基因组的天书需要213万页，叠加起来有170米高。</p>
<p class="qapf" style="">6、基因可以改变吗？</p>
<p class="qapt" style="">基因从目前的科技水平来认识还不可以改变。基因的改变是肯定的，但时间太漫长，基因的改变决定了生物的进化，但对每个人来讲，基因基本上在短短的几十年中一般是不会改变的。人体有60万亿个细胞，每个细胞所携带的基因信息都是相同的，也就是说体内到处都有基因的存在，我们不可能将每一个细胞都进行基因改造，但未来也许会实现。 </p>

<p class="qapf" style="">7、什么是基因突变？</p>
<p class="qapt" style="">基因突变是指由于DNA碱基对的置换，插入或缺失而引起的基因结构的变化，亦称点突变。在自然条件下发生的突变叫自发突变。基因突变是生物变异的主要原因，是生物进化的主要因素。在生产上人工诱变是产生生物新品种的重要方法。</p>

<p class="qapf" style="">8、基因后天还会不会变呢？基因检测多久做一次？ </p>
<p class="qapt" style="">基因在受到一些射线等长期辐射的情况下会发生突变，正常情况下是不会轻易发生改变的，所以基因检测一生只检测一次就可以了。</p>

<p class="qapf" style="">9、什么是易感基因？ </p>
<p class="qapt" style="">在适宜的环境刺激下能够编码遗传性疾病或获得疾病易感性的基因。现代医学研究成果表明：大多数疾病是多种环境因素和遗传体质共同作用的结果；对健康不利的遗传体质所对应的一些与疾病发生相关的基因型，我们就叫做疾病易感基因。</p>

<p class="qapf" style="">10、什么是基因检测？ </p>
<p class="qapt" style="">基因检测就是提取被检者的血液中的DNA样品，根据不同的疾病易感基因和药物不良反应的不同要求，分别采用DNA测序或SNP基因分型技术共同完成检测。基因检测使人们能及时了解自己的基因信息，了解身体患疾病的风险，预防疾病的发生。</p>

<p class="qapf" style="">11、基因检测依据的科学原理是什么？ </p>
<p class="qapt" style="">基因检测的全称是“疾病易感性基因检测服务”。所谓的疾病易感性是指由遗传决定的容易患某种或某类疾病的倾向性。具有疾病易感的人具有特定的遗传特征，带有某种或某类疾病的易感基因，通过与正常人的数据配对即可得出相应的结论，从而可以预测患病的几率和风险。 </p>

<p class="qapf" style="">12、基因检测准不准确？ </p>
<p class="qapt" style="">随着基因测序技术和SNP分析技术近年来得到迅速发展，使用基因测序进行SNP分析,具有快速、高效、准确等特点，特定基因序列对生命功能的影响，是全世界科学家共同研究的成果，其科学性勿庸置疑。从技术参数上看，准确率在99%以上。对一般癌症疾病，能比目前的其他检查能提早六个月诊断癌症的复发。</p>

</div>
<div class="w1000">
	<div class="rightdiv">
			

			<p class="lastp" >
					<span >饮酒小故事</span>
					<b class="indenx" ></b><?php echo $this->fzheye['0']['gushi'];?>
			</p>
			<img src="/public/gaiban/images/baogao/j1.png">
			
		
		</div>
</div>
</body>

<script src="/public/gaiban/js/fit_a.js"></script>
</html>