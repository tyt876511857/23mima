<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>基因检测结果-运动基因 </title>
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
	width:100%;margin:0 auto;background: url(/public/gaiban/images/baogao/thirdbg3.jpg);background-position: 100% 0%; background-size:100%;background-repeat:no-repeat;position: relative;
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
	color: #31b0d7;display: block;font-size: 23px;margin-bottom: 10px;
}
.lastp{
	padding: 0px 10%;line-height: 31px;font-size: 15px;
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
.topul2 li p{top:30px;color: #f29600;font-size: 28px;text-align: center;margin-top: 7px;}
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
		var $fen = <?php echo $this->fzheye['0']['fenshu'];?>;
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
			$baseWidth = $baseWidth+18;
			$top = '100px';
			$index = 2;
			$color = '#ca8623';
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
			<p class="titlep"> 运动基因检测：<span><?php echo $this->fzheye['0']['fenshu1']==5 ?'强':($this->fzheye['0']['fenshu1']==4 ?'良好':'一般'); ?></span></p>
			<div style="padding-top: 40px;">
				<ul class="topul2">
					<li >您的等级<p><?php echo $this->fzheye['0']['fenshu1']==5 ?'达人':($this->fzheye['0']['fenshu1']==4 ?'高手':'菜鸟'); ?> </p></li>
					<li style="border-right:none;">您的检测得分 <p><?php echo $this->fzheye['0']['fenshu'];?></p></li>
				</ul>
				<div style="clear: both;"></div>
	
			
				<p style="margin-top: 30px;text-align: center;font-size: 16px;">您的运动能力：<?php $p=$this->fzheye['0']['fenshu1']-2;echo $p;?>个拳击手

				</p>
				<div class="ping">
					<div style="margin: 0 auto;width: 242px;margin-bottom: 40px;">
						<?php if($p>=1) {?>
							<img src="/public/gaiban/images/baogao/y4.png" style="margin-left: 10px;">
						<?php } elseif($p>0.1) {?>
							<img src="/public/gaiban/images/baogao/y6.png" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/y5.png" style="margin-left: 10px;">
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
							<img src="/public/gaiban/images/baogao/y4.png" style="margin-left: 10px;">
						<?php } elseif($p>1.1) {?>
							<img src="/public/gaiban/images/baogao/y6.png" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/y5.png" style="margin-left: 10px;">
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
							<img src="/public/gaiban/images/baogao/y4.png" style="margin-left: 10px;">
						<?php } elseif($p>2) {?>
							<img src="/public/gaiban/images/baogao/y6.png" style="margin-left: 10px;">
						<?php } else{ ?>
							<img src="/public/gaiban/images/baogao/y5.png" style="margin-left: 10px;">
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
			                {value:10, name:'高手',itemStyle:{normal:{color:'#c23531'}}},
			                {value:30, name:'菜鸟',itemStyle:{normal:{color:'#91c7af'}}},
			                {value:60, name:'达人',itemStyle:{normal:{color:'#ca8623'}}}
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
							<td style="font-size: 12px;width: 33.3%;"><?php print_r($vk['3']);?></td>
							<td style="font-size: 12px;color: #3f3b3a;width: 33.3%;color: #f29600;"><span><?php if ($vk['2']>70) {
							echo '<span style="color:red;">强</span>';
							} elseif ($vk['2']>40) {
							 echo '<span style="color:#f29600;">一般</span>';
							} else {
							 echo '<span style="color:#88ca4d;">弱</span>';
							};?></span></td>
					
							<td style="font-size: 12px;color: #3f3b3a;width: 33.3%;"><p style="text-align: center;"><?php print_r($vk['4']);?>
							</p></td>
						</tr>
					<?php }?>				
					</tbody>
				</table>
				<p style="width: 92%;color: #3f3b3a;margin-top: 20px;font-size: 13px;line-height: 25px;padding: 0 4%;">
				 声明：<br>本报告结果为运动能力相关联的特定基因变异。环境和生活方式等因素造成的影响不在本报告结果之内。
以上结论是根据此基因携带人群的平均水平得出的，相同基因型携带者之间的个人水平有可能与相应人群的平均水平有一定差异。

				</p>

				<p class="commonp" style="box-shadow:3px 3px 4px 4px #e6e2e1;margin-top: 40px;">
					<img src="/public/gaiban/images/baogao/thirdpp1.png" width="100%">
					<b class="indenx"></b>
虽然后天的科学训练对运动员的成绩影响非常大，但运动员要取得足以在奥运会上夺得金牌的顶级运动成绩，特异基因不可缺少。对于那些奥运会上的爆发力选手来说，<a style="color: #f29600;">ACTN3</a>是名副其实的“金牌基因”。ACTN3基因是从遗传上决定的，携带这种基因的运动员在爆发力运动项目中，会比接受相同质量训练的非携带者更容易取得最好的运动成绩<br><b class="indenx"></b>
过氧化物酶增殖激活受体γ共激活子1α通过调节特定组织的ATP生成和氧化磷酸化从而调控机体能量代谢。<a style="color: #f29600;">PPARGC1A</a>基因可辅助过氧化物酶增殖激活受体使得机体消耗能量增加。<br><b class="indenx"></b>
<a style="color: #f29600;">AQP1</a>蛋白主要负责通过水通道运送水进入细胞。在运动时，AQP1蛋白负责将血液中的水运输到肌肉组织中维持渗透压的平衡。快速的液体流动不仅有利于维持肌肉组织的渗透压稳定，也可以带走身体运动中产生的热量，维持充沛的体能。
				</p>
				
				<p style="color: #3f3b3a;margin-top: 40px;line-height: 25px;padding: 0 4%;">
				 <span style="color:#000;font-size: 15px;">参考文献</span><br>1、Daniel G MacArthur, et al.Loss of ACTN3 gene function alters mouse muscle metabolism and shows evidence of positive selection in humans.NATURE GENETICS.2007（11）39-10: 1261 -1265.<br>
2、Niemi A K, Majamaa K. Mitochondrial DNA and ACTN3 genotypes in Finnish elite endurance and sprint athletes[J]. European Journal of Human Genetics Ejhg, 2005, 13(8):965.<br>
3、M.A. Rivera, J.L. Martínez, A. Carrion, T.D. Fahey. AQP-1 association with body fluid loss in 10-km runners. Int. J. Sports Med., 32 (2011), pp. 229–233.<br>
4、Saunders, M. Posthumus, K. O'connell, A.V. September, M. CollinsA variant within the AQP1 3'-untranslated region is associated with running performance, but not weight changes, during an Ironman Triathlon. J. Sports Sci. (2014).<br>
5、Eynon N, Meckel Y, Sagiv M, et al. Do PPARGC1A and PPARalpha polymorphisms influence sprint or endurance phenotypes?[J]. Scandinavian Journal of Medicine & Science in Sports, 2010, 20(1):e145.


				</p>
			</div>
		</div>
</div>
<div class="w1000">

<?php foreach($this->fzheye['0']['CT'] as $key=>$vk) {?>
	<div class="jinp">
		<p>基因：<span style="color:#f39800;"><?php echo $vk['3'];?></span></p>
		<p>位点：<?php echo $key;?></p>
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
			<p class="ml20 commonp">
					<img width="100%" src="/public/gaiban/images/baogao/thirdpp2.png" />
			</p>

			<p class="lastp" >
					<span >爆发力</span>
					<b class="indenx"></b>爆发力是指在最短时间内使器械（或人体本身）移动到尽量远的距离的力。顾名思义，这种力就像火药爆炸一样，能在一瞬间崩发出巨大的能量。爆发力实质是指不同肌肉间的相互协调能力，力量素质以及速度素质相结合的一项人体体能素质。<br>
<a style="color: #31b0d7;">爆发力分为3种情况：</a>1、高爆发力：即30秒内的运动。2、中爆发力：即30秒至5分间的运动。3、低爆发力：即5分至15分间的运动。
爆发力训练依靠力量来支持，需要超负荷的阻力训练，这样才能刺激肌肉迅速提供能量，让机体迅速达到预想中的力量爆发。而且肌肉训练需要在重复次数上超负荷，这样才能持久。<br>
<a style="color: #31b0d7;">爆发力训练的好处：</a>1、让人变的更强壮。2、改善关节控制能力。3、延长寿命。<br>
<a style="color: #31b0d7;">提高爆发力的几个经典练习：</a>1、杠铃／哑铃平推。2、连续蛙跳。3、击掌俯卧撑。4、俯卧撑跳。
爆发力强适合进行的运动：短跑、游泳比赛、跳远、跳高、铁饼、铅球、武术、拳击棒（垒）球、网球、羽毛球等等......


			</p>

			<p class="ml20 commonp">
					<img width="100%" src="/public/gaiban/images/baogao/thirdpp3.png" />
			</p>
			<p class="lastp" >
					<span >耐力</span>
					<b class="indenx"></b>耐力是指有机体在较长的时间内，保持特定强度负荷或动作质量的能力，是人体基本的运动素质之一。遗传对有氧耐力影响甚大。最大摄氧能力VO2max（决定耐力素质的主要因素之一）的93%取决于遗传因素，后天训练只能提高7%。<br><b class="indenx"></b>
根据竞赛及体育活动持续的时间，耐力可分为短时间耐力(短于2分钟)、中等时间耐力(2－8分钟)和长时间耐力(长于8分钟)。<br><b class="indenx"></b>
拥有耐力意味着拥有长时间忍受某件事、病痛或是压力的力量。总的来说，增强耐力意味着在完成一项活动时减少疲劳。<br><b class="indenx"></b>
提高耐力的几个方法：1、每天坚持慢跑一个小时会对腿部的肌肉耐力有很好的锻炼，注意控制呼吸，要有节奏，放慢呼吸。2、经常登山，登山过程中尽量不要停，最好有节奏的慢慢登。3、每天慢慢骑行半个小时左右可以很有效的加强耐力。4、高原旅游，因为高原氧气稀少，可以使肺部的功能不断增强。
耐力强适合进行的运动：长跑、游泳、自行车、跳绳、划船、滑水、滑雪、足球、篮球等球类运动等......

<img width="100%" src="/public/gaiban/images/baogao/thirdpp4.png" />

			</p>

			
	</div>
</div>
</body>

<script src="/public/gaiban/js/fit_a.js"></script>
</html>