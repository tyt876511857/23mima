<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加基因</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加基因</p></div>
  <form action="<?php echo U('Report/runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>名称：</td>
      <td><input name="name" type="text" value='<?php if(isset($field['name'])){echo $field['name'];} ?>'/></td>
    </tr>
    <tr>
      <td>描述：</td>
      <td><textarea name="description" cols="40" rows="8"><?php if(isset($field['description'])){echo $field['description'];} ?></textarea></td>
    </tr>
	<?php if($field['id'] == 4){?>
	 <tr>
      <td>简介：</td>
      <td><textarea name="cont1" cols="40" rows="8"><?php if(isset($field['cont1'])){echo $field['cont1'];} ?></textarea></td>
    </tr>
	<tr>
      <td>危害：</td>
      <td><textarea name="cont2" cols="40" rows="8"><?php if(isset($field['cont2'])){echo $field['cont2'];} ?></textarea></td>
    </tr>
	<tr>
      <td>高发期：</td>
      <td><textarea name="cont3" cols="40" rows="8"><?php if(isset($field['cont3'])){echo $field['cont3'];} ?></textarea></td>
    </tr>
	<tr>
      <td>主要原因：</td>
      <td><textarea name="cont4" cols="40" rows="8"><?php if(isset($field['cont4'])){echo $field['cont4'];} ?></textarea></td>
    </tr>
	<tr>
      <td>相关基因：</td>
      <td><textarea name="cont5" cols="40" rows="8"><?php if(isset($field['cont5'])){echo $field['cont5'];} ?></textarea></td>
    </tr>
	<tr>
      <td>减肥总建议：</td>
      <td><textarea name="cont6" cols="40" rows="8"><?php if(isset($field['cont6'])){echo $field['cont6'];} ?></textarea></td>
    </tr>
	<?php } ?>
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