<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php $this->display('css','lib') ?>
<link rel="stylesheet" href="/public/user1/reset.css" type="text/css">
<link rel="stylesheet" href="/public/user1/style.css" type="text/css">
<script async="" src="/public/user1/agt.js"></script>
<script charset="utf-8" src="/public/user1/v.js"></script>
<script async="" src="/public/user1/tg.js"></script>

<script src="/public/user1/hm.js"></script>
<script type="text/javascript" async="" src="/public/user1/vds.js"></script>
<script type="text/javascript" async="" defer="" src="/public/user1/piwik.js"></script>


<script src="/public/user1/jquery.min.js" type="text/javascript"></script>
<script src="/public/user1/jquery.plugins.min.js" type="text/javascript"></script>

<script src="/public/user1/functions.js" type="text/javascript"></script>
<script src="/public/user1/common.js" type="text/javascript"></script>
<script src="/public/user1/widget.js" type="text/javascript"></script> 
<!--[if lt IE 9]>
<script src="/res/desktop/plugin/selectivizr.min.js"></script>
<script src="/res/desktop/plugin/html5shiv.min.js"></script>
<![endif]-->






<!-- End Piwik Code -->
<script type="text/javascript">
/*var _vds = _vds || [];
window._vds = _vds;
(function(){
  _vds.push(['setAccountId', 'a468fa1a1535faa3']);
  (function() {
    var vds = document.createElement('script');
    vds.type='text/javascript';
    vds.async = true;
    vds.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dn-growing.qbox.me/vds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(vds, s);
  })();
})();*/
</script>


<title>购物车</title>
  <link rel="stylesheet" type="text/css" href="/public/user1/cart.css">
  <link rel="stylesheet" type="text/css" href="/public/user1/invoice.css">
  <style type="text/css">
    .navbar-buy-btn{display:none!important;}
  </style>
</head>
<body>
<div class="invoice-shade"></div>
<?php $this->display('header','lib') ?>
<form action="<?php echo U('Shopping/runmima') ?>" method="post" onsubmit='return run();'>
    <div class="shopping-cart clearfix">
      <div class="cart-added fn-left">
        <h3 class="cart-added-hd">已选购服务</h3>
        <?php foreach ($shopping as $v){ ?>
        <div id="cartList" class="cart-list cart-list-added"><div id="201512" class="packwrap clearfix">
            <img class="pack-intro-img fn-left" src="<?php if(isset($v['goods_thumb'])){echo $v['goods_thumb'];} ?>" alt="<?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?>">
            <div class="pack-select fn-right">
              <h2 class="pack-select-name "><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></h2>
              <p class="pack-select-price">优惠价：<span class="fcred"><?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?></span> <!-- <span class="delete">1998</span> --></p>
              <p class="pack-intro-txt"><?php if(isset($v['description'])){echo $v['description'];} ?></p>
              <div class="pack-select-wrap">
                <label class="pack-select-label" for="201512_0">套餐数量</label>
                <div class="cart-amount">
                  <a class="cart-amount-ctrl cart-amount-reduce" href="javascript:;" hidefocus="true">-</a>
                  <input id="201512_0" name='number[]' class="cart-amount-num" type="text" value="<?php if(isset($v['number'])){echo $v['number'];} ?>" data-price="<?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?>" title="请输入购买数量">
                  <a class="cart-amount-ctrl cart-amount-increase" href="javascript:;" hidefocus="true">+</a>
                </div>
              </div>
            </div>
          </div></div>
          <input type="hidden" name='goods_id[]' value="<?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?>">
          <input type="hidden" name='unit_price[]' value="<?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?>">
      <?php } ?>
      </div>
      <div class="cart-others fn-right">
        <h3 class="cart-others-hd">选购更多基因服务</h3>
        <div class="cart-list">
        <?php foreach ($goodslist as $v){ ?>
          <!-- 标准检测 -->
          <div id="201513" class="packwrap clearfix">
            <img class="pack-intro-img fn-left" src="<?php if(isset($v['goods_thumb'])){echo $v['goods_thumb'];} ?>" alt="<?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?>">
            <div class="pack-select fn-right">
              <h2 class="pack-select-name"><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></h2>
              <p class="pack-select-price">价格：<span class="fcred"><?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?></span></p>
              <p class="pack-intro-txt"><?php if(isset($v['description'])){echo $v['description'];} ?></p>
              <div class="pack-select-wrap">
                <label class="pack-select-label" for="201513_0">数量</label>
                <div class="cart-amount">
                  <a class="cart-amount-ctrl cart-amount-reduce" href="javascript:;" hidefocus="true">-</a>
                  <input id="201513_0" name='number[]' class="cart-amount-num"  type="text" value="0" data-price="<?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?>" title="请输入购买数量">
                  
                  <a class="cart-amount-ctrl cart-amount-increase" href="javascript:;" hidefocus="true">+</a>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name='goods_id[]' value="<?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?>">
          <input type="hidden" name='unit_price[]' value="<?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?>">
          <?php } ?>

        </div>
      </div>
    </div>


    <!-- orderfill -->
    <div class="shopping-order clearfix">
