<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>购物车</title>
		<link rel="stylesheet" type="text/css" href="/public/wap1/css/frozen.css" />
		<link rel="stylesheet" type="text/css" href="/public/wap1/icon/iconfont.css" />
		<link rel="stylesheet" type="text/css" href="/public/wap1/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/public/wap1/css/buy_car.css" />
		<script type="text/javascript" src="/public/wap1/js/jquery.js"></script>
		<script type="text/javascript" src="/public/wap1/js/header.js"></script>
		<script>
			$(function() {
				var T = true;
				$('.move_goods').click(function() {
					if (!T)
						return false;
					T = false;
					$('.product_move').slideToggle(function() {
						T = true;
					});
				});
				var pNum;
				$('.del').click(function() {
					pNum = $(this).siblings('.product_num').val();
					pNum--;
					if (pNum <= 0) {
						pNum = 0
					};
					$(this).siblings('.product_num').val(pNum);
				});
				$('.add').click(function() {
					pNum = $(this).siblings('.product_num').val();
					pNum++;
					$(this).siblings('.product_num').val(pNum);
				});

				$('.buy_car').on('click', 'a', function() {
					var a = 0;
					var e = 0;
					$('.buy_car').each(function(i, val) {
						var b = $(this).find('input[type=text]').val();
						var c = $(this).find('.b_c_d_price').children().html();
						d = parseInt(c) * parseInt(b);
						a = a + parseInt(b);
						e = e + d;
					});
					$('.p_num').html(a);
					$('.total_price').html("￥" + e);
				});

			});
		</script>
	</head>

	<body style="background: #F1F3F2;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<form action="<?php echo U('Shopping/runmima') ?>" method="post" onsubmit='return run();'>
				<ul class="ui-row ui-whitespace buy_car">
					<?php foreach ($shopping as $v){ ?>
					<li class="ui-row-flex">
						<div class="ui-col ui-col-2">
							<img src="<?php if(isset($v['goods_thumb'])){echo $v['goods_thumb'];} ?>" alt="" width="100%" />
						</div>
						<div class="ui-col ui-col-2 b_c_detial">
							<h1><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></h1>
							<p class="ui-txt-info"><?php if(isset($v['description'])){echo $v['description'];} ?></p>
							<p class="b_c_d_price">￥<b><?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?></b></p>
						</div>
					</li>
					<li class="ui-row-flex">
						<div class="ui-col ui-col-2"><span>购买数量：</span></div>
						<div class="ui-col ui-col-2 but_num">
							<span><a href="javascript:;" class="del">-</a><input type="text" name="number[]" value="<?php if(isset($v['number'])){echo $v['number'];} ?>" class="product_num"/><a href="javascript:;" class="add">+</a></span>
						</div>
						<script>
							var price = <?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?>;
						</script>
					</li>
					<input type="hidden" name='goods_id[]' value="<?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?>">
          			<input type="hidden" name='unit_price[]' value="<?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?>">
					<?php } ?>
					<li class="ui-row-flex">
						<div class="ui-col ui-col-2"><span>选购更多检测服务：</span></div>
						<div class="ui-col ui-col-2" style="text-align: right;line-height: 1.5em;"><b class="iconfont move_goods" style="color:#58585A ;font-size: 1.5em;">&#xe662;</b></div>
					</li>
				</ul>
				<div class="ui-row ui-whitespace product_move" style="background:#00B8EE;padding: 10px 0;display: none;">
					<ul class="ui-row ui-whitespace buy_car">
						<?php foreach ($goodslist as $k=>$v){ ?>
						<?php if($k==0){ ?>
						<li class="ui-row-flex">
							<div class="ui-col ui-col-2">
								<img src="<?php if(isset($v['goods_thumb'])){echo $v['goods_thumb'];} ?>" alt="" width="100%" />
							</div>
							<div class="ui-col ui-col-2 b_c_detial">
								<h1><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></h1>
								<p class="ui-txt-info"><?php if(isset($v['description'])){echo $v['description'];} ?></p>
								<p class="b_c_d_price">￥<b><?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?></b></p>
							</div>
						</li>
						<li class="ui-row-flex">
							<div class="ui-col ui-col-2"><span>购买数量：</span></div>
							<div class="ui-col ui-col-2 but_num">
								<span><a href="javascript:;" class="del">-</a><input type="text" name="number[]"  value="0" class="product_num"/><a href="javascript:;" class="add">+</a></span>
							</div>
						</li>
						<input type="hidden" name='goods_id[]' value="<?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?>">
          				<input type="hidden" name='unit_price[]' value="<?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?>">
          				<?php } ?>
						<?php } ?>
					</ul>
				</div>
				<div class="ui-row ui-whitespace" style="margin: 10px 0;">
					总数量：<span class="p_num"></span>
				</div>
				<div class="ui-row ui-whitespace" style="margin: 10px 0;">
					收货信息：
				</div>
				<div class="ui-row ui-whitespace">
					<div class="ui-form ui-border-t">
						<div class="ui-form-item ui-border-b">
							<label>收件人：</label>
							<input type="text" name="name" placeholder="请输入收件人姓名">
						</div>
						<div class="ui-form-item ui-border-b">
							<label> 电话 ：</label>
							<input type="text" name="mobile" placeholder="请输入收件人手机号码">
						</div>
						<div class="ui-form-item ui-border-b">
							<label> 地区 ：</label>
						  <script type="text/javascript" src="/public/user/GlobalProvinces_main.js"></script>
				          <script type="text/javascript" src="/public/user/GlobalProvinces_extend.js"></script>
				          <script type="text/javascript" src="/public/user/initLocation.js"></script>
				          <script type="text/javascript" src="/public/user/initLocation1.js"></script>
							<div style="padding-left:60px;">
								<select class="form-control input-sm" id="sheng" name="province"></select>
							    <select class="form-control input-sm" id="shi" name="city"></select>
							    <select class="form-control input-sm" id="xian" name="country"></select>
							    <select id="xiang" name="address1[street]" ></select>
							    <script>initLocation({sheng_val:sheng,shi_val:shi,xian_val:xian});</script>
							</div>
						</div>
						<style>.ui-form-item select{width:30%;}</style>
						<div class="ui-form-item ui-form-item-textarea ui-border-b">
							<label>详细地址：</label>
							<textarea placeholder="详细地址" name="address"></textarea>
						</div>
					</div>
				</div>
				<div class="ui-row ui-whitespace" style="margin: 10px 0;">
					发票信息：
				</div>
				<!--<div class="ui-row-flex ui-whitespace">
							<div class="ui-col ui-col"><label for="by"><input id="by" name='fp' type="radio" checked value='0'/>不需要</label></div>
							<div class="ui-col ui-col"><label for="pt"><input id="pt" name='fp' type="radio"  value='1'/>普通发票</label></div>
							<div class="ui-col ui-col"><label for="zz"><input id="zz" name='fp' type="radio"  value='2'/>增值税发票</label></div>
						</div>-->
						<div class="ui-row ui-whitespace">
						<div class="ui-form ui-border-t">

							<div class="ui-form-item ui-form-item-radio">
								
								<label class="ui-radio ui-form-item-radio" for="radio">
									<input type="radio" name="fapiao" checked value="0">
								</label>
								<p>不需要</p>
							</div>
							<div class="ui-form-item ui-form-item-radio">
								
								<label class="ui-radio" for="radio">
									<input type="radio" name="fapiao" id="fp_danwei" value="1">
								</label>
								<p>普通发票</p>
							</div>
							<div class="ui-form-item ui-form-item-radio">
								
								<label class="ui-radio" for="radio">
									<input type="radio" name="fapiao" value="3">
								</label>
								<p>增值税发票</p>
							</div>
						
						</div>
						</div>
						<div class="ui-row ui-whitespace fapiao">
						</div>
						<div class="ui-row ui-whitespace fapiao" style="display:none">
							<div class="ui-form ui-border-t">
								<div class="ui-form-item">
									<label>发票抬头：</label>
									
								</div>
								<div class="ui-form-item ui-form-item-radio">
									
									<label class="ui-radio" for="radio1">
										<input type="radio" name="radio1" value="0" checked>
									</label>
									<p>个人</p>
								</div>
								<div class="ui-form-item ui-form-item-radio">
									
									<label class="ui-radio" for="radio1">
										<input type="radio" name="radio1" value="1">
									</label>
									<p>单位</p>
								</div>
								<div class="ui-form-item ui-border-b" id="dwmc" style="display:none">
									<label>
										单位名称
									</label>
									<input type="text" name='companyName'  placeholder="单位名称">
								</div>
							</div>
						</div>
						<div class="ui-row ui-whitespace fapiao">
						</div>
						<div class="ui-row ui-whitespace fapiao" style="display:none">
							<div class="ui-form ui-border-t">
								<div class="ui-form-item ui-border-b" >
									<label>
										单位名称
									</label>
									<input type="text" name='vat_companyName' placeholder="单位名称">
									
								</div>
								<div class="ui-form-item ui-border-b" >
									<label>
										纳税人识别码
									</label>
									<input type="text" name='vat_code' placeholder="纳税人识别码">
									
								</div>
								<div class="ui-form-item ui-border-b" >
									<label>
										注册地址
									</label>
									<input type="text" name='vat_address' placeholder="注册地址">
									
								</div>
								<div class="ui-form-item ui-border-b" >
									<label>
										注册电话
									</label>
									<input type="text" name='vat_tel' placeholder="注册电话">
									
								</div>
								<div class="ui-form-item ui-border-b" >
									<label>
										开户银行
									</label>
									<input type="text" name='vat_bank' placeholder="开户银行">
									
								</div>
								<div class="ui-form-item ui-border-b" >
									<label>
										银行账户
									</label>
									<input type="text" name='vat_bank_num' placeholder="银行账户">
									
								</div>
								<div class="ui-form-item ui-border-b" >
									<label>
										收票人姓名
									</label>
									<input type="text" name='vat_name' placeholder="收票人姓名">
									
								</div>
								<div class="ui-form-item ui-border-b" >
									<label>
										收票人手机
									</label>
									<input type="text" name='vat_message_tel' placeholder="收票人手机">
									
								</div>
								
								<div class="ui-form-item ui-border-b">
									<label>收票人省份</label>
									<div class="ui-select-group">
										<select class="inv-selProvince" name="vat_province" id="sheng1"></select>
							            <select class="inv-selCity" name="vat_city" id="shi1"></select>
							            <select class="inv-selCity" name="vat_country" id="xian1"></select>
							            <select id="xiang1" name="address1[street]" ></select>
									</div>
									<script>initLocation1({sheng_val:sheng1,shi_val:shi1,xian_val:xian1});</script>
								</div>
								<div class="ui-form-item ui-border-b" >
									<label>
										详细地址
									</label>
									<input type="text" name='vat_receive_address' placeholder="详细地址">
									
								</div>
							</div>
						</div>
				<div class="ui-row ui-whitespace" style="margin: 10px 0;">
					优惠码：
				</div>
				
				<div class="ui-row ui-whitespace" style="margin: 10px 0 56px 0;">
				<div class="ui-form ui-border-t">
					<div class="ui-form-item ui-border-b" >
							<input type="text" name='card' placeholder="优惠码">
					</div>
					 
					
				</div>
				</div>
				
				<div class="ui-footer ui-footer-stable ui-btn-group ui-border-t ui-row-flex ">
					<div class="ui-col ui-col-4 ui-whitespace total_price">￥<script>document.write(price);</script></div>
					<button class="ui-col ui-btn-lg" style="width: 60px;background: #00B8EE;color: #FFFADF;">提交订单</button>
				</div>
			</form>
		</section>
		
	</body>

