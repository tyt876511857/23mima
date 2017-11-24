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
		<style>
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
			.report_con .u_l_li .title.kexue{
				background: url(/public/wap1/images/kexue.png) no-repeat;
				
			}
			.report_con .u_l_li .title.story{
				background: url(/public/wap1/images/jiyin.png) no-repeat;
				
			}
			.report_con .u_l_li .title.hover{
				background-position: 0 -45px;
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
			/*#595856*/
		</style>
		<script>
			$(function() {
				annulus($(".c1"), 6);
				annulus($(".c2"), 98);
				annulus($(".c3"), 10);
			})
		</script>
	</head>

	<body style="background: #DCF3F9;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container" style="margin-bottom: 40px;">
			<div class="ui-row ui-whitespace" style="background: #1FADDD;position: relative;z-index: 90;">
				<span style="padding: 10px 0;display: inline-block;color: #FFFFFF;font-size: .8em;"></span>
				<div class="ui-form-item ui-border-b" style=" position:relative;width: 130px;height:30px;background:#FFFFFF;border-radius: 3px;float: right;margin:6px 0;line-height: 30px;">
					<div class="ui-select" style="margin: 0;">
						<select onchange='tiaozhuang()' id="select">
							<option value='1'>选择报告</option>
							<?php foreach ($baogao as $v){ ?>
			                <option value='<?php echo U("/Index/baogao/id/$v[id]") ?>'><?php if(isset($v['name'])){echo $v['name'];} ?></option>
			                <?php } ?>
				        </select>
				        <script>
				        function tiaozhuang(){
				        	var url  = $('#select option:selected').val();
				        	if(url != 1){
				        		window.location.href=url; 
				        	}
				        }
				        </script>
					</div>
				</div>

			</div>
			<div class="ui-row report_con">
				<div class="ui-row" style="width: 120px;height: 120px;border-radius: 120px;overflow: hidden;margin: 20px auto;">
					<img src="<?php if(isset($zheye['litpic1'])){echo $zheye['litpic1'];} ?>" alt="" width="100%" />
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
							<div class="ui-col ui-col-2">结果</div>
						</div>
						<?php foreach ($zheye['title'] as $v){ ?>
						<div class="ui-row ui-row-flex">
							<div class="ui-col ui-col-3"><?php echo $jiyin_new[$v]['title_c'];?></div>
							<div class="ui-col ui-col-3"><?php echo $jiyin_new[$v]['SNP'];?></div>
							<div class="ui-col ui-col-4"><?php echo $jiyin_new[$v]['name'];?></div>
							<div class="ui-col ui-col-2"><?php echo $field['content1'][$v][1];?></div>
							<div class="ui-col ui-col-2">
							<!-- <div class="power power<?php echo $r; ?>" style='float:left'></div> -->
							<?php echo $jiyin_new[$v]['son'][$field['content1'][$v][1]];?>
							</div>
						</div>
						<?php } ?>
					</div>
					<p style="height: 0.2rem;color: #0079FF; font-size: 1em;padding-left: 25px;background:url(/public/wap1/images/jiyin01.png) no-repeat;margin: 5px 0 50px 0;"><a href="JavaScript:;" id="ckwx">参考文献</a></p>
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
				<div style="line-height: 34px;height: 34px;">
					<i style="display: inline-block;width: 40px;height: 30px;float: left;"><img src="/public/wap1/images/book.png" alt="" width="100%"/></i>
					<span>教育建议</span>
				</div>
				<div class="ui-row ui-whitespace" style="text-align:left;text-indent:2em;border-top: 2px solid #0079FF;background: #FFFFFF;padding: 10px;margin-bottom: 30px;">
					<p><?php if($_GET['f']==3){echo $zheye['jianyi2'];}else{echo $zheye['jianyi1'];}?></p>
				</div>
				<div style="line-height: 34px;height: 34px;">
					<i style="display: inline-block;width: 40px;height: 30px;float: left;"><img src="/public/wap1/images/reagent.png" alt="" width="100%"/></i>
					<span>基因定位</span>
				</div>
				<style>
					.lunbo_bigPic {
						min-height: 135px;
						position: relative;
					}
					
					.lunbo_bigPic li {
						position: absolute;
						top: 0;
						left: 0;
					}
				</style>
				<script>
					$(function() {
						$(".user_link").find('li').click(function() {
							$(this).next().toggleClass('hide');
							$(this).toggleClass('report_con_li1');
							$(this).children('.title').toggleClass('hover');
							$(this).children('.direction_right').toggleClass('hide');
						})
					});
				</script>
				<div class="ui-row lunbo" style="text-align: center;border-top: 2px solid #0079FF;background: #FFFFFF;margin-bottom: 30px;overflow:hidden">
					<!-- <div class="ui-slider">
						<ul class="ui-slider-content" style="width: 300%">
							<li><span style="background-image:url(/public/wap1/images/product_deital/product_deital_09.jpg)"></span></li>
							<li><span style="background-image:url(/public/wap1/images/product_deital/product_deital_09.jpg)"></span></li>
							<li><span style="background-image:url(/public/wap1/images/product_deital/product_deital_09.jpg)"></span></li>
						</ul>
						<ul class="ui-slider-content">
						<li><span style="background-image:url(<?php if(isset($zheye['litpic3'])){echo $zheye['litpic3'];} ?>)"></span></li>
						</ul>
						<img src="<?php if(isset($zheye['litpic3'])){echo $zheye['litpic3'];} ?>" alt="" style="width:100%">
					</div> -->
					<img src="<?php if(isset($zheye['litpic4'])){echo $zheye['litpic4'];} ?>" alt="" style="width:100%">
				</div>
				<script>
					(function() {
						var slider = new fz.Scroll('.ui-slider', {
							role: 'slider',
							indicator: true,
							autoplay: true,
							interval: 5000
						});
					})();
				</script>
				<ul class="ui-list ui-list-text ui-list-active ui-list-cover user_link">
					<li class="ui-border-t u_l_li">
						<i class="title kexue"></i><span>基因解读</span><i class="iconfont direction_right">&#xe662;</i>
					</li>
					<div class="ui-row ui-whitespace hide" style="text-align: center;border-top: 2px solid #0079FF;background: #FFFFFF;padding: 10px;margin-bottom: 30px;">
						<p><?php if(isset($zheye['content1'])){echo $zheye['content1'];} ?></p>
					</div>
					<li class="ui-border-t u_l_li">
						<i class="title story"></i><span>基因小故事</span><i class="iconfont direction_right">&#xe662;</i>
					</li>
					<div class="ui-row ui-whitespace hide" style="text-align: center;border-top: 2px solid #0079FF;background: #FFFFFF;padding: 10px;margin-bottom: 30px;">
						<p><?php if(isset($zheye['content3'])){echo $zheye['content3'];} ?></p>
					</div>
				</ul>
			</div>
		</section><?php $this->display('footer','lib') ?>
	</body>
<?php $this->display('index:Index:jssdk','lib') ?>
<script>
if (!shareData) {
    var shareData = {
        title: '<?php if(isset($zheye['name'])){echo $zheye['name'];} ?>_我的报告',
        desc: '<?php if(isset($zheye['name'])){echo $zheye['name'];} ?>_我的报告',
        link: 'http://23mima.com/index/Index/fenxiang1/type/2/id/'+<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>+'/key/'+<?php if(isset($_GET['key'])){echo $_GET['key'];} ?>+'/f/'+<?php if(isset($_GET['f'])){echo $_GET['f'];} ?>,
        imgUrl:'http://23mima.com/<?php if(isset($zheye['litpic1'])){echo $zheye['litpic1'];} ?>'
    };
}
wx.ready(function(){
	wx.onMenuShareAppMessage(shareData);
    wx.onMenuShareTimeline(shareData);
    wx.onMenuShareQQ(shareData);
    wx.onMenuShareQZone(shareData);
});
</script>
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