<!--       <form id="orderfill" class="orderfill" novalidate="novalidate"> -->
        <h3 class="order-title">收件人信息</h3>
        <div class="deliver-info-unit">
          <label class="deliver-tooltip" for="rcvName">收件人姓名</label>
          <input id="rcvName" class="deliver-input" name="name" type="text" placeholder="输入姓名">
        </div>
        <div class="deliver-info-unit">
          <label class="deliver-tooltip" for="rcvTel">联系电话</label>
          <input id="rcvTel" class="deliver-input" name="mobile" type="text" placeholder="请输入联系电话">
        </div>
        <div id="selAddress" class="deliver-info-unit">
          <label class="deliver-tooltip">收件地址</label>
          <script type="text/javascript" src="/public/user/GlobalProvinces_main.js"></script>
          <script type="text/javascript" src="/public/user/GlobalProvinces_extend.js"></script>
          <script type="text/javascript" src="/public/user/initLocation.js"></script>
          <script type="text/javascript" src="/public/user/initLocation1.js"></script>
          <div class="deliver-sel-wrap fn-relative">
            <select id="sheng" class="deliver-select" name="province"></select>
          </div>
          <div class="deliver-sel-wrap fn-relative">
            <select id="shi" class="deliver-select" name="city"></select>
          </div>
          <div class="deliver-sel-wrap fn-relative">
            <select id="xian" class="deliver-select" name="country"></select>
            <select id="xiang" name="address1[street]" ></select>
          </div>
          <!-- <div class="deliver-sel-wrap fn-relative">
            <select id="selProvince" class="deliver-select" name="province"><option value="-1">请选择</option>
          </select>
          </div>
          <div class="deliver-sel-wrap fn-relative">
            <select id="selCity" class="deliver-select" name="city"><option value="-1">请选择</option>
          </select>
          </div> -->
          <div class="deliver-ipt-wrap fn-relative">
            <input id="rcvAddress" class="deliver-input" name="address" type="text" placeholder="请填写具体街道信息">
          </div>
        </div>
<!--       </form> -->
<script>initLocation({sheng_val:sheng,shi_val:shi,xian_val:xian});</script>
        <div class="deliver-info-unit">
          <label class="deliver-tooltip" for="rcvTel">优惠码</label>
          <input id="rcvTel" class="deliver-input" name="youhuima" type="text" placeholder="请输入优惠码">
        </div>
        <div id="invoice" class="invoice">
        <h3 class="order-title">发票信息</h3>
        <div class="invoice-category-box clearfix">
          <div class="invoice-choose-uncurrent j-invoice-none invoice-choose-current">不开发票</div>
          <div class="invoice-choose-uncurrent j-invoice-normal">普通发票<span class="invoice-info-box j-normal-info" style="display: none;">明细 :<span class="j-invoice-normal-info">个人</span></span></div>
          <div class="invoice-choose-uncurrent j-invoice-vat">增值税发票<span class="invoice-info-box j-vat-info">明细 :<span class="j-invoice-vat-info"></span></span></div>
        </div>
      </div>
	  
      <!-- 余额显示与使用 -->
      </div>

    <!-- 总计栏 -->
    <div class="total-box">
      <p class="category">金额合计：<span id="productMoney" class="rmb">1888.00</span></p>
      <p class="category fn-hide" style="display: none;">优惠券抵扣：<span id="couponMoney" class="rmb"></span></p>
      <p class="category fn-hide" style="display: none;">余额支付：<span id="balanceMoney" class="rmb"></span></p>
      <p class="category">运费：<span id="shiptMoney">顺丰免邮</span></p>
      <span class="category">应付总额：<b id="finalPrice" class="final-price rmb">1888.00</b></span>
      <button id="buyConfirm" class="order-buy-btn" type="submit" >确认订单</button>
      <input type="hidden" name='fapiao' value="" id="fapiao">
    </div>




