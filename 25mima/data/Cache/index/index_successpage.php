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
<title>提示页面</title>
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
h3{font-size:16px;text-align:center}
h3 a{margin-left:22px;font-size:12px;color:#333;}
p{text-align:center}
</style>
<body>
<?php $this->display('index:Index:header','lib') ?>
<div id="header" style="width:1000px;">
    <div id="info">
        <h3>交易成功！</h3>
        <p>&nbsp;</p>
        <p><a href="/" style="margin-right:20px;">返回首页</a><a href="/user/Indent/index#binded">绑定采样盒</a></p>
       
    </div>
</div>


<?php $this->display('index:Index:footer','lib') ?>
</body>
</html>

