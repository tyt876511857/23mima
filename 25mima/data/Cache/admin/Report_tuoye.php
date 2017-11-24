<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>绑定列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>绑定列表</p>
  </div>
  <div class="search" style="padding:15px">
  <form action="<?php echo U('report/tuoye') ?>" method='get'>
	<input type="text" name="keyword" />
	<select name="cid">
		<option value="">全部</option>
		<?php foreach ($catechanpin as $vo){ ?>
		<option value="<?php if(isset($vo['id'])){echo $vo['id'];} ?>"><?php if(isset($vo['name'])){echo $vo['name'];} ?></option>
		<?php } ?>
	</select>
	<select name="state">
		<option value="">全部</option>
		
		<option value="1">样本已到实验室</option>
		<option value="2">样本正在分析中</option>
		<option value="3">检测报告正在生成中</option>
		<option value="4">检测报告专家正在审核</option>
		<option value="5">样本报告已经发出</option>
		<option value="6">样本不合格，需再次取样检测</option>
		<option value="7">删除</option>
	</select>
	
	<button type="submit">搜索</button>
  </form>
  <a style=" height: 21px;line-height: 21px;padding: 0 11px;background: #ececec;border: 1px #aaaaaa solid;
    border-radius: 3px;display: inline-block;text-decoration: none;font-size: 12px;margin-top:-20px;outline: none;float: right;" href="<?php echo U('report/addtuoYeView') ?>" style="float: right;">添加报告</a>
  </div>
  <div class="shenhe" style="padding:15px">
	<form action="<?php echo U('report/tuoye') ?>" method='post'>
	<select name="status">
		<option value="1">样本已到实验室</option>
		<option value="2">样本正在分析中</option>
		<option value="3">检测报告正在生成中</option>
		<option value="4">检测报告专家正在审核</option>
		<option value="5">样本报告已经发出</option>
		<option value="6">样本不合格，需再次取样检测</option>
		<option value="7">删除</option>
	</select>
	
	<input type="hidden" name="ids" id="sh" />
	<button type="submit">批量审核</button>
	</form>
  </div>
  <table class="table" border="1" align="center" class="checkboxs">
    <tr>
      <td width="5%"><input type="checkbox" id="allchecked" />编号</td>
      <td width="10%">编码</td>
      <td width="10%">姓名</td>
	  <td width="10%">性别</td>
      <td width="10%">出生日期</td>
	  <td width="10%">电话</td>
	  <td width="10%">产品名称</td>
      <td width="10%">状态</td>
	  <td width="10%">绑定时间</td>
	  <td width="10%">备注</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><input type="checkbox" class="items" value='<?php if(isset($v['id'])){echo $v['id'];} ?>' /><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php if(isset($v['identifier'])){echo $v['identifier'];} ?></td>
        <td><?php if(isset($v['name'])){echo $v['name'];} ?></td>
		<td><?php if($v['rcvSex']==1){ echo '男';}else{ echo '女';} ?></td>
        <td><?php echo date('Y-m-d',$v['birthtime']) ?></td>
		<td><?php if(isset($v['username'])){echo $v['username'];} ?></td>
		<td><?php if(isset($v['cname'])){echo $v['cname'];} ?></td>
        <td><?php echo $tuoye_state[$v['state']];?></td>
		<td><?php echo date('Y-m-d',$v['time0']) ?></td>
		<td><?php if(isset($v['msg'])){echo $v['msg'];} ?></td>
        <td>
          <a href='<?php echo U("Report/tuoye_add/id/$v[id]") ?>' title="编辑">
            <img src="/Modules/admin/Tpl/public/images/icon_edit.gif" border="0" height="16" width="16" />
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
<script>

$(function() {  
    $("#allchecked").click(function() {
		
        if ($(this).prop('checked')) {  
            $(".items").each(function() {  
                $(this).prop("checked", true);  
            });  
        } else {  
            $(".items").each(function() {  
                $(this).prop("checked", false);  
            });  
        }  
		check();
    }); 

	$(".items").click(function(){
		check();
	});
      
});
function check(){
	var arr=new Array();
	var str='';
	var text="";  
	$(".items").each(function() {  
		if ($(this).prop('checked')) {  
			text += ","+$(this).val();  
			//alert($(this).parent().parent().index());
			//arr[$(this).parent().parent().index()-1]=$(this).val();
			arr.push($(this).val());
		}  
	});  
	str=arr.join(',');
	//alert(str);
	$('#sh').val(str)
}
</script>
</body>
</html>