<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title><?php if(isset($zheye['name'])){echo $zheye['name'];} ?>_我的报告</title>
		<?php $this->display('css','lib') ?>
		<script type="text/javascript" src="/public/wap1/js/zepto.min.js"></script>
		<script type="text/javascript" src="/public/wap1/js/frozen.js"></script>
		<script type="text/javascript" src="/public/wap1/js/annulus.js"></script>
		<script type="text/javascript" src="/public/wap1/js/jquery.circliful.min.js"></script>
		<style>
			.ui-container{
			background: url(/public/wap1/images/fenxiang1.jpg);background-size:100% auto;
			}
			.user_link {
				background: #DCF3F9;
			}
			.user_link li{
				border: none;
			}
			.detial_list li {
				line-height: 40px;
				border-bottom: 1px solid #58585A;
			}
			
			.report_con .u_l_li {
				margin-top: 10px;
				background: #FEE9BE;
			}
			
			.report_con .u_l_li.report_con_li1 {
			
				background: #DCF3F9 !important;
				border:0 !important;
			}
			
			.report_con .u_l_li .title {
				display: inline-block;
				width: 45px;
				height: 45px;
				float: left;
				position: relative;
				z-index: 99;
				margin-right: 10px;
				margin-top:-10px;
			}
			.title.kexue{
			float:left;
			width:40px;
			height:30px;
				background: url(/public/wap1/images/kexue.png) no-repeat;
				background-position: 0 -44px;
				background-size:40px;
			}
			
			
			.report_con .direction_right {
				color: #CAC9CC;
				font-size: 2em;
				top: 6px;
			}
			
			.report_con .u_l_li span {
				display: inline-block;
				color: #595856;
			}
			
			
			.circliful {
				position: relative; 
				margin: 0 auto;
			}

			.circle-text, .circle-info, .circle-text-half, .circle-info-half {
				width: 100%;
				position: absolute;
				text-align: center;
				display: inline-block;
				color: #1faddf;
			}

			.circle-info, .circle-info-half {
				color: #999;
			}

			.circliful .fa {
				margin: -10px 3px 0 3px;
				position: relative;
				bottom: 4px;
			}
			.goumai_bt{
				    padding: 10px 20px;
					background: #1EADDC;
					color: #fff;
					display: block;
					border-radius: 10px;
					font-size: 1em;
			}
			/*#595856*/
		</style>
		<script>
			$(function() {
				annulus($(".c1"), 6);
				annulus($(".c2"), 98);
				annulus($(".c3"), 10);
				$('#myStat').circliful();
			})
		</script>
	</head>

	<body style="background: #DCF3F9;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container" style="margin-bottom: 40px;">
			<div class="ui-row ui-whitespace" style="position: relative;z-index: 90;">
				小天才基因
			</div>
			<div class="ui-row report_con">
				<div class="ui-row" style="width:100%;text-align:center;font-size:3em;font-family:'微软雅黑';color:#1faddd">
					<?php if(isset($field['tuoye'])){echo $field['tuoye'];} ?>
				</div>
				<div class="ui-row" style="width: 50%;margin: 0 auto;text-align: center;">
					<div style="margin:0 auto;height: 30px;" class="lights lv<?php if(isset($_GET['f'])){echo $_GET['f'];} ?>">
					<?php
			  			for($i=1;$i<=5;$i++){
			  				if($i<=$_GET['f']){
			  					echo '<img src="/public/baogao/tal_star.png" class="tal-star">';
			  				}else{
			  					echo '<img src="/public/baogao/tal_star.png" class="tal-star pictures">';
			  				}
			  			}
			  		  ?>
			  		 <style>.lights{background:none;}.lights img{width:20px;}.pictures{filter: alpha(opacity=50) Gray;-webkit-filter: grayscale(100%);opacity: 0.5;}</style>
					</div>
					<div style="margin-top: 10px;"><span style="display:inline-block;padding: 5px;border-radius:5px ;background: #1EADDC; color: #FFFFFF;"><?php if(isset($zheye['name'])){echo $zheye['name'];} ?><?php echo $array[$_GET['f']]?></span></div>
					<p style=" color: #585755;margin:10px auto;font-size: .5em;"></p>
				</div>
				<div class="ui-row ui-whitespace">
					<div style="line-height: 34px;height: 34px;">
						<i style="display: inline-block;width: 40px;height: 30px;float: left;"><img src="/public/wap1/images/list.png" alt="" width="100%"/></i>
						<span>检测内容</span>
					</div>
					<div class="ui-row ui-whitespace" style="text-align: center;border-top: 2px solid #0079FF;background: #FFFFFF;padding: 10px 0;font-size:0.8em">
						<div class="ui-row-flex " style="color: #0090FF;">
							<div class="ui-col ui-col-3">基因</div>
							<div class="ui-col ui-col-3">SNP位点</div>
							<div class="ui-col ui-col-4">基因能力</div>
							<div class="ui-col ui-col-2">基因型</div>
							<div class="ui-col ui-col-3">结果</div>
						</div>
						<?php foreach ($zheye['title'] as $v){ ?>
						<div class="ui-row ui-row-flex">
							<div class="ui-col ui-col-3"><?php echo $jiyin_new[$v]['title_c'];?></div>
							<div class="ui-col ui-col-3"><?php echo $jiyin_new[$v]['SNP'];?></div>
							<div class="ui-col ui-col-4"><?php echo $jiyin_new[$v]['name'];?></div>
							<div class="ui-col ui-col-2"><?php echo $field['content1'][$v][1];?></div>
							<div class="ui-col ui-col-3">
							<!-- <div class="power power<?php echo $r; ?>" style='float:left'></div> -->
							<div class="lights lv<?php echo $jiyin_new[$v]['son'][$field['content1'][$v][1]];?>">
							<?php
			  			for($i=1;$i<=5;$i++){
			  				if($i<=$jiyin_new[$v]['son'][$field['content1'][$v][1]]){
			  					echo '<img src="/public/baogao/tal_star.png" style="width:.8em" class="tal-star">';
			  				}else{
			  					echo '<img src="/public/baogao/tal_star.png" style="width:.8em" class="tal-star pictures">';
			  				}
			  			}
			  		  ?></div>
							</div>
						</div>
						<?php } ?>
					</div>
					<p style="height:30px;color: #0079FF; font-size: 1em;padding-left: 35px;background:url(/public/wap1/images/jiyin01.png) no-repeat;background-size:30px auto;margin: 10px 0 10px 0;"><a href="JavaScript:;" style="line-height:30px;" id="ckwx">参考文献</a></p>
					<div >	
					</div>
					<div class="ui-row ui-whitespace" style="text-align: center;border-top: 2px solid #0079FF;background: #FFFFFF;padding: 10px 0;margin-bottom:30px;">
						<div class="ui-row-flex " style="color: #1faddf;">
							<div class="ui-col ui-col-3" style="font-size:1.5em;font-family:'微软雅黑';">23密码中有多少人跟我一样</div>
							
						</div>
						
						<div class="ui-row ui-row-flex ui-whitespace">
							<?php $per=array('3'=>'90','4'=>'20','5'=>'5'); ?>
							<div class="ui-col ui-col-2"><div id="myStat" data-dimension="125" data-text="<?php echo $per[$_GET['f']]?>%"  data-width="10" data-fontsize="38" data-percent="<?php echo $per[$_GET['f']]?>" data-fgcolor="#1faddf" data-bgcolor="#bbb"></div></div>
							<div class="ui-col ui-col-3">
							<!-- <div class="power power<?php echo $r; ?>" style='float:left'></div> -->
							<p style="line-height:125px;font-size:1em;color:#888;font-family:'微软雅黑';"><?php if(isset($zheye['name'])){echo $zheye['name'];} ?><?php echo $array[$_GET['f']]?></p>
							</div>
						</div>
						
					</div>
					<div style="line-height: 34px;height: 34px;">
						<i style="display: inline-block;width: 40px;height: 30px;float: left;"><img src="/public/wap1/images/book.png" alt="" width="100%"/></i>
						<span>教育建议</span>
					</div>
					<div class="ui-row ui-whitespace" style="text-align: left;border-top: 2px solid #0079FF;background: #FFFFFF;padding: 10px;margin-bottom:30px;">
						<p ><?php if($_GET['f']==3){echo $zheye['jianyi2'];}else{echo $zheye['jianyi1'];}?></p>
					</div>
					<div style="line-height: 34px;height: 34px;">
						<i class="title kexue"></i>
						<span>基因解读</span>
					</div>
					<div class="ui-row ui-whitespace" style="text-align: left;border-top: 2px solid #0079FF;background: #FFFFFF;padding: 10px;margin-bottom:30px;">
						<p ><?php if(isset($zheye['content1'])){echo $zheye['content1'];} ?></p>
					</div>
					<div class="ui-row ui-whitespace" style="text-align: center;margin-bottom:30px;">
						<a class="goumai_bt" href="/goods_1.html">购买检测套件，解读基因密码</a>
					</div>
				</div>
				<!-- <div class="ui-row" style=" background: linear-gradient(to right, #F5E8D7 ,#FEE9BC, #F5E8D7);">
					<div style="text-align: center;height: 50px;line-height: 50px;width: 70%;margin: 0 auto;">
						<span style="display: inline-block;width: 50px;height: 50px;float: left;background: url(images/icon.png) no-repeat center;background-size: 100%;"></span>
						<span>23密码有多少跟我样的人</span>
					</div>
				</div>
				<div class="ui-whitespace" style="margin-bottom:20px">
					<ul class="ui-row" style="background:#ffffff">
						<li class="ui-row ui-row-flex" style="padding:10px 0;">
							<div class="ui-col ui-col-2" style="position:relative">
								<div class="annulus c1">
									<div class="hold1">
										<div class="annulus1"></div>
									</div>
									<div class="hold2">
										<div class="annulus2"></div>
									</div>
									<div class="annulus3"><img src="/public/wap1/images/menu_icon04.png" alt="" width="100%"></div>
								</div>
								<div style="position:absolute;right:0;top:30%;color:#1CACDE">6%</div>
							</div>
							<div class="ui-col ui-col-3" style="text-align:center;color:#595556;line-height:80px">逻辑推理能力一般</div>
						</li>
						<li class="ui-row ui-row-flex" style="padding:10px 0;">
							<div class="ui-col ui-col-2" style="position:relative">
								<div class="annulus c2">
									<div class="hold1">
										<div class="annulus1"></div>
									</div>
									<div class="hold2">
										<div class="annulus2"></div>
									</div>
									<div class="annulus3"><img src="/public/wap1/images/menu_icon05.png" alt="" width="100%"></div>
								</div>
								<div style="position:absolute;right:0;top:30%;color:#1CACDE">98%</div>
							</div>
							<div class="ui-col ui-col-3" style="text-align:center;color:#595556;line-height:80px">逻辑推理能力优秀</div>
						</li>
						<li class="ui-row ui-row-flex" style="padding:10px 0;">
							<div class="ui-col ui-col-2" style="position:relative">
								<div class="annulus c3">
									<div class="hold1">
										<div class="annulus1"></div>
									</div>
									<div class="hold2">
										<div class="annulus2"></div>
									</div>
									<div class="annulus3"><img src="/public/wap1/images/menu_icon02.png" alt="" width="100%"></div>
								</div>
								<div style="position:absolute;right:0;top:30%;color:#1CACDE">10%</div>
							</div>
							<div class="ui-col ui-col-3" style="text-align:center;color:#595556;line-height:80px">逻辑推理能力良好</div>
						</li>
					</ul>
				</div> -->
				
				
				
				
				
				
				
			</div>
		</section>
		
	</body>
	<script src="/public/artDialog/lib/sea.js"></script>
	<script>
seajs.config({
  alias: {
    "jquery": "jquery-1.10.2.js"
  }
});
</script>
<script>
seajs.use(['jquery', '/public/artDialog/src/dialog'], function ($, dialog) {
	window.dialog = dialog;
	
	
	

	$('#ckwx').on('click', function () {
		var d = dialog({
			title: '参考文献',
			content: '<?php if(isset($zheye['wenxian'])){echo $zheye['wenxian'];} ?>',
			
		});
			d.show();
		
	});


});
</script>
</html>
<style>
.power5{background-position: 0 0;}
.power4{background-position: -20px 0;}
.power3{background-position: -40px 0;}
</style>