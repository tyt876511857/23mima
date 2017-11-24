<?php
/* *
 * 功能：支付宝纯担保交易接口接口调试入口页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 */

?>
<html>
<head>
<title>交易平台</title>
<meta http-equiv='Content-Type' content='text/html';charset='utf-8'>
<?php $this->display('index:Index:css','lib') ?>
<?php $this->display('css','lib') ?>
</head>
<style>
.w980{width:980px;margin:10px auto;}
#header #info{padding:20px;border:solid 1px #ddd;background:#fafafa;margin:10px 0;}
#header #info p{line-height:24px;font-size:14px;}
#box{display:block;clear:both;}
#box img{float:left;}
.mls-btn{display:block;float:left;width:120px;height:30px;line-height:30px;font-size:14px;background:#666;border:0;color:#fff;cursor: pointer;margin:14px 26px;}
h3{font-size:16px;}
h3 a{margin-left:22px;font-size:12px;color:#333;}
</style>
<body>
<?php $this->display('index:Index:header','lib') ?>
<div id="header" style="width:1000px;">
    <div id="info">
        <h3>下单成功！</h3>
        <p>&nbsp;</p>
        <p>业务单号：<?php if(isset($data['indent'])){echo $data['indent'];} ?></p>
        <p>应支付总金额：<?php if(isset($data['price'])){echo $data['price'];} ?>元</p>
    </div>
</div>
<h3 class="w980">平台支付</h3>
<div id="box" class="w980">
<!-- <div id="radio">
  <img src="/public/user/imgservice.jpg" class="li2" onclick="zf_radio(0)">
  <img src="/public/user/wjpg.jpg" onclick="zf_radio(1)">
</div> -->
<style>
#radio img:first-child{margin-right:40px;}
#radio img{filter: alpha(opacity=50) Gray;-webkit-filter: grayscale(100%);opacity:0.5;}
#radio .li2{filter: alpha(opacity=100);-webkit-filter: grayscale(0%);opacity:1; }
</style>
<form name='alipayment' action='/data/alipay/alipayapi.php' method='post'>
    <input size="30" name="WIDout_trade_no" type="hidden" value="<?php if(isset($data['indent'])){echo $data['indent'];} ?>" />
    <input size="30" name="WIDprice" type="hidden" value="<?php if(isset($data['price'])){echo $data['price'];} ?>" />
    <!-- <img src="/public/user/imgservice.jpg"> -->
    <button type="submit" class="mls-btn zf_radio0"></button>
</form>
<form onsubmit="return false">
    <!-- <img src="/public/user/wjpg.jpg"> -->
    <button  class="mls-btn zf_radio1" id="wxsm"></button>
    <img src="" id="wxewm">
    <p class='zhifu' style="display:none;">扫码支付</p>
</form>
</div>
<style>
.mls-btn{width:164px;height:60px;}
.zf_radio0{background:url(/public/user/imgservice.jpg);}
.zf_radio1{background:url(/public/user/wjpg.jpg);}
</style>
<script>
$("#wxsm").click(function(){
  $.post("/data/WxpayAPI/example/native.php",
  {
    WIDout_trade_no:<?php if(isset($data['indent'])){echo $data['indent'];} ?>
  },
  function(data,status){
    $('#wxewm').attr('src',data);
    $('.zhifu').css('display','block');
  });
});
function zhifu(){
  $.post("<?php echo U('/Alipay/zhifu') ?>",
  {
    indent:<?php if(isset($data['indent'])){echo $data['indent'];} ?>
  },
  function(data,status){
    if(data>0){
       window.location.href="<?php echo U('Alipay/zhifusuccess') ?>"; 
    }
  });
}
var interval = 5000;
var start = setInterval("zhifu()",interval);
//选择支付方式
function zf_radio(i){
  $('#radio img').removeClass('li2');
  $('#radio img:eq('+i+')').addClass('li2');
  $('.mls-btn').css('display','none');
  $('.zf_radio'+i).css('display','block');
}
</script>
</body>
</html>

