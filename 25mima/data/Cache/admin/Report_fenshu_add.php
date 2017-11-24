<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加基因值</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加基因值</p></div>
  <form action="<?php echo U('Report/fenshu_runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>名称：</td>
      <td><input name="name" type="text" value='<?php if(isset($field['name'])){echo $field['name'];} ?>'/></td>
    </tr>
    <tr>
      <td>分值：</td>
      <td><input name="sum" type="text" value='<?php if(isset($field['sum'])){echo $field['sum'];} ?>'/></td>
    </tr>
    <tr>
      <td>描述：</td>
      <td><input name="description" type="text" value='<?php if(isset($field['description'])){echo $field['description'];} ?>'/></td>
    </tr>
    <tr>
      <td>生物学功能描述：</td>
      <td><input name="secdes" type="text" value='<?php if(isset($field['secdes'])){echo $field['secdes'];} ?>'/></td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="id" value="<?php if(isset($field['id'])){echo $field['id'];} ?>" />
      <input type="hidden" name="pid" value="<?php if(isset($_GET['pid'])){echo $_GET['pid'];} ?>" />
      <input type="hidden" name="code" value="<?php if(isset($GLOBALS['code'])){echo $GLOBALS['code'];} ?>">
  </div>
  </form>
</div>
</body>
</html>
<style>
  #image{max-width:80%;}
</style>