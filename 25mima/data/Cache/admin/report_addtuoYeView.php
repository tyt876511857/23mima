<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加绑定列表</title>
<?php $this->display('css','lib') ?>
<script type="text/javascript" src="/public/artDialog/artDialog.js?skin=blue"></script>
<script type="text/javascript" src="/public/artDialog/dist/dialog-plus.js"></script>
<style type="text/css">
.a60 {
    width: 60%;
}
.inp {
    background: #fff;
    border: 2px solid #dce4ec;
    border-radius: 3px;
    height: 20px;
    line-height: 20px;
    padding: 4px;
    text-indent: 1px;
    margin-right: 10px;
}
input, button, textarea, select, optgroup, option {
    font-family: inherit;
    font-size: inherit;
    font-style: inherit;
    font-weight: inherit;
}
.tablist {
    color: #075587;
}
.tabtit td, .sltab .tabtit td {
    /*background: url(/static/images/liast.jpg) repeat-x 0 0;*/
    border: none;
    border-bottom: 2px solid #ddd;
    color: #075587;
    font-weight: bold;
    padding: 8px 2px;
    vertical-align: bottom;
}
.addtable tr {
    border: none 0px #fff;
    height: 50px;
}
.listPage a:hover {
    border: 1px solid #0ca6df;
    text-decoration: none;
}
.listPage a:visited {
    background: none repeat scroll 0 0 #f9f9f9;
    border: 1px solid #f9f9f9;
    color: #323232;
    display: block;
    float: left;
    height: 26px;
    line-height: 26px;
    margin: 0 2px;
    text-align: center;
    text-decoration: none;
    width: 30px;
}
.pages {
    float: right;
    padding-right: 20px;
}
.listPage a {
    background: none repeat scroll 0 0 #f9f9f9;
    border: 1px solid #f9f9f9;
    color: #767676 !important;
    display: block;
    float: left;
    font-weight: bold;
    height: 26px;
    line-height: 26px;
    margin: 0 2px;
    text-align: center;
    text-decoration: none;
    width: 30px;
}
.listPage .none {
    background: none repeat scroll 0 0 #23a1f2;
    border: 1px solid #23a1f2;
    color: #ffffff !important;
    font-weight: bold;
}
#next {
    height: 26px;
    width: 66px;
}
.tabcon td {
    border-bottom: 1px solid #d6dfe8;
    border-right: none;
    border-left: none;
    line-height: 22px;
    padding: 6px 4px;
    word-break: break-all;
}
.btn {
    width: 140px;
    height: 36px;
    line-height: 18px;
    font-size: 18px;
    color: #306c6f;
    padding-bottom: 4px;
}
</style>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加绑定列表</p></div>
 
  <form method="post" action="" enctype="multipart/form-data" name="theForm">
  <div id='tabs0'>
  <table class="addtable" border="0" align="center" >
    <tr>
      <td>编码号：</td>
      <td><input class="inp wid140" type="text" name="identifier" size="30" id="identifier" onkeyup="this.value = this.value.toUpperCase();"/>&nbsp;
            <span>*</span>
      </td>
    </tr>

     <tr>
      <td>姓名：</td>
      <td><input class="inp wid140" type="text" name="realname" size="30" id="realname" />&nbsp;
            <span>*</span>
      </td>
    </tr>
     </tr>

      <tr>
      <td><span class="iPrompt sel_wrap">出生日期:</span></td>
      <td>
		<input class="inp wid140" type="text" name="year" size="30" id="year" placeholder='年' />&nbsp;
		<input class="inp wid140" type="text" name="month" size="30" id="month"  placeholder='月'/>&nbsp;
		<input class="inp wid140" type="text" name="day" size="30" id="day"  placeholder='日'/>&nbsp;
      </td>
    </tr>
     </tr>


     <tr>
      <td>身高：</td>
      <td><input class="inp wid140" type="text" name="hight" size="30" id="hight" />&nbsp;
            <span>*</span>
      </td>
    </tr>

    <tr>
      <td>体重：</td>
      <td><input class="inp wid140" type="text" name="weight" size="30" id="weight" />&nbsp;
            <span>*</span>
      </td>
    </tr>

    <tr>
      <td>性别：</td>
      <td>
        <input type="radio"  name ="rcvSex" value="1" checked>男
		<input type="radio"  name ="rcvSex" value="0">女
        <span>*</span>
      </td>
    </tr>

    <tr>
      <td><input type="button" class ='btn' value="点击绑定手机" id="bindUser"/></td>
     <td> <input value="" class="inp wid140" readonly="" id="username" name="username" onclick="$('#bindUser').click()"><input type="hidden" name="uid" id="uid" value=""></td>
    </tr>
    
   
  </table>
  </div>
  
  
  
  <div style="margin: 0 27% 0;">
      <input type="button" class ='btn'  value=" 确定 " onclick="putvalue()"/>
      <input type="reset" class ='btn' value=" 重置 " />
      
  </div>
  </form>