<!--/* @Author: @vijay   @DateTime: 2016-06-02 15:49:24   @Description: 发票重构 */-->
    <div id="invoice-status" data-category="0">
      <div class="invoice-normal-wrap">
        <div class="invoice-comm-title">普通发票</div>
        <div id="fm-invoice-normal" class="invoice-normal-fm">
          <div class="invoice-choose"><label>发票抬头 :</label><span class="invoice-choose-uncurrent invoice-choose-current">个人</span><span class="invoice-choose-uncurrent j-choose-company">单位</span></div>
          <div class="invoice-company-box invoice-normal-error">单位名称 :<input type="text" name="companyName" class="invoice-normal-company"></div>
          <div class="invoice-normal-btn"><input type="button" class="invoice-normal-submit" value="保存"><input type="button" class="invoice-normal-cancel" value="取消"></div>
        </div>
      </div>

      <div class="invoice-vat-wrap">
        <div class="invoice-comm-title">增值税发票</div>
        <div class="invoice-vat-step"><span class="invoice-vat-step1 invoice-vat-step-current">填写公司信息</span><span class="invoice-vat-step2">填写收票人信息</span></div>
        <div class="invoice-vat-fm invoice-vat-fm-step-one" id="invoice-vat-fm" novalidate="novalidate">
          <div>
            <p><span>单位名称：</span><input type="text" name="vat_companyName" data="companyName" class="j-invoice-vat-company"></p>
            <p><span>纳税人识别码：</span><input type="text" name="vat_code" data="taxpayerCode"></p>
            <p><span>注册地址：</span><input type="text" name="vat_address" data="registerAddress"></p>
            <p><span>注册电话：</span><input type="text" name="vat_tel" data="registerNumber"></p>
            <p><span>开户银行：</span><input type="text" name="vat_bank" data="registerBank"></p>
            <p><span>银行账户：</span><input type="text" name="vat_bank_num" data="bankAccount"></p>
            <div class="invoice-vat-btn">
              <input type="button" class="invoice-vat-next" value="下一步">
              <input type="button" class="invoice-vat-cancel" value="取消">
            </div>
          </div>
        </div>
        <div class="invoice-vat-fm invoice-vat-fm-step-two" id="invoice-vat-fm-two" novalidate="novalidate">
          <div>
            <p><span>收票人姓名：</span><input type="text" name="vat_name" data="invoiceTakerName"></p>
            <p><span>收票人手机：</span><input type="text" name="vat_message_tel" data="invoiceTakerPhone"></p>
            <p class="inv-error-box"><span>收票人省份：</span>
            <select class="inv-selProvince" name="vat_province" id="sheng1"></select>
            <select class="inv-selCity" name="vat_city" id="shi1"></select>
            <select class="inv-selCity" name="vat_country" id="xian1"></select>
            <select id="xiang1" name="address1[street]" ></select>
            </p>
            <p><span>详细地址：</span><input type="text" id="" name="vat_receive_address" class="vat-receive-address"></p>
            <div class="invoice-vat-btn">
            <input type="button" class="invoice-vat-over" value="完成">
            <input type="button" class="invoice-vat-cancel" value="取消"><span class="invoice-vat-pre">返回上一步</span></div>
          </div>
        </div>
      </div>
    </div>
    <script>initLocation1({sheng_val:sheng1,shi_val:shi1,xian_val:xian1});</script>
    <!--发票系统结束-->







</form>

  <script>
  function run(){
    var name = $('[name=name]').val();
    var mobile = $('[name=mobile]').val();
    var country = $('[name=country]').val();
    var address = $('[name=address]').val();
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
  }
  </script>

  <input type="hidden" id="page_no_cache" data-description="magic_methon_dont_touch_me_fuck_x5" value="yes">
<?php $this->display('footer','lib') ?>
<script>
  var _hmt = _hmt || [];
  _hmt.push(['_setCustomVar', 1, 'uid', uid, 1]);
  _hmt.push(['_setCustomVar', 2, 'userStatus', userStatus, 1]);
  (function() {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?08b920c492d69aa3ea81852effbff71a";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
  })();
</script>
<script> 
    (function(a,b,c,d,e){ 
        var s= b.createElement(c);s.async=1;s.src='//t.agrantsem.com/tg.js?c='+d+'&t='+e; 
        var r= b.getElementsByTagName(c)[0];r.parentNode.insertBefore(s,r); 
    })(window,document,'script','AG_863614_EAHA','1'); 
</script> 
 <script src="/public/user1/register.js"></script>
  <script src="/public/user1/login.js"></script>
  <script src="/public/user1/loginAndRegister.js"></script>
  <script src="/public/user1/invoice.js"></script>
  <script src="/public/user1/productCart.js"></script>
  <script src="/public/user1/cities.min.js"></script>
  <script src="/public/user1/component_cities.js"></script>
  <script> 
    $(function(){
      // 谷歌分析
      /*ga('set', 'contentGroup1', '购物流程-购物车');
      ga('send', 'pageview');*/

      window.Fn.initCitiesSelect({
          proEl: $('#selProvince'),
          cityEl: $('#selCity')
      });

      /*window.Fn.initCitiesSelect({
          proEl: $('.inv-selProvince'),
          cityEl: $('.inv-selCity')
      });*/

/*      common.pageNoCache();*/
      productBuy.buyPage();

    });
  </script>

<img src="/public/user1/pv" style="display: none; width: 0px; height: 0px;"></body></html>
<style>
.deliver-select{color:#999;text-indent:10px;}
</style>