<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>我的肥胖子报告-23密码</title>
		<?php $this->display('css','lib') ?>
		<script type="text/javascript" src="/public/wap1/js/zepto.min.js"></script>
		<script type="text/javascript" src="/public/wap1/js/frozen.js"></script>
		
		<style>
			table{border-collapse: separate !important;}
			.ui-selector{font-family: 微软雅黑;color:#888}
			.ui-row{margin:1em 0;}
			
			.fptitle{font-size: 2.5em;font-family: 微软雅黑;margin: 0 auto;font-weight: bold;padding:0.5em;color: #23c4f1;}
			.fpline{background:#23c4f1;height:4px;width:100%}
			.item-title{color:#23c4f1;display:block;font-size:1.5em;font-family: 微软雅黑;text-align:center;padding:0.5em;}
			.item-num{font-size:2em;margin-left:5px;padding-right:10px}
			.item-qk{font-size:1.2em;color:#fd5958;font-family: 微软雅黑;font-weight: bold;margin-left:10px;display: block;line-height: 2.5em;}
			th{color:#23c4f1}
			.ui-table td, .ui-table th{line-height:2}
			.ui-btn-wrap{text-align:right}
			.fit_z{font-weight: bold;font-family: 微软雅黑;position: absolute;z-index: 2;top: 0;left: 0;right: 0;margin: 1em 0;text-align: center;font-size: 1.5em;}
			.color7{color:#41220e}
			.color5{color:#171c60}
			.color6{color:#8f1e3c}
			.color8{color:#09cdc3}
			.checklook{font-family: 微软雅黑;position:relative;z-index: 2;text-align:center;}
		</style>
		
	</head>

	<body >
		<?php $this->display('header','lib') ?>
		
		<div class="ui-placehold-img">
			<p class="fit_z color<?php echo ($key-24);?>"><?php if(isset($zheye['name'])){echo $zheye['name'];} ?>对减肥的作用<br/><?php if(isset($zheye['title_c'])){echo $zheye['title_c'];} ?>  <?php if(isset($fenshu1['description'])){echo $fenshu1['description'];} ?></p>
			
			<span style="background-image:url('<?php if(isset($zheye['litpic2'])){echo $zheye['litpic2'];} ?>')"></span>
		</div>
		
	<section class="ui-row ui-whitespace">
		<div class="ui-border">
			<div class="fpline"></div>
			<span class='item-title'>基因解读</span>
			<div class="ui-whitespace">
				<?php if(isset($zheye['jianyi1'])){echo $zheye['jianyi1'];} ?>
			</div>
		</div>
		<div class="ui-btn-wrap">
				
				<button class="ui-btn" id="ckwx">
					参考文献
				</button>
			</div>
	</section>
	
	
	<section class="ui-row ui-whitespace">
		<div class="ui-border">
			<div class="fpline"></div>
			<span class='item-title'>基因明细</span>
			<table class="ui-table ui-border-tb">
				<thead>
				<tr><th>基因</th><th>检测位点</th><th>基因型</th></tr>
				</thead>
				<tbody>
				
					<tr>
						<td><?php if(isset($zheye['title_c'])){echo $zheye['title_c'];} ?></td><td><?php if(isset($zheye['SNP'])){echo $zheye['SNP'];} ?></td><td><?php if(isset($fenshu1['name'])){echo $fenshu1['name'];} ?></td>
					</tr>
				
				</tbody>
			</table>
			
		</div>
	</section>
	<section class="ui-row ui-whitespace">
		<div class="ui-border">
			<div class="fpline"></div>
			<span class='item-title'>专家减肥建议</span>
			<div class="ui-whitespace">
				<?php if(isset($zheye['content3'])){echo $zheye['content3'];} ?>
			</div>
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
