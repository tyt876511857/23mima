<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>我的订单</title>
		<?php $this->display('css','lib') ?>
		<style>
			.myList {
				margin-top: 10px;
			}
			
			.myList > li {
				margin-bottom: 10px;
				background: #FFFFFF;
				font-size: .8em;
				padding-top: 10px;
				padding-bottom: 10px;
			}
			
			.myList_del{
				display: inline-block;
				width: 60px;
				text-align: center;
				color:red;
				border: 1px solid red;
				border-radius: 10px;
			}
			.myList_pay {
				display: inline-block;
				width: 60px;
				text-align: center;
				color:green;
				border: 1px solid green;
				border-radius: 10px;
			}
			<?php if($list==false){ ?>
			.ICP{position:absolute;bottom:0.55rem;right:0}
			<?php } ?>
		</style>
	</head>

	<body style="background: #F7F5F6;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<!--<div class="ui-row" style="width: 130px;height:130px;margin:50px auto;">
				<img src="images/myOrder01.png" alt="" width="100%" />
			</div>
			<div class="ui-row ui-whitespace" style="text-align: center; padding: 10px 0;">
				<p style="color: #383637;">您还没有订单<br/> 请先去购买型号合适的商品吧！</p>
			</div>
			<div class="ui-border-t ui-whitespace" style="text-align: center;width: 130px;border: none;margin: 0 auto;">
				<a href="javascript:;"><button class="ui-btn-lg ui-btn-primary">去购买</button></a>
			</div>-->
			<ul class="ui-row myList">
				<?php foreach ($list as $v){ ?>
				<li>
					<div class="ui-whitespace">
						<p>订单编号：<?php if(isset($v['indent'])){echo $v['indent'];} ?></p>
						<p>订单日期：<?php echo date('y-m-d',$v['addtime']) ?></p>
						<p>支付金额：<b style="font-weight: normal;color: #F9B935;font-size: 1.5em;">￥<?php if(isset($v['price'])){echo $v['price'];} ?></b></p>
						<p>姓名：<?php if(isset($v['name'])){echo $v['name'];} ?></p>
						<p>地址：<?php if(isset($v['size'])){echo $v['size'];} ?></p>
					</div>
					<?php foreach ($v['child'] as $j){ ?>
					<div class="ui-row ui-row-flex" style="padding: 10px 0;border-top: 1px solid #EFEFEF;border-bottom: 1px solid #EFEFEF;">
						<div class="ui-col ui-col-2" style="text-align: center;">
							<span style="display:inline-block;width: 80px;height: 80px;border: 1px solid;">
								<img src="<?php if(isset($j['goods_thumb'])){echo $j['goods_thumb'];} ?>" alt="" width='80' height='80'>
							</span>
						</div>
						<div class="ui-col ui-col-3">
							<p style="font-size: 1.3em;"><?php if(isset($j['goods_name'])){echo $j['goods_name'];} ?></p>
							<p style="color: #F9B935;font-size: .7em;">￥<?php if(isset($j['shop_price'])){echo $j['shop_price'];} ?></p>
							<p style="margin-top: 20px;">X<?php if(isset($j['number'])){echo $j['number'];} ?></p>
						</div>
					</div>
					<?php } ?>
					<div class="ui-row ui-whitespace" style="text-align: right;padding: 10px;">
						<a href="javascript:;" style="color:#999;" ><?php if(isset($v['typename'])){echo $v['typename'];} ?> </a>
						<?php if($v["type"]==0){ ?>
						<a href='<?php echo U("Alipay/index/id/$v[indent]","user") ?>' class="myList_pay">付款</a>
						<?php } ?>
					</div>
				</li>
				<?php } ?>
			</ul>
		</section>
		
<?php $this->display('footer','lib') ?>
	</body>

</html>