</html>
  <script>
  function run(){
    var name = $('[name=name]').val();
    var mobile = $('[name=mobile]').val();
    var country = $('[name=country]').val();
    var address = $('[name=address]').val();
    var fapiao = $('[name=fapiao]:checked').val();
    
    if(name==''){
      alert('请填写姓名！');
      return false;
    }
    if(mobile=='' || mobile.length!='11'){
      alert('请填写手机号！');
      return false;
    }
    if(country==''){
      alert('请选择地区！');
      return false;
    }
    if(address==''){
      alert('请填写地址！');
      return false;
    }

    if(fapiao == 2){
    	var conpanyname = $('[name=companyName]').val();
    	if(conpanyname == ''){
    		alert('请填写单位名称');
    		return false;
    	}
    }else if(fapiao == 3){
    	var r1 = $('[name=vat_companyName]').val();
        var r2 = $('[name=vat_code]').val();
        var r3 = $('[name=vat_address]').val();
        var r4 = $('[name=vat_tel]').val();
        var r5 = $('[name=vat_bank]').val();
        var r6 = $('[name=vat_bank_num]').val();
        if(r1=='' || r2=='' || r3=='' || r4=='' || r5=='' || r6==''){
          alert('请完整填写公司信息！');
          return false;
        }
        var r1 = $('[name=vat_name]').val();
        var r2 = $('[name=vat_message_tel]').val();
        var r3 = $('[name=vat_country]').val();
        var r4 = $('[name=vat_receive_address]').val();
        if(r1=='' || r2=='' || r3=='' || r4==''){
          alert('请完整填写收票人信息！');
          return false;
        }
    }
  }
  
   $('[name=fapiao]').click(function(){
	var index=$(this).val();
	$('#fp_danwei').val(1);
	$('[name="radio1"]').eq(0).prop("checked",true);
	$('.fapiao').eq(index).fadeIn();
	$('.fapiao').eq(index).siblings('.fapiao').fadeOut();

  });
 
  $('[name=radio1]').click(function(){
	if($(this).val()==1){
		$('#dwmc').fadeIn();
		$('#fp_danwei').val(2);
	}else{
		$('#dwmc').fadeOut();
		$('#fp_danwei').val(1);
	}
  });
  </script>