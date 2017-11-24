<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>mysql语句</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>mysql语句</p></div>
  <form action="<?php echo U('Mysql/runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>mysql语句</td>
      <td>
        <input name="sql" type="text" value=''/></td>
    </tr>
    <tr>
      <td>我的工号</td>
      <td>
        <input name="str" type="text" value=''/></td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="id" value="<?php if(isset($field['id'])){echo $field['id'];} ?>" />
  </div>
  </form>
</div>
</body>
</html>