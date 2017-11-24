<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代
	    $conf = require('../../include/config.inc.php');//引入配置文件
        include('../../include/diy_mysql.class.php');
        
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
	//商户订单号

	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号

	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];

	//判断是否有退款
    if( !empty($_POST['refund_status']) ){
    	$refund_status = $_POST['refund_status'];
    	if($refund_status=='WAIT_SELLER_AGREE'){
    		$sql = 'update '.$conf['DB_PREFIX'].'indent set refund_status=1 where indent='.$out_trade_no;
       		$r = mysql_query($sql);
       		email('退款');
       		echo "success";
    	}else if($refund_status=='WAIT_BUYER_RETURN_GOODS' or $refund_status=='WAIT_SELLER_CONFIRM_GOODS'){
    		$sql = 'update '.$conf['DB_PREFIX'].'indent set refund_status=3 where indent='.$out_trade_no;
       		$r = mysql_query($sql);
       		echo "success";
    	}
    	else if($refund_status=='REFUND_SUCCESS'){
    		$sql = 'update '.$conf['DB_PREFIX'].'indent set refund_status=2 where indent='.$out_trade_no;
       		$r = mysql_query($sql);
       		echo "success";
    	}
    }
	if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
	//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
		$sql = 'update '.$conf['DB_PREFIX'].'indent set type=0,WIDtrade_no="'.$_POST['trade_no'].'" where indent='.$out_trade_no;
        $r = mysql_query($sql);
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
			
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
	else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
	//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
		$sql = 'update '.$conf['DB_PREFIX'].'indent set type=1 where indent='.$out_trade_no;
        $r = mysql_query($sql);
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
		email('下单');
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
	else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS'){
	//该判断表示卖家已经发了货，但买家还没有做确认收货的操作
		$sql = 'update '.$conf['DB_PREFIX'].'indent set type=2 where indent='.$out_trade_no;
        $r = mysql_query($sql);
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
			
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
	else if($_POST['trade_status'] == 'TRADE_FINISHED') {
	//该判断表示买家已经确认收货，这笔交易完成
		$sql = 'update '.$conf['DB_PREFIX'].'indent set type=3 where indent='.$out_trade_no;
        $r = mysql_query($sql);
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
			
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
    else {
		//其他状态判断
        echo "success";
        //调试用，写文本函数记录程序运行情况是否正常
        //logResult ("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
    
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	/*$a = array_keys($_POST);
	$b = implode(',',$a);
	logResult($b);
	logResult($sql);*/
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";
    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
function email($str){
	$uri = "http://alumduan.com/data/email/index.php";
	// 参数数组
	$data = array (
	        'address' => 'maeshe@163.com',
	        'title'   => rand(1,9999),
	        'FromName'=> rand(1,9999),
	        'body'    => '有一待处理订单'.$str.'、请去处理商品订单号'.$_POST['out_trade_no'].'支付宝交易号'.$_POST['trade_no']
	// 'password' => 'password'
	);
	 
	$ch = curl_init();
	// print_r($ch);
	curl_setopt ( $ch, CURLOPT_URL, $uri );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$return = curl_exec ($ch);
	curl_close ($ch);
}
?>