<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';
//模式一
/**
 * 流程：
 * 1、组装包含支付信息的url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
 * 5、支付完成之后，微信服务器会通知支付成功
 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$notify = new NativePay();
//$url1 = $notify->GetPrePayUrl("123456789");

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
        /*加入数据库配置信息*/
        if(empty($_POST)){
        	echo '<script>alert("参数不正确");</script>';
        }
        $conf = require('../../../include/config.inc.php');//引入配置文件
        include('../../../include/diy_mysql.class.php');
        $sql = 'select *,i.id from '.$conf['DB_PREFIX'].'indent i left join '.$conf['DB_PREFIX'].'site s on i.site = s.id where i.indent='.$_POST['WIDout_trade_no'].' and i.type=0';
        $r = mysql_query($sql);
        $v = mysql_fetch_array($r);
        if(empty($v['id']) ){
        	echo '<script>alert("参数不正确");</script>';
        	die();
        }
        /*加入数据库配置信息*/

$input = new WxPayUnifiedOrder();
$input->SetBody("23密码");//商品名称
$input->SetAttach($_POST['WIDout_trade_no']);//附带信息
$input->SetOut_trade_no($_POST['WIDout_trade_no']);//商户订单号
$input->SetTotal_fee($v['price']*100);//价格以分为单位
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 6000));
$input->SetGoods_tag("test");//设置商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
$input->SetNotify_url("http://23mima.com/data/WxpayAPI/example/notify.php");
$input->SetTrade_type("NATIVE");
$input->SetProduct_id("123456789");//设置trade_type=NATIVE，此参数必传。此id为二维码中包含的商品ID，商户自行定义
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];
echo 'http://paysdk.weixin.qq.com/example/qrcode.php?data='.urlencode($url2);
?>