<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>绑定样本盒</title>
		<?php $this->display('css','lib') ?>
		<script src="/public/user1/functions.js" type="text/javascript"></script>
		<style>
			.check_con li {
				margin-bottom: 10px;
			}
			
			.cheack_icon {
				display: inline-block;
				width: 100px;
				height: 100px;
				border-radius: 100px;
				overflow: hidden;
				float: left;
				margin-right: 5px;
			}
			
			.cheack_icon1 {
				background: url(/public/wap1/images/check01.png) no-repeat;
				background-size: 100% 100%;
			}
			
			.cheack_icon2 {
				background: url(/public/wap1/images/check02.png) no-repeat;
				background-size: 100% 100%;
			}
			.ICP{position:absolute;bottom:0.5rem;right:0;}
			input.numinput1{width:20% !important;}
			input.numinput{width:5%; text-transform:uppercase;padding-left:5px !important;padding-right:0 !important; }
		</style>
		<script>
			$(function() {
				$('.cheack_sex').on('click', 'a', function() {
					$(this).children('input[type=radio]').attr('checked', 'checked');
					$(this).parent().siblings().find('input[type=radio]').removeAttr('checked', 'checked');
					$(this).css('color', '#FF8811');
					$(this).children('span').css('border', '2px solid #FF8811');
					$(this).parent().siblings().children('a').css('color', '#5A5655');
					$(this).parent().siblings().children('a').children('span').css('border', '0');
				});
				$('.check_save').click(function() {
					$('form[name=check_bill]').submit();
				})
			})
		</script>
	</head>

	<body style="background: #FFFFFF;">
		<?php $this->display('header','lib') ?>
		<section class="ui-container">
			<form method="post" name="check_bill" action="<?php echo U('/Index/runadd') ?>">
				<ul class="ui-row ui-whitespace check_con">
					<li class="ui-row ui-row-flex cheack_sex" style="height: 105px;line-height: 105px;color:#5A5655;">
						<div class="ui-col">性别：</div>
						<div class="ui-col ui-col-2">
							<a href="javascript:;" style="color: rgb(255, 136, 17);">
								<span class="cheack_icon cheack_icon1" style="border: 2px solid rgb(255, 136, 17);"></span>女
								<input type="radio" name="rcvSex" checked value="0" style="display: none;" />
							</a>
						</div>
						<div class="ui-col ui-col-2">
							<a href="javascript:;" style="color:#5A5655;">
								<span class="cheack_icon cheack_icon2"></span>男
								<input type="radio" name="rcvSex" value="1" style="display: none;" />
							</a>
						</div>
					</li>
					<li style=" color:red;font-size:.5em;" class="ui-row ui-list-text">
						您的检测报告将于我们收到您的样本后的10个工作日得出，请在收到提示短信后，登录www.23mima.com查看报告。
					</li>
					<li style="color: #585657;">
						<div class="ui-form ui-border-t">

							<div class="ui-form-item ui-form-item-pure ui-border-b">
								<input type="text" name="name" placeholder="请输入受检人姓名">
							</div>
							<div class="ui-form-item ui-form-item-r ui-border-b">
								<input type="text" name="identifier[0]" class="numinput"  maxlength="1" id="identifier1" onchange="checkcategroy()">-
								<input type="text" name="identifier[1]" class="numinput1 numinput"  maxlength="4" id="identifier2" onchange="checkcategroy()">-
								<input type="text" name="identifier[2]" class="numinput1 numinput" maxlength="4" id="identifier3" onchange="checkcategroy()">
								<button type="button" class="ui-border-l" style="color:#585657;">怎么找到编号</button>
							</div>
							<div class="ui-form-item ui-form-item-pure ui-border-b">

								<span class="iPrompt sel_wrap">出生日期:</span>
								<div class="sel_wrap">
								<select id="selYear" name='year'></select></div>
								<div class="sel_wrap">
								<select id="selMonth" name='month'></select></div>
								<div class="sel_wrap">
								<select id="selDay" name='day'></select></div>

								<style>
								.ui-form-item .sel_wrap{float:left;margin-right:4px;}
								</style>
							</div>
							<div class="ui-form-item ui-form-item-pure ui-border-b" id="hight" style="display:none">
								
								<input type="text" name="high" placeholder="身高(cm)">
							</div>
							<div class="ui-form-item ui-form-item-pure ui-border-b" id="weight"  style="display:none">
								
								<input type="text" name="weight" placeholder="体重(kg)">
							</div>
							<span style="font-size: .5em;width:100%;">已授权DNA样本保存</span>
							<span style="font-size: .5em;width:100%"><input type="checkbox" checked />确认并阅读<a href="/content_34.html">《使用协议》</a></span>
						</div>
					</li>
				</ul>
			</form>
		</section>
		<div class=" ui-footer-stable ui-btn-group ui-border-t">
			<input type="hidden" name='id' value="<?php if(isset($field['id'])){echo $field['id'];} ?>">
			<button class="ui-btn-lg ui-btn-primary" style='margin-right:20px;margin-left:10px;' id="scanQRCode1">扫码获取编码</button>
			<button class="ui-btn-lg ui-btn-primary check_save">保存</button>
		</div>
		<!--扫一扫-->
		<?php $this->display('index:Index:jssdk','lib') ?>
		
		<script > document.querySelector('#scanQRCode1').onclick = function () {
    wx.scanQRCode({
      needResult: 1,
      desc: 'scanQRCode asc',
      success: function (res) {
        //alert(JSON.stringify(res));
		var code=res.resultStr.split(",");;
		var msg=res.errMsg.split(":");;
		var json_str=JSON.stringify(res);
		//var json_array=eval('('+json_str+')');
		$('input[name="identifier"]').val('');
		if(msg[1]=='ok'){
			var str=code[1].split('-')
			$('input[name="identifier[0]"]').val(str[0]);
			$('input[name="identifier[1]"]').val(str[1]);
			$('input[name="identifier[2]"]').val(str[2]);
		}
		checkcategroy();
      }
    });
  };</script>
		<!---->
	<?php $this->display('footer','lib') ?>
	</body>

</html>
<script>
/*$('.rcvNumber').keypress(function(e){
	var keycode = e.which ? e.which : e.keyCode;
	//alert(keycode);
	//if(keycode != 8 && (keycode < 48 || keycode > 59)){
	if(keycode != 8 && (keycode < 48 || keycode > 122 || (keycode>58 && keycode<65))){
		return false;
	}
	if( keycode != 8 && (e.target.value.length  == 1 || e.target.value.length  == 6 || e.target.value.length  == 11)){
		e.target.value += '-';
	}
});*/

</script>
<script type="text/javascript" src="/public/user1/productBind.js"></script>
<script type="text/javascript">
	$(function () {
  		var detecionPerson = {};
  			var myDate = new Date();

		$("#dateSelector").DateSelector({
	    ctlYearId: 'selYear',
	    ctlMonthId: 'selMonth',
	    ctlDayId: 'selDay'
		});

		cusSelect();
		$('#selYear').val(new Date().getFullYear());

  });
</script>
<script type="text/javascript">
		function checkcategroy(){
			var num1=$('#identifier1').val();
			var num2=$('#identifier2').val();
			var num3=$('#identifier3').val();
			var str=num1+'-'+num2+'-'+num3;
			$.post('/user/index/checkcategroy',{'code':str},function(e){
				if(e.status==1){
					$("#hight").fadeIn();
					$("#weight").fadeIn();
				}else{
					$("#hight").css('display','none');
					$("#weight").css('display','none');
				}
			},'json');
		}
		checkcategroy();
	</script>