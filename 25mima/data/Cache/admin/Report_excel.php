<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>导入数据</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>导入数据</p></div>
  <form action="/data/excel/b.php" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>文件：</td>
      <td><input name="file[1]" type="file" value=''/></td>
    </tr>
    <tr>
      <td>文件：</td>
      <td><input name="file[2]" type="file" value=''/></td>
    </tr>
    <tr>
      <td>文件：</td>
      <td><input name="file[3]" type="file" value=''/></td>
    </tr>
    <tr>
      <td>文件：</td>
      <td><input name="file[4]" type="file" value=''/></td>
    </tr>
    <tr>
      <td>文件：</td>
      <td><input name="file[5]" type="file" value=''/></td>
    </tr>
    <tr>
      <td>文件：</td>
      <td><input name="file[6]" type="file" value=''/></td>
    </tr>
    <tr>
      <td>文件：</td>
      <td><input name="file[7]" type="file" value=''/></td>
    </tr>
    <tr>
      <td>文件：</td>
      <td><input name="file[8]" type="file" value=''/></td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="code" value="<?php if(isset($GLOBALS['code'])){echo $GLOBALS['code'];} ?>">
  </div>
  </form>
</div>
</body>
</html>
<style>
  #image{max-width:80%;}
</style>