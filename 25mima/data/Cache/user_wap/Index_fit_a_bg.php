<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>我的肥胖报告-23密码</title>
		<?php $this->display('css','lib') ?>
		<script type="text/javascript" src="/public/wap1/js/zepto.min.js"></script>
		<script type="text/javascript" src="/public/wap1/js/frozen.js"></script>
		
		<style>
			table{border-collapse: separate !important;}
			.ui-selector{font-family: 微软雅黑;color:#888}
			.ui-row{margin:1em 0;}
			.titlebg{
			background: url(/public/wap1/images/fenxiang2.jpg);background-size:100% auto;
			}
			.fptitle{font-size: 2.5em;font-family: 微软雅黑;margin: 0 auto;font-weight: bold;padding:0.5em;color: #23c4f1;}
			.fpline{background:#23c4f1;height:4px;width:100%}
			.item-title{color:#23c4f1;display:block;font-size:1.5em;font-family: 微软雅黑;text-align:center;padding:0.5em;}
			.item-num{font-size:2em;margin-left:5px;padding-right:10px}
			.item-qk{font-size:1.2em;color:#fd5958;font-family: 微软雅黑;font-weight: bold;margin-left:10px;display: block;line-height: 2.5em;}
			th{color:#23c4f1}
			.ui-table td, .ui-table th{line-height:2}
			.ui-btn-wrap{text-align:right}
			.fit_z{font-weight: bold;font-family: 微软雅黑;position: absolute;z-index: 2;top: 0;left: 0;right: 0;margin: 0.5em 0;text-align: center;font-size: 1.2em;}
			.color5{color:#41220e}
			.color7{color:#171c60}
			.color6{color:#8f1e3c}
			.color8{color:#09cdc3}
			.checklook{font-family: 微软雅黑;position:relative;z-index: 2;text-align:center;}
		</style>
		
	</head>

	<body >
		<?php $this->display('header','lib') ?>
		<div class="ui-flex  ui-flex-align-center">
			<div>肥胖基因</div>
		</div>
		<div class="ui-flex  ui-flex-align-center titlebg">
			<div class="fptitle"><?php if(isset($field['name'])){echo $field['name'];} ?></div>
		</div>
		<div class="ui-row ui-whitespace">
			<div class="fpline"></div>
		</div>
		
		<section class="ui-selector">
		  
		  <div class="ui-selector-content ui-whitespace" >
			<ul>
			  <li class="ui-selector-item active ui-border">
				<ul class="ui-list">
				<span class='item-title'>肥胖简介</span>
				  <p><?php if(isset($field1['cont1'])){echo $field1['cont1'];} ?></p>
				</ul>
				<h3 >
				  <p>肥胖简介</p>
				</h3>
			  </li>
			  <li class=" ui-selector-item ui-border">
				<ul class="ui-list">
				<span class='item-title'>肥胖危害</span>
				  <p><?php if(isset($field1['cont2'])){echo $field1['cont2'];} ?></p>
				</ul>
				<h3>
				  <p>肥胖危害</p>
				</h3>
				
			  </li>
			  <li class=" ui-selector-item ui-border">
				<ul class="ui-list">
				<span class='item-title'>肥胖高发期</span>
				  <p><?php if(isset($field1['cont3'])){echo $field1['cont3'];} ?></p>
				</ul>
				<h3 >
				  <p>肥胖高发期</p>
				</h3>
				
			  </li>
			  <li class=" ui-selector-item ui-border">
				<ul class="ui-list">
				<span class='item-title'>肥胖主要原因</span>
				  <p><?php if(isset($field1['cont4'])){echo $field1['cont4'];} ?></p>
				</ul>
				<h3 >
				  <p>肥胖主要原因</p>
				</h3>
				
			  </li>
			  <li class=" ui-selector-item ui-border">
				<ul class="ui-list">
				<span class='item-title'>肥胖相关基因</span>
				  <p><?php if(isset($field1['cont5'])){echo $field1['cont5'];} ?></p>
				</ul>
				<h3 >
				  <p>肥胖相关基因</p>
				</h3>
				
			  </li>
			</ul>
		  </div>
		</section>
	<section class="ui-row ui-whitespace">
		<div class="ui-border">
			<div class="fpline"></div>
			<span class='item-title'>我的结果</span>
			<ul class="ui-list ui-list-pure ">
				<li >
					
					<h4 class="ui-flex ui-flex-pack-center">我的BMI<font class="item-num ui-border-r"><?php echo $bmi; ?></font><font class="item-qk"><?php echo $bmi_shuoming; ?></font></h4>
				</li>
				<li >
					
					<h4 class="ui-flex ui-flex-pack-center">总风险系数<font class="item-num ui-border-r"><?php echo $zfxxs; ?></font><font class="item-qk"><?php if($zfxxs>1){echo '肥胖风险高';}else{echo '肥胖风险正常';} ?></font></h4>
				</li>
				
			</ul>
		</div>
	</section>
	<?php 
				$gl1=rand(0,5)+55;
				$gl2=100-$gl1;
				
				?>
	<section class="ui-row ui-whitespace">
		<div class="ui-border" style="padding-bottom:1em">
			<div class="fpline"></div>
			<span class='item-title'>23密码中有多少人跟我一样</span>
			<ul class="ui-row">
				<li class="ui-col ui-col-50">
					<svg height="150" version="1.1" width="150" style="display:block;margin:0 auto" xmlns="http://www.w3.org/2000/svg">
						<circle cx="75" cy="55" r="50" stroke="#68d7c6"stroke-width="1" fill="#fff"/>
						<path class="ring" stroke-linecap="round" rate="<?php echo $gl2;?>" fill="none" x="75" y="55" r="50" stroke="#68d7c6"  stroke-width="10" />
						<text fill="<?php if($zfxxs<=1){echo '#68d7c6';}else{echo '#c9c9c9';} ?>">
							<tspan x='0.7em' y='1.5em' style="font-size:3em"><?php echo $gl2;?></tspan>
							<tspan x='2.7em' y='2.2em' style="font-size:2em">%</tspan>
							<tspan x='0.7em' y='6em' style="font-size:1.5em">肥胖风险低</tspan>
						</text>
					</svg>
				</li>
				<li class="ui-col ui-col-50 ui-flex-align-center">
					<svg height="150" version="1.1" width="150" style="display:block;margin:0 auto" xmlns="http://www.w3.org/2000/svg">
						<circle cx="75" cy="55" r="50" stroke="#fd5959"stroke-width="1" fill="#fff"/>
						<path class="ring" stroke-linecap="round" rate="<?php echo $gl1;?>" fill="none" x="75" y="55" r="50" stroke="#fd5959"  stroke-width="10" />
						<text fill="<?php if($zfxxs>1){echo '#fd5959';}else{echo '#c9c9c9';} ?>">
							<tspan x='0.7em' y='1.5em' style="font-size:3em"><?php echo $gl1;?></tspan>
							<tspan x='2.7em' y='2.2em' style="font-size:2em">%</tspan>
							<tspan x='0.7em' y='6em' style="font-size:1.5em">肥胖风险高</tspan>
						</text>
					</svg>
				</li>
				
			</ul>
		</div>
	</section>
	<section class="ui-row ui-whitespace">
		<div class="ui-border">
			<div class="fpline"></div>
			<span class='item-title'>基因明细</span>
			<table class="ui-table ui-border-tb">
				<thead>
				<tr><th>基因</th><th>检测位点</th><th>基因型</th><th>风险系数</th></tr>
				</thead>
				<tbody>
				<?php foreach ($fit1 as $v){ ?>
					<tr>
						<td><?php if(isset($v['title_c'])){echo $v['title_c'];} ?></td><td><?php if(isset($v['SNP'])){echo $v['SNP'];} ?></td><td><?php if(isset($v['jy'])){echo $v['jy'];} ?></td><td><?php if(isset($v['fs'])){echo $v['fs'];} ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<div class="ui-btn-wrap">
				<button class="ui-btn" onclick="location.href='/user/Index/fit_z/id/<?php echo $id; ?>';">
					检测结果解释
				</button>
				<button class="ui-btn" id="ckwx">
					参考文献
				</button>
			</div>
		</div>
	</section>
	<section class="ui-row ui-whitespace">
		<div class="ui-border">
			<div class="fpline"></div>
			<span class='item-title'>减肥建议</span>
			<p class="ui-whitespace">
				<?php foreach ($jianyi as $k=>$item){ ?>
					<b><?php echo $k; ?>:</b><br/>
					<?php foreach ($item as $k1=>$v){ ?>
					<?php echo ($k1+1);?>.<?php if(isset($v['name'])){echo $v['name'];} ?><br />
					<?php } ?>
					<br/>
				<?php } ?>
			</p>
		</div>
	</section>
	<?php foreach ($fit2 as $k=>$v){ ?>
	<section class="ui-row ui-whitespace">
	<a href="/user/Index/baogao1/id/<?php echo $id; ?>/key/<?php if(isset($v['id'])){echo $v['id'];} ?>/f/<?php if(isset($v['fs'])){echo $v['fs'];} ?>">
		<div class="ui-placehold-img">
			<p class="fit_z color<?php echo ($k+5);?>"><?php if(isset($v['name'])){echo $v['name'];} ?>对减肥的作用<br/><?php if(isset($v['title_c'])){echo $v['title_c'];} ?><?php if(isset($v['jg'])){echo $v['jg'];} ?></p>
			<p class="checklook color<?php echo ($k+5);?>">查看详情</p>
			<span style="background-image:url('/public/gaiban/images/fitmobile<?php echo ($k+5);?>.jpg')"></span>
		</div>
	</a>
	</section>
	<?php } ?>
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
			content: "<?php foreach ($articles as $k=>$v){ ?><?php if(isset($v['content'])){echo $v['content'];} ?><br/><?php } ?>",
			
		});
			d.show();
		
	});
	$(".ui-selector-content .ui-selector-item h3").on("tap",function(){
		$(this).parent().siblings().removeClass('active');
		if($(this).parent().hasClass('active')){
		$(this).parent().removeClass('active');
		}else{
		$(this).parent().addClass('active');
		}
	});
	
	$("path.ring").each(function() {
		var aa = $(this);

	   // YUNM.debug('path.ring' + aa.selector);

		var r = aa.attr("r");
		var x = aa.attr("x"), rate = aa.attr("rate"),y1 = aa.attr("y");

		
		if (rate < 100) {
			var progress = rate / 100;

			
			aa.attr('transform', 'translate(' + x + ',' + y1 + ')');

			
			var degrees = progress * 360;

			
			var rad = degrees * (Math.PI / 180);

			
			var x = (Math.sin(rad) * r).toFixed(2);
			var y = -(Math.cos(rad) * r).toFixed(2);

			
			var lenghty = window.Number(degrees > 180);

			
			var descriptions = [ 'M', 0, -r, 'A', r, r, 1, lenghty, 1, x, y ];

			aa.attr('d', descriptions.join(' '));
		}
	})
});
</script>
</html>
