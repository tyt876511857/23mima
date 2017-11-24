<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>样本盒状态</title>
		<?php $this->display('css','lib') ?>
		<style>
			.sample_list {
				width: 60%;
				margin: 0 auto;
				color: #919191;
			}
			
			.sample_list li .xuhao {
				display: inline-block;
				width: 30px;
				height: 30px;
				margin-bottom: 20px;
				border-radius: 30px;
				line-height: 30px;
				text-align: center;
				color: #FFFADF;
				font-size: 1em;
				margin-right: 10px;
			}
			.sample_list li:nth-child(odd) .xuhao{
				background: #18ABDD;
			}
			.sample_list li:nth-child(even) .xuhao{
				background: #F7B52B;
			}
			/*background: #18ABDD;*/
		</style>
	</head>

	<body style="background: #FFFFFF;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<div class="ui-row ui-whitespace">
				<div class="ui-row">
					<div class="ui-row ui-whitespace" style="text-align: center;border-bottom: 1px solid #58585A;padding-bottom: 30px;">
						<div style="width: 98px;height: 98px;margin: 20px auto;">
							<img src="/public/user1/male<?php if(isset($field['rcvSex'])){echo $field['rcvSex'];} ?>.png" alt="" />
						</div>
						<p><?php if(isset($field['name'])){echo $field['name'];} ?></p>
						<p>生日：<?php if(isset($field['birthtime1'])){echo $field['birthtime1'];} ?></p>
					</div>
					<div class="ui-row">
						<p style="text-align: center;">您的采样盒当前位置</p>
						<ul class="ui-row sample_list">
							<?php 
							if($field['state']==6){
							for($i=0;$i<=2;$i++){
							?>
							<li><span class="xuhao"><?php echo $i+1;?></span><span><?php echo $tuoye_state[$i].' ';  echo date('Y-m-d',$field['time'.$i]);?></span></li>
							<?php
							}
							?>
							<li><span class="xuhao">4</span><span><?php echo $tuoye_state[6].' ';  echo date('Y-m-d',$field['time6']);?></span></li>
							<?php
							}else{
							for($i=0;$i<=$field['state'];$i++){ ?>
							<li><span class="xuhao"><?php echo $i+1;?></span><span><?php echo $tuoye_state[$i].' ';  echo date('Y-m-d',$field['time'.$i]);?></span></li>
							<?php }} ?>
						</ul>
					</div>
				</div>
			</div>
		</section><?php $this->display('footer','lib') ?>
		</body>
</html>