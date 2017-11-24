<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>23密码</title>
		<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
		<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
		<?php $this->display('css','lib') ?>
		<link rel="stylesheet" type="text/css" href="/public/wap1/user/iconfont3.css" />
		<style>
		.ui-row li{text-align:center}
		.ICP{position:absolute;bottom:0.55rem;right:0}
		</style>
		<script>
		//获取剪贴板数据方法
		function getClipboardText(event){
		var clipboardData = event.clipboardData || window.clipboardData;
			return clipboardData.getData("text");
		};

		//设置剪贴板数据
		function setClipboardText(event, value){
			if(event.clipboardData){
				return event.clipboardData.setData("text/plain", value);
			}else if(window.clipboardData){
				return window.clipboardData.setData("text", value);
			}
		};
		
		window.onload = function(){
			var oInp = document.getElementById("inp");
			 
			function getClipboardText(event){
				var clipboardData = event.clipboardData || window.clipboardData;
				return clipboardData.getData("text");
			};
			 
			oInp.addEventListener('paste',function(event){
				var event = event || window.event;
				var text = getClipboardText(event);
			 
				if(!/^\d+$/.test(text)){
					event.preventDefault();
				}
			}, false); 
		}
		</script>
	</head>

	<body style="background: #F6F4F5;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<ul class="ui-list ui-list-pure ui-border-tb">
				<li class="ui-border-t">
					<ul class="ui-row">
						<li class="ui-col ui-col-100"><img src="/public/wap1/user/img3.png"></li>
					</ul>
				</li>	
			</ul>
			<?php foreach ($youhui as $v){ ?>
			<ul class="ui-list ui-list-pure ui-border-t">
				<li class="ui-border-t">
					<ul class="ui-row">	
						<li class="ui-col ui-col-25"><?php if(isset($v['title'])){echo $v['title'];} ?></li>					
						<li class="ui-col ui-col-25"><?php if(isset($v['price'])){echo $v['price'];} ?></li>
						<?php
							if($v['state'] == 0){
								echo '<li class="ui-col ui-col-25">未使用</li>';
							}else{
								echo '<li class="ui-col ui-col-25" style="color:red;">已使用</li>';
							}
						?>
											
						<li class="ui-col ui-col-25"><?php $time = $v['endtime']-time();echo floor($time/86400).'天'; ?>
						</li>
					</ul>
				</li>	
			</ul>
			<?php } ?>
		</section>
	
		<?php $this->display('footer','lib') ?>
	</body>
</html>
