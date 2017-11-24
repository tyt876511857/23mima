<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加标识</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加标识</p></div>
  <form action="<?php echo U('Report/identify_runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>名称：</td>
      <td><input name="name" type="text" value='<?php if(isset($field['name'])){echo $field['name'];} ?>'/></td>
    </tr>
    <tr>
      <td>描述：</td>
      <td><input name="title" type="text" value='<?php if(isset($field['title'])){echo $field['title'];} ?>'/></td>
    </tr>
    <tr>
      <td></td>
      <?php if(!empty($field)){ ?>
      <td><img src="/uploads/<?php if(isset($field['name'])){echo $field['name'];} ?>.png" class="img" alt=""></td>
      <?php }else{ ?>
      <td><img src="" class="img" alt=""></td>
      <?php } ?>
    </tr>
    <tr>
      <td></td>
      <td><a href="javascript:;" onclick='ewm()'>生成二维码</a></td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="id" value="<?php if(isset($field['id'])){echo $field['id'];} ?>" />
      <input type="hidden" name="code" value="<?php if(isset($GLOBALS['code'])){echo $GLOBALS['code'];} ?>">
  </div>
  </form>
</div>
</body>
</html>
<style>
  #image{max-width:80%;}
</style>
<script>
function ewm(){
  var name = $('[name="name"]').val();
  if(name == ''){
    alert('请先输入标识！');
    return false;
  }
  $.get("/index/Jsget/erweima"+'/url/'+name,function(){
      $('.img').attr('src','/uploads/'+name+'.png');
      //$('#share div').css('display','block');
    });
}
</script>