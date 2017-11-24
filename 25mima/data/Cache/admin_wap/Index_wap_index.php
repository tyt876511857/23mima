<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <script type="text/javascript" src="/Modules/admin/Tpl/public/js/jquery-1.9.1.min.js"></script>

    <title>扫一扫</title>
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
.order_sub2 {height:44px; margin:14px 5px; background:#999; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.order_sub3 {height:44px; margin:14px 5px;background:#e2cb04; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.order_sub4 {height:44px; margin:14px 5px; background:#18c0f7; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}

.order_main1 {height:30px;padding:10px;border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; background:#fff;text-align:center;margin-top:10px; }
.order_sub5 {height:30px; width:35%;padding:5px 10px 5px 10px; border:1px solid #ccc; border-radius:4px; text-align:center; font-size:16px; line-height:30px; color:#333; }
.order_sub6 {height:44px; margin:14px 5px; background:#07c4d0; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}

.order_subc {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
#scanQRCode1{position:fixed;bottom:0;width:100%;left:0;}
</style>
	<div id="container"><input type="hidden" id="orderid" value="719">
       <div class="page_topbar">
        <a href="javascript:;" class="back" ><i class="fa fa-angle-left"></i></a>
    </div>
    <div class="order_main" style="display:none">  
        <div class="line"><div class="label">编号</div><div class="info"><div class="inner" id="bianhao">111</div></div></div>
        <div class="line"><div class="label">状态</div><div class="info"><div class="inner" id="zhuangtai">2222</div></div></div>
        <form action="<?php echo U('Report/tuoye_runadd') ?>" method="post">
        <input type="hidden" name='id' id="id" value="">
        <input type="hidden" name='state' id="state" value="">
        <input type="submit" class="button order_sub2" id="submit" value="更改状态">
        </form>
    </div>
        
    <div class="button order_sub1" id="scanQRCode1">扫一扫</div>
    
    <!--扫一扫-->
		<?php $this->display('index:Index:jssdk','lib') ?>
		
		<script > document.querySelector('#scanQRCode1').onclick = function () {
    wx.scanQRCode({
      needResult: 1,
      desc: 'scanQRCode desc',
      success: function (res) {
        //alert(JSON.stringify(res));
		var code=res.resultStr.split(",");;
		var msg=res.errMsg.split(":");;
		var json_str=JSON.stringify(res);
		//var json_array=eval('('+json_str+')');
		$('input[name="identifier"]').val('');
		if(msg[1]=='ok'){
			$.post("<?php echo U('Index/zhuangtai') ?>",
			{
			name:code[1],
			},
			function(data,status){
				if(data!='false'){
					var data = eval('(' + data + ')'); 
					$('.order_main').css('display','block');
					$('#bianhao').html(code[1]);
					$('#zhuangtai').html(data.zt);
					$('#id').val(data.id);
					if(data.state<5){
						data.state=1+parseInt(data.state);
						$('#submit').css('display','block');
					}else{
						$('#submit').css('display','none');
					}
					$('#state').val(data.state);
				}else{
					alert('找不到编号');
				}
			

			});
		}
      }
    });
  };</script>
		<!---->
    
    
    
    
<!--     <div class="button order_subc" style="display:none">确认支付</div>
</div>
<br/>
<font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div> -->
</body>
</html>