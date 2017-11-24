<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加编码</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加编码</p></div>
 
  <form method="post" action="" enctype="multipart/form-data" name="theForm">
  <div id='tabs0'>
  <table class="addtable" border="0" align="center" >
    <tr>
      <td>编码分类：</td>
      <td><input type="text" name="dh" size="30" id="dh" onkeyup="this.value = this.value.toUpperCase();"/>&nbsp;
            <span>*</span>
      </td>
    </tr>
	<tr>
      <td>产品名称：</td>
      <td><select name="cid"  id="cid" />
	  <?php foreach ($list as $vo){ ?>
			<option value="<?php if(isset($vo['id'])){echo $vo['id'];} ?>"><?php if(isset($vo['name'])){echo $vo['name'];} ?></option>
	<?php } ?>
			</select>
	  &nbsp;
            <span>*</span>
      </td>
    </tr>
    <tr>
      <td>生成数量：<br />&nbsp;</td>
      <td>
        <input type="text" name="num"  id="num"/>&nbsp;
        <span>*</span>
      </td>
    </tr>
    
   
  </table>
  </div>
  
  
  
  <div class="button-div">
      <input type="button" value=" 确定 " onclick="putvalue()"/>
      <input type="reset" value=" 重置 " />
      
  </div>
  </form>
</div>
</body>
</html>
<script type="text/javascript">
function putvalue(){
	var dh = $('#dh').val();
	var num = $('#num').val();
	var cid = $('#cid').val();
	//if(dh==false){
		//alert('编码分类不能为空！');
	//}
	if(num==false){
		alert('数量不能为空！');
	}
	if(isNaN(num)){
		alert('数量不正确！');
	}
	
	$.post("<?php echo U('/Code/post_add') ?>",{'dh':dh,'num':num,'cid':cid},function(e){
	
		var status = e.status;
		var info = e.info;
		if(status>0){
			alert(info);
			location.href="<?php echo U('/Code/index') ?>";
		}else{
			alert(info);
		}
	},'json');

}

</script>