<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php $this->display('index:Index:css','lib') ?>
<link rel="stylesheet" href="/public/user1/reset.css" type="text/css">
<link rel="stylesheet" href="/public/user1/style.css" type="text/css">

<script charset="utf-8" src="/public/user1/v.js"></script>

<script src="/public/user1/hm.js"></script>


<script src="/public/user1/jquery.min.js" type="text/javascript"></script>
<script src="/public/user1/jquery.plugins.min.js" type="text/javascript"></script>
<script src="/public/user1/functions.js" type="text/javascript"></script>
<script src="/public/user1/common.js" type="text/javascript"></script>
<script src="/public/user1/widget.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="/res/desktop/plugin/selectivizr.min.js"></script>
<script src="/res/desktop/plugin/html5shiv.min.js"></script>
<![endif]-->


<title>唾液盒绑定</title>
</head>
<body>
	<link rel="stylesheet" href="/public/user1/nav.css">
  <!-- 用户菜单 -->
  <?php $this->display('index:Index:header','lib') ?>
<div class="mainContent">
		<div class="infoBinding mt20 container">

			<div class="newBind" id="newBind">
				<form method="post" novalidate="novalidate" action="<?php echo U('/Index/runadd') ?>">
					<h2>填写信息<span id="modifyTip"><i class="iCue"></i>您的检测报告将在我们收到回寄之后的10个工作日左右给出；基因检测报告出来以后，性别与出生日期不可更改。</span></h2>
					<div class="rcvSex" id="rcv-sex-detection">
						<span class="iPrompt">受检人性别</span>
						<label for="rcvMale" class="rcvMale"><i></i>男士</label>
						<label for="rcvFamale" class="rcvFamale"><i></i>女士</label>
						<input type="radio" name="rcvSex" id="rcvMale" value="1">
						<input type="radio" name="rcvSex" id="rcvFamale" value="0">
					</div>
					<div>
						<span class="iPrompt">受检人姓名</span>
						<input style="width:100px;height:32px;" type="text" placeholder="请输姓名" class="rcvName" name="name"><label for="name" generated="true" class="error" style="display: inline;">This field is required.</label>
					</div>
					<div>
						<span class="iPrompt">编号</span>
						<input type="text" style="width:40px;height:32px;" maxlength="1" class="rcvNumber" id="identifier1" name="identifier[]">-
						<input type="text" style="width:90px;height:32px;" maxlength="4" class="rcvNumber" id="identifier2" name="identifier[]">-
						<input type="text" style="width:90px;height:32px;" maxlength="4" class="rcvNumber" id="identifier3" name="identifier[]"  onblur="checkcategroy()">
						<a href="javascript:;" id="getNum" class="getNum">怎么找到编号？</a>
						<img class="fn-right numPic" src="/public/user1/getNum.png">
					</div>
					<div id="datePick" class="datePick">
						<span class="iPrompt">出生日期</span>

						<div class="sel_wrap"><label>1980</label>
            <select id="selYear" name='year'></select></div>
						<div class="sel_wrap"><label>5</label>
            <select id="selMonth" name='month'></select></div>
						<div class="sel_wrap"><label>1</label>
            <select id="selDay" name='day'></select></div>

					</div>
					<div id="hight" style="display:none">
						<span class="iPrompt">身高</span>
						<input type="text" style="width:40px;" maxlength="3" class="rcvNumber"  name="high" >
						cm
					</div>
					<div id="weight" style="display:none">
						<span class="iPrompt">体重</span>
						<input type="text" style="width:40px;" maxlength="3" class="rcvNumber"  name="weight" >
						kg
					</div>
					
			<div >
				<span class="iPrompt"></span><input type="checkbox" checked />确认并阅读<a target="_blank" href="/content_34.html">《使用协议》</a>
			</div>
          <input type="hidden" name='id' value="<?php if(isset($field['id'])){echo $field['id'];} ?>">
					<button class="saveBtn" type="submit" >保存</button>
				</form>
			</div>
		</div>
	</div>


	<div id="numPomp">
		<div class="box-title">
			<h2>信息提示</h2>
		</div>
		<div class="box-main">
			<h3>编号在采集器瓶身位置</h3>
			<p>请根据您的采集器的编号，填入编号的输入框完成绑定。<br>编号由数字和“-”组成，格式为：x-xxxx-xxxx。</p>
			<img src="/public/user1/getNum.png" width="300" height="300" alt="编号所在位置">
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
<script type="text/javascript" src="/public/user1/productBind.js"></script>
	<script type="text/javascript">
		$(function () {
      <?php if(empty($field)){ ?>
			var detecionPerson = {};
      <?php }else{ ?>
      var detecionPerson = {"birthday":"<?php if(isset($field['birthtime1'])){echo $field['birthtime1'];} ?>","sex":"<?php if(isset($field['rcvSex'])){echo $field['rcvSex'];} ?>","name":"<?php if(isset($field['name'])){echo $field['name'];} ?>","barCode":"<?php if(isset($field['identifier'])){echo $field['identifier'];} ?>"};
      <?php } ?>
			var myDate = new Date();

			$("#dateSelector").DateSelector({
		    ctlYearId: 'selYear',
		    ctlMonthId: 'selMonth',
		    ctlDayId: 'selDay'
			});

			cusSelect();
			productBind.init(detecionPerson);
	  });
	</script>
	<script type="text/javascript">

		function checkcategroy(){
			var num1=$('#identifier1').val();
			var num2=$('#identifier2').val();
			var num3=$('#identifier3').val();
			var str =num1+'-'+num2+'-'+num3;
			$.ajax({
				type: 'POST',
				url: '/user/index/checkcategroy',
				data:{'code':str},
				dataType: "json",
				success:function(e){
					//console.log(e);
					if(e.status==1){
						$("#hight").show();
						$("#weight").show();
					}else{
						$("#hight").hide();
						$("#weight").hide();
					}
				}
				

			});
		}
	//checkcategroy();
	</script>


<img src="/public/user1/pv" style="display: none; width: 0px; height: 0px;"></body></html>