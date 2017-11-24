<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>基因检测结果-肥胖基因 </title>
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jyy_a_bg.css" rel="stylesheet" type="text/css" />
<link href="/public/gaiban/css/fit_a_bg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/public/js/echarts.js"></script>
<!-- <script type="text/javascript" src="/public/js/echarts.js"></script> -->
<!-- <script type="text/javascript" src="/public/gaiban/js/highcharts.js"></script>
<script type="text/javascript" src="/public/gaiban/js/highcharts-more.js"></script> -->
<style>
.indenx{padding: 0px 18px;}
p{text-align: justify;}
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
	width:100%;margin:0 auto;background: url(/public/gaiban/images/baogao/thirdbg2.jpg);background-position: 100% 0%; background-size:100%;background-repeat:no-repeat;position: relative;
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
	text-align: justify;line-height: 26px;font-size: 15px;color: #3f3b3a;padding: 10px;
}
.commonp span,.lastp span,.applebgp span{
	color: #31b0d7;display: block;font-size: 23px;margin-bottom: 5px;
}
.lastp{
	padding: 0px 10%;line-height: 31px;font-size: 15px;margin-top: 20px;
}
.rightdiv{
	/*background: -webkit-gradient(linear, 0% 25%, 75% 100%, from(#21acdc), to(#81c4bf));*/
	width: 100%;
	margin-bottom: 40px;
}
.rightdiv img{/*margin-top: -10px;margin-bottom: 50px;*/width: 100%;}
.chantu{
	border-radius: 100px;height: 20px;background-color: #ccc;position: relative;width: 80%;margin: 0 auto;
}
.chantu div{border-radius: 100px;width: <?php echo $feipang['fenshu1']*20;?>%;height: 20px;background: -webkit-gradient(linear, 0% 25%, 75% 100%, from(#21acdc), to(#81c4bf));}
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
.topul2 li p{top:30px;color: #f29600;font-size: 15px;text-align: center;margin-top: 7px;}
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
		var $fen = <?php echo $feipang['fenshu'];?>;
		var $baseWidth = $(window).width()/2*0.9-165;
		var $titleWidth = $(window).width()/2*0.9-93;
		var $top;
		var $index;
		if ($fen > 93) {
			$baseWidth = $baseWidth+245;
			$top = '105px';
			$index = 4;
			$color = '#c23531';
		} else if($fen > 86) {
			$baseWidth = $baseWidth;
			$top = '140px';
			$index = 2;
			$color = '#334b5c';
		} else {
			$baseWidth = $baseWidth+225;
			$top = '294px';
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
			if(index == 0) {
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
			<p class="titlep"> 减肥基因检测：<span><?php echo $feipang['fenshu1']==5 ?'强':($feipang['fenshu1']==4 ?'良好':'一般'); ?></span></p>
			<div style="padding-top: 40px;">
				<ul class="topul2">
					<li >您的等级<p><?php echo $feipang['fenshu1']==5 ?'达人':($feipang['fenshu1']==4 ?'强人':'菜鸟'); ?> </p></li>
					<li style="border-right:none;">您的检测得分 <p><?php echo $feipang['fenshu'];?></p></li>
				</ul>
				<div style="clear: both;"></div>
	
			
				<p style="margin-top: 30px;text-align: center;font-size: 16px;">您的减肥能力：<?php $p=$feipang['fenshu1']-2;echo $p;?>个瘦身模特

				</p>
				<div class="ping">
					<div style="margin: 0 auto;width: 242px;margin-bottom: 40px;">
						<?php if($p>=1) {?>
							<img src="/public/gaiban/images/baogao/j4.png" style="margin-left: 10px;">
						<?php } elseif($p>0.1) {?>
							<img src="/public/gaiban/images/baogao/j6.png" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/j5.png" style="margin-left: 10px;">
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
							<img src="/public/gaiban/images/baogao/j4.png" style="margin-left: 10px;">
						<?php } elseif($p>1.1) {?>
							<img src="/public/gaiban/images/baogao/j6.png" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/j5.png" style="margin-left: 10px;">
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
							<img src="/public/gaiban/images/baogao/j4.png" style="margin-left: 10px;">
						<?php } elseif($p>2) {?>
							<img src="/public/gaiban/images/baogao/j6.png" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/j5.png" style="margin-left: 10px;">
						<?php }?>
					</div>
				</div>
			
			</div>
			<p style="font-size: 16px;margin:10px auto;padding:10px;line-height: 30px;color: #fff;height:360px;background: -webkit-gradient(linear, 0% 25%, 75% 100%, from(#21acdc), to(#81c4bf));width: 85%;"><b class="indenx" ></b>
				<?php echo $fenxi;?>
			</p>

		</div>

		<div style="position: relative;box-shadow: 3px 3px 4px 4px #e6e2e1;width: 90%;margin:30px auto;padding-bottom: 30px;">
			<div id="container" style="width:100%;height:340px;margin:0 auto;padding-top: 20px;">
			</div>
			<span id="here" style="position: absolute;font-size: 16px;">您在这儿</span>
			<span id="titlehere" style="position: absolute;font-size: 16px;top:23px;margin:0 auto;left: 24%;">全国有<span style="color: #f29600;font-size: 20px;"><?php echo $avg;
						?>%</span>的人与你相当</span>
			<ul id="toolb" >
				<div style="margin: 0 auto;width: 310px;">
					<li style="color: #91c7ae;">
						<span ></span>菜鸟
					</li> 

					<li style="color: #61a0a8;">
						<!-- <span style="background: #61a0a8;"></span>酒徒 -->
					</li> 
					<li style="color: #ca8623;">
						<span style="background: #ca8623;"></span>达人
					</li> 

					<li style="color: #d48265;" >
						<!-- <span style="background: #d48265;"></span>酒圣 -->
					</li > 

					<li style="color: #c23531;">
						<span style="background: #c23531;"></span>高手
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
			                {value:10, name:'rose1',itemStyle:{normal:{color:'red'}}},
			                {value:30, name:'rose5',itemStyle:{normal:{color:'#91c7af'}}},
			                {value:60, name:'rose7',itemStyle:{normal:{color:'#ca8623'}}}
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
					<?php foreach($feipang['CT'] as $key=>$vk) { ?>
						<tr>
							<td style="font-size: 12px;width: 33.3%;"><?php print_r($vk['3']);?></td>
							<td style="font-size: 12px;color: #3f3b3a;width: 33.3%;color: #f29600;"><span><?php if ($vk['2']>70) {
							echo '<span style="color:red;">高</span>';
							} elseif ($vk['2']>40) {
							 echo '<span style="color:#f29600;">正常</span>';
							} else {
							 echo '<span style="color:#88ca4d;">弱</span>';
							};?></span></td>
					
							<td style="font-size: 12px;color: #3f3b3a;width: 33.3%;"><p style="text-align: center;"><?php print_r($vk['4']);?>：
							<?php if ($vk['2']>70) {
							echo '强';
							} elseif ($vk['2']>40) {
							 echo '一般';
							} else {
							 echo '弱';
							};?></p></td>
						</tr>
					<?php }?>				
					</tbody>
				</table>
				<p style="width: 92%;color: #3f3b3a;margin-top: 20px;font-size: 13px;line-height: 25px;padding: 0 4%;">
				 声明：<br>本报告结果为减肥相关联的特定基因变异。环境和生活方式等因素造成的影响不在本报告结果之内。
以上结论是根据此基因携带人群的平均水平得出的，相同基因型携带者之间的个人水平有可能与相应人群的平均水平有一定差异。

				</p>

				<p class="commonp" style="box-shadow:3px 3px 4px 4px #e6e2e1;margin-top: 40px;">
					<img src="/public/gaiban/images/baogao/thirdpp10.png" width="100%">
					<b class="indenx"></b>
<!-- 虽然后天的科学训练对运动员的成绩影响非常大，但运动员要取得足以在奥运会上夺得金牌的顶级运动成绩，特异基因不可缺少。对于那些奥运会上的爆发力选手来说，<a style="color: #f29600;">ACTN3</a>是名副其实的“金牌基因”。ACTN3基因是从遗传上决定的，携带这种基因的运动员在爆发力运动项目中，会比接受相同质量训练的非携带者更容易取得最好的运动成绩<br><b class="indenx"></b>
过氧化物酶增殖激活受体γ共激活子1α通过调节特定组织的ATP生成和氧化磷酸化从而调控机体能量代谢。<a style="color: #f29600;">PPARGC1A</a>基因可辅助过氧化物酶增殖激活受体使得机体消耗能量增加。<br><b class="indenx"></b>
<a style="color: #f29600;">AQP1</a>蛋白主要负责通过水通道运送水进入细胞。在运动时，AQP1蛋白负责将血液中的水运输到肌肉组织中维持渗透压的平衡。快速的液体流动不仅有利于维持肌肉组织的渗透压稳定，也可以带走身体运动中产生的热量，维持充沛的体能。 -->
 <a style="color: #f29600;">FTO</a>基因是迄今为止被研究证实的最强、最确定的肥胖易感基因，拥有特定基因突变的人群即使低强度运动，也会比无此突变的人群高强度运动的减重效果更好。<br><b class="indenx"></b>
<a style="color: #f29600;">载脂蛋白A（APOA5）</a>是载脂蛋白家族的一员，有调节血浆甘油三酯分解代谢的作用，APOA5的基因变异可导致血浆甘油三酯水平增高，体重增加。<br><b class="indenx"></b>
<a style="color: #f29600;">单不饱和脂肪酸</a>有降血糖、降血脂、降胆固醇的作用，一般来源于饮食中的鱼类和蔬果。而过氧化物酶体增殖剂激活受体γ（PPARG）是脂肪形成的关键调节剂，能抵抗高脂饮食引起的肥胖。<br><b class="indenx"></b>
<a style="color: #f29600;">肾上腺素受体（ADRB3）</a>基因位点发生突变时，会使肾上腺素受体的氨基酸发生变化，由色氨酸转变为精氨酸，有该基因突变的人群通过饮食控制减少卡路里摄入减重效果更好。

				</p>
				
				<p style="color: #3f3b3a;margin-top: 40px;line-height: 25px;padding: 0 4%;">
				 <span style="color:#000;font-size: 15px;">参考文献</span><br>1、Razquin C, Alfredo M J, Martinezgonzalez M A, et al. The Mediterranean diet protects against waist circumference enlargement in 12Ala carriers for the PPARgamma gene: 2 years' follow-up of 774 subjects at high cardiovascular risk.[J]. British Journal of Nutrition, 2009, 102(5):672-9.<br>
2、Memisoglu A, Hu F B, Hankinson S E, et al. Interaction between a peroxisome proliferator-activated receptor gamma gene polymorphism and dietary fat intake in relation to body mass.[J]. Human Molecular Genetics, 2003, 12(22):2923-9.<br>
3、Shiwaku K, Nogi A, Anuurad E, et al. Difficulty in losing weight by behavioral intervention for women with Trp64Arg polymorphism of the beta3-adrenergic receptor gene.[J]. International Journal of Obesity & Related Metabolic Disorders Journal of the International Association for the Study of Obesity, 2003, 27(9):1028-36.<br>
4、Tuomas O. Kilpeläinen, Qi L, Brage S, et al. Physical Activity Attenuates the Influence of FTO Variants on Obesity Risk: A Meta-Analysis of 218,166 Adults and 19,268 Children[J]. Plos Medicine, 2011, 8(11):e1001116.
				</p>
			</div>
		</div>
</div>
<div class="w1000">

<?php foreach($feipang['CT'] as $key=>$vk) {?>
	<div class="jinp">
		<p>基因：<span style="color:#f39800;"><?php if($key=='rs99396092') {echo 'rs9939609';}else{ echo $vk['3'];};?></span></p>
		<p>位点：<?php if($key=='rs99396092') {echo 'rs9939609';}else{ echo $vk['3'];};?></p>
		<p>您的结果：<span ><?php echo $vk['1'];?></span>    
		<?php print_r($vk['4']);?>：
		<?php if ($vk['2']>70) {
		echo '强';
		} elseif ($vk['2']>40) {
		 echo '一般';
		} else {
		 echo '弱';
		};?>
		</p>
		<p><img width="100%" src="/public/gaiban/images/baogao/gene/<?php echo $key;?>_j.png"></p>
		<p>生物学功能：<?php echo $vk['5'];?></p>
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
			<div class="lastp" style="background: url(/public/gaiban/images/baogao/thirdpp12.png);background-position: 105% 100%;background-size: 35%;background-repeat:no-repeat;height: 236px;">
				<p style="float: left;width: 68%;line-height: 26px;">
					<span >关于本系列</span>
					<b class="indenx"></b>不同人群对脂肪的分解速率是不同的，是否可以通过一定的有氧体育运动、补充单不饱和脂肪酸、控制高热量食物等措施消耗身体多余脂肪，促进新陈代谢，从而科学塑身是要因人而异的。
				</p>
			</div>

			<p class="lastp" >
					<span >缺乏运动的表现</span>
					<b class="indenx"></b>
					<img width="100%" src="/public/gaiban/images/baogao/thirdpp11.png" />


			</p>

			<p class="lastp">
					<span >我们为什么要控制高热量食物和脂肪的摄入</span>
					<b class="indenx"></b>血液中坏胆固醇太多，就容易损坏血管壁以及引起动脉阻塞，单不饱和脂肪酸则能清除血液中的坏胆固醇。

			</p>

			<div class="lastp" style="background: url(/public/gaiban/images/baogao/thirdpp13.png);background-position: 105% 100%;background-size: 35%;background-repeat:no-repeat;height: 236px;">
				<p style="float: left;width: 68%;line-height: 26px;">
					<span >我们为什么要摄入单不饱和脂肪酸</span>
					<b class="indenx"></b>不同人群对脂肪的分解速率是不同的，是否可以通过一定的有氧体育运动、补充单不饱和脂肪酸、控制高热量食物等措施消耗身体多余脂肪，促进新陈代谢，从而科学塑身是要因人而异的。
				</p>
			</div>

			<p class="lastp" style="margin-top: 40px;">
					<span >肥胖的危害</span>
					<b class="indenx"></b>肥胖不仅影响形体美，而且给生活带来不便，更重要的是容易引起多种并发症，加速衰老和死亡，肥胖是疾病的先兆、衰老的信号。

			</p >

			<p style="width: 90%;margin: 0 auto;">
<img  src="/public/gaiban/images/baogao/thirdpp14.png" />	
			</p>
			
	</div>
</div>
</body>

<script src="/public/gaiban/js/fit_a.js"></script>
</html>