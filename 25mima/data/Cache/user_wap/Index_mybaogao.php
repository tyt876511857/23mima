<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>23密码-我的报告</title>
		<?php $this->display('css','lib') ?>
	</head>

	<!-- <body style="background: #FFFFFF;">
		
		<section class="ui-container">
			<div style="width: 130px;height: 130px;margin: 0 auto;">
				<img src="/public/wap1/images/pic3.png" alt="">
			</div>
			<div class="ui-row ui-whitespace" style="text-align: center; font-size: 0.5em;padding: 10px 0;">
				<p style="color: #898989;margin-bottom: 10px;"><b style="font-weight: normal;">账户名</b>，您好。<br/> 您还没有购买或绑定23密码基因检测服务
				</p>
				<p style="color: #383637;">您可以通过一下方式查看相关数据</p>
			</div>
			<div class="ui-border-t ui-whitespace">
				<a href="javascript:;"><button class="ui-btn-lg user_out"  style="background: #F8B62A;margin-bottom: 10px;">购买检测服务</button></a>
				<a href="<?php echo U('Index/add') ?>"><button class="ui-btn-lg ui-btn-primary user_out">绑样本盒定</button></a>
			</div>
		</section>
	</body> -->
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
			<div class="ui-row ui-whitespace">
				<?php foreach ($baogao as $v){ ?>
				<div class="ui-row ui-row-flex ui-whitespace" style="background: #FFFFFF;margin: 10px auto;padding: 10px;" onclick='window.location.href="<?php echo U("Index/baogao/id/$v[id]") ?>";'>
					<div class="ui-col ui-col-2">
						<div class="ui-avatar-lg" style="width: 100px;height: 100px;margin: 0 auto;"><img src="/public/wap1/images/check<?php if(isset($v['rcvSex'])){echo $v['rcvSex'];} ?>.png" alt="" width="100% 100%"></div>
						<a href='<?php echo U("Index/baogao/id/$v[id]") ?>' style="display: inline-block;font-size: 1em;width: 100%;text-align:center">·查看报告</a>
					</div>
					<ul class="ui-col ui-col-3 detial_list">
						<li><?php if(isset($v['name'])){echo $v['name'];} ?></li>
						<?php
				          $sql = 'select name from '.$this->code.' as c left join '.$this->bg_chanpin.' as cp on c.cid=cp.id where code="'.$v['identifier'].'"';
				          $r = $this->db->getRow($sql);
				          if($r){
				            echo '<li>产品：'.$r['name'].'</li>';
				          }
				        ?>
						<li>编号：<?php if(isset($v['identifier'])){echo $v['identifier'];} ?></li>
						<li style="color: #F8B62A;border: none;"><?php echo $tuoye_state[$v['state']]?>：<?php echo date('Y-m-d',$v['time'.$v['state']]);?></li>
					</ul>
				</div>
				<?php } ?>
			</div>
		</section><?php $this->display('footer','lib') ?>

	</body>
</html>