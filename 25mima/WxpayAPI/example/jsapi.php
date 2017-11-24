<?php 
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}
/*加入数据库配置信息*/
//开启 session

session_start();
if(empty($_SESSION['WIDout_trade_no']) ){
	echo '<script>alert("参数不正确");</script>';
	die();
}
$conf = require('../../../include/config.inc.php');//引入配置文件
include('../../../include/diy_mysql.class.php');
$sql = 'select *,i.id from '.$conf['DB_PREFIX'].'indent i where i.indent='.$_SESSION['WIDout_trade_no'].' and i.type=0';
$r = mysql_query($sql);
$v = mysql_fetch_array($r);
if(empty($v['id']) ){
	echo '<script>alert("参数不正确");</script>';
	die();
}


//①、获取用户openid
$tools = new JsApiPay();
if(empty($_SESSION['wx_openId'])){
	$_SESSION['wx_openId'] = $openId = $tools->GetOpenid();
}else{
	$openId = $_SESSION['wx_openId'];
}

//print_r($_SESSION);

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody('23mima');//商品名称
$input->SetAttach($_SESSION['WIDout_trade_no']);//附带信息
$input->SetOut_trade_no($_SESSION['WIDout_trade_no']);//商户订单号
$input->SetTotal_fee($v['price']*100);//价格以分为单位
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 6000));
$input->SetGoods_tag("test");//设置商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
$input->SetNotify_url('http://23mima.com/data/WxpayAPI/example/notify.php');
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);//设置trade_type=NATIVE，此参数必传。此id为二维码中包含的商品ID，商户自行定义
//print_r($input);
$order = WxPayApi::unifiedOrder($input);
//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
//printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);

//获取共享收货地址js函数参数
//$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>支付订单</title>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				if(res.err_msg=='get_brand_wcpay_request:ok'){
					<?php
						if(empty($_SESSION['user_userid']) ){
							echo("window.location.href='/index/Index/loginurl';");
						}else{
							echo("window.location.href='/user/Indent/index';");
						}
					?>
				}
				//alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
	<script type="text/javascript">
	//获取共享地址
	function editAddress()
	{
/*		WeixinJSBridge.invoke(
			'editAddress',
			<?php echo $editAddress; ?>,
			function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;
				
				alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);*/
	}
	
	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress); 
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};
	
	</script>
</head>
<body>
	<style type="text/css">
    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;}
.order_main {height:auto; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; background:#fff;margin-top:10px;}
.order_main .line {height:44px; margin:0 5px; border-bottom:1px solid #f0f0f0; line-height:44px;}
.order_main .line .label { float:left;width:80px;}
.order_main .line .info { float:right; width:100%; margin-left:-85px;text-align: right;overflow:hidden;height:44px;}
.order_main .line .info .inner { color:#666;margin-left:85px;}
.order_main .tip { color:#666; line-height:20px;padding:5px;font-size:13px; }
 
  .order_main .line .nav {height:22px; width:40px; background:#ccc; margin:10px 0px; float:right; border-radius:40px;}
.order_main .line .on {background:#4ad966;}
.order_main .line .nav nav {height:20px; width:20px; background:#fff; margin:1px; border-radius:20px;}
.order_main .line .nav .on {margin-left:19px;}

.order_sub1 {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.order_sub2 {height:44px; margin:14px 5px; background:#f49c06; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.order_sub3 {height:44px; margin:14px 5px;background:#e2cb04; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.order_sub4 {height:44px; margin:14px 5px; background:#18c0f7; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}

.order_main1 {height:30px;padding:10px;border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; background:#fff;text-align:center;margin-top:10px; }
.order_sub5 {height:30px; width:35%;padding:5px 10px 5px 10px; border:1px solid #ccc; border-radius:4px; text-align:center; font-size:16px; line-height:30px; color:#333; }
.order_sub6 {height:44px; margin:14px 5px; background:#07c4d0; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}

.order_subc {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
</style>
	<div id="container"><input type="hidden" id="orderid" value="719">
       <div class="page_topbar">
        <a href="javascript:;" class="back" ><i class="fa fa-angle-left"></i></a>
    </div>
    <div class="order_main">  
        <div class="line"><div class="label">订单编号</div><div class="info"><div class="inner"><?php echo $v['indent'];?></div></div></div>
        <div class="line"><div class="label">支付金额</div><div class="info"><div class="inner"><div style="color:#ff6600">￥<span id="orderprice" price="0.50"><?php echo $v['price'];?></span>元</div></div></div></div>
    </div>
        
    <div class="button order_sub1" onclick="callpay()">微信支付</div>
    
    
    
    
    
    
<!--     <div class="button order_subc" style="display:none">确认支付</div>
</div>
<br/>
<font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div> -->
</body>
</html>