</div>
</body>
</html>
<script type="text/javascript">
$(function() {  
	$( "#bindUser" ).click(
		function( event ) {
		   var content_dialog = '<div id="dialog" title="选择用户" style="width:600px"><input class="inp a60" type="text" name="user_keyword" id="user_keyword" value="请输入用户电话"onblur="if(this.value == \'\'){this.value = \'请输入用户电话\';}" onClick="if(this.value == \'请输入用户电话\'){this.value = \'\';}else {this.select();}" /><button class="cbtn_my" type="button" id="user_search">搜索</button><div class="tabcon tablist"  style="margin-top:5px" ><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr class="tabtit"><td width="10%">选择</td><td width="15%">用户名</td><td width="50%">电话</td><td width="20%">添加时间</td></tr></tbody><tbody id=\'moduletbody\'></tbody></table></div><div id="hidden_classroom_list" style="display:none"></div></div>';
		   dialog_choose_crid = window.art.dialog({
		        title: '用户选择',
		        content: content_dialog,
		        width: '600px',
		        lock:true,
		        opacity : 0.2
		       //   close:function(){window.location.reload();}
		    });
		    dialog_choose_crid.button([
		        {name: '关闭'}
		    ]);
		    $("#user_search").click(function() {
		        goPage(1);  
		    });
		    event.preventDefault();
		    goPage(1);
			$("#user_keyword").blur();
	}); 
});
function goPage(page)
{
    var user_keyword = $("#user_keyword").val();
    if (user_keyword == '请输入用户电话') user_keyword = '';
    $.post("/admin/Member/getUserList", {page: page, keyword: user_keyword},
        function(data){
            $("#moduletbody").html(data);
        }, "html");
}
function checkCrItem(uid, username)
{
    $('#username').val(username);
    $('#uid').val(uid);
    dialog_choose_crid.close();
}
function putvalue(){
	var identifier = $('#identifier').val();
	var uid = $('#uid').val();
	var realname = $('#realname').val();
	var username = $('#username').val();//手机号
	var weight = $('#weight').val();
	var hight = $('#hight').val();

	var year = $('#year').val();
	var month = $('#month').val();
	var day = $('#day').val();
	var rcvSex = $('input[name=rcvSex]:checked').val();
	if(identifier==false){
		alert('编码不能为空！');
	}
	if(uid==false){
		alert('数量不能为空！');
	}
	if(realname==false || realname==''){
		alert('用户名为空');
	}
	if(isNaN(uid)){
		alert('用户手机未帅选不正确！');
	}
	
	$.post("<?php echo U('/report/bindTuoYe') ?>",{'identifier':identifier,'username':username,'weight':weight,'high':hight,'uid':uid,'realname':realname,'year':year,'month':month,'day':day,'rcvSex':rcvSex},function(e){
		var status = e.code;
		var msg = e.msg;
		if(status==0){
			alert(msg);
			window.location.href='/admin/Report/tuoye';
		}else{
			alert(msg);
		}
	},'json');

}

